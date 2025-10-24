<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Profil</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Profil</li>
    </ol>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= base_url('user/UpdateData/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($user['nama']) ?>">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (opsional)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Profil (opsional)</label>
                    <?php if (!empty($user['foto'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/' . $user['foto']) ?>" alt="Foto Profil" width="100">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
