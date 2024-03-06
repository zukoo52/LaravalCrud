<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospital = Hospital::all();
        return response()->json(['hospital' => $hospital]);
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
            'address' => ['required'],
            'phone'=> ['required']
            
            
        ]);
     
       $hospital = Hospital::create([
          'name'  => $validateData['name'],
          'address'  => $validateData['address'],
          'phone'  => $validateData['phone']
            
        ]);
       return response()->json(["registerd to hospital"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) // Corrected the method signature
    {
        $validateData = $request->validate([ // Corrected to use $request
            'id' => ['required'],
        ]);
        $id = $validateData['id'];

        $hospital = Hospital::find($id);  
        if (!$hospital) {
            return response()->json(['message' => 'Hospital not found'], 404);

        }

        return response()->json(['Hospital' => $hospital]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        $validatedData = $request->validate([
            'name' => ['sometimes', 'required'],
            'address' => ['sometimes', 'required'],
            'phone' => ['sometimes', 'required'],
        ]);
    
        // Update the hospital model with the validated data.
        // The 'fill' method is safe to use here because we've already validated the data.
        // Alternatively, you could use the 'update' method directly on the model instance.
        $hospital->fill($validatedData);
    
        
        if($hospital->save()) {
            
            return response()->json(['message' => 'Hospital updated successfully', 'hospital' => $hospital]);
        } else {
            
            return response()->json(['message' => 'Failed to update hospital'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

    // Return a success response indicating the hospital was deleted.
    return response()->json(["message" => "Hospital was successfully deleted."]);
    }
}