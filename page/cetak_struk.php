<?php
    require_once '../config/koneksi.php';
?>

<?php
$no = $_GET['no'];
$pesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pesanan WHERE no_pesanan='$no'"));
$pembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE no_pesanan='$no'"));

$detail = mysqli_query($koneksi, "SELECT *FROM detail_pesanan JOIN barang ON detail_pesanan.kd_barang = barang.kd_barang WHERE detail_pesanan.no_pesanan='$no'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Struk</title>

    <style>
        body{
            font-family: monospace;
            font-size:12px;
        }

        .struk{
            width:80mm;
            margin:auto;
            padding:5px;;
            border:1px solid;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        .right{
            text-align:right;
        }

        hr{
            border:0;
            border-top:1px dashed black;
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }

        @media print{    
            button{
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <center>
        <h3>TOKO JJ</h3>
        Jl. Kenanga
    </center>

    <hr>

    <table>
        <tr>
            <td>No. Pesan</td>
            <td>: <?= $pesanan['no_pesanan'] ?></td>
        </tr>

        <tr>
            <td>No. Bayar</td>
            <td>: <?= $pembayaran['no_bayar'] ?></td>
        </tr>

        <tr>
            <td>Kasir</td>
            <td>: <?= $pesanan['username'] ?></td>
        </tr>

        <tr>
            <td>Waktu</td>
            <td>: <?= $pesanan['waktu_pesanan'] ?></td>
        </tr>
    </table>

    <hr>

    <?php while($d = mysqli_fetch_assoc($detail)){ ?>

        <div>
            <?= $d['nm_barang'] ?>
        </div>

        <table>
            <tr>
                <td>
                    <?= $d['jumlah'] ?> x
                    <?= number_format($d['harga_barang']) ?>
                </td>

                <td class="right">
                    <?= number_format($d['total']) ?>
                </td>
            </tr>
        </table>

    <?php } ?>

    <hr>

    <table>
        <tr>
            <td>TOTAL</td>
            <td class="right">
                <?= number_format($pesanan['total_pesanan']) ?>
            </td>
        </tr>

        <tr>
            <td>BAYAR</td>
            <td class="right">
                <?= number_format($pembayaran['nominal']) ?>
            </td>
        </tr>

        <tr>
            <td>KEMBALI</td>
            <td class="right">
                <?= number_format($pembayaran['kembalian']) ?>
            </td>
        </tr>
    </table>

    <hr>

    <center>
        Terima Kasih
    </center>

</div>

<script>
window.onload = function(){
    window.print();
}

window.onafterprint = function(){
    window.location.href='../index.php?page=pesanan';
 }
</script>

</body>
</html>