<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Complaint;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = DB::table('complaints')->paginate(15);
        return view('admin.complaint.index', ['complaints' => $complaints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.complaint.create');
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
            'name' => 'required|unique:complaints|max:255',
            'description' => 'nullable|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.complaint.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $complaint = new Complaint();
        $complaint->name = $request->name;
        $complaint->description = $request->description;
        $complaint->type = $request->type;
        $complaint->save();
        return redirect()->back()->with('create', $complaint->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($id)
    {
        $complaint = Complaint::where('id', $id)->first();
        if($complaint){
            return view('admin.complaint.show', ['complaint' => $complaint]);
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
        $complaint = Complaint::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'name' => ['required','string', 'max:255', Rule::unique('complaints')->ignore($complaint->id)],
            'description' => 'nullable|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $complaint->name = $request->name;
        $complaint->description = $request->description;
        $complaint->type = $request->type;
        $complaint->update();
        return redirect()->route('admin.complaint.show', ['id' => $complaint->id])->with('update', $complaint->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::where('id', $id)->first();
        $name  = $complaint->name;
        if($complaint && url()->previous() == route('admin.complaint.show', ['id' => $id])){
            $complaint->delete();
            return redirect()->route('admin.complaint.index')->with('delete', $name);
        }
        else{
            abort(404);
        }
    }

}
