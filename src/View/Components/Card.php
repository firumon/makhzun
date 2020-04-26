<?php

namespace Firumon\Makhzun\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    protected $availableTools = ['maximize' => 'expand','collapse' => 'minus','remove' => 'times'];
    public $title = null,$tools = [],$class = '',$footer = null,$collapse = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $color = null, $outline = null, $maximize = null, $remove = null, $collapse = null)
    {
        $this->title = $title;
        if($color) { $this->class .= ' card-' . $color; }
        if($outline) { $this->class .= ' card-outline'; }
        if($maximize || $remove) { foreach ($this->availableTools as $item => $icon) if($$item !== null) $this->tools[$item] = $icon; }
        if($collapse) { $this->collapse = true; }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('Makhzun::components.base.card');
    }
}
