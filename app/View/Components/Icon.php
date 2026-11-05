<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $class = null,
        public bool $tooltip = false,
        public ?string $title = null,
        public ?string $link = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $show = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->class = $this->map($this->class);

        return view('components.icon');
    }

    /**
     * Map icon shortcuts into their fontawesome or other elements
     */
    protected function map(string $class): string
    {
        return match ($class) {
            'map' => 'fa-solid fa-map',
            'check' => 'fa-solid fa-check',
            'trash' => 'fa-solid fa-trash-can',
            'plus' => 'fa-solid fa-plus',
            'question' => 'fa-solid fa-question-circle',
            'save' => 'fa-solid fa-save',
            'pencil' => 'fa-solid fa-pencil',
            'cog' => 'fa-solid fa-cog',
            'copy' => 'fa-solid fa-copy',
            'edit' => 'fa-solid fa-pen-to-square',
            'premium' => 'fa-solid fa-gem',
            'lock' => 'fa-solid fa-lock',
            'filter' => 'fa-solid fa-filter',
            'load' => 'fa-solid fa-spinner fa-spinner',
            'arrow' => 'fa-solid fa-arrow-right',
            'permissions' => 'fa-solid fa-user-shield',
            'attributes' => 'fa-solid fa-rectangle-list',
            'link' => 'fa-solid fa-external-link',
            'sort' => 'fa-solid fa-grip-vertical',
            default => $class,
        };
    }
}
