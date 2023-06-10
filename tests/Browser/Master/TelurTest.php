<?php

namespace Tests\Browser\Master;

use App\Models\SatuanBesar;
use App\Models\SatuanKecil;
use App\Models\Telur;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\LoginAsAdmin;

class TelurTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function testUserCanVisitIndexTelurFromSidebarMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit('/dashboard')
                ->waitForText('Dashboard')
                ->assertSee('Master Data')
                ->click('@sidebar-master-treeview')
                ->waitForText('Telur')
                ->click('@sidebar-master-telur-index')
                ->assertSee('Master Data - Telur');
        });
    }

    public function testUserCanSeeAllTelurs(): void
    {

        $this->browse(function (Browser $browser) {
            $telur = Telur::factory(10)->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->assertSee('Master Data - Telur')
                ->assertSee($telur->first()->name)
                ->screenshot('telur_index');
        });
    }

    public function testUserCanCreateTelurWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $telur = Telur::factory()->make();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->assertSee('Tambah Telur')
                ->click('@btn-telur-create')
                ->assertSee('Tambah Telur')
                ->type('name', $telur->name)
                ->select('satuan_besar_id', $telur->satuan_besar_id)
                ->select('satuan_kecil_id', $telur->satuan_kecil_id)
                ->type('isi_satuan_kecil', $telur->isi_satuan_kecil)
                ->press('@btn-telur-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan')
                ->screenshot('telur_created');
        });
    }

    public function testUserCantCreateTelurWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->assertSee('Tambah Telur')
                ->click('@btn-telur-create')
                ->assertSee('Tambah Telur')
                ->type('name', '')
                ->select('satuan_besar_id', '')
                ->select('satuan_kecil_id', '')
                ->type('isi_satuan_kecil', '')
                ->press('@btn-telur-store')
                ->assertSee(__('validation.required', ['Attribute' => 'Nama']))
                ->assertSee(__('validation.required', ['Attribute' => 'Satuan besar']))
                ->assertSee(__('validation.required', ['Attribute' => 'Satuan kecil']))
                ->assertSee(__('validation.required', ['Attribute' => 'Isi satuan kecil']))
                ->screenshot('telur_create_validation');
        });
    }

    public function testuserCanUpdateTelurWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $telur = Telur::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->click('a[href="' . route('master-data.telur.edit', $telur->id) . '"]')
                ->assertSee('Ubah Telur')
                ->clear('name')
                ->type('name', $telur->name . '_updated')
                ->press('@btn-telur-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($telur->name . '_updated')
                ->screenshot('telur_edited');
        });
    }

    public function testUserCanUpdateTelurWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $telur = Telur::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->click('a[href="' . route('master-data.telur.edit', $telur->id) . '"]')
                ->assertSee('Ubah Telur')
                ->clear('name')
                ->type('name', '')
                ->press('@btn-telur-update')
                ->assertSee(__('validation.required', ['Attribute' => 'Nama']))
                ->screenshot('telur_edit_validation');
        });
    }

    public function testUserCanDeleteTelur(): void
    {
        $this->browse(function (Browser $browser) {
            $telur = Telur::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.telur.index'))
                ->click('a[href="' . route('master-data.telur.destroy', $telur->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($telur->name)
                ->screenshot('telur_deleted');
        });
    }
}
