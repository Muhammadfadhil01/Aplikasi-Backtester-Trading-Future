<?php

$id = $_GET['id'];

$conn = mysqli_connect('localhost', 'root', '', 'db_trading');
$query4 = mysqli_query($conn, "DELETE FROM trade WHERE id = '$id'");
if ($query4 > 0) {
    echo '
        <script>
            alert("data berhasil dihapus");
            document.location.href = "backtest.php"; 
        </script>    
        ';
}else{
    echo '
        <script>
            alert("data gagal dihapus");
            document.location.href = "backtest.php"; 
        </script>    
        ';
}
