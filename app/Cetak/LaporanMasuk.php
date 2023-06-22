<?php

namespace App\Cetak;

use App\Libraries\EasyTable\exFPDF;
use App\Libraries\EasyTable\easyTable;
use DB;
use Illuminate\Http\Request;

trait LaporanMasuk
{
    public function cetakLaporan(Request $request)
    {
        if (!$request->filled('start') || !$request->filled('end')) {
            abort(403, 'Tanggal awal dan akhir dibutuhkan');
        }

        if (($request->start > $request->end) || ($request->end < $request->start)) {
            abort(403, 'Periode laporan tidak valid, silahkan cek tanggal awal dan akhir.');
        }

        $masuks = DB::select("
            SELECT
                d.name,
                b.tanggal_masuk,
                c.name as telur,
                a.satuan_besar,
                a.satuan_kecil,
                SUM(a.qty_satuan_besar) as qty_besar,
                SUM(a.total) as qty_kecil
            FROM
                transaksi_masuk_details a
            JOIN transaksi_masuk b
                on b.id = a.transaksi_masuk_id and b.insert_stok = 'sudah'
            JOIN telurs c
                on c.id = a.telur_id
            JOIN supliers d
                on d.id = b.suplier_id
            WHERE b.tanggal_masuk >= ? and b.tanggal_masuk <= ?
            GROUP BY 1,2,3,4, 5
            ORDER BY 2 ASC
        ", [$request->start, $request->end]);

        $pdf = new exFPDF();

        $pdf->SetTitle("Laporan Penerimaan Verte Telur");
        $pdf->addPage();

        $pdf->setFont('Arial', 'B', 15);


        $pdf->setY(10);
        $pdf->setX(10);
        $pdf->MultiCell(190, 5, "Laporan Penerimaan Periode $request->start s/d $request->end", 0, 'C');

        $pdf->setY(20);

        $pdf->setFont('Arial', 'B', 8);


        $table = new easyTable($pdf, "{10, 20, 30, 40, 30, 30}", 'border:1;width:100%');
        $table->easyCell("No", "border: 1;align:C;");
        $table->easyCell("Suplier", "border: 1;align:C;");
        $table->easyCell("Tanggal", "border: 1;align:C;");
        $table->easyCell("Item", "border: 1;align:C");
        $table->easyCell("Jml Satuan Besar", "border: 1;align:C;");
        $table->easyCell("Jml Satuan Kecil", "border: 1;align:C;");
        $table->printRow();

        $index = 1;
        $pdf->setFont('Arial', '', 8);
        foreach ($masuks as $key => $masuk) {
            $table->easyCell($index, "border: 1;align:C;");
            $table->easyCell($masuk->name, "border: 1;align:C;");
            $table->easyCell($masuk->tanggal_masuk, "border: 1;align:C;");
            $table->easyCell($masuk->telur, "border: 1;align:C;");
            $table->easyCell(number_format($masuk->qty_besar) . " " . $masuk->satuan_kecil, "border: 1;align:C;");
            $table->easyCell(number_format($masuk->qty_kecil) . " " . $masuk->satuan_kecil, "border: 1;align:C;");
            $table->printRow();
            $index++;
        }
        $table->endTable(-0.1);


        $pdf->output('I', 'laporan_penerimaan_' . $request->start . '_sd_' . $request->end);

        exit;
    }
}
