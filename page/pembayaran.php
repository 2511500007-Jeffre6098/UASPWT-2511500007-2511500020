<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Histori Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $no = $_GET['no'];

        $query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE no_pembayaran = '$no'");

        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus
            </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>No. pembayaran</th>
                            <th>No. pesanan</th>
                            <th>Nominal</th>
                            <th>Kembalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM pembayaran join pesanan on pesanan.no_pesanan = pembayaran.no_pesanan");

                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['no_bayar']; ?></td>
                                <td><?= $result['no_pesanan']; ?></td>
                                <td><?= "Rp " . number_format($result['nominal'], 0, ',', '.'); ?></td>
                                <td><?= "Rp " . number_format($result['kembalian'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="index.php?page=pembayaran&action=hapus&no=<?= $result['no_bayar']; ?>">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>