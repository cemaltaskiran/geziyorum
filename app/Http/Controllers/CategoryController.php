<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Routing\UrlGenerator;

class CategoryController extends Controller
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
        return view('admin.category.create');
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
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.category.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->back()->with('create', $category->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($name)
    {
        $category = Category::where('name', $name)->first();
        if($category){
            return view('admin.category.show', ['category' => $category]);
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
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::where('name', $name)->first();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        return redirect()->route('admin.category.show', ['name' => $category->name])->with('update', $category->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {

        $category = Category::where('name', $name)->first();
        if($category && url()->previous() == route('admin.category.show', ['name' => $name])){
            $category->delete();
            return redirect()->route('admin.category.index')->with('delete', $name);
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
        $categories = DB::table('categories')->paginate(15);
        return view('admin.category.index', ['categories' => $categories]);
    }
}
