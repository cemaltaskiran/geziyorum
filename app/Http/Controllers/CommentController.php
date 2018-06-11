<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Helper;

class CommentController extends Controller
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
        //
    }

    public function hide(Request $request, $id){
        $comment = Comment::find($id);

        if($comment){
            $comment->delete();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'hidden');

            return redirect()->back()->with('hide', true);
        }

        return redirect()->back()->with('hide', false);
    }

    public function unhide(Request $request, $id){
        $comment = Comment::withTrashed()->find($id);

        if($comment){
            $comment->restore();

            $helper = new Helper();
			$helper->createHistory($request->report_id, 'restored');

            return redirect()->back()->with('unhide', true);
        }

        return redirect()->back()->with('unhide', false);
    }
}
