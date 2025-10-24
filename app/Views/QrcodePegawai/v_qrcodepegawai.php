<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4"><?= $judul ?></h6>

        <div class="row">
            <?php foreach ($pegawai as $p): ?>
                <div class="col-md-3 text-center mb-4">
                    <img src="<?= base_url('qrcodepegawai/generate/' . $p['nip']) ?>" alt="QR Code" width="150">
                </div>
            <?php endforeach; ?>

            <?php if (empty($pegawai)): ?>
                <div class="col-12 text-center">
                    <p>Tidak ada QR Code pegawai yang tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
