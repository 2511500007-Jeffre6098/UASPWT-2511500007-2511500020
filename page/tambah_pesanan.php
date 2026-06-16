<div class="content-header">
    <div class="container-fluno">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Pesanan</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(no_pesanan) FROM pesanan") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "P" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "P001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses simpan
if (isset($_POST['tambah'])) {
    $no_pesanan = $_POST['no_pesanan'];
    $waktu_pesanan = $_POST['waktu_pesanan'];
    $username = $_POST['username'];
    $kd_barang = $_POST['kd_barang'];
    $jumlah = $_POST['jumlah'];
    $total_pesanan = $_POST['total_pesanan'];

    $insert_pesanan = mysqli_query($koneksi, "INSERT INTO pesanan VALUES ('$no_pesanan', '$waktu_pesanan', '$username', '$total_pesanan')");

    if (!$insert_pesanan) {
        echo "Gagal insert ke tabel pesanan: " . mysqli_error($koneksi);
        die;
    }

    $allSuccess = true;
    for ($i = 0; $i < count($mapel); $i++) {
        $insertdetail = mysqli_query($koneksi, "INSERT INTO detail_pesanan (no_pesanan, kd_barang, jumlah) VALUES ('$no_pesanan', '{$kd_barang[$i]}', '{$jumlah[$i]}')");
        if (!$insertdetail) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($koneksi);
        }
    }

    if ($allSuccess) {
        echo '
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pesanan">';
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal menyimpan sebagian atau seluruh data detail</h4>
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluno">
        <div class="card">
            <div class="card-body p-2">

                <form method="POST" action="">

                    <h5><?= "No. Pesanan: " . $hasilkode ?></h5>
                    <h5><?= "Waktu Pesanan: " . $waktu = date('Y-m-d H:i:s') ?></h5>
                    <h5><?= "Nama Penjual: " . $_SESSION['username'] ?></h5>
                    <br>

                    <hr>
                    <h5>Detail Pesanan</h5>

                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody id="detail-pesanan">
                            <tr>
                                <td>
                                    <select name="kd_barang" class="form-control" onchange="isiHarga(this)">
                                        <option disabled selected value=''>-- Pilih Barang --</option>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                                        while ($b = mysqli_fetch_array($query)) {
                                            echo "<option value='$b[kd_barang]' data-harga='$b[harga_barang]'>$b[nm_barang]</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="harga" class="form-control" placeholder="-" readonly></td>
                                <td><input type="number" name="jumlah" class="form-control" placeholder="Jumlah" oninput="hitungTotal(this)"></td>
                                <td><input type="text" name="total" class="form-control" placeholder="-" readonly></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- <div no="detail-pesanan">
                        <div class="row mb-2">

                            <div class="col-md-3">
                                <select name="barang" class="form-control">
                                    <option disabled selected value="">-- Pilih Barang --</option>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                                        while ($b = mysqli_fetch_array($query)) {
                                            echo "<option value='$b[kd_barang]'>$b[nm_barang]</option>";
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah">
                            </div>
                        </div>
                    </div> -->

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">+ Tambah Barang</button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">

                </form>

                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detail-pesanan');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('select').forEach(select => select.value = '');
                        row.querySelectorAll('input').forEach(input => input.value = '');
                        container.appendChild(row);
                    }

                    function isiHarga(select) {
                        let harga = select.options[select.selectedIndex].dataset.harga;
                        let row = select.closest('tr');
                        row.querySelector('[name="harga"]').value = harga;
                    }

                    function hitungTotal(input){
                        let row = input.closest('tr');
                        let harga = row.querySelector('[name="harga"]').value || 0;
                        let total = harga * parseInt(row.querySelector('[name="jumlah"]').value || 0);
                        row.querySelector('[name="total"]').value = total;
                    }
                </script>

            </div>
        </div>
    </div>
</section>