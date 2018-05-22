<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Report;
use App\Trip;
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
        if($request->resolved){
            $resolved = $request->resolved;
        }
        else{
            $resolved = 'all';
        }

        if ($resolved === 'no'){
            $reports = Report::where('resolved', false)->paginate(15);
        }
        elseif ($resolved === 'yes'){
            $reports = Report::where('resolved', true)->paginate(15);
        }
        else{
            $reports = Report::paginate(15);
        }

        return view('admin.report.index', ['reports' => $reports, 'resolved' => $resolved]);
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
        //
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
