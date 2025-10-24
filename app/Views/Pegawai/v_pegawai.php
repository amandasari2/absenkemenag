<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4"><?= $judul ?></h6>
        <div class="mb-3">
            <a href="<?= base_url('pegawai/tambah') ?>" class="btn btn-primary">Tambah Pegawai</a>
        </div>
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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Unit Kerja</th>
                        <th scope="col">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pegawai as $p): ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $p['nip'] ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['jabatan'] ?></td>
                            <td><?= $p['unit_kerja'] ?></td>
                            <td>
                                <a href="<?= base_url('pegawai/edit/' . $p['id']) ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('pegawai/delete/' . $p['id']) ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pegawai)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pegawai</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>