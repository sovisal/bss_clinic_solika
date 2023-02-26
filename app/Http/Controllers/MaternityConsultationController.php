<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\ConsultationController;

class MaternityConsultationController extends Controller
{

    public $consultation;

    public function __construct(ConsultationController $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->consultation->index('maternity');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->consultation->create('maternity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->consultation->store($request, 'maternity');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        return $this->consultation->edit($consultation, 'maternity');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        return $this->consultation->update($request, $consultation, 'maternity');
    }

    public function getTemplate(Request $request)
    {
        return $this->consultation->getTemplate($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        return $this->consultation->destroy($consultation);
    }
}
