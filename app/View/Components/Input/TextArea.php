<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $name;
    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $model = "")
    {
        $this->name = $name;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view("components.input.text-area");
    }
}
