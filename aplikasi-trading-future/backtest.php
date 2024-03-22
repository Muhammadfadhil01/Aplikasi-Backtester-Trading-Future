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




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Future trading backtester</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</head>

<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    Future fadhil
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="index.php">
                        <span class="material-icons-outlined">dashboard</span> Beranda
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="backtest.php">
                        <span class="material-icons-outlined">fact_check</span> Data backtest
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="laporan.php" target="_blank">
                        <span class="material-icons-outlined">poll</span> Laporan
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h2>Backtest</h2>
                <form action="backtest.php" method="post">
                    <input type="text" class="input1" name="cari">
                    <button class="button1" type="submit" name="submit1"><span class="material-icons-outlined" style="color: white;">search</span></button>
                </form>

            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pair</th>
                            <th>Profit/loss</th>
                            <th>Nominal</th>
                            <th>Posisi</th>
                            <th>Aksi</th>
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
                                <td><a href="ubahbacktest.php?id=<?= $row['id'] ?>" style="text-decoration: none; color:skyblue">Ubah</a> | <a href="hapusbacktest.php?id=<?= $row['id'] ?>" style="text-decoration: none; color:skyblue">hapus</a></td>
                            </tr>
                            <?php $number++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><br>
            <a href="tambahbacktest.php" class="tombol-tambah" style="text-decoration: none; font-size:0.8rem">Tambah</a>
        </main>
        <!-- End Main -->

    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
    <script>
        $("td:contains('profit')").css("background-color", "green");
        $("td:contains('loss')").css("background-color", "crimson");
    </script>
</body>

</html>