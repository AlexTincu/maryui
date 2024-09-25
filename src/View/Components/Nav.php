<?php

namespace Mary\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class Nav extends Component
{
    public function __construct(
        public ?bool $sticky = false,
        public ?bool $fullWidth = false,
        public ?string $maxWidthClass = null,

        // Slots
        public mixed $brand = null,
        public mixed $actions = null
    ) {
        $this->maxWidthClass = $maxWidthClass ?? Config::get('mary.default_max_width_class', 'max-w-screen-2xl');
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
                    <div {{ $attributes->class(["bg-base-100 border-base-300 border-b", "sticky top-0 z-10" => $sticky]) }}>
                        <div @class(["flex items-center px-6 py-5", "$maxWidthClass mx-auto" => !$fullWidth])>
                            <div {{ $brand?->attributes->class(["flex-1 flex items-center"]) }}>
                                {{ $brand }}
                            </div>
                            <div {{ $actions?->attributes->class(["flex items-center gap-4"]) }}>
                                {{ $actions }}
                            </div>
                        </div>
                    </div>
                HTML;
    }
}

