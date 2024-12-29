<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Microposts extends Component
{
    public $microposts;

    public function __construct($microposts)
    {
        $this->microposts = $microposts;
    }

    public function render()
    {
        return view('components.microposts');
    }
}

