<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Http\Controllers\PatientController;

class MaternityController extends Controller
{

    public $patient;

    public function __construct(PatientController $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->patient->index($request, 'maternity');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->patient->create('maternity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        return $this->patient->store($request, 'maternity');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $maternity)
    {
        return $this->patient->show($maternity, 'maternity');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $maternity)
    {
        return $this->patient->edit($maternity, 'maternity');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $maternity)
    {
        return $this->patient->update($request, $maternity, 'maternity');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Patient $maternity)
    public function destroy(Patient $maternity)
    {
        return $this->patient->destroy($maternity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        return $this->patient->restore($id);
    }

}
