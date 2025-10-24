<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
    protected $modelPegawai;
    public function __construct()
    {
        $this->modelPegawai = new ModelPegawai();
    }
    public function index()
    {
        //
        $data = [
            'judul' => 'Data Pegawai',
            'menu' => 'pegawai',
            'page' => 'Pegawai/v_pegawai',
            'pegawai' => $this->modelPegawai->getPegawai(),
        ];
        return view('v_templete', $data);
    }

    public function tambah()
    {
        //
        $data = [
            'judul' => 'Tambah Data Pegawai',
            'menu' => 'pegawai',
            'page' => 'Pegawai/v_tambahpegawai',
            'pegawai' => $this->modelPegawai->getPegawai(),
        ];
        return view('v_templete', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai Harus Diisi'
                ]
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP Pegawai Harus Diisi'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Pegawai Harus Diisi'
                ]
            ],
            'unit_kerja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Unit Kerja Pegawai Harus Diisi'
                ]
            ],
        ])) {
            $nip = $this->request->getPost('nip');
            $data = [
                'nama' => $this->request->getPost('nama'),
                'nip' => $nip,
                'jabatan' => $this->request->getPost('jabatan'),
                'unit_kerja' => $this->request->getPost('unit_kerja'),
            ];

            // Simpan dulu ke DB
            $this->modelPegawai->InsertData($data);

            // Ambil ID Pegawai terakhir
            $idPegawai = $this->modelPegawai->insertID(); // ← otomatis dari CI4

            // Generate QR Code dari NIP
            $qrFileName = 'qr_' . $nip . '.png';
            $qrDir = FCPATH . 'qrcode/';
            $qrFilePath = $qrDir . $qrFileName;

            if (!is_dir($qrDir)) {
                mkdir($qrDir, 0777, true);
            }


            // Build QR
            $result = \Endroid\QrCode\Builder\Builder::create()
                ->writer(new \Endroid\QrCode\Writer\PngWriter())
                ->data($nip)
                ->encoding(new \Endroid\QrCode\Encoding\Encoding('UTF-8'))
                ->errorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->labelText("NIP: $nip")
                ->labelFont(new \Endroid\QrCode\Label\Font\NotoSans(16))
                ->build();

            // Simpan ke file
            $result->saveToFile($qrFilePath);

            // Update kolom qr_code di DB
            $this->modelPegawai->update($idPegawai, [
                'qr_code' => $qrFileName
            ]);

            session()->setFlashdata('pesan', 'Data Pegawai & QR Code berhasil ditambahkan');
            return redirect()->to(base_url('pegawai'));
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('pegawai/tambah'));
        }
    }


    public function edit($id)
    {
        $data = [
            'judul' => 'Edit Data Pegawai',
            'menu' => 'pegawai',
            'page' => 'Pegawai/v_editpegawai',
            'pegawai' => $this->modelPegawai->DetailData($id),
        ];
        return view('v_templete', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai Harus Diisi'
                ]
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP Pegawai Harus Diisi'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Pegawai Harus Diisi'
                ]
            ],
            'unit_kerja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Unit Kerja Pegawai Harus Diisi'
                ]
            ],
        ])) {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'nip' => $this->request->getPost('nip'),
                'jabatan' => $this->request->getPost('jabatan'),
                'unit_kerja' => $this->request->getPost('unit_kerja'),
            ];
            $this->modelPegawai->UpdateData($data, $id);

            session()->setFlashdata('pesan', 'Data Pegawai Berhasil Diupdate');
            return redirect()->to(base_url('pegawai'));
        }
        // Jika validasi gagal
        else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('pegawai/edit/' . $id));
        }
    }

    public function delete($id)
    {
        $this->modelPegawai->DeleteData($id);
        session()->setFlashdata('pesan', 'Data Pegawai Berhasil Dihapus');
        return redirect()->to(base_url('pegawai'));
    }
}
