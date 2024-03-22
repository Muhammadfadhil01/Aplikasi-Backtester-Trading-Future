<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_trading');

//cari

function bacatable()
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM trade");
    if (isset($_POST['cari'])) {
        $keyword = $_POST['cari'];
        $query = mysqli_query($conn, "SELECT * FROM trade WHERE pair LIKE '%$keyword%' OR profitloss = '$keyword' OR nominal = '$keyword' OR position = '$keyword' ");
    }
    return $query;
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-excel.xls");


?>

<p align="center" style="font-weight:bold;font-size:16pt">LAPORAN TRANSAKSI TRADING</p>

<table border="1"  align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Pair</th>
            <th>Hasil</th>
            <th>Nominal</th>
            <th>Posisi</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 1; ?>
        <?php foreach (bacatable() as $row) { ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?= $row['pair'] ?></td>
                <td><?= $row['profitloss'] ?></td>
                <td>Rp.<?= number_format($row['nominal'], 0, ",") ?></td>
                <td><?= $row['position'] ?></td>
            </tr>
            <?php $number++; ?>
        <?php } ?>
    </tbody>
</table>
