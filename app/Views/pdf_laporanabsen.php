<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PDF Absensi</title>
    <link href="<?= base_url('admin/img/logodepag.png') ?>" rel="icon">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 5px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat img {
            float: left;
            width: 90px;
            height: auto;
        }

        .kop-surat h1,
        .kop-surat h2,
        .kop-surat p {
            margin: 0;
        }

        .kop-surat .judul {
            font-weight: bold;
            font-size: 18px;
        }

        .kop-surat .alamat {
            font-size: 14px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        h2 {
            text-align: center;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .periode {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<?php use CodeIgniter\HTTP\URI; ?>

    <!-- KOP SURAT -->
    <div class="kop-surat clearfix">
        <img src="<?= base_url('admin/img/logodepag.png') ?>" alt="Logo Kemenag">
        <div>
            <h2>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h2>
            <h2>KANTOR KEMENTERIAN AGAMA KABUPATEN ASAHAN</h2>
            <!-- <h1 class="judul">KANTOR URUSAN AGAMA KECAMATAN KOTA KISARAN TIMUR</h1> -->
            <p class="alamat">Jl. Turi No.4, Kisaran Kota, Kec. Kota Kisaran Barat</p>
            <p class="alamat">Kabupaten Asahan, Sumatera Utara - Kode Pos 21216</p>
        </div>
    </div>

    <!-- JUDUL LAPORAN -->
    <h2>Laporan Rekap Absensi Pegawai</h2>
    <p class="periode">Periode: <?= date('d-m-Y', strtotime($tanggal_lengkap)) ?> </p>
    <!-- TABEL ABSENSI -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Hadir</th>
                <th>Tidak Hadir</th>
                <th>Total Hari Absen</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($absensi as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a['nip'] ?></td>
                    <td><?= $a['nama'] ?></td>
                    <td><?= $a['hadir'] ?></td>
                    <td><?= $a['tidak_hadir'] ?></td>
                    <td><?= $a['total_absen'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>