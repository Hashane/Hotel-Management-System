<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoomCategoryDropdown extends Component
{
    public $selected;

    public $name;

    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($selected = null, $name = 'room_type', $id = null)
    {
        $this->selected = $selected;
        $this->name = $name;
        $this->id = $id ?? $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.room-category-dropdown');
    }
}
