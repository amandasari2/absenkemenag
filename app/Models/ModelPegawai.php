<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    protected $table            = 'tb_pegawai';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'nip', 'jabatan', 'unit_kerja', 'qr_code']; // ← WAJIB DITAMBAH

    public function getPegawai()
    {
        return $this->db->table('tb_pegawai')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        return $this->db->table('tb_pegawai')->insert($data);
    }

    public function DetailData($id)
    {
        return $this->db->table('tb_pegawai')->where('id', $id)->get()->getRowArray();
    }

    public function UpdateData($data, $id)
    {
        return $this->db->table('tb_pegawai')->update($data, ['id' => $id]);
    }

    public function DeleteData($id)
    {
        return $this->db->table('tb_pegawai')->delete(['id' => $id]);
    }

    // public function TotalHadir()
    // {
    //     return $this->db->table('tb_pegawai')->where('status', 'Hadir')->countAllResults();
    // }
}
