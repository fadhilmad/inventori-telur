<?php

namespace Tests\Browser\Master;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function testAdminCanSeeUsersData(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($user)
                ->visit('/dashboard')
                ->waitForText('Dashboard')
                ->assertSee('Master Data')
                ->click('@sidebar-master-treeview')
                ->waitForText('User')
                ->click('@sidebar-master-user-index')
                ->assertSee('Master Data - User')
                ->assertSee($user->name);
        });
    }

    public function testAdminCanCreateUser(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->make(['username' => 'dump123', 'password' => 'password']);

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.user.index'))
                ->assertSee('Buat')
                ->click('@btn-user-create')
                ->assertSee('Buat User')
                ->type('name', $user->name)
                ->type('username', $user->username)
                ->select('role', $user->role)
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('@btn-user-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan');
        });
    }

    public function testAdminCanEditUser(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['username' => 'dump1234', 'password' => 'password']);

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.user.index'))
                ->click('a[href="' . route('master-data.user.edit', $user->id) . '"]')
                ->assertSee('Ubah User')
                ->clear('name')
                ->type('name', $user->name . '_updated')
                ->press('@btn-user-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($user->name . '_updated')
                ->screenshot('edit_user');
        });
    }

    public function testAdminCanDeleteUser(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['username' => 'delete_user',]);

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.user.index'))
                ->assertSee($user->name)
                ->screenshot('before_delete_user')
                ->click('a[href="' . route('master-data.user.destroy', $user->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($user->name)
                ->screenshot('delete_user');
        });
    }

    public function testAdminCantDeleteItSelf(): void
    {
        $this->browse(function (Browser $browser) {
            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.user.index'))
                ->assertSee($userLogin->name)
                ->click('a[href="' . route('master-data.user.destroy', $userLogin->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitForText('Tidak dapat menghapus akun anda sendiri')
                ->screenshot('delete_user_itself');
        });
    }

    public function testKaryawanCantSeeMasterDataMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'karyawan']);

            $browser->loginAs($user)
                ->visit('dashboard')
                ->assertDontSee('Master Data');
        });
    }

    public function testKaryawanCantAccessMasterData(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'karyawan']);

            $browser->loginAs($user)
                ->visit(route('master-data.user.index'))
                ->assertSee('Anda tidak memiliki akses ke halaman ini.');
        });
    }
}
