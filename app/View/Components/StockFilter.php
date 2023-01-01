<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Inventory\Product;

class StockFilter extends Component
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
        $data['products'] = Product::where('status', 1)->orderBy('name_en', 'asc')->get();
        return view('components.stock-filter', $data);
    }
}