<?php

namespace Tests\Browser\Master;

use App\Models\Suplier;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginAsAdmin;
use Tests\DuskTestCase;

class SuplierTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function testUserCanVisitIndexSuplierFromSidebarMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit('/dashboard')
                ->waitForText('Dashboard')
                ->assertSee('Master Data')
                ->click('@sidebar-master-treeview')
                ->waitForText('Suplier')
                ->click('@sidebar-master-suplier-index')
                ->assertSee('Master Data - Suplier');
        });
    }

    public function testUserCanSeeAllSupliers(): void
    {

        $this->browse(function (Browser $browser) {
            $suplier = Suplier::factory(10)->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->assertSee('Master Data - Suplier')
                ->assertSee($suplier->first()->name)
                ->screenshot('suplier_index');
        });
    }

    public function testUserCanCreateSuplierWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $suplier = Suplier::factory()->make();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->assertSee('Tambah Suplier')
                ->click('@btn-suplier-create')
                ->assertSee('Tambah Suplier')
                ->type('name', $suplier->name)
                ->type('address', $suplier->address)
                ->type('contact', $suplier->contact)
                ->press('@btn-suplier-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan')
                ->screenshot('suplier_created');
        });
    }

    public function testUserCantCreateSuplierWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->assertSee('Tambah Suplier')
                ->click('@btn-suplier-create')
                ->assertSee('Tambah Suplier')
                ->type('name', '')
                ->type('address', '')
                ->type('contact', '')
                ->press('@btn-suplier-store')
                ->assertSee(__('validation.required', ['Attribute' => 'Nama']))
                ->assertSee(__('validation.required', ['Attribute' => 'Alamat']))
                ->assertSee(__('validation.required', ['Attribute' => 'Contact']))
                ->screenshot('suplier_create_validation');
        });
    }

    public function testuserCanUpdateSuplierWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $suplier = Suplier::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->click('a[href="' . route('master-data.suplier.edit', $suplier->id) . '"]')
                ->assertSee('Ubah Suplier')
                ->clear('name')
                ->type('name', $suplier->name . '_updated')
                ->press('@btn-suplier-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($suplier->name . '_updated')
                ->screenshot('suplier_edited');
        });
    }

    public function testUserCanUpdateSuplierWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $suplier = Suplier::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->click('a[href="' . route('master-data.suplier.edit', $suplier->id) . '"]')
                ->assertSee('Ubah Suplier')
                ->clear('name')
                ->type('name', '')
                ->press('@btn-suplier-update')
                ->assertSee(__('validation.required', ['Attribute' => 'Nama']))
                ->screenshot('suplier_edit_validation');
        });
    }

    public function testUserCanDeleteSuplier(): void
    {
        $this->browse(function (Browser $browser) {
            $suplier = Suplier::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('master-data.suplier.index'))
                ->click('a[href="' . route('master-data.suplier.destroy', $suplier->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($suplier->name)
                ->screenshot('suplier_deleted');
        });
    }
}
