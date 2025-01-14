<?php

namespace TallStackUi\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use TallStackUi\View\Personalizations\Contracts\Personalization;
use TallStackUi\View\Personalizations\SoftPersonalization;

#[SoftPersonalization('form.label')]
class Label extends Component implements Personalization
{
    public function __construct(
        public ?string $for = null,
        public ?string $label = null,
        public bool $error = false,
    ) {
        //
    }

    public function personalization(): array
    {
        return [
            'text' => 'block text-sm font-semibold text-gray-600 dark:text-dark-400',
            'asterisk' => 'font-bold not-italic text-red-500',
            'error' => 'text-red-600 dark:text-red-500',
        ];
    }

    public function render(): View
    {
        return view('tallstack-ui::components.form.label');
    }
}
