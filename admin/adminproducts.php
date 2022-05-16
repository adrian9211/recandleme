<?php include('includes/apheader.php'); ?>

<div class="h5 w3-text-blue">Add Product</div>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-10 mt-2">
            <div class="input-group mb-3 input-group-sm">
               <span class="input-group-text">Item Name</span>
              <input type="text" class="form-control" name="name"<?php if(isset($_POST['name'])){ echo 'value="'.$_POST['name'].'"';}?>>
            </div>
            <div class="input-group mb-3 input-group-sm">
               <span class="input-group-text">Description</span>
              <textarea name="desc" id="description" rows="3" class="form-control" maxlength="200"><?php if(isset($_POST['desc'])){ echo $_POST['desc']; }?></textarea>
            </div>
            <div class="input-group mb-3 input-group-sm">
               <span class="input-group-text">Image</span>
              <input type="file" name="item_img" class="form-control">
            </div>
            <div class="input-group mb-3 input-group-sm">
               <span class="input-group-text">Price</span>
              <input type="number" class="form-control" name="price" <?php if(isset($_POST['price'])){ echo 'value="'.$_POST['price'].'"'; } else { echo 'value="0.00"'; } ?> placeholder='0.00' step="0.01" min="0.01">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="form-check" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show this product in the shop">
                    <label class="form-check-label">Visible</label>
                    <input class="form-check-input" type="checkbox" id="visible" name="visible" <?php if(isset($_POST['visible'])){ echo 'checked'; }?> >
                </div>
            </div>
            <div class="input-group mb-3 input-group-sm">
               <span class="input-group-text">Stock</span>
              <input type="number" class="form-control" min="0" <?php if(isset($_POST['stock'])){ echo 'value="'.$_POST['stock'].'"';} else { echo 'value="0"'; }?> name="stock">
            </div>
        </div>
    </div>
    <div class="row"><div class="col-xl-6 col-lg-8 col-md-10 d-grid"><button type="submit" class="btn btn-sm btn-block w3-blue" name="submit">Add</button></div></div>
</form>

<?php 
# if(isset($_POST['submit'])) {
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors[] = '';
  if (!isset($_POST['name']) || !isset($_POST['desc']) || !isset($_POST['price'])) {
    echo '<script>alert("Please enter all required values");</script>';
    echo '<script>location.href="adminproducts.php";</script>'; 
  }
  include ('../../db/dbaccess.php');
  $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
  $q = "select * from products where item_name ='$name'";
  $r = mysqli_query($dbc, $q);
  if(mysqli_num_rows($r) > 0) { echo '<script>alert("Item name already exists, please choose another");</script>'; echo '<script>location.href="adminproducts.php";</script>'; }
  $img = 'no-image.png';
  if(isset($_POST["item_img"]) && $check = getimagesize($_FILES["item_img"]["tmp_name"])){
    $filename = $_FILES['item_img']['name'];
    $tempname = $_FILES['item_img']['tmp_name'];                     
    $folder = "../shop/".$filename;
    $folderlg = "../shop/lg/".$filename;
    if (move_uploaded_file($tempname, $folder))
    {
      $img = $filename;                                            
    }
    if (copy($folder, $folderlg)) 
    {
      $img = $filename;
    }   
  }
  $desc = mysqli_real_escape_string($dbc, trim($_POST['desc']));
  $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
  if(!isset($_POST['visible']) || is_null($_POST['visible'])) { $visible = 0; } else { $visible = 1; }
  $stock = intval(mysqli_real_escape_string($dbc, trim($_POST['stock'])));
  $query = "insert into products (item_name, item_desc, img_url, item_price, visible, stock) values ('$name','$desc','$img','$price','$visible','$stock')";
  if($result = mysqli_query($dbc, $query)){
    echo '<script>alert("Product added successfully!");</script>';
  }
  dbClose();
}

?>

<script src="js/utilities.js"></script>
<?php include('includes/apfooter.php'); ?>
