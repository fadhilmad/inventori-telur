<?php

namespace App\Cetak;

use App\Libraries\EasyTable\exFPDF;
use App\Libraries\EasyTable\easyTable;
use App\Models\TransaksiKeluar;

trait NotaKeluar
{
    public function cetak(TransaksiKeluar $keluar)
    {
        $keluar->load('details', 'details.telur', 'details.stok');

        $pdf = new exFPDF('L', 'mm', [105, 160]);

        $pdf->SetTitle("Nota Keluar Verte Telur");
        $pdf->addPage();

        $pdf->setFont('Arial', 'B', 8);


        $pdf->setY(10);
        $pdf->setX(10);
        $pdf->MultiCell(140, 5, 'NOTA KELUAR', 0, 'C');

        $pdf->setY(20);

        $table = new easyTable($pdf, "{30, 5, 70, 30, 5, 40}", 'border:0;width:100%');
        $table->easyCell("Tanggal", "width: 40%;border: 0;");
        $table->easyCell(":", "border: 0;");
        $table->easyCell($keluar->tanggal_keluar, "border: 0;");
        $table->easyCell("Tujuan", "border: 0;");
        $table->easyCell(":", "border: 0;");
        $table->easyCell($keluar->tujuan, "border: 0;");
        $table->printRow();
        $table->endTable();


        $table = new easyTable($pdf, "{10, 120, 30}", 'border:1;width:100%');
        $table->easyCell("No", "border: 1;align:C;");
        $table->easyCell("Uraian", "border: 1;align:C");
        $table->easyCell("Jml", "border: 1;align:C;");
        $table->printRow();

        $index = 1;
        $pdf->setFont('Arial', '', 8);
        foreach ($keluar->details as $key => $detail) {
            $table->easyCell($index, "border: 1;align:C;");
            $table->easyCell($detail->telur->name, "border: 1;align:L");
            $table->easyCell($detail->qty . " " . $detail->stok->satuan_kecil, "border: 1;align:C;");
            $table->printRow();
            $index++;
        }
        $table->endTable(-0.1);


        $pdf->output('I', 'nota_keluar_' . $keluar->tanggal_keluar . '_' . $keluar->id);

        exit;
    }
}
