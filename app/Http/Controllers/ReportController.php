<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Report;
use App\Trip;
use App\Comment;
use App\User;
use App\Media;
use App\Helper;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resolved = 'all';
        $type = 'all';

        if($request->resolved){
            $resolved = $request->resolved;
        }

        if($request->type){
            $type = $request->type;
        }

        if ($resolved === 'no'){
            $reports = Report::where('resolved', false);
        }
        elseif ($resolved === 'yes'){
            $reports = Report::where('resolved', true);
        }
        else{
            $reports = Report::with('complaint');
        }

        if($type != 'all'){
            $reports = $reports->where('complaintable_type', $type);
        }

        $reports = $reports->paginate(15);
        return view('admin.report.index', ['reports' => $reports, 'resolved' => $resolved, 'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->user()->isUserComplained($request->complaintable_id, $request->complaintable_type)){
            $report = new Report();
            $report->complaint_id = $request->complaint;
            $report->complaintable_id = $request->complaintable_id;
            $report->complaintable_type = $request->complaintable_type;
            $report->user_id = $request->user()->id;
            $report->save();
        }
        return redirect()->back()->with('report', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        

        if ($report){
            $reported = null;
            
            if($report->complaintable_type == 'trip')
                $reported = Trip::withTrashed()->find($report->complaintable_id);

            if($report->complaintable_type == 'comment')
                $reported = Comment::withTrashed()->find($report->complaintable_id);
            
            if($report->complaintable_type == 'user')
                $reported = User::withTrashed()->find($report->complaintable_id);

            if($report->complaintable_type == 'media')
                $reported = Media::withTrashed()->find($report->complaintable_id);

            return view('admin.report.show', ['report' => $report, 'reported' => $reported]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resolve($id){
        
        $report = Report::find($id);
        
        if($report){
            $report->resolved = true;
            $report->update();

            $helper = new Helper();
            $helper->createHistory($id, 'resolved');

            return redirect()->back()->with('resolved', true);
        }

        return redirect()->back()->with('resolved', false);
    }

    public function unresolve($id){
        
        $report = Report::find($id);
        
        if($report){
            $report->resolved = false;
            $report->update();

            $helper = new Helper();
            $helper->createHistory($id, 'unresolved');

            return redirect()->back()->with('unresolved', true);
        }

        return redirect()->back()->with('unresolved', false);
    }
}
