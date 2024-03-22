<?php


$conn = mysqli_connect('localhost', 'root', '', 'db_trading');
function bacatotal()
{
  global $conn;
  $query5 = mysqli_query($conn, "SELECT 
  (SELECT jumlahsaldo FROM saldo) + 
  COALESCE(
      (SELECT SUM(CASE WHEN profitloss = 'profit' THEN nominal ELSE -nominal END) FROM trade), 
      0
  ) AS total_saldo;
");
  return $query5;
}

function bacatotaltrade()
{
  global $conn;
  $query5 = mysqli_query($conn, "SELECT COUNT(*) AS total_transaksi FROM trade");
  return $query5;
}

function bacaprofit()
{
  global $conn;
  $query5 = mysqli_query($conn, "SELECT SUM(nominal) AS total_profit FROM trade WHERE profitloss = 'profit';
  ");
  return $query5;
}

function bacaloss()
{
  global $conn;
  $query5 = mysqli_query($conn, "SELECT SUM(nominal) AS total_loss FROM trade WHERE profitloss = 'loss';
  ");
  return $query5;
}

$query6 = mysqli_fetch_assoc(bacatotal());
$query7 = mysqli_fetch_assoc(bacatotaltrade());
$query8 = mysqli_fetch_assoc(bacaprofit());
$query9 = mysqli_fetch_assoc(bacaloss());
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
        <h2>Beranda</h2>
      </div>

      <div class="main-cards">

        <div class="card">
          <div class="card-inner">
            <h3>PNL</h3>
          </div>
          <h3>Rp.<?= number_format($query6['total_saldo'], "0", ',')  ?></h3>
        </div>

        <div class="card">
          <div class="card-inner">
            <h3>Total trade</h3>
          </div>
          <h3><?php echo $query7['total_transaksi'] ?>x</h3>
        </div>

        <div class="card">
          <div class="card-inner">
            <h3>Profit</h3>
          </div>
          <h3>Rp.<?= number_format($query8['total_profit'], "0", ',') ?></h3>
        </div>

        <div class="card">
          <div class="card-inner">
            <h3>Loss</h3>
          </div>
          <h3>Rp.<?= number_format($query9['total_loss'], "0", ',') ?></h3>
        </div>


      </div>


        <!-- <div class="charts-card">
          <h2 class="chart-title">Chart</h2>
          <div id="area-chart"></div>
        </div> -->

        <br><br>
        <canvas id="myChart" style="width: 40px; height:40px"></canvas>
        
    </main>
    <!-- End Main -->

  </div>

  <!-- Scripts -->
  <!-- Custom JS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/scripts.js"></script>
</body>

</html>