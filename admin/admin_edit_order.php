<?php 
session_start();
if($_SESSION['admin'] != 1) {
    echo '<script>location.href="../index.php";</script>';
} 
else if ($_SESSION['admin'] == 1) {
    include('../../db/dbaccess.php');
}

$q = "SELECT * FROM orders WHERE order_id = ". $_GET['id'];
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array( $r, MYSQLI_ASSOC);
    if($_GET['mark'] == 'paid') { $mark = 'paid'; }
    else if ($_GET['mark'] == 'posted') { $mark = 'posted'; }
    if ($row[$mark] == 1) {
        $q = "UPDATE orders SET $mark = '0' WHERE order_id = '".$_GET['id']."'";
        $ar = mysqli_query($dbc, $q);
    }
    elseif ($row[$mark] == 0) {
        $q = "UPDATE orders SET $mark = '1' WHERE order_id = '".$_GET['id']."'";
        $ar = mysqli_query($dbc, $q);
    }
    else {
        echo '<script>alert("An error occurred, please try again"); window.location.href="adminorders.php";</script>';
    }
    
    if ($ar) {
        echo '<script>alert("Order successfully updated"); window.location.href="adminorders.php";</script>';
    }
}

# Display error message on failure.
echo '<script>alert("Unable to edit order, please try again"); window.location.href="adminorders.php";</script>';

mysqli_close($dbc);

?>