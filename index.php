<?php
session_start();

function addjenis($barang, $harga, $jumlah) {
    $newjenis = array(
        'barang' => $barang,
        'harga' => $harga,
        'jumlah' => $jumlah
    );

    $_SESSION['transaksi'][] = $newjenis;
}

function calculateTotalCost() {
    $total = 0;
    foreach($_SESSION['transaksi'] as $jenis) {
        $total += $jenis['harga'] * $jenis['jumlah'];
    }
    return $total;
}

if(!isset($_SESSION['transaksi'])) {
    $_SESSION['transaksi'] = array();
}

if(isset($_POST['add'])) {
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    addjenis($barang, $harga, $jumlah);
}

if(isset($_POST['pay'])) {
    $totalCost = calculateTotalCost();

    header("Location: b1.php?totalCost=$totalCost");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #66ff4f;
            padding: 20px;
            text-align: center;
            align-items: center;
        }

        h2 {
            color: #333;
        }

        h3 {
            text-align: center;
            justify-content: center;
            padding: 2%;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .a {
            display: flex;
            padding-left: 43%;
            margin-left: auto;
            margin-right: auto;
        }

        .b {
            margin-left: auto;
            margin-right: auto;  
        }

        .input {
            margin-top: 20px;
        }

        .input label {
            color: black;
        }

        .input input[type="text"], .input input[type="number"] {
            padding: 8px;
            width: 50%;
            box-sizing: border-box;
        }

        .input button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .c {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .c h3 {
            color: #333;
            text-align: center;
            display: flex;
            
        }

        .c table {
            border-collapse: collapse;
            width: 50%;
        }

        .c th {
            background-color: #4caf50;
            color: white;
            padding: 8px;
        }

        .c td {
            padding: 8px;
        }

        .pay-button-container {
            margin-top: 20px;
        }

        .pay-button-container button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>CEPEW.MART</h2>
    <div class="input">
        <form method="post">
            <label>Nama Barang:</label><br>
            <input type="text" name="barang" required placeholder="ISI Nama Barang"><br>
            <label>Harga:</label><br>
            <input type="number" name="harga" required placeholder="Masukan Harga"><br>
            <label>Jumlah:</label>
            <br>
            <input type="number" name="jumlah" required placeholder="Masukan Jumlah Barang"><br>
            <br>
            <div class="a">
            <button type="submit" name="add">Masukan Keranjang</button>
            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
        </form>
    </div>
    <div class="b">
    <?php if(!empty($_SESSION['transaksi'])) { ?>
    <div class="c">
        <h3>Telah Masuk Keranjang</h3>
        <table class="b">
            <tr style="background-color: #4caf50; color: white;"><th>Barang</th><th>Harga</th><th>Jumlah</th></tr>
            <?php foreach($_SESSION['transaksi'] as $jenis) { ?>
                <tr>
                    <td><?php echo $jenis['barang']; ?></td>
                    <td>Rp <?php echo $jenis['harga']; ?></td>
                    <td><?php echo $jenis['jumlah']; ?></td>
                </tr>
            <?php } ?>
        </table>
        </div>
    </div>

    <?php } ?>

    <div class="pay-button-container">
        <?php if(!empty($_SESSION['transaksi'])) { ?>
            <form method="post">
                <button type="submit" name="pay">Bayar</button>
            </form>
        <?php } ?>
    </div>
</div>
</div>
</body>
</html>