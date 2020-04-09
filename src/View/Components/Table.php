<?php

namespace Firumon\Makhzun\View\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Table extends Component
{
    public $headings = [], $records = [], $empty = 'NO DATA', $class = '', $actions = null;
    protected $tableTypes = ['sm','bordered','striped','hover'];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($records = [],$criteria = null,$actions = [],$iteration = null,$sm = null,$striped = null,$bordered = null,$hover = null,$empty = null)
    {
        $records = ($records instanceof Collection) ? $records : (($records instanceof Paginator) ? collect($records->items()) : collect($records));
        if(!$criteria) $criteria = collect($records->first())->mapWithKeys(function($value,$key){ return [Str::of($key)->ucfirst()->__toString() => $key]; })->toArray();
        $headings = array_keys($criteria); if($iteration) array_unshift($headings,'#');
        $this->records = $records->mapWithKeys(function($record,$idx) use($criteria,$iteration){
            $data = ($iteration) ? [ intval($iteration)+$idx ] : [];
            foreach ($criteria as $criterion) $data[] = Arr::get($record,$criterion,'');
            return [$record->id => $data];
        })->toArray();
        $this->headings = $headings;
        foreach ($this->tableTypes as $type) if($$type) $this->class .= ' table-' . $type;
        if($empty) $this->empty = $empty;
        if($actions && !empty($actions)) $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('Makhzun::components.base.table');
    }
}
