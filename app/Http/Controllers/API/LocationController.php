<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Location;
use Validator;

class LocationController extends Controller 
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
            'trip_id' => 'required|integer', 
            'longitude' => 'required', 
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $location = new Location();
        $location->trip_id = $request->trip_id;
        $location->longitude = $request->longitude;
        $location->latitude = $request->latitude;
        $location->save();

        return response()->json($location, $this->successStatus);
    }
}