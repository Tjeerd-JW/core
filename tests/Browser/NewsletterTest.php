<?php

namespace Rapidez\Core\Tests\Browser;

use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Rapidez\Core\Tests\DuskTestCase;

class NewsletterTest extends DuskTestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function test()
    {
        $this->browse(function (Browser $browser) {
            $email = $this->faker->email;
            $browser->visit('/')
                ->waitUntilVueLoaded()
                ->scrollIntoView('@newsletter')
                ->waitUntilIdle()
                ->type('@newsletter-email', $email)
                ->click('@newsletter-submit')
                ->waitUntilIdle()
                ->assertSee(__('Thank you for subscribing!'))
                ->waitForText(__('We care about the protection of your data. Read our'))
                ->type('@newsletter-email', $email)
                ->click('@newsletter-submit')
                ->waitUntilIdle()
                ->assertSee(__('This email address is already subscribed.'));
        });
    }
}
