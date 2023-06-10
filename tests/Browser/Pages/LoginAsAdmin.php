<?php

namespace Tests\Browser\Pages;

use App\Models\User;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class LoginAsAdmin extends Page
{
    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/';
    }

    public function startAdminSession(Browser $browser)
    {
        $user = User::where('username', 'admin')->first() ?? User::factory()->create(['username' => 'admin', 'role' => 'admin', 'name' => 'Administrator']);

        $browser->loginAs($user);
    }
}
