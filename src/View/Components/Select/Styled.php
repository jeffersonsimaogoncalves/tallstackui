<?php

namespace TallStackUi\View\Components\Select;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use TallStackUi\View\Components\Form\Traits\DefaultInputClasses;
use TallStackUi\View\Components\Select\Traits\InteractsWithSelectOptions;
use TallStackUi\View\Personalizations\Contracts\Personalization;
use TallStackUi\View\Personalizations\SoftPersonalization;
use TallStackUi\View\Personalizations\Traits\InteractWithValidations;
use Throwable;

#[SoftPersonalization('select.styled')]
class Styled extends Component implements Personalization
{
    use DefaultInputClasses;
    use InteractsWithSelectOptions;
    use InteractWithValidations;

    /** @throws Throwable */
    public function __construct(
        public ?string $label = null,
        public ?string $hint = null,
        public Collection|array $options = [],
        public string|array|null $request = null,
        public ?bool $multiple = false,
        public ?bool $searchable = false,
        public ?string $select = null,
        public ?array $selectable = [],
        public ?string $after = null,
        public ?bool $disabled = false,
        public ?bool $common = true,
        public array $placeholders = [],
        public readonly bool $ignoreValidations = false,
    ) {
        $this->placeholders = [...__('tallstack-ui::messages.select')];

        $this->common = ! filled($this->request);
        $this->searchable = ! $this->common ? true : $this->searchable;

        $this->options();
        $this->validate();
    }

    public function personalization(): array
    {
        return Arr::dot([
            'input' => [
                'wrapper' => [
                    'base' => 'dark:text-dark-300 dark:bg-dark-800 dark:focus:ring-primary-600 dark:disabled:bg-dark-600 dark:ring-dark-600 mt-1 flex w-full cursor-pointer items-center gap-x-2 rounded-md border-0 bg-white py-1.5 text-sm leading-6 ring-1 ring-inset ring-gray-300 disabled:bg-gray-100 disabled:text-gray-500 disabled:ring-gray-300',
                    'color' => 'focus:ring-primary-600 text-gray-600 focus:outline-none focus:ring-2',
                    'error' => $this->error(),
                ],
                'content' => 'relative inset-y-0 left-0 flex w-full items-center space-x-2 overflow-hidden rounded-lg pl-2 transition',
            ],
            'buttons' => [
                'wrapper' => 'mr-2 flex items-center',
                'size' => 'h-5 w-5',
                'base' => 'text-secondary-500 dark:text-dark-400 hover:text-red-500 dark:hover:text-red-500',
                'error' => 'text-red-500',
            ],
            'box' => [
                'wrapper' => 'dark:bg-dark-700 absolute z-10 mt-1 w-full overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5',
                'button' => [
                    'class' => 'absolute inset-y-0 right-2 flex cursor-pointer items-center px-2',
                    'icon' => 'text-secondary-500 h-5 w-5 transition hover:text-red-500',
                ],
                'list' => [
                    'wrapper' => 'soft-scrollbar z-50 max-h-60 w-full overflow-auto rounded-b-lg text-base focus:outline-none sm:text-sm',
                    'loading' => [
                        'wrapper' => 'flex items-center justify-center space-x-4 p-4',
                        'class' => 'text-primary-600 dark:text-dark-400 h-12 w-12 animate-spin',
                    ],
                    'item' => [
                        'wrapper' => 'dark:text-dark-300 dark:hover:bg-dark-500 dark:focus:bg-dark-500 relative cursor-pointer select-none px-2 py-2 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-none',
                        'options' => 'flex items-center justify-between',
                        'selected' => 'font-semibold hover:bg-red-500 hover:text-white dark:hover:bg-red-500',
                        'check' => 'h-5 w-5',
                    ],
                    'empty' => 'dark:text-dark-300 block w-full pr-2 text-gray-600',
                ],
            ],
            'itens' => [
                'placeholder' => 'dark:text-dark-400 text-gray-400',
                'single' => 'dark:text-dark-300 text-gray-600',
                'multiple' => [
                    'item' => 'dark:text-dark-100 dark:bg-dark-700 dark:ring-dark-600 inline-flex items-center space-x-1 rounded-lg bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-200',
                    'icon' => 'h-4 w-4 text-red-500',
                ],
            ],
        ]);
    }

    public function render(): View
    {
        return view('tallstack-ui::components.select.styled');
    }
}
