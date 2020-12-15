<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAccessPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/admin/login')
                    ->assertSee('Admin');
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/admin/login')
                    ->type('username', config('app.username_test'))
                    ->type('password', config('app.password_test_fail'))
                    ->press('#btn_login')
                    ->assertPathIs('/admin/login');
        });
    }

    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/admin/login')
                    ->type('username', config('app.username_test'))
                    ->type('password', config('app.password_test_success'))
                    ->press('#btn_login')
                    ->assertPathIs('/admin');
        });
    }
}
