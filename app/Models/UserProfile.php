<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfile extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role'];

    // Ambil semua data
    public function AllData()
    {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    // Tambah data baru
    public function InsertData($data)
    {
        $this->db->table($this->table)->insert($data);
    }

    // Ambil detail berdasarkan ID
    public function DetailData($id)
    {
        return $this->db->table($this->table)
            ->where($this->primaryKey, $id)
            ->get()->getRowArray();
    }

    // Update data berdasarkan ID
    public function UpdateData($data)
    {
        $this->db->table($this->table)
            ->where($this->primaryKey, $data[$this->primaryKey])
            ->update($data);
    }

    // Hapus data berdasarkan ID
    public function DeleteData($data)
    {
        $this->db->table($this->table)
            ->where($this->primaryKey, $data[$this->primaryKey])
            ->delete();
    }

    // Hitung total user
    public function getTotalUser()
    {
        return $this->db->table($this->table)->countAll();
    }
}
