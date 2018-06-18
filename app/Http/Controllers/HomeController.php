<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use App\Media;
use App\MediaType;
use App\Trip;
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
        
        $user->username = $request->username;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->name_surname = $request->name_surname;
        $user->bio = $request->bio;
        $user->location = $request->location;

        if($request->photo){
            $photo = $request->photo;
            $photo->getClientOriginalName();
            $photoPath = Hash::make($photo->getClientOriginalName().$request->ip().Carbon::now());
            $photoPath = str_replace("/", "-", $photoPath);
            $photoPath = $photoPath.'.'.$photo->extension();
            $photo->storeAs('public/pp/', $photoPath);
        }

        if($user->photo_path != NULL){
            Storage::delete('public/pp/'.$user->photo_path);
        }
        $user->photo_path = $photoPath;
        $user->update();

        return redirect()->back()->with('update', true);
    }

    public function trips(){
        $user = Auth::user();
        return view('panel.trips')->with('user', $user);
    }

    public function showTrip($id){
        $trip = Trip::find($id);
        $user = Auth::user();
        if($trip)
            return view('panel.editTrip')->with('trip', $trip);
        abort(404);
    }

    public function punished(){
        
        $user = Auth::user();
        if($user->hasBan())
            return view('punished')->with('user', $user);
        return redirect()->route('homepage');
        
    }

    public function search(Request $request){
        if ($request->type == 'trip'){
            $trips = Trip::where([
                ['name', 'LIKE', '%' . $request->keyword . '%'],
            ])->paginate(15);

            return view('search')->with('trips', $trips);
        }
        elseif ($request->type == 'user'){
            $users = User::where([
                ['username', 'LIKE', '%' . $request->keyword . '%'],
            ])->paginate(15);

            return view('search')->with('users', $users);
        }

        abort(404);
    }
}
