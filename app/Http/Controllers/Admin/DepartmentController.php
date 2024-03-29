<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use Carbon\Carbon;
use session;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $depart = Department::all();
        return view('admin.department')->with('depart',$depart);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'department_name' => 'required|min:5|unique:departments,department_name',
        ]);

        $department = new Department();
        $department->department_name = $request->department_name;
        $department->department_slug = $request->department_name;
        $department->department_information = $request->department_information;
        $department->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $department->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $department->save();
        toastr()->success('Department has been added successfully!','Success!');
        return redirect()->back();
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
    public function edit(Department $depart)
    {
        $depart = Department::get();
        return view('admin.department')->with('depart',$depart);
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
    public function destroy(Department $department)
    {

        $department->delete();

        toastr()->success('Data has been deleted successfully','Success!');

        return redirect()->back();

    }
}
