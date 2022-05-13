<?php include('includes/apheader.php'); ?>
<script src="js/functions.js"></script>

<?php
include('../../db/dbaccess.php');
$query = "select * from messages";
$result = mysqli_query($dbc, $query);
?>

<div class="h5 w3-text-blue">Messages</div>



<?php
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo '<div class="w3-panel w3-card w3-display-container mb-2 me-3 p-2">';
    echo '';
    echo '<div class="row"><div class="col-1 w3-text-dark-grey">Name</div><div class="col-10 w3-text-grey">'.$row['name'].'<span onclick="deleteContact(\''.$row['message_id'].'\')" class="w3-button w3-display-topright">&#10060;</span></div></div>';
    echo '<div class="row"><div class="col-1 w3-text-dark-grey">Email</div><div class="col-10 w3-text-grey">'.$row['email'].'</div></div>';
    echo '<div class="row"><div class="col-1 w3-text-dark-grey">Message</div><div class="col-10 w3-text-grey">'.$row['message'].'</div></div>';
    echo '<div class="row"><div class="col-1 w3-text-dark-grey">Date</div><div class="col-10 w3-text-grey">'.$row['send_date'].'</div></div>';
    echo '</div>';
}
dbClose();
?>


<?php include('includes/apfooter.php'); ?>
