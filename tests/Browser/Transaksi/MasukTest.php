<?php

namespace Tests\Browser\Transaksi;

use App\Models\Suplier;
use App\Models\TransaksiMasuk;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\LoginAsAdmin;

class MasukTest extends DuskTestCase
{
    use DatabaseTruncation;
    /**
     * A Dusk test example.
     */
    public function testUserCanVisitIndexTransaksiMasukFromSidebarMenu(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit('/dashboard')
                ->waitForText('Dashboard')
                ->assertSee('Transaksi')
                ->click('@sidebar-transaksi-treeview')
                ->waitForText('Masuk')
                ->click('@sidebar-transaksi-masuk-index')
                ->assertSee('Transaksi Masuk');
        });
    }

    public function testUserCanSeeAllTransaksiMasukData(): void
    {
        $this->browse(function (Browser $browser) {
            $tMasuk = TransaksiMasuk::factory(10)->create();

            $tMasuk = $tMasuk->first();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->assertSee('Transaksi Masuk')
                ->assertSee($tMasuk->tanggal_masuk)
                ->screenshot('t_masuk_index');
        });
    }

    public function testUserCanCreateTransaksiMasukWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $tmasuk = TransaksiMasuk::factory()->make();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->assertSee('Buat Transaksi')
                ->click('@btn-tmasuk-create')
                ->assertSee('Buat Transaksi Masuk')
                ->type('tanggal_masuk', $tmasuk->tanggal_masuk)
                ->select('suplier_id', $tmasuk->suplier_id)
                ->press('@btn-tmasuk-store')
                ->waitForText('Data berhasil disimpan')
                ->assertSee('Data berhasil disimpan')
                ->screenshot('t_masuk_create');
        });
    }

    public function testUserCantCreateTransaksiMasukWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->assertSee('Buat Transaksi')
                ->click('@btn-tmasuk-create')
                ->assertSee('Buat Transaksi Masuk')
                ->type('tanggal_masuk', '')
                ->select('suplier_id', '')
                ->press('@btn-tmasuk-store')
                ->assertSee(__('validation.required', ['Attribute' => 'Tanggal masuk']))
                ->assertSee(__('validation.required', ['Attribute' => 'Suplier']))
                ->screenshot('telur_create_validation');
        });
    }

    public function testUserCanUpdateTransaksiMasukWithValidData(): void
    {
        $this->browse(function (Browser $browser) {
            $tmasuk = TransaksiMasuk::factory()->create();

            $newSuplier = Suplier::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->click('a[href="' . route('transaksi.masuk.edit', $tmasuk->id) . '"]')
                ->assertSee('Ubah Transaksi')
                ->select('suplier_id', $newSuplier->id)
                ->click('@btn-tmasuk-update')
                ->waitForText('Data berhasil diubah')
                ->assertSee('Data berhasil diubah')
                ->assertSee($newSuplier->name)
                ->screenshot('t_masuk_edited');
        });
    }

    public function testUserCanUpdateTransaksiMasukWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $tmasuk = TransaksiMasuk::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->click('a[href="' . route('transaksi.masuk.edit', $tmasuk->id) . '"]')
                ->assertSee('Ubah Transaksi')
                ->select('suplier_id', '')
                ->click('@btn-tmasuk-update')
                ->assertSee(__('validation.required', ['Attribute' => 'Suplier']))
                ->screenshot('telur_update_validation');
        });
    }

    public function testUserCanDeleteTransaksiMasuk(): void
    {
        $this->browse(function (Browser $browser) {
            $tMasuk = TransaksiMasuk::factory()->create();

            $browser->on(new LoginAsAdmin)
                ->startAdminSession()
                ->visit(route('transaksi.masuk.index'))
                ->assertSee($tMasuk->tanggal_masuk)
                ->screenshot('before_delete_tmasuk')
                ->click('a[href="' . route('transaksi.masuk.destroy', $tMasuk->id) . '"]')
                ->waitFor('.swal2-container')
                ->press('Ya, hapus!')
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee($tMasuk->tanggal_masuk)
                ->screenshot('delete_tmasuk');
        });
    }
}
