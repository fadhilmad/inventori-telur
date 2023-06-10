<?php

namespace Tests\Browser\Master;

use App\Models\User;
use App\Models\SatuanKecil;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SatuanKecilTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function testUserCanVisitIndexSatuanKecilFromSidebarMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($user)
                ->visit('/dashboard')
                ->waitForText('Dashboard')
                ->assertSee('Master Data')
                ->click('@sidebar-master-treeview')
                ->waitForText('Satuan Kecil')
                ->click('@sidebar-master-satuan-kecil-index')
                ->assertSee('Master Data - Satuan Kecil');
        });
    }


    public function testUserCanSeeAllSatuanKecil(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory(10)->create();

            $satuanFirst = $satuan->first();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->assertSee('Master Data - Satuan Kecil')
                ->assertSee($satuanFirst->name)
                ->screenshot('satuan_kecil_index');
        });
    }

    public function testUserCanCreateSatuanKecilWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory()->make();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->assertSee('Tambah Satuan')
                ->click('@btn-satuan-create')
                ->assertSee('Tambah Satuan Kecil')
                ->type('name', $satuan->name)
                ->press('@btn-satuan-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan')
                ->screenshot('satuan_kecil_created');
        });
    }

    public function testUserCantCreateSatuanKecilWithInvalidData(): void
    {
        // satuan should be unique

        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->assertSee('Tambah Satuan')
                ->click('@btn-satuan-create')
                ->assertSee('Tambah Satuan Kecil')
                ->type('name', $satuan->name)
                ->press('@btn-satuan-store')
                ->assertSee(__('validation.unique', ['Attribute' => 'Nama']))
                ->screenshot('satuan_kecil_create_validation');
        });
    }

    public function testUserCanUpdateSatuanKecilWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->click('a[href="' . route('master-data.satuan-kecil.edit', $satuan->id) . '"]')
                ->assertSee('Ubah Satuan')
                ->clear('name')
                ->type('name', $satuan->name . '_updated')
                ->press('@btn-satuan-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($satuan->name . '_updated')
                ->screenshot('satuan_kecil_edited');
        });
    }

    public function testUserCantUpdateSatuanKecilWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory()->create();

            $satuanDua = SatuanKecil::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->click('a[href="' . route('master-data.satuan-kecil.edit', $satuan->id) . '"]')
                ->assertSee('Ubah Satuan')
                ->clear('name')
                ->type('name', $satuanDua->name)
                ->press('@btn-satuan-update')
                ->assertSee(__('validation.unique', ['Attribute' => 'Nama']))
                ->screenshot('satuan_kecil_edit_validation');
        });
    }

    public function testUserCanDeleteSatuan(): void
    {
        $this->browse(function (Browser $browser) {
            $satuan = SatuanKecil::factory()->create();

            $userLogin = User::factory()->create(['role' => 'admin']);

            $browser->loginAs($userLogin)
                ->visit(route('master-data.satuan-kecil.index'))
                ->assertSee($satuan->name)
                ->screenshot('before_delete_satuan')
                ->click('a[href="' . route('master-data.satuan-kecil.destroy', $satuan->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($satuan->name)
                ->screenshot('delete_satuan_kecil');
        });
    }
}
