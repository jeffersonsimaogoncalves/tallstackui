<?php

namespace TasteUi\Support\Personalizations\Components;

use Illuminate\Contracts\Support\Arrayable;
use TasteUi\Support\Personalizations\Contracts\Personalizable;
use TasteUi\Support\Personalizations\Traits\ShareablePersonalization;

class Avatar implements Arrayable, Personalizable
{
    use ShareablePersonalization;

    public const EDITABLES = [
        'wrapper',
        'content',
    ];
}
