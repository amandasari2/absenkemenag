<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPegawai;
use App\Models\ModelAbsensi;
use App\Models\UserProfile;

class Dashboard extends BaseController
{
    protected $modelPegawai;
    protected $modelAbsensi;
    protected $userProfile;
    public function __construct()
    {
        $this->modelPegawai = new ModelPegawai();
        $this->modelAbsensi = new ModelAbsensi();
        $this->userProfile = new UserProfile();
    }
    public function index()
    {
        $id = session()->get('id'); // Ambil ID user dari session
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'v_dashboard',
            'pegawai' => $this->modelPegawai->getPegawai(),
            'absensi' => $this->modelAbsensi->getAbsensi(),
            'user' => $this->userProfile->DetailData($id), // <-- Tambahkan ini
        ];
        return view('v_templete', $data);
    }
}
