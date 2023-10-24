<?php

namespace Tests\Browser\Select;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;
use Tests\Browser\Select\Components\Searchable\StyledAfterSlotComponent;
use Tests\Browser\Select\Components\Searchable\StyledComponent;
use Tests\Browser\Select\Components\Searchable\StyledMultipleComponent;
use Tests\Browser\Select\Components\Searchable\StyledMultipleLiveEntangleComponent;
use Tests\Browser\Select\Components\Searchable\StyledMultipleLiveEntangleDefaultComponent;
use Tests\Browser\Select\Components\Searchable\StyledSearchableComponent;

class StyledSearchableTest extends BrowserTestCase
{
    /** @test */
    public function can_clear_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('delectus aut autem')
                ->click('@tallstackui_select_clear')
                ->click('@sync')
                ->waitUntilMissingText('delectus aut autem')
                ->assertDontSee('delectus aut autem')
                ->assertSee('Select an option');
        });
    }

    /** @test */
    public function can_open_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->assertSee('quis ut nam facilis et officia qui')
                ->assertSee('fugiat veniam minus')
                ->assertSee('et porro tempora')
                ->assertSee('laboriosam mollitia et enim quasi adipisci quia provident illum');
        });
    }

    /** @test */
    public function can_render_after_slot_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledAfterSlotComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->waitUntilMissingText('Ooops')
                ->assertDontSee('Ooops')
                ->type('@tallstackui_select_search_input', 'foo,bar,baz')
                ->waitForText('Ooops');
        });
    }

    /** @test */
    public function can_search_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledSearchableComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->waitForText('quis ut nam facilis et officia qui')
                ->waitForText('fugiat veniam minus')
                ->waitForText('et porro tempora')
                ->waitForText('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->type('@tallstackui_select_search_input', 'et porro tempora')
                ->waitForText('et porro tempora')
                ->waitUntilMissingText('delectus aut autem')
                ->assertDontSee('delectus aut autem');
        });
    }

    /** @test */
    public function can_select_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('delectus aut autem')
                ->assertDontSee('Select an option');
        });
    }

    /** @test */
    public function can_select_multiple_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->waitForLivewire()
                ->click('@sync')
                ->waitForText('delectus aut autem,quis ut nam facilis et officia qui,fugiat veniam minus');
        });
    }

    /** @test */
    public function can_select_multiple_with_live_entangle_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleLiveEntangleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->click('@sync')
                ->waitForText('delectus aut autem');
        });
    }

    /** @test */
    public function can_select_multiple_with_live_entangle_preserving_default_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleLiveEntangleDefaultComponent::class)
                ->assertSee('delectus aut autem')
                ->pressAndWaitFor('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->pressAndWaitFor('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->pressAndWaitFor('@tallstackui_select_open_close')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@tallstackui_select_open_close')
                ->waitUntilMissingText('delectus aut autem')
                ->click('@sync')
                ->waitForText('quis ut nam facilis et officia qui')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@tallstackui_select_open_close')
                ->waitForText('quis ut nam facilis et officia qui,fugiat veniam minus,delectus aut autem');
        });
    }

    /** @test */
    public function can_unselect_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->click('@sync')
                ->waitForText('delectus aut autem')
                ->click('@tallstackui_select_clear')
                ->click('@sync')
                ->waitUntilMissingText('delectus aut autem')
                ->assertDontSee('delectus aut autem')
                ->assertSee('Select an option');
        });
    }

    /** @test */
    public function can_unselect_multiple_as_searchable(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, StyledMultipleComponent::class)
                ->assertSee('Select an option')
                ->assertDontSee('delectus aut autem')
                ->assertDontSee('quis ut nam facilis et officia qui')
                ->assertDontSee('fugiat veniam minus')
                ->assertDontSee('et porro tempora')
                ->assertDontSee('laboriosam mollitia et enim quasi adipisci quia provident illum')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[1]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[2]')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->click('@sync')
                ->waitForText('delectus aut autem')
                ->click('@tallstackui_select_open_close')
                ->waitForText('delectus aut autem')
                ->clickAtXPath('/html/body/div[3]/div/div[2]/div/ul/li[3]')
                ->click('@tallstackui_select_open_close')
                ->click('@sync')
                ->waitForText('delectus aut autem,quis ut nam facilis et officia qui');
        });
    }
}