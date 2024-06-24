<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pembayaran</titlgite>
</head>

<body>
    <div class="mt-2 py-2">
        <h1 class="text-center">Pembayaran Sederhana Smart</h1>
        <form action="" method="post">
            <div class="mb-3 mx-3">
                <label for="NominalUang">Masukkan Nominal Uang</label>
                <input type="number" class="form-control" name="NominalUang" id="NominalUang"
                placeholder="Masukkan Nominal Uang" required>
            </div>

            <div class="mx-3">

            <?Php
            $_SESSION['JumlahHarga_'] = 0;

            if($_SESSION['DataBarang'] && !empty($_SESSION['DataBarang'])) {
                foreach ($_SESSION['DataBarang'] as $key ) {
                    $_SESSION['JumlahHarga_'] += $key['JumlahHarga'];
                }
                echo "<p>Total Harga : Rp. " . number_format($_SESSION['JumlahHarga_'], 2, ',', '.') . "</p>";
            }

            if (isset($_POST['Bayar'])) {
                $NominalUang = $_POST['NominalUang'];
                $_SESSION['UangKembalian'] = $NominalUang - $_SESSION['JumlahHarga_'];

                if ($NominalUang < $_SESSION['JumlahHarga_']) {
                    $KurangUang = $_SESSION['JumlahHarga_'] - $NominalUang;

                    echo "<p class='alert alert-danger'>Pembelian Gagal <br>
                        Uang kamu kurang sebesar : Rp. ". number_format($KurangUang,2,',','.')."</p>";
                    } else { 
                        $_SESSION['UangBeli'] = $NominalUang;
                        echo "<p class='alert alert-success'>Pembelian berhasil <br>
                        Kembalian : Rp. " . number_format($_SESSION['UangKembalian'],2,',','.'). "</p>";
                        header("location: Struk.php");
                }
            }
            ?>
            </div>
            <div class="d-grid gap-2 d-md-block mx-3">
                <button class="btn btn-success" type="submit" name="Bayar">Bayar</button>
                <a href="Index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>