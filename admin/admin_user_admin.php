<?php 
session_start();
if($_SESSION['admin'] != 1) {
    echo '<script>location.href="../index.php";</script>';
} 
else if ($_SESSION['admin'] == 1) {
    include('../assets/includes/dbaccess.php');
}

$q = "SELECT * FROM users WHERE user_id = ". $_GET['id'];
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array( $r, MYSQLI_ASSOC);
    if ($row['admin'] == 1) {
        $q = "UPDATE users SET admin = '0' WHERE user_id = '".$_GET['id']."'";
        $ar = mysqli_query($dbc, $q);
    }
    elseif ($row['admin'] != 1) {
        $q = "UPDATE users SET admin = '1' WHERE user_id = '".$_GET['id']."'";
        $ar = mysqli_query($dbc, $q);
    }
    else {
        echo '<script>alert("An error occurred, please try again"); window.location.href="adminusers.php";</script>';
    }
    
    if ($ar) {
        echo '<script>alert("User successfully updated"); window.location.href="adminusers.php";</script>';
    }
}

# Display error message on failure.
echo '<script>alert("Unable to edit user, please try again"); window.location.href="adminusers.php";</script>';

mysqli_close($dbc);

?>