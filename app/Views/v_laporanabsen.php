<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Laporan Rekap Absensi Pegawai</h6>

        <form method="get" class="row mb-3">
            <div class="col-md-4">
                <input type="date" name="tanggal_lengkap" class="form-control"
                    value="<?= esc($tanggal_lengkap ?? '') ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <?php if ($tanggal_lengkap): ?>
                    <a href="<?= base_url('cetak-pdf?tanggal_lengkap=' . $tanggal_lengkap) ?>" class="btn btn-success">Cetak PDF</a>
                <?php endif ?>
            </div>
        </form>

        <?php if ($tanggal_lengkap): ?>
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
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
                        <?php if (count($absensi) > 0): ?>
                            <?php $no = 1;
                            foreach ($absensi as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($a['nip']) ?></td>
                                    <td><?= esc($a['nama']) ?></td>
                                    <td><?= esc($a['hadir']) ?></td>
                                    <td><?= esc($a['tidak_hadir']) ?></td>
                                    <td><?= esc($a['total_absen']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data absensi pada tanggal <?= date('d-m-Y', strtotime($tanggal_lengkap)) ?></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>

    </div>
</div>