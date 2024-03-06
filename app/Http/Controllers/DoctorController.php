<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::all();
        return response()->json(['Doctor' => $doctor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=> ['required'],
            'specialization' => ['required'],
            'hospitals_id'=> ['required']
            
            
        ]);

    

$hospitalsId = $validateData['hospitals_id']; 
$exists = Hospital::where('id', $hospitalsId)->exists();
if($exists) {
    $doctor = Doctor::create([
        'name' => $validateData['name'],
        'specialization' => $validateData['specialization'], 
        'hospitals_id' => $validateData['hospitals_id'] 
]);

    echo "Doctor was registerd";
} else {
    echo "Doctor_id does not exist in the branches table.";
}
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $doctor = Doctor::where('hospitals_id', $id)->get();
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found']);
        }
        return response()->json(['Doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validateData = $request->validate([
            'name'=> ['required'],
            'specialization' => ['required'],
           'hospitals_id'=> ['required'],
            'id' => ['required'],
        ]);
        
        $doctorId = $validateData['id'];
      
        $doctor = Doctor::where('id', $doctorId)->first();
    
        if (!$doctor) {
            return response()->json(["message" => "No doctor found for the provided hospitals_id"]);
        }
  
        $doctor->update([
            'name' => $validateData['name'],
            'specialization' => $validateData['specialization'], 
            'hospitals_id' => $validateData['hospitals_id'] 
        ]);
        return response()->json(["Doctor was updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Doctor $doctor)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $doctorId = $validateData['id'];
        $doctor = Doctor::where('hospitals_id', $doctorId);

        if ($doctor) {
            $doctor->delete();
            return response()->json(["Doctor was delete"]);
        } else {
            return response()->json(["Fail to access this hospital"]);
        }
    }
}