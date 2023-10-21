<?php

use TallStackUi\View\Personalizations\Personalization;

test('Personalization', function (string $method) {
    expect(Personalization::class)->toHaveMethod($method);
})->with([
    '__construct',
    'block',
    'instance',
    'alert',
    'modal',
    'button',
    'avatar',
    'badge',
    'card',
    'dialog',
    'dropdown',
    'error',
    'errors',
    'toast',
    'form',
    'hint',
    'select',
    'tab',
    'tooltip',
    'wrapper',
    'component',
]);