<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    /**
     * Create a new component instance.
     */
    public float $rating;

    public function __construct($rating = 0)
    {
        $this->rating = floatval($rating);
    }

    public function render()
    {
        return view('components.star-rating');
    }
}
