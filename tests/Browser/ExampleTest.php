<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * @test
     * @group register
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('firstname', 'Gary')
                    ->type('lastname', 'testacc')
                    ->type('email', 'garytestacc@student.thomasmore.be')
                    ->type('password', '12345')
                    ->press('register-student')
                    ->assertPathIs('/login');
        });
    }
}
