<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Ban;
use App\Helper;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|integer',
            'banable_type' => 'required|string|max:255',
            'banable_id' => 'required|integer',
            'message' => 'required|string|max:255',
            'timeout' => 'required|date_format:Y-m-d H:i:s|after:now',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ban = new Ban();
        $ban->complaint_id = $request->complaint_id;
        $ban->banable_type = $request->banable_type;
        $ban->banable_id = $request->banable_id;
        $ban->message = $request->message;
        $ban->timeout = $request->timeout;
        $ban->save();

        $helper = new Helper();
        $helper->createHistory($request->report_id, 'user punished untill '.$ban->timeout);

        return redirect()->route('admin.report.show', ['id' => $request->report_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $ban = Ban::find($id);
        if($ban){
            $ban->delete();
            return redirect()->back();
        }
    }
}
