<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Media;
use App\MediaType;
use Validator;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('panel.index');
    }

    public function indexAdmin()
    {
        return view('admin.index');
    }

    public function showAccount(){
        $user = Auth::user();
        return view('panel.editAccount')->with('user', $user);
    }

    public function editAccount(Request $request){
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'username' => ['required','string', 'max:255', 
            Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', 
            Rule::unique('users')->ignore($user->id)],
            'birthdate' => 'date|required|string|min:10|max:10',
            'name_surname' => 'nullable|max:255|min:3|string',
            'bio' => 'nullable|max:255|string',
            'location' => 'nullable|max:255|string',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->route('panel.editAccount')
                        ->withErrors($validator)
                        ->withInput();
        }

        $media = $user->media;
        if($request->photo){
            $photo = $request->photo;
            $media = new Media();
            $media->name = $photo->getClientOriginalName();
            $media->path = str_replace("/", "-", Hash::make($media->name.$request->ip().Carbon::now()).'.'.$photo->extension());
            $media->ip = $request->ip();
            $media->media_type_id = MediaType::where('name', 'profile photo')->first()->id;
            $media->save();
            $photo->storeAs('public/'.$media->mediaType->path, $media->path);
        }
        
        
        $user->username = $request->username;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->name_surname = $request->name_surname;
        $user->bio = $request->bio;
        $user->location = $request->location;
        $user->media_id = $media->id;
        $user->update();

        
        return redirect()->back()->with('update', true);
    }

    public function trips(){
        $user = Auth::user();
        return view('panel.trips')->with('user', $user);
    }
}
