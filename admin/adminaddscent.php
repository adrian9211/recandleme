<?php include('includes/apheader.php'); ?>

<div class="h5 w3-text-blue">Add Scent</div>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-10 mt-2">
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text me-1">Item Type</span>
                <select class="form-select form-select-sm" name="type" id="type">
                    <option value="1">Page 1</option>
                    <option value="2">Page 2</option>
                    <option value="3">Jar</option>
                </select>
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Item Name</span>
                <input type="text" class="form-control" name="name"<?php if(isset($_POST['name'])){ echo 'value="'.$_POST['name'].'"';}?>>
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Description</span>
                <textarea name="desc" id="description" rows="3" class="form-control" maxlength="1000"><?php if(isset($_POST['desc'])){ echo $_POST['desc']; }?></textarea>
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Image</span>
                <input type="file" name="item_img" class="form-control">
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="form-check" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show this product in the shop">
                    <label class="form-check-label">Visible</label>
                    <input class="form-check-input" type="checkbox" id="visible" name="visible" <?php if(isset($_POST['visible'])){ echo 'checked'; }?> >
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-xl-6 col-lg-8 col-md-10 d-grid"><button type="submit" class="btn btn-sm btn-block w3-blue" name="submit">Add</button></div></div>
</form>

<?php 
# if(isset($_POST['submit'])) {
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors[] = '';
  if (!isset($_POST['name']) || !isset($_POST['desc'])) {
    echo '<script>alert("Please enter all required values");</script>';
    echo '<script>location.href="adminaddscent.php";</script>'; 
  }
  include ('../../db/dbaccess.php');
  $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
  $q = "select * from scents where scent_name ='$name'";
  $r = mysqli_query($dbc, $q);
  if(mysqli_num_rows($r) > 0) { echo '<script>alert("Scent name already exists, please choose another");</script>'; echo '<script>location.href="adminaddscent.php";</script>'; }

  $img = 'no-image.png';
  if($_FILES['item_img']['size'] > 0) {
    $check = getimagesize($_FILES["item_img"]["tmp_name"]); 
    if($check !== false) {
      $filename = basename($_FILES['item_img']['name']);
      # $tempname = $_FILES['item_img']['tmp_name'];                     
      $folder = "../shop/".$filename;
      $folderlg = "../shop/lg/".$filename;
      if (move_uploaded_file($_FILES['item_img']['tmp_name'], $folder))
      {
        $img = $filename;                                            
      }
      if (copy($folder, $folderlg)) 
      {
        $img = $filename;
      }   
  }
  }
  $desc = mysqli_real_escape_string($dbc, trim($_POST['desc']));
  if(!isset($_POST['visible']) || is_null($_POST['visible'])) { $visible = 0; } else { $visible = 1; }
  $query = "insert into scents (scent_type, scent_name, description, img_url, visible) values ('{$_POST['type']}', '$name','$desc','$img','$visible')";
  if($result = mysqli_query($dbc, $query)){
    echo '<script>alert("Scent added successfully!");</script>';
  }
  dbClose();
}

?>

<script src="js/utilities.js"></script>
<?php include('includes/apfooter.php'); ?>
