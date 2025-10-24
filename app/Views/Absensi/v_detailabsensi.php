<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4"><?= $judul ?></h6>

        <table class="table table-bordered">
            <tr>
                <th>NIP</th>
                <td><?= $absensi['nip'] ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td><?= $absensi['nama'] ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= $absensi['tanggal'] ?></td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td><?= $absensi['waktu'] ?? '-' ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $absensi['status'] ?></td>
            </tr>
        </table>

        <a href="<?= base_url('absensi') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
