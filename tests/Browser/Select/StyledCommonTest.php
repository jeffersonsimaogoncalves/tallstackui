<?php

namespace Tests\Browser\Select;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;
use Tests\Browser\Select\Components\Common\StyledComponent;
use Tests\Browser\Select\Components\Common\StyledMultipleComponent;
use Tests\Browser\Select\Components\Common\StyledMultipleLiveEntangleComponent;
use Tests\Browser\Select\Components\Common\StyledMultipleLiveEntangleDefaultComponent;
use Tests\Browser\Select\Components\Common\StyledSearchableComponent;

class StyledCommonTest extends BrowserTestCase
{
    /** @test */
    public function can_clear_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('foo')
                ->click('@tallstackui_select_clear')
                ->click('@sync')
                ->waitUntilMissingText('foo')
                ->assertSee('Select an option');
        });
    }

    /** @test */
    public function can_open_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('bar')
                ->assertDontSee('foo')
                ->click('@tallstackui_select_open_close')
                ->waitForText('bar')
                ->assertSee('foo');
        });
    }

    /** @test */
    public function can_render_after_slot_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledSearchableComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('bar')
                ->assertDontSee('foo')
                ->click('@tallstackui_select_open_close')
                ->waitForText('bar')
                ->waitUntilMissingText('Ooops')
                ->assertDontSee('Ooops')
                ->type('@tallstackui_select_search_input', 'foo,bar,baz')
                ->waitForText('Ooops');
        });
    }

    /** @test */
    public function can_search_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledSearchableComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('bar')
                ->assertDontSee('foo')
                ->click('@tallstackui_select_open_close')
                ->waitForText('bar')
                ->type('@tallstackui_select_search_input', 'bar')
                ->waitForText('bar')
                ->assertSee('bar')
                ->waitUntilMissingText('foo')
                ->assertDontSee('foo');
        });
    }

    /** @test */
    public function can_select_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('foo')
                ->waitUntilMissingText('bar')
                ->assertDontSee('bar')
                ->assertDontSee('Select an option');
        });
    }

    /** @test */
    public function can_select_multiple_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->assertDontSee('baz')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->click('@tallstackui_select_open_close')
                ->click('@sync')
                ->waitForText('foo')
                ->assertSee('bar')
                ->assertDontSee('Select an option');
        });
    }

    /** @test */
    public function can_select_multiple_with_live_entangle_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleLiveEntangleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->assertDontSee('baz')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->assertSee('foo')
                ->click('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->assertSee('bar')
                ->click('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->click('@tallstackui_select_open_close')
                ->waitForLivewire()
                ->click('@sync')
                ->waitForText('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->assertDontSee('Select an option');
        });
    }

    /** @test */
    public function can_select_multiple_with_live_entangle_preserving_default_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleLiveEntangleDefaultComponent::class)
                ->assertDontSee('Select an option')
                ->assertSee('foo')
                ->assertDontSee('bar')
                ->assertDontSee('baz')
                ->click('@tallstackui_select_open_close')
                ->waitForText('bar')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->waitForText('foo')
                ->assertSee('bar')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->waitForText('foo')
                ->assertSee('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->click('@tallstackui_select_open_close') //
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@tallstackui_select_open_close')
                ->waitUntilMissingText('foo')
                ->waitForText('bar')
                ->assertDontSee('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->click('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->waitForText('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->assertDontSee('Select an option');
        });
    }

    /** @test */
    public function can_unselect_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('foo')
                ->click('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('Select an option')
                ->waitUntilMissingText('foo')
                ->assertDontSee('foo');
        });
    }

    /** @test */
    public function can_unselect_multiple_as_common(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('foo')
                ->assertDontSee('bar')
                ->assertDontSee('baz')
                ->click('@tallstackui_select_open_close')
                ->waitForText('foo')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@sync')
                ->waitForText('foo')
                ->assertSee('bar')
                ->assertSee('baz')
                ->click('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->click('@sync')
                ->waitForText('foo')
                ->assertSee('bar');
        });
    }
}