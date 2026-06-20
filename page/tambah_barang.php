<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Barang</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(kd_barang) FROM Barang") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "B-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "B-001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses simpan
if (isset($_POST['tambah'])) {
    $kd_barang = $_POST['kd_barang'];
    $nm_barang = $_POST['nm_barang'];
    $harga_barang = $_POST['harga_barang'];
    $kategori_barang = $_POST['kategori_barang'];
    $stok_barang = $_POST['stok_barang'];

    $insert = mysqli_query($koneksi, "INSERT INTO barang VALUES ('$kd_barang', '$nm_barang', '$harga_barang', '$kategori_barang', '$stok_barang')");

    if ($insert) {
        echo '
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=barang">';
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal Disimpan</h4>
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">

                <form method="POST" action="">

                    <div class="form-group">
                        <label for="kd_barang">Kode Barang</label>
                        <input 
                            type="text" 
                            name="kd_barang" 
                            value="<?= $hasilkode; ?>" 
                            class="form-control" 
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="nm_barang">Nama Barang</label>
                        <input 
                            type="text" 
                            name="nm_barang" 
                            id="nm_barang"
                            placeholder="Nama barang" 
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="harga_barang">Harga Barang</label>
                        <input 
                            type="number" 
                            name="harga_barang" 
                            id="harga_barang" 
                            placeholder="Harga barang" 
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="kategori_barang">Kategori Barang</label>
                        <select 
                            name="kategori_barang" 
                            id="kategori_barang" 
                            class="form-control">
                            <option disabled selected>--Pilih Kategori--</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Perawatan pribadi">Perawatan pribadi</option>
                            <option value="Kebutuhan rumah tangga">Kebutuhan rumah tangga</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input 
                            type="number" 
                            name="stok_barang" 
                            id="stok_barang"
                            placeholder="Stok barang" 
                            class="form-control">
                    </div>

                    <div class="card-footer">
                        <input 
                            type="submit" 
                            class="btn btn-primary" 
                            name="tambah" 
                            value="Simpan">
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>