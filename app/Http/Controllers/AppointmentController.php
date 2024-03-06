<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointment = Appointment::all();
        return response()->json(['Patient' => $appointment]);
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
           // 'appoiments_id'=> ['required'],
            'date'=> ['required'],
           'patients_id'=> ['required']
            
            
        ]);
       
        $patientid = $validateData['patients_id']; 
$exists = Patient::where('id', $patientid)->exists();

if($exists) {
    $appointment = Appointment::create([
        'date' => $validateData['date'], 
        'patients_id' => $validateData['patients_id'] 
]);

    echo "Appoiment was created" ;
} else {
    echo "no patient id" ;
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment ,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $appointment = Appointment::where('appointment_id', $id)->get();
        if (!$appointment) {
            return response()->json(['message' => 'appointment not found']);
        }
        return response()->json(['Appointment' => $appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validateData = $request->validate([
            'date'=> ['required'],
           'patients_id'=> ['required'],
            'id' => ['required'],
        ]);
        
        $appointmentId = $validateData['id'];
      
        $appointment = Appointment::where('id', $appointmentId)->first();
    
        if (!$appointment) {
            return response()->json(["message" => "No appointment found for the provided patient_id"]);
        }
  
        $appointment->update([
            'date' => $validateData['date'],
            'patients_id' => $validateData['patients_id'] 
            
        ]);
        return response()->json(["appointment was updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Appointment $appointment)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $appointmentId = $validateData['id'];
        $appointment = Appointment::where('patients_id', $appointmentId);

        if ($appointment) {
            $appointment->delete();
            return response()->json(["appointment was delete"]);
        } else {
            return response()->json(["Can't find any appointment reletedthis patient"]);
        }
    }
    }

