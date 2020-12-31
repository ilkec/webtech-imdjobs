<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ExampleTest extends DuskTestCase
{
    use withFaker;
    
    /**
     * @test
     * @group register
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('firstname', $this->faker->firstName)
                    ->type('lastname', $this->faker->lastName)
                    ->type('email', $this->faker->firstName . '@student.thomasmore.be')
                    ->type('password', $this->faker->password)
                    ->press('register-student')
                    ->assertPathIs('/login');
        });
    }

    /**
    * @test
    * @group register
    */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'test@mail.com')
                    ->type('password', 'test')
                    ->press('login')
                    ->assertPathIs('/');
        });
    }
}
