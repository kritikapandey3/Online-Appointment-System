<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use session;
use App\Doctor;
use App\Department;
use App\Day;
use DB;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $depart = Department::all();
        $doctor = Doctor::all();
        $day = Day::all();
        return view('admin.doctor')->with(['depart' => $depart, 'doctor' => $doctor, 'day' => $day]);
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
            'doctor_name' => 'required|min:5|unique:doctors,doctor_name',
            'department_id' => 'required',
            'doctor_degree' => 'required',
        ]);

        $doctor = new Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_information = $request->doctor_information;
        $doctor->department_id = $request->department_id;
        $doctor->degree = $request->doctor_degree;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFilename = $doctor->image;
            $doctor->image = $filename;
            Storage::delete($oldFilename);
        }

        $doctor->save();
        $doctor->days()->attach(implode(',',$request->day_id));
        // $hello = DB::insert('insert into doctor_days(doctor_id,day_id) values (?, ?)', [1, $days]);
        toastr()->success('Data has been successfully saved','Success!');
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}