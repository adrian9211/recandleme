<?php include('includes/apheader.php'); ?>

<div class="h5 w3-text-blue">Manage Products</div>

<?php
include('../../db/dbaccess.php');
$query = "SELECT * FROM products";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) :?>
    <div class="row w3-blue me-2">
    <div class="col-1">Edit | Item ID</div><div class="col-1">| Item Name</div><div class="col-6">| Description</div><div class="col-1">| Img URL</div><div class="col-1">| Price</div><div class="col-1">| Visible</div><div class="col-1">| Stock</div>
    </div>
    <?php 
    while($row = mysqli_fetch_array( $result, MYSQLI_ASSOC))
    {
        echo '<div class="row w3-light-blue me-2">';
        echo '<div class="col-1">'.$row['item_id'].'</div><div class="col-1">'.$row['item_name'].'</div><div class="col-6">'.$row['item_desc'].'</div><div class="col-1">'.$row['img_url'].'</div><div class="col-1">'.$row['item_price'].'</div><div class="col-1">'.$row['visible'].'</div><div class="col-1">'.$row['stock'].'</div>';
        echo '</div>';
    }
    ?>
<?php endif; 
if(mysqli_num_rows($result) < 1)
{
    echo '<p>There are no products to display</p>';
}
?>

<?php include('includes/apfooter.php'); ?>

<!-- 
Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti quasi, asperiores animi a, debitis eaque nesciunt magni vitae soluta est eos praesentium tenetur cupiditate inventore nisi distinctio suscipit molestias esse.
Omnis accusamus quo corporis adipisci error, magni qui debitis totam assumenda perspiciatis molestias dicta, enim, exercitationem fugiat laborum temporibus itaque ad? Eos aliquid minus sequi voluptas adipisci quibusdam corrupti vitae.
Mollitia placeat officia molestias, earum impedit, sunt aut aperiam dolorum asperiores consectetur perspiciatis tenetur consequuntur eveniet, quibusdam tempora excepturi! Dolore ullam, voluptates dolor minus nam excepturi cupiditate iste fugit itaque.
Aspernatur numquam, quasi mollitia nulla praesentium consequatur deleniti eos natus eveniet vel at illum dignissimos sint nisi perspiciatis ducimus voluptatibus veritatis, reprehenderit asperiores. Inventore facilis obcaecati commodi labore excepturi hic!
Sequi cum soluta, omnis maxime possimus, animi dolores natus libero itaque, veritatis sint dolor inventore cupiditate reprehenderit. Maxime ab quam consequuntur aperiam facere dolores, quisquam magni perspiciatis minus repellendus explicabo 
-->