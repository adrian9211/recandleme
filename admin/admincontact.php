<?php include('includes/apheader.php'); ?>

<?php
include('../../db/dbaccess.php');
$query = "select * from messages";
$result = mysqli_query($dbc, $query);
?>

<div class="h5 w3-text-blue">Messages</div>



<?php
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo '<div class="w3-card mb-2 me-2 p-2">';
    echo '<div class="row me-2"><div class="col-1 w3-text-dark-grey">Name</div><div class="col-10 w3-text-grey">'.$row['name'].'</div></div>';
    echo '<div class="row me-2"><div class="col-1 w3-text-dark-grey">Email</div><div class="col-10 w3-text-grey">'.$row['email'].'</div></div>';
    echo '<div class="row me-2"><div class="col-1 w3-text-dark-grey">Message</div><div class="col-10 w3-text-grey">'.$row['message'].'</div></div>';
    echo '<div class="row me-2"><div class="col-1 w3-text-dark-grey">Date</div><div class="col-10 w3-text-grey">'.$row['send_date'].'</div></div>';
    echo '</div>';
}
dbClose();
?>



<?php include('includes/apfooter.php'); ?>


<!-- <div class="row w3-blue me-2">
<div class="col-1">Actions</div><div class="col-1">USER ID</div><div class="col-1">Username</div><div class="col-2">Email</div><div class="col-2">Phone Number</div><div class="col-1">Date Joined</div>
</div> -->

