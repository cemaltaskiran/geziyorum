<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\MediaType;
use Illuminate\Routing\UrlGenerator;

class MediaTypeController extends Controller
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
        return view('admin.mediaType.create');
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
            'name' => 'required|max:255',
            'path' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.mediaType.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $mediaType = new MediaType();
        $mediaType->name = $request->name;
        $mediaType->path = $request->path;
        $mediaType->save();
        return redirect()->back()->with('create', $mediaType->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($name)
    {
        $mediaType = MediaType::where('name', $name)->first();
        if($mediaType){
            return view('admin.mediaType.show', ['mediaType' => $mediaType]);
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
    public function edit($name)
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
    public function update(Request $request, $name)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'path' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mediaType = MediaType::where('name', $name)->first();
        $mediaType->name = $request->name;
        $mediaType->path = $request->path;
        $mediaType->update();
        return redirect()->route('admin.mediaType.show', ['name' => $mediaType->name])->with('update', $mediaType->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        $mediaType = MediaType::where('name', $name)->first();
        if($mediaType && url()->previous() == route('admin.mediaType.show', ['name' => $name])){
            $mediaType->delete();
            return redirect()->route('admin.mediaType.index')->with('delete', $name);
        }
        else{
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $mediaTypes = DB::table('media_types')->paginate(15);
        return view('admin.mediaType.index', ['mediaTypes' => $mediaTypes]);
    }
}
abort(404);