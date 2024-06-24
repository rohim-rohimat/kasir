<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>.</title>
</head>

<body>
    <div class="mt-2 py-2">
        <h1 class="text-center">Data Barang</h1>
        <form action="" method="post">
            <div class="mb-3 mx-3">
                <label for="NamaBarang">Nama Barang :</label>
                <input type="text" class="form-control" name="NamaBarang" id="NamaBarang"
                    placeholder="Masukkan Nama Barang">
            </div>

            <div class="mb-3 mx-3">
                <label for="HargaBarang">Harga Barang :</label>
                <input type="number" class="form-control" name="HargaBarang" id="HargaBarang"
                    placeholder="Masukkan Harga Barang">
            </div>

            <div class="mb-3 mx-3">
                <label for="JumlahBarang">Jumlah Barang :</label>
                <input type="number" class="form-control" name="JumlahBarang" id="JumlahBarang"
                    placeholder="Masukkan Jumlah Barang">
            </div>

            <div class="mx-2 mb-3 mx-3">
                <button type="submit" class="btn btn-success" name="tambah" id="tambah">Tambah</button>
                <button type="submit" class="btn btn-danger" name="hapus" id="hapus"><a href="destroy.php"
                        class="text-decoration-none text-white">Hapus Semua Barang</a></button>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php
            session_start();

            if (!isset($_SESSION['DataBarang'])) {
                $_SESSION['DataBarang'] = array();
            }

            if (isset($_POST['tambah'])) {
                if ($_POST['NamaBarang'] == "" && $_POST['HargaBarang'] == "" && $_POST['JumlahBarang'] == "") {
                    echo "Belum Ada Data <br>";
                } else {
                    $JumlahHarga = $_POST['HargaBarang'] * $_POST['JumlahBarang'];
                    $Barang = array(
                        "NamaBarang" => $_POST['NamaBarang'],
                        "HargaBarang" => $_POST['HargaBarang'],
                        "JumlahBarang" => $_POST['JumlahBarang'],
                        "JumlahHarga" => $JumlahHarga
                    );
                    array_push($_SESSION['DataBarang'], $Barang);
                }
            }
            
            if (!empty($_SESSION['DataBarang'])) {
                foreach ($_SESSION['DataBarang'] as $key => $value) {
                    $Total = $value['HargaBarang'] * $value['JumlahBarang'];
                    $FormatTotal = "Rp. " . number_format($Total,2,',','.');
                    $Harga = "Rp. ". number_format($value['HargaBarang'],2,',','.');

                    echo'
                    <tbody>
                        <tr>
                        <td>' . $value['NamaBarang']. '</td>
                        <td>' . $Harga. '</td>
                        <td>' . $value['JumlahBarang']. '</td>
                        <td>' . $FormatTotal .'</td>
                        <td><a href = "?hapus=' . $key . '" class="btn btn-danger ms-2">Hapus</a></td>
                        </tr>
                    </tbody>';                   
                }
            }

            if (isset($_GET['hapus'])) {
                $key = $_GET['hapus'];
                unset($_SESSION['DataBarang'][$key]);
            
                header('location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
            ?>
            <tr>
            <td style="border-top:2px solid black ;" class="" colspan="3">Total Harga</td>
                <td style="border-top: 2px solid black;">
                    <?php
                    $totalHarga = 0;
                    foreach ($_SESSION['DataBarang'] as $key) {
                        $totalHarga += $key['JumlahHarga'];
                    }
                    echo "Total Rp. " . number_format($totalHarga, 2, ',', '.');
                    ?>
                </td>
                <td style="border-top: 2px solid black; "><a href="pembayaran.php" class="btn btn-primary me-7" name="pembayaran">Pembayaran</a></td>
            </tr>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>