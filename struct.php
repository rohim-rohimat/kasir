<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .container{
            border-radius: 10px;
            box-shadow: 5px 10px 5px 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-2 py-3">
        <div class="text-center">
            <h1 class="text-center">Struk Pembelian</h1>
            <p><?php echo "Melakukan Transaksi Pada Tanggal: " . date("Y-m-d") ?></p>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["DataBarang"]) && !empty($_SESSION["DataBarang"])) {
                    foreach ($_SESSION["DataBarang"] as $key) {
                        echo "<tr>";
                        echo "<td>" . ucfirst($key['NamaBarang']) . "</td>";
                        echo "<td>Rp " . number_format($key['HargaBarang'], 2, ',', '.') . "</td>";
                        echo "<td>" . $key['JumlahBarang'] . "</td>";
                        echo "<td>Rp " . number_format($key['JumlahHarga'], 2, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="mb-4">
            <p class="fw-bold">Uang: Rp. <?php echo number_format($_SESSION['UangBeli'], 2, ',', '.'); ?>
            </p>
            <p class="fw-bold">Total Harga: Rp. <?php echo number_format($_SESSION['JumlahHarga_'], 2, ',', '.'); ?></p>
            <?php if ($_SESSION['UangKembalian'] > 0): ?>
                <p class="fw-bold">Kembalian : Rp. <?php echo number_format($_SESSION['UangKembalian'], 2, ',', '.'); ?></p>
            <?php endif; ?>
        </div>
        <div class="mx-2">
            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
            <a href="bayar.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>