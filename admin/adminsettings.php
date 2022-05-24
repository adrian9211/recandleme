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
        <div class="h5 ps-1 mt-1 pt-1 w3-light-grey w3-text-blue">Administration Settings</div>
        <form method="post">
        <label for="admin_email" class="form-label mt-2 ps-1">Email address for webmail: </label> <input type="text" class="form-control form-control-sm flex-fill" name="webmail" placeholder="<?php echo $row['admin_email'];?>" id="webmail">      
        <label for="customcandle" class="form-label mt-2 ps-1">Custom Candle Price: </label><input type="number" class="form-control form-control-sm" name="customcandle" min="0.00" max="1000.00" step="0.01" placeholder="<?php echo $row['custom_price'];?>">      
        <input type="submit" class="btn w3-blue btn-sm mt-3 w-100" value="Update">
        </form>
    </div>
</div>


<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<script>adminSettings();</script>';
    $messageUpdate = "";
    if (!empty($_POST['webmail'])) {
        $mailSafe = $dbc->real_escape_string($_POST['webmail']);
        $mailQuery = "update settings set admin_email = '$mailSafe' where id = 1";
        $mailResult = mysqli_query($dbc, $mailQuery);
        if($mailResult) {
            $messageUpdate .= "Site Email updated";
        }
    }
    if(!empty($_POST['customcandle'])) {
        $priceQuery = "update settings set custom_price = '{$_POST['customcandle']}' where id = 1";
        $priceResult = mysqli_query($dbc, $priceQuery);
        if($priceResult) {
            $messageUpdate .= "Custom Price updated";               
        }
    }
    if($messageUpdate != "") {
        echo "<script>alert('$messageUpdate');</script>";
        header('Refresh:0; url=adminsettings.php'); 
    }
}

dbClose();
?>

<?php include('includes/apfooter.php'); ?>