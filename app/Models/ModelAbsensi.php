<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAbsensi extends Model
{
    protected $table            = 'tb_absensi';
    protected $primaryKey       = 'id';

    public function getAbsensi()
    {
        return $this->select('tb_absensi.*, tb_pegawai.nip, tb_pegawai.nama, tb_pegawai.jabatan, tb_pegawai.unit_kerja')
            ->join('tb_pegawai', 'tb_pegawai.id = tb_absensi.id_pegawai')
            ->findAll();
    }


    public function getAbsensiByPegawai($id_pegawai)
    {
        return $this->where('id_pegawai', $id_pegawai)->findAll();
    }

    public function getAbsensiByDate($date)
    {
        return $this->where('tanggal', $date)->findAll();
    }

    public function insertAbsensi($data)
    {
        return $this->insert($data);
    }

    public function updateAbsensi($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAbsensi($id)
    {
        return $this->delete($id);
    }

    public function getDetailAbsensi($id)
    {
        return $this->db->table('tb_absensi')
            ->select('tb_absensi.*, tb_pegawai.nip, tb_pegawai.nama')
            ->join('tb_pegawai', 'tb_pegawai.id = tb_absensi.id_pegawai')
            ->where('tb_absensi.id', $id)
            ->get()
            ->getRowArray();
    }

    public function rekapAbsensiPerPegawai($bulan = null, $tahun = null)
    {
        $builder = $this->db->table('tb_pegawai p')
            ->select('p.id, p.nama, p.nip, COUNT(a.id) as total_absen,
                  SUM(CASE WHEN a.status = "hadir" THEN 1 ELSE 0 END) as hadir,
                  SUM(CASE WHEN a.status = "tidak hadir" THEN 1 ELSE 0 END) as tidak_hadir')
            ->join('tb_absensi a', 'a.id_pegawai = p.id', 'left');

        if ($bulan && $tahun) {
            $builder->where('MONTH(a.tanggal)', $bulan);
            $builder->where('YEAR(a.tanggal)', $tahun);
        } elseif ($tahun) {
            $builder->where('YEAR(a.tanggal)', $tahun);
        }

        return $builder->groupBy('p.id')->get()->getResultArray();
    }

    public function getRekapAbsensi($tanggal)
    {
        return $this->db->table('tb_absensi')
            ->select('tb_pegawai.nip, tb_pegawai.nama, 
                  SUM(tb_absensi.status = "Hadir") AS hadir, 
                  SUM(tb_absensi.status = "Tidak Hadir") AS tidak_hadir, 
                  COUNT(tb_absensi.id) AS total_absen')
            ->join('tb_pegawai', 'tb_pegawai.id = tb_absensi.id_pegawai')
            ->where('tb_absensi.tanggal', $tanggal)
            ->groupBy('tb_pegawai.id')
            ->get()
            ->getResultArray();
    }
}
