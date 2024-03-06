<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::all();
        return response()->json(['Doctor' => $patient]);
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
            'age' => ['required'],
            'gender'=> ['required'],
           'doctors_id'=> ['required']
            
            
        ]);
        $doctorID = $validateData['doctors_id']; 
$exists = Doctor::where('id', $doctorID)->exists();
if($exists) {
    $patient = Patient::create([
        'name' => $validateData['name'],
        'age' => $validateData['age'], 
        'gender' => $validateData['gender'], 
        'doctors_id' => $validateData['doctors_id'] 
]);

    echo "Patient was registerd";
} else {
    echo "patient_id does not exist in the branches table.";
}


}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $patient = Patient::where('doctors_id', $id)->get();
        if (!$patient) {
            return response()->json(['message' => 'patient not found']);
        }
        return response()->json(['Patient' => $patient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //'name'=> ['required'],
           // 'age' => ['required'],
          //  'gender'=> ['required'],
          // 'doctors_id'=> ['required']
          $validateData = $request->validate([
            'name'=> ['required'],
            'age' => ['required'],
            'gender' => ['required'],
           'doctors_id'=> ['required'],
            'id' => ['required'],
        ]);

        $patientid = $validateData['id'];
      
        $patient= Patient::where('id', $patientid)->first();
    
        if (!$patient) {
            return response()->json(["message" => "No patient found for the provided Doctors_id"]);
        }
  
        $patient->update([
            'name' => $validateData['name'],
            'age' => $validateData['age'], 
            'gender' => $validateData['gender'], 
            'doctors_id' => $validateData['doctors_id'] 
        ]);
        return response()->json(["patient was updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $patientid = $validateData['id'];
        $patient = Patient::where('doctors_id', $patientid);

        if ($patient) {
            $patient->delete();
            return response()->json(["patient was delete"]);
        } else {
            return response()->json(["Fail to access this patient because no doctore recodes"]);
        }
    }
}
