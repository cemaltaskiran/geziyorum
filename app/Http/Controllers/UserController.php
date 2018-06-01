<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class UserController extends Controller
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
        return view('admin.user.create');
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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'date|required|string|min:10|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach(Role::where('name', 'default')->first());
        return redirect()->back()->with('create', $user->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();
        if($user){
            return view('admin.user.show', ['user' => $user]);
        }
        else{
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();
        if($user){
            return view('admin.user.show', ['user' => $user]);
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
    public function edit($username)
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
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        if(isset($user)){
            if($request->email === $user->email && $request->username === $user->username){
                $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'birthdate' => 'date|required|string|min:10|max:10',
                ]);
            }
            elseif($request->username === $user->username){
                $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'birthdate' => 'date|required|string|min:10|max:10',
                ]);
            }
            elseif($request->email === $user->email){
                $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255|unique:users',
                    'email' => 'required|string|email|max:255',
                    'birthdate' => 'date|required|string|min:10|max:10',
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255|unique:users',
                    'email' => 'required|string|email|max:255|unique:users',
                    'birthdate' => 'date|required|string|min:10|max:10',
                ]);
            }
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->username = $request->username;
            $user->email = $request->email;
            $user->birthdate = $request->birthdate;
            $user->update();
            return redirect()->route('admin.user.show', ['username' => $user->username])->with('update', $user->username);
        }
        abort(404);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {

        $user = User::where('username', $username)->first();
        if($user && url()->previous() == route('admin.user.show', ['username' => $username])){
            $user->delete();
            return redirect()->back()->with('delete', $username);
        }
        else{
            abort(404);
        }
    }

    public function restore($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();
        if($user && url()->previous() == route('admin.user.show', ['username' => $username])){
            $user->restore();
            return redirect()->back()->with('restore', $username);
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
    public function indexAdmin(Request $request)
    {
        $show = 'all';
        $keyword = '';

        if($request->show){
            $show = $request->show;
        }
        if($request->keyword){
            $keyword = $request->keyword;
        }
        if($show == 'active'){
            $users = User::where([
                ['deleted_at', '=', NULL]
            ]);
        }
        elseif($show == 'deleted'){
            $users = User::where([
                ['deleted_at', '<>', NULL]
            ]);
        }
        else{
            $users = DB::table('users');
        }

        if($keyword){
            $users = $users->where([
                ['username', 'LIKE', '%' . $keyword . '%'],
            ]);
        }

        $users = $users->paginate(15);
        return view('admin.user.index', ['users' => $users, 'show' => $show, 'keyword' => $keyword]);
    }
}
