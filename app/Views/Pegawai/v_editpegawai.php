<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4"><?= $judul ?></h6>

        <!-- Tampilkan pesan error validasi -->
        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('pegawai/update/' . $pegawai['id']) ?>" method="post">
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" value="<?= $pegawai['nip'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" name="nama" value="<?= $pegawai['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" value="<?= $pegawai['jabatan'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Unit Kerja</label>
                <input type="text" class="form-control" name="unit_kerja" value="<?= $pegawai['unit_kerja'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('pegawai') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>