<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4"><?= $judul ?></h6>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <a href="<?= base_url('absensi/tambah') ?>" class="btn btn-primary">Tambah Absensi</a>
            <a href="<?= base_url('absensi/tandaitidakhadir') ?>" class="btn btn-danger">Tandai Tidak Hadir Hari Ini</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($absensi as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['nip'] ?></td>
                            <td><?= $a['nama'] ?></td>
                            <td><?= $a['tanggal'] ?></td>
                            <td><?= $a['waktu'] ?? '-' ?></td>
                            <td><?= $a['status'] ?></td>
                            <td>
                                <a href="<?= base_url('absensi/detail/' . $a['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?= base_url('absensi/delete/' . $a['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($absensi)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data absensi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>