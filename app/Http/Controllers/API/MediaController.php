<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Media;
use Validator;

class MediaController extends Controller 
{

    private $successStatus = 200;

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function store(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer', 
            'trip_id' => 'required|integer', 
            'location_id' => 'required|integer', 
            'media_type_id' => 'required|integer', 
            'file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        
        $path = md5($request->file->getClientOriginalName()).'.'.$request->file->extension();

        if($request->file){
            $request->file->storeAs('public/'.$request->user_id.'/'.$request->media_type_id.'/'.$request->trip_id.'/'.$request->location_id.'/', $path);
        }

        $media = new Media();
        $media->user_id = $request->user_id;
        $media->trip_id = $request->trip_id;
        $media->location_id = $request->location_id;
        $media->media_type_id = $request->media_type_id;
        $media->name = $request->file->getClientOriginalName();
        $media->path = $path;
        $media->ip = $request->ip();
        $media->save();

        return response()->json($media, $this->successStatus);
    }
}