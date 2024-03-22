<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_trading');

function bacaubah()
{
    global $conn;
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM trade WHERE id = '$id'");

    return $query;
}
bacaubah();
$query2 = mysqli_fetch_assoc(bacaubah());

function ubahbacktest()
{
    global $conn;
    if (isset($_POST['submit3'])) {
        $id = $_POST['id'];
        $pair = $_POST['pair'];
        $profitloss = $_POST['profitloss'];
        $nominal = $_POST['nominal'];
        $position = $_POST['position'];

        $query3 = mysqli_query($conn, "UPDATE trade SET pair = '$pair', profitloss = '$profitloss', nominal = $nominal, position = '$position' WHERE id = '$id' ");
        if ($query3 > 0) {
            echo '
            <script>
                alert("data berhasil diubah");
                document.location.href = "backtest.php"; 
            </script>
            
            ';
        }else{
            echo '
            <script>
                alert("data gagal diubah");
                document.location.href = "backtest.php"; 
            </script>
            
            ';
        }
    }
}

ubahbacktest();

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
                    <a href="laporan.php">
                        <span class="material-icons-outlined" target="_blank">poll</span> Laporan
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h2>Ubah data backtest</h2>
            </div>
            <div class="form1">
                <form method="post">
                    <input type="hidden" name="id" value="<?= $query2['id'] ?>" type="hidden" id="">
                    <div class="form-group">
                        <label for="pair">Pair:</label>
                        <select id="pair" name="pair" required>
                            <?php foreach (bacaubah() as $row) { ?>
                                <option value="<?= $row['pair'] ?>"><?= $row['pair'] ?></option>
                                <option value="AUDUSD">AUDUSD</option>
                                <option value="EURGBP">EURGBP</option>
                                <option value="EURJPY">EURJPY</option>
                                <option value="EURUSD">EURUSD</option>
                                <option value="GBPJPY">GBPJPY</option>
                                <option value="GBPUSD">GBPUSD</option>
                                <option value="USDCAD">USDCAD</option>
                                <option value="USDCHF">USDCHF</option>
                                <option value="USDJPY">USDJPY</option>
                                <option value="NZDUSD">NZDUSD</option>
                                <option value="XAUUSD">XAUUSD</option>
                                <option value="XAGUSD">XAGUSD</option>
                                <option value="BTCUSD">BTCUSD</option>
                                <option value="ETHUSD">ETHUSD</option>
                                <option value="LINKUSD">LINKUSD</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profitloss">Profit/Loss:</label>
                        <select id="profitloss" name="profitloss" required>
                            <?php foreach (bacaubah() as $row) { ?>
                                <option value="<?= $row['profitloss'] ?>"><?= $row['profitloss'] ?></option>
                                <option value="profit">profit</option>
                                <option value="loss">loss</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal:</label>
                        <input type="text" id="nominal" name="nominal" value="<?php echo $query2['nominal'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <select id="position" name="position" required>
                            <?php foreach (bacaubah() as $row) { ?>
                                <option value="<?= $row['position'] ?>"><?= $row['position'] ?></option>
                                <option value="buy">buy</option>
                                <option value="sell">Sell</option>
                            <?php } ?>
                        </select>
                    </div>
                    <a href="backtest.php" class="tombol-tambah" style="text-decoration: none; font-size:0.8rem">Kembali</a>
                    <button class="tombol-tambah" name="submit3" type="submit">Submit</button>
                </form>
            </div>
        </main>
        <!-- End Main -->

    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
    <script>
        $("td:contains('Profit')").css("background-color", "green");
        $("td:contains('Loss')").css("background-color", "crimson");
    </script>
</body>

</html>