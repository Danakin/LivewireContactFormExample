<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Text extends Component
{
    public $name;
    public $model;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $model = "", $type = "text")
    {
        $this->name = $name;
        $this->model = $model;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view("components.input.text");
    }
}
