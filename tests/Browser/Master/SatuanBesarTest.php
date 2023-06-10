<?php

namespace Tests\Browser\Master;

use App\Models\User;
use App\Models\SatuanBesar;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SatuanBesarTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function testUserCanVisitIndexSatuanBesarFromSidebarMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($user)
                ->visit('/dashboard')
                ->assertSee('Master Data')
                ->click('@sidebar-master-treeview')
                ->click('@sidebar-master-satuan-besar-index')
                ->assertSee('Master Data - Satuan Besar');
        });
    }


    public function testUserCanSeeAllSatuanBesar(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory(10)->create();

            $satuanFirst = $satuan->first();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->assertSee('Master Data - Satuan Besar')
                ->assertSee($satuanFirst->name)
                ->screenshot('satuan_index');
        });
    }

    public function testUserCanCreateSatuanBesarWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory()->make();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->assertSee('Tambah Satuan')
                ->click('@btn-satuan-create')
                ->assertSee('Tambah Satuan Besar')
                ->type('name', $satuan->name)
                ->press('@btn-satuan-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan')
                ->screenshot('satuan_created');
        });
    }

    public function testUserCantCreateSatuanBesarWithInvalidData(): void
    {
        // satuan should be unique

        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->assertSee('Tambah Satuan')
                ->click('@btn-satuan-create')
                ->assertSee('Tambah Satuan Besar')
                ->type('name', $satuan->name)
                ->press('@btn-satuan-store')
                ->assertSee(__('validation.unique', ['Attribute' => 'Nama']))
                ->screenshot('satuan_create_validation');
        });
    }

    public function testUserCanUpdateSatuanBesarWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->click('a[href="' . route('master-data.satuan-besar.edit', $satuan->id) . '"]')
                ->assertSee('Ubah Satuan')
                ->clear('name')
                ->type('name', $satuan->name . '_updated')
                ->press('@btn-satuan-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($satuan->name . '_updated')
                ->screenshot('satuan_edited');
        });
    }

    public function testUserCantUpdateSatuanBesarWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory()->create();

            $satuanDua = SatuanBesar::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->click('a[href="' . route('master-data.satuan-besar.edit', $satuan->id) . '"]')
                ->assertSee('Ubah Satuan')
                ->clear('name')
                ->type('name', $satuanDua->name)
                ->press('@btn-satuan-update')
                ->assertSee(__('validation.unique', ['Attribute' => 'Nama']))
                ->screenshot('satuan_edit_validation');
        });
    }

    public function testUserCanDeleteSatuan(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanBesar::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-besar.index'))
                ->assertSee($satuan->name)
                ->screenshot('before_delete_satuan')
                ->click('a[href="' . route('master-data.satuan-besar.destroy', $satuan->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($satuan->name)
                ->screenshot('delete_user');
        });
    }
}
