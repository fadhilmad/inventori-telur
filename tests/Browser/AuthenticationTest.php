<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function testLoginWithValidAccount(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->visit('/')
                ->assertSee('Login')
                ->type('username', $user->username)
                ->type('password', 'password')
                ->press('@btn-login')
                ->assertSee('Dashboard')
                ->logout();
        });
    }

    public function testLoginWithEmptyField(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                ->assertSee('Login')
                ->press('@btn-login')
                ->assertSee(__('validation.required', ['Attribute' => 'Nama pengguna']))
                ->assertSee(__('validation.required', ['Attribute' => 'Kata sandi']));
        });
    }

    public function testLoginWithEmptyPassword(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->visit('/')
                ->assertSee('Login')
                ->type('username', $user->username)
                ->press('@btn-login')
                ->assertSee(__('validation.required', ['Attribute' => 'Kata sandi']));
        });
    }

    public function testLoggedInCanLogout(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($user)
                ->visit('/dashboard')
                ->assertSee($user->name)
                ->click('@btn-user-menu')
                ->press('@btn-logout')
                ->assertSee('Login');
        });
    }

    public function testGuestCantAccessDashboard(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                ->assertSee('Login');
        });
    }
}
