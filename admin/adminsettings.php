<?php include('includes/apheader.php'); ?>
<script src="js/functions.js"></script>
<?php
include('../../db/dbaccess.php');
$query = "SELECT * FROM settings WHERE id = 1";
$result = mysqli_query($dbc, $query);
$row = $result->fetch_assoc();
?>

<div class="w3-cell ps-2" style="width:25rem">
    <div class="w3-bar-block w3-light-grey">
        <div class="h5 ps-1 mt-1 pt-1 w3-light-grey w3-text-blue">Administration Panel</div>
        <form method="post">
        <label for="admin_email" class="form-label mt-2 ps-1">Email address for webmail: </label> <input type="text" class="form-control form-control-sm flex-fill" name="webmail" placeholder="<?php echo $row['admin_email'];?>" id="webmail">      
        <input type="submit" class="btn w3-blue btn-sm mt-3 w-100" value="Update">
        </form>
    </div>
</div>


<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['webmail'])) {
        echo '<script>adminEmail("'.$_POST['webmail'].'");</script>';
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['webmail'])) {
        $mailSafe = $dbc->real_escape_string($_GET['webmail']);
        $mailQuery = "update settings set admin_email = '$mailSafe' where id = 1";
        if($mailResult = $dbc->query($mailQuery)) {
            echo '<script>alert("Site Email updated!");</script>';
            header('Refresh:0; url=adminsettings.php');
        }
    }
}

dbClose();
?>

<?php include('includes/apfooter.php'); ?>