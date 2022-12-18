<?php

namespace App\View\Components;

use App\Models\Patient;
use Illuminate\View\Component;

class ReportFilter extends Component
{

    public $url;

    /**
     * Create a new component instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
        return view('components.para-clinic.report-filter', $data);
    }
}
