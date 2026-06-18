<div class="content-header">
    <div class="container-fluno">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pesanan</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $no = $_GET['no'];
        mysqli_query($koneksi, "DELETE FROM detail_pesanan WHERE no_pesanan = '$no'");
        mysqli_query($koneksi, "DELETE FROM pembayaran WHERE no_pesanan = '$no'");
        $query = mysqli_query($koneksi, "DELETE FROM pesanan WHERE no_pesanan = '$no'");


        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus
            </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=pesanan">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluno">
        <div class="card">
            <div class="card-body">


                    <a href="index.php?page=tambah_pesanan" class="btn btn-primary btn-sm">
                        Tambah Pesanan
                    </a>
                    <br><br>

                    <table class="table table-sm table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>No. Pesanan</th>
                                <th>Nama Penjual</th>
                                <th>Waktu Pesanan</th>
                                <th>Total Pesanan</th>
                                <th>Detail pesanan</th>                                  
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM pesanan");
                            while ($result = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $result['no_pesanan']; ?></td>
                                    <td><?= $result['username']; ?></td>
                                    <td><?= $result['waktu_pesanan']; ?></td>
                                    <td><?= $result['total_pesanan']; ?></td>
                                    <td>
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $det = mysqli_query($koneksi,"SELECT * FROM detail_pesanan JOIN barang ON detail_pesanan.kd_barang = barang.kd_barang
                                                    WHERE detail_pesanan.no_pesanan = '{$result['no_pesanan']}'"
                                                );

                                                while ($d = mysqli_fetch_assoc($det)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $d['nm_barang']; ?></td>
                                                        <td><?= number_format($d['harga_barang']); ?></td>
                                                        <td><?= $d['jumlah']; ?></td>
                                                        <td><?= number_format($d['total']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                                                        </td>
                                    <td>
                                        <a href="index.php?page=pesanan&action=hapus&no=<?= $result['no_pesanan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                            <span class="badge badge-danger">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <a href="index.php?page=cetak_pesanan" class="btn btn-primary btn-sm">
                        Cetak Struk
                    </a>
            </div>
        </div>
    </div>
</div>