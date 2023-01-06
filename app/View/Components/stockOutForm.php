<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Inventory\Product;

class stockOutForm extends Component
{
    protected $module;
    protected $row;
    /**
     * Create a new component instance.
     */
    public function __construct($module = null, $row = null )
    {
        $this->module = $module;
        $this->row = $row;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'products' => Product::where('status', 1)->where('qty_remain', '>', '0')->orderBy('name_en', 'asc')->get(),
            'module' => $this->module,
            'row' => $this->row,
        ];
        return view('components.stock-out-form', $data);
    }
}
