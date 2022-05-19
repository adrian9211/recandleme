<?php include('includes/apheader.php'); ?>
<script src="js/functions.js"></script>

<div class="h5 w3-text-blue">Manage Products</div>

<?php
include('../../db/dbaccess.php');
$query = "SELECT * FROM products";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) :?>
    <div class="row w3-blue me-2">
    <div class="col-1"> &nbsp;Edit &nbsp;&nbsp; Item ID</div><div class="col-1">Item Name</div><div class="col-7">Description</div><div class="col-1">Img URL</div><div class="col-1">Visible</div><div class="col-1">Stock</div>
    </div>
    <?php 
    while($row = mysqli_fetch_array( $result, MYSQLI_ASSOC))
    {
        echo '<div class="row w3-light-blue me-2">';
        echo '<div class="col-1"><a href="admineditproduct.php?id='.$row['item_id'].'" class="adminBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit this Product">&#9999;</a><a class="adminBtn" onclick="deleteProduct(\''.$row['item_id'].'\',\''.$row['item_name'].'\')" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete this Product">&#10060;&nbsp;&nbsp;&nbsp; </a> '.$row['item_id'].'</div><div class="col-1">'.$row['item_name'].'</div><div class="col-7">'.$row['item_desc'].'</div><div class="col-1">'.$row['img_url'].'</div><div class="col-1">'.$row['visible'].'</div><div class="col-1">'.$row['stock'].'</div>';
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
