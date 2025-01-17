<?php

namespace TallStackUi\Facades;

use Illuminate\Support\Facades\Facade;
use TallStackUi\TallStackUiDirectives;
use TallStackUi\View\Personalizations\Personalization;

/**
 * @method static Personalization personalize(?string $component = null)
 * @method static TallStackUiDirectives directives()
 */
class TallStackUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \TallStackUi\TallStackUi::class;
    }
}
