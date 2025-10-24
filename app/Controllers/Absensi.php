<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPegawai;
use App\Models\ModelAbsensi;

class Absensi extends BaseController
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
        //
        $data = [
            'judul' => 'Data Absensi',
            'menu' => 'absensi',
            'page' => 'Absensi/v_absen',
            'absensi' => $this->modelAbsensi->getAbsensi(),
        ];
        return view('v_templete', $data);
    }

    public function tambah()
    {
        //
        $data = [
            'judul' => 'Tambah Data Absensi',
            'menu' => 'absensi',
            'page' => 'Absensi/v_tambahabsensi',
            'pegawai' => $this->modelPegawai->getPegawai(),
        ];
        return view('v_templete', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'id_pegawai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Pegawai Harus Diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Absensi Harus Diisi'
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu Absensi Harus Diisi'
                ]
            ],
        ])) {
            $data = [
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu' => $this->request->getPost('waktu'),
                'status' => $this->request->getPost('status'),
            ];
            $this->modelAbsensi->insertAbsensi($data);
            return redirect()->to('/absensi');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Edit Data Absensi',
            'menu' => 'absensi',
            'page' => 'Absensi/v_editabsensi',
            'absensi' => $this->modelAbsensi->find($id),
            'pegawai' => $this->modelPegawai->getPegawai(),
        ];
        return view('v_templete', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'id_pegawai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Pegawai Harus Diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Absensi Harus Diisi'
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu Absensi Harus Diisi'
                ]
            ],
        ])) {
            $data = [
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu' => $this->request->getPost('waktu'),
                'status' => $this->request->getPost('status'),
            ];
            $this->modelAbsensi->updateAbsensi($id, $data);
            return redirect()->to('/absensi');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function absenHariIni($id_pegawai)
    {
        $absensiModel = new ModelAbsensi();

        $tanggalHariIni = date('Y-m-d');

        // Cek apakah sudah absen hari ini
        $sudahAbsen = $absensiModel
            ->where('id_pegawai', $id_pegawai)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        if ($sudahAbsen) {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini.');
        }

        // Simpan absensi jika belum
        $data = [
            'id_pegawai' => $id_pegawai,
            'tanggal' => $tanggalHariIni,
            'status' => 'Hadir'
        ];
        $absensiModel->insert($data);

        return redirect()->back()->with('success', 'Absensi berhasil dicatat.');
    }


    public function delete($id)
    {
        $this->modelAbsensi->deleteAbsensi($id);
        return redirect()->to('/absensi');
    }

    public function tandaiTidakHadirHariIni()
    {
        $tanggal = date('Y-m-d');

        $db = \Config\Database::connect();

        // Ambil semua pegawai
        $pegawai = $db->table('tb_pegawai')->get()->getResult();

        foreach ($pegawai as $p) {
            // Cek apakah sudah absen
            $cek = $db->table('tb_absensi')
                ->where('id_pegawai', $p->id)
                ->where('tanggal', $tanggal)
                ->get()
                ->getRow();

            // Jika belum absen, tambahkan sebagai Tidak Hadir
            if (!$cek) {
                $data = [
                    'id_pegawai' => $p->id,
                    'tanggal'    => $tanggal,
                    'waktu'      => null,
                    'status'     => 'Tidak Hadir',
                    'berkas'     => null
                ];
                $db->table('tb_absensi')->insert($data);
            }
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Semua yang tidak absen ditandai sebagai Tidak Hadir.']);
    }

    public function detail($id)
    {
        $absensi = $this->modelAbsensi->getDetailAbsensi($id); // Pastikan method ini ada di model
        if (!$absensi) {
            return redirect()->to('/absensi')->with('error', 'Data absensi tidak ditemukan.');
        }

        $data = [
            'judul' => 'Detail Data Absensi',
            'menu' => 'absensi',
            'page' => 'Absensi/v_detailabsensi',
            'absensi' => $absensi
        ];
        return view('v_templete', $data);
    }

    
}
