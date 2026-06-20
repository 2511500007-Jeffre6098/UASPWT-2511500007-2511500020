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
    $hasilkodePembayaran = "PB" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "P001";
    $hasilkodePembayaran = "P001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses simpan
if (isset($_POST['tambah'])) {
    $no_pesanan = $hasilkode;
    $waktu_pesanan = $waktu = date('Y-m-d H:i:s');
    $username = $_SESSION['username'];
    $kd_barang = $_POST['kd_barang'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];
    $total_pesanan = $_POST['total_pesanan'];
    $no_pembayaran = $hasilkodePembayaran;
    $nominal = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];

    $insert_pesanan = mysqli_query($koneksi, "INSERT INTO pesanan VALUES ('$no_pesanan', '$waktu_pesanan', '$total_pesanan', '$username')");
    $insert_pembayaran = mysqli_query($koneksi, "INSERT INTO pembayaran VALUES ('$no_pembayaran', '$no_pesanan', '$nominal', '$kembalian')");

    if (!$insert_pesanan || !$insert_pembayaran) {
        echo "Gagal insert ke tabel pesanan: " . mysqli_error($koneksi);
        die;
    }

    $allSuccess = true;
    for ($i = 0; $i < count($kd_barang); $i++) {
        $insertdetail = mysqli_query($koneksi, "INSERT INTO detail_pesanan (no_pesanan, kd_barang, jumlah, total) VALUES ('$no_pesanan', '{$kd_barang[$i]}', '{$jumlah[$i]}', '{$total[$i]}')");
        if (!$insertdetail) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($koneksi);
        } else {
            mysqli_query($koneksi, "UPDATE barang SET stok_barang = stok_barang - '{$jumlah[$i]}' WHERE kd_barang = '{$kd_barang[$i]}'");
        }
    }

    if ($allSuccess) {
        echo "
            <script>
                window.location='page/cetak_struk.php?no=$no_pesanan';
            </script>
            ";
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
                                    <select name="kd_barang[]" id="kd_barang[]" class="form-control" onchange="isiHarga(this)">
                                        <option disabled selected value=''>-- Pilih Barang --</option>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                                        while ($b = mysqli_fetch_array($query)) {
                                            echo "<option value='$b[kd_barang]' data-harga='$b[harga_barang]'>$b[nm_barang]</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="harga[]"  id="harga[]" class="form-control" placeholder="-" readonly></td>
                                <td><input type="number" name="jumlah[]" id="jumlah[]" class="form-control" placeholder="Jumlah" oninput="hitungTotal(this)"></td>
                                <td><input type="text" name="total[]" id="total[]" class="form-control" placeholder="-" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total Pesanan:</strong></td>
                                <td><input type="text" name="total_pesanan" id="total_pesanan" class="form-control" placeholder="-" readonly></td>
                        </tbody>
                    </table>
                    <br>
                    <table>
                    </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Nominal Bayar:</strong>
                            </td>
                                <td><input type="text" name="bayar" id="bayar" class="form-control" placeholder="Rupiah"  oninput="hitungKembalian()">
                            </td>
                            <td colspan="3" class="text-right"><strong>Kembalian:</strong>
                            </td>
                                <td><input type="text" name="kembalian" id="kembalian" class="form-control" placeholder="-" readonly>
                            </td>
                          
                            </table>
                            <br>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">+ Tambah Barang</button>
                    <br><br>
                    <button type="submit" class="btn btn-primary" name="tambah" value="Simpan" >Simpan dan Cetak Struk</button>

                </form>

                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detail-pesanan');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('select').forEach(select => select.value = '');
                        row.querySelectorAll('input').forEach(input => input.value = '');
                        let rowTotalPesanan = container.lastElementChild;
                        container.insertBefore(row, rowTotalPesanan);
                    }

                    function isiHarga(select) {
                        let harga = select.options[select.selectedIndex].dataset.harga;
                        let row = select.closest('tr');
                        row.querySelector('[name="harga[]"]').value = harga;
                    }

                    function hitungTotal(input){
                        let row = input.closest('tr');
                        let harga = row.querySelector('[name="harga[]"]').value || 0;
                        let total = harga * row.querySelector('[name="jumlah[]"]').value || 0;
                        row.querySelector('[name="total[]"]').value = total;
                        hitungTotalPesanan();
                    }

                    function hitungTotalPesanan(){
                        let totalPesanan = 0;
                        document.querySelectorAll('[name="total[]"]').forEach(function(input){
                            let total = parseInt(input.value) || 0;
                            totalPesanan += total;
                        });
                        document.getElementById('total_pesanan').value = totalPesanan;
                    }

                    function hitungKembalian(){
                        let bayar = parseInt(document.getElementById('bayar').value) || 0;
                        let totalPesanan = parseInt(document.getElementById('total_pesanan').value) || 0;
                        let kembalian = bayar - totalPesanan;
                        document.getElementById('kembalian').value = kembalian;
                        // Simpan kembalian ke input tersembunyi atau tampilkan di UI sesuai kebutuhan
                    }
                </script>

            </div>
        </div>
    </div>
</section>