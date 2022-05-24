<?php include('includes/apheader.php'); ?>
<script src="js/functions.js"></script>

<div class="h5 w3-text-blue">Manage Scents</div>

<?php
include('../../db/dbaccess.php');
$query = "SELECT * FROM scents";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) :?>
    <div class="row w3-blue me-2">
    <div class="col-1"> &nbsp;Edit &nbsp;&nbsp; Scent ID</div><div class="col-1">Type</div><div class="col-1">Scent Name</div><div class="col-6">Description</div><div class="col-2">Img URL</div><div class="col-1">Visible</div>
    </div>
    <?php 
    while($row = mysqli_fetch_array( $result, MYSQLI_ASSOC))
    {
        echo '<div class="row w3-light-blue me-2">';
        echo '<div class="col-1"><a href="admineditscent.php?id='.$row['scent_id'].'" class="adminBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit this Scent">&#9999;</a><a class="adminBtn" onclick="deleteScent(\''.$row['scent_id'].'\',\''.$row['scent_name'].'\')" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete this Product">&#10060;&nbsp;&nbsp;&nbsp; </a> '.$row['scent_id'].'</div><div class="col-1">'.$row['scent_type'].'</div><div class="col-1">'.$row['scent_name'].'</div><div class="col-6">'.$row['description'].'</div><div class="col-2">'.$row['img_url'].'</div><div class="col-1">'.$row['visible'].'</div>';
        echo '</div>';
    }
    ?>
<?php endif; 
if(mysqli_num_rows($result) < 1)
{
    echo '<p>There are no products to display</p>';
}
?>

<script src="js/utilities.js"></script>
<?php include('includes/apfooter.php'); ?>
