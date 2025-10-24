<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPegawai;
use App\Models\ModelAbsensi;
use Dompdf\Dompdf;

class LaporanAbsen extends BaseController
{
    protected $modelPegawai;
    protected $modelAbsensi;

    public function __construct()
    {
        $this->modelPegawai = new ModelPegawai();
        $this->modelAbsensi = new ModelAbsensi();
    }

    public function index()
    {
        $tanggal_lengkap = $this->request->getGet('tanggal_lengkap');

        if ($tanggal_lengkap) {
            $absensi = $this->modelAbsensi->getRekapAbsensi($tanggal_lengkap);
        } else {
            $absensi = []; // Kosongkan data jika belum pilih tanggal
        }

        $data = [
            'judul' => 'Laporan Absensi',
            'menu' => 'laporanabsen',
            'page' => 'v_laporanabsen',
            'absensi' => $absensi,
            'tanggal_lengkap' => $tanggal_lengkap
        ];
        return view('v_templete', $data);
    }

    public function cetak_pdf()
    {
         $tanggal_lengkap = $this->request->getGet('tanggal_lengkap');

        if ($tanggal_lengkap) {
            $absensi = $this->modelAbsensi->getRekapAbsensi($tanggal_lengkap);
        } else {
            $absensi = []; // Kosongkan data jika belum pilih tanggal
        }

        $data = [
            'absensi' => $absensi,
            'tanggal_lengkap' => $tanggal_lengkap
        ];

        $dompdf = new \Dompdf\Dompdf();
        $html = view('pdf_laporanabsen', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Absensi.pdf');
    }
}
