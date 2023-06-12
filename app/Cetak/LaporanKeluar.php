<?php

namespace App\Cetak;

use App\Libraries\EasyTable\exFPDF;
use App\Libraries\EasyTable\easyTable;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

trait LaporanKeluar
{
    public function cetakLaporan(Request $request)
    {
        if (!$request->filled('start') || !$request->filled('end')) {
            abort(403, 'Tanggal awal dan akhir dibutuhkan');
        }

        if (($request->start > $request->end) || ($request->end < $request->start)) {
            abort(403, 'Periode laporan tidak valid, silahkan cek tanggal awal dan akhir.');
        }

        $keluars = TransaksiKeluar::with('details', 'details.telur', 'details.stok')
            ->where('tanggal_keluar', '>=', $request->start)
            ->where('tanggal_keluar', '<=', $request->end)
            ->get();

        $pdf = new exFPDF();

        $pdf->SetTitle("Laporan Pengeluaran Verte Telur");
        $pdf->addPage();

        $pdf->setFont('Arial', 'B', 15);


        $pdf->setY(10);
        $pdf->setX(10);
        $pdf->MultiCell(190, 5, "Laporan Pengeluaran Periode $request->start s/d $request->end", 0, 'C');

        $pdf->setY(20);

        $pdf->setFont('Arial', 'B', 8);


        $table = new easyTable($pdf, "{10, 20, 30, 70, 30}", 'border:1;width:100%');
        $table->easyCell("No", "border: 1;align:C;");
        $table->easyCell("Tanggal", "border: 1;align:C;");
        $table->easyCell("Tujuan", "border: 1;align:C");
        $table->easyCell("Item", "border: 1;align:C");
        $table->easyCell("Jml", "border: 1;align:C;");
        $table->printRow();

        $index = 1;
        $pdf->setFont('Arial', '', 8);
        foreach ($keluars->sortBy('tanggal_keluar') as $key => $keluar) {
            $table->easyCell($index, "border: 1;align:C;rowspan: {$keluar->details->count()}");
            $table->easyCell($keluar->tanggal_keluar, "border: 1;align:C;rowspan: {$keluar->details->count()}");
            $table->easyCell($keluar->tujuan, "border: 1;align:C;rowspan: {$keluar->details->count()}");
            foreach ($keluar->details as $key => $detail) {
                $table->easyCell($detail->telur->name, "border: 1;align:C;");
                $table->easyCell(number_format($detail->qty) . " " . $detail->stok->satuan_kecil, "border: 1;align:C;");

                $table->printRow();
            }
            $table->printRow();
            $index++;
        }
        // $table->endTable(-0.1);


        $pdf->output('I', 'laporan_keluar_' . $request->tanggal_masuk . '_sd_' . $request->tanggal_keluar);

        exit;
    }
}
