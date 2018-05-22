<?php

namespace App\Http\Controllers;

use App\Trip;
use App\Complaint;
use App\ReportHistory;
use App\Helper;
use Illuminate\Http\Request;
use DB;
use Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trip.index');
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
    public function show($url)
    {
        if(Auth::check() && Auth::user()->hasRole('admin')){
            $trip = Trip::withTrashed()->where([
                ['url', '=', $url],
            ])->first();
        }
        else{
            $trip = Trip::where([
                ['url', '=', $url],
                ['freeze', '=', false],
            ])->first();
        }
        
        $complaints = Complaint::where('type', 'trip')->get();
        if($trip){
            return view('trip.show')->with(['trip' => $trip, 'complaints' => $complaints]);
        }
        else{
            abort(404);
        }
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
        $trip = Trip::find($id);
        if($trip){
            $trip->delete();
        }
    }

    public function complaint(Request $request, $id)
    {
        $trip = Trip::find($id);
        
        if ($trip && url()->previous() == route('trip.show', ['url' => $trip->url])){
            DB::table('reports')->insert([
                'complaint_id' => $request->complaint, 
                'complaintable_id' => $id, 
                'complaintable_type' => 'trip', 
                'user_id' => $request->user()->id, 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->back()->with('report', true);
    }

    public function freeze(Request $request, $id){
        $trip = Trip::find($id);

        if($trip){
            $trip->freeze = true;
            $trip->update();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'freezed');

            return redirect()->back()->with('freeze', true);
        }

        return redirect()->back()->with('freeze', false);
    }

    public function unfreeze(Request $request, $id){
        $trip = Trip::find($id);

        if($trip){
            $trip->freeze = false;
            $trip->update();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'unfreezed');

            return redirect()->back()->with('unfreeze', true);
        }

        return redirect()->back()->with('unfreeze', false);
    }

    public function hide(Request $request, $id){
        $trip = Trip::find($id);

        if($trip){
            $trip->delete();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'hidden');

            return redirect()->back()->with('hide', true);
        }

        return redirect()->back()->with('hide', false);
    }

    public function unhide(Request $request, $id){
        $trip = Trip::withTrashed()->find($id);

        if($trip){
            $trip->restore();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'restored');

            return redirect()->back()->with('unhide', true);
        }

        return redirect()->back()->with('unhide', false);
    }
}
