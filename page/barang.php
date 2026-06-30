<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Barang</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];

        $query = mysqli_query($koneksi, "DELETE FROM barang WHERE kd_barang = '$kd'");

        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus
            </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=barang">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <a href="index.php?page=tambah_barang" class="btn btn-primary btn-sm">
                    Tambah barang
                </a>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Kategori Barang</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM barang");

                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['kd_barang']; ?></td>
                                <td><?= $result['nm_barang']; ?></td>
                                <td><?= "Rp " . number_format($result['harga_barang'], 0, ',', '.'); ?></td>
                                <td><?= $result['kategori_barang']; ?></td>
                                <td><?= $result['stok_barang']; ?></td>
                                <td>
                                    <a href="index.php?page=barang&action=hapus&kd=<?= $result['kd_barang']; ?>">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>

                                    <a href="index.php?page=edit_barang&kd=<?= $result['kd_barang']; ?>">
                                        <span class="badge badge-warning">Edit</span>
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