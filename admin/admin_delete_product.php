<?php 
session_start();
if($_SESSION['admin'] != 1) {
    echo '<script>location.href="../index.php";</script>';
} 
else if ($_SESSION['admin'] == 1) {
    include('../../db/dbaccess.php');
}

$q = "SELECT * FROM products WHERE item_id = '". $_GET['id']."'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
    $qu = "DELETE FROM products WHERE item_id = '".($_GET['id'])."'";
    $ar = mysqli_query($dbc, $qu);
    if ($ar) { echo '<script>alert("Product successfully deleted"); window.location.href="adminmanageproducts.php";</script>'; }
}

# Display error message on failure.
echo '<script>alert("Unable to delete product, please try again"); window.location.href="adminmanageproducts.php";</script>';

mysqli_close($dbc);

?>