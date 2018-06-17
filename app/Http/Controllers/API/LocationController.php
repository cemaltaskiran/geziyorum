<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Location;
use App\Trip;
use Illuminate\Support\Facades\Auth; 
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
            'longitude' => 'nullable|string|max:64000', 
            'latitude' => 'nullable|string|max:64000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $trip = new Trip();
        $trip->name = $request->name;
        $trip->user_id = $request->user_id;
        $trip->about = $request->about;
        $trip->freeze = true;
        $trip->save();

        return response()->json(['success' => $trip], $this->successStatus);
    }
}