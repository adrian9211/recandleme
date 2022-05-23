<?php include('includes/apheader.php'); ?>

<script src="js/functions.js"></script>

<div class="h5 w3-text-blue">View Orders</div>

<?php
include('../../db/dbaccess.php');
$query = "SELECT * FROM orders";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) :?>
    <div class="row w3-blue me-2">
    <div class="col-2">ID Email</div><div class="col-5">Address</div><div class="col-1">Postcode</div><div class="col-1">Total</div><div class="col-2">Date</div><div class="col-1">Paid &nbsp;Posted</div>
    </div>
    <?php 
    while($row = mysqli_fetch_array( $result, MYSQLI_ASSOC))
    {
        echo '<div class="row w3-light-blue me-2 py-1 w3-border-bottom w3-border-light-blue w3-hover-border-white">';
        echo '<div class="col-2">'.$row['order_id'].' &nbsp;&nbsp;'.$row['email'].'</div><div class="col-5">'.$row['address'].'</div><div class="col-1">'.$row['postcode'].'</div><div class="col-1">'.$row['total'].'</div><div class="col-2">'.$row['order_date'].'</div><div class="col-1"><a href="admin_edit_order.php?id='.$row['order_id'].'&mark=paid" class="adminBtn" data-bs-toggle="tooltip" data-bs-placement="bottom"';
        if ($row['paid'] == 1) {
            echo 'title="Mark as unpaid">&#10004;';
        }
        else if ($row['paid'] == 0) {
            echo 'title="Mark as paid">&#10060;';
        }
         echo '&nbsp;&nbsp;&nbsp;</a><a class="adminBtn" href="admin_edit_order.php?id='.$row['order_id'].'&mark=posted" data-bs-toggle="tooltip" data-bs-placement="bottom"'; 
         if ($row['posted'] == 1) {
            echo 'title="Mark as not posted">&#10004;</a> </div>';
         }
         else if ($row['posted'] == 0) {
            echo 'title="Mark as posted">&#10060;</a> </div>';
         }

        echo '</div>';
    }
    ?>
<?php endif; 
if(mysqli_num_rows($result) < 1)
{
    echo '<p>There are no orders to display</p>';
}
?>

<script src="js/utilities.js"></script>
<?php include('includes/apfooter.php'); ?>