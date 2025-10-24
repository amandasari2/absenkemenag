<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Controllers\ModelAbsensi;

class Home extends Controller
{
    public function index()
    {
        return view('v_home');
    }

    public function simpan()
{
    $json = $this->request->getJSON();
    $nip = preg_replace('/\s+/', '', $json->nip); // bersihkan semua karakter whitespace

    $db = \Config\Database::connect();

    $pegawai = $db->table('tb_pegawai')->where('nip', $nip)->get()->getRow();

    if (!$pegawai) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'NIP tidak ditemukan', 'nip' => $nip]);
    }

    $today = date('Y-m-d');
    $cek = $db->table('tb_absensi')
        ->where('id_pegawai', $pegawai->id)
        ->where('tanggal', $today)
        ->get()
        ->getRow();

    if ($cek) {
        return $this->response->setJSON(['status' => 'exists', 'message' => 'Sudah absen hari ini']);
    }

    $data = [
        'id_pegawai' => $pegawai->id,
        'tanggal' => $today,
        'waktu' => date('Y-m-d H:i:s'),
        'status' => 'Hadir',
        'berkas' => null
    ];

    $db->table('tb_absensi')->insert($data);

    return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi berhasil']);
}

}
