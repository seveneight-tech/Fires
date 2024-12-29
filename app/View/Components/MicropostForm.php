<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MicropostForm extends Component
{
    public $action;
    public $placeholder;
    public $buttonText;

    public function __construct($action = '', $placeholder = "What's on your mind?", $buttonText = '投稿する')
    {
        $this->action = $action;
        $this->placeholder = $placeholder;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.micropost-form');
    }
}
