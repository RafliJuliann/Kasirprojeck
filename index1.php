<?php
session_start();

$transaksi = isset($_SESSION['transaksi']) ? $_SESSION['transaksi'] : array();

$totalCost = 0;
foreach($transaksi as $jenis) {
    $totalCost += $jenis['harga'] * $jenis['jumlah'];
}

unset($_SESSION['transaksi']);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
         body {
            background-image: url(kasir.png);
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        .a {
            text-align: center;
            font-size: small;
        }

        .b{
            background-color: #4caf50;
            color: white;
            border-radius: 4px;
            font-size: medium;
            cursor: pointer;
        }

        h3, h4 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        p {
            margin-top: 20px;
            font-size: 15px;
            color: #333;
        }

        p strong {
            color: #000;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Struk CEPEW.MART</h3>
    <h4>Bukti Pembayaran</h4>
    <table>
        <tr style="background-color: #4caf50; color: white;"><th>Barang</th><th>Harga</th><th>Jumlah</th></tr>
        <?php foreach($transaksi as $jenis) { ?>
            <tr>
                <td><?php echo $jenis['barang']; ?></td>
                <td>Rp <?php echo $jenis['harga']; ?></td>
                <td><?php echo $jenis['jumlah']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <hr>
    <p><strong>Total Belanja:</strong> Rp <?php echo $totalCost; ?></p>
    <p><strong>Terima kasih telah berbelanja <hr></strong></p>
    <div class="a">
    <p><strong>CEPEW.MART</strong></p>
    <form action="" method="post">
    <button class="b" type="submit" name="destroy">kembali</button>
    </form>
    </div>
</div>

<?php

        if(isset($_POST['destroy'])){
            session_destroy();
            header('location:   '.'b.php');
        }
    
    ?>

</body>
</html>