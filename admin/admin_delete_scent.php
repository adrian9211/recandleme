<?php 
session_start();
if($_SESSION['admin'] != 1) {
    echo '<script>location.href="../index.php";</script>';
} 
else if ($_SESSION['admin'] == 1) {
    include('../../db/dbaccess.php');
}

$q = "SELECT * FROM scents WHERE scent_id = '". $_GET['id']."'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
    $qu = "DELETE FROM scents WHERE scent_id = '".($_GET['id'])."'";
    $ar = mysqli_query($dbc, $qu);
    if ($ar) { echo '<script>alert("Scent successfully deleted"); window.location.href="adminmanagescents.php";</script>'; }
}

# Display error message on failure.
echo '<script>alert("Unable to delete scent, please try again"); window.location.href="adminmanagescents.php";</script>';

mysqli_close($dbc);

?>