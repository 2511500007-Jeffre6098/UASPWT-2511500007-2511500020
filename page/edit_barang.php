<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Barang</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];

// PERBAIKAN: SELECT harus pakai *
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE kd_barang='$kd'");
$edit  = mysqli_fetch_array($query);

// Proses update
if (isset($_POST['tambah'])) {
    $kd_barang = $_POST['kd_barang'];
    $nm_barang = $_POST['nm_barang'];
    $hrg_barang = $_POST['hrg_barang'];
    $ktg_barang = $_POST['ktg_barang'];

    // PERBAIKAN: tanda kutip kkm diperbaiki
    $update = mysqli_query($koneksi, "UPDATE barang 
        SET nm_barang='$nm_barang', hrg_barang='$hrg_barang', ktg_barang='$ktg_barang' 
        WHERE kd_barang='$kd_barang'
    ");

    if ($update) {
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
                            value="<?= $edit['kd_barang']; ?>" 
                            class="form-control" 
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="nm_barang">Nama Barang</label>
                        <input 
                            type="text" 
                            name="nm_barang" 
                            value="<?= $edit['nm_barang']; ?>" 
                            id="nm_barang" 
                            placeholder="Nama barang" 
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="hrg_barang">Harga Barang</label>
                        <input 
                            type="number" 
                            name="hrg_barang" 
                            value="<?= $edit['hrg_barang']; ?>" 
                            id="hrg_barang" 
                            placeholder="Harga Barang" 
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="ktg_barang">Kategori Barang</label>
                        <select 
                            name="ktg_barang" 
                            id="ktg_barang" 
                            class="form-control">
                            <option disabled selected>--Pilih Kategori--</option>
                            <option value="Makanan" <?= ($edit['ktg_barang'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                            <option value="Minuman" <?= ($edit['ktg_barang'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                            <option value="Perawatan pribadi" <?= ($edit['ktg_barang'] == 'Perawatan pribadi') ? 'selected' : ''; ?>>Perawatan pribadi</option>
                            <option value="Kebutuhan rumah tangga" <?= ($edit['ktg_barang'] == 'Kebutuhan rumah tangga') ? 'selected' : ''; ?>>Kebutuhan rumah tangga</option>
                        </select>
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