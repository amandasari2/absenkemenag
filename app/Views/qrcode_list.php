<h2>Daftar QR Code Pegawai</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>QR Code</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pegawai as $p): ?>
            <tr>
                <td><?= $p['nip'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td>
                    <img src="<?= base_url('qrcodepegawai/generate/' . $p['nip']) ?>" width="150">
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
