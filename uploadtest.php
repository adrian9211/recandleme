
<!DOCTYPE html>
<html>
<body>

<form action="uploadtest.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="item_img" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>



<?php
$target_dir = "shop/";
$target_file = $target_dir . basename($_FILES["item_img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if($_FILES['item_img']['size'] > 0) {
  echo '<script>alert("yes");</script>';  
  if($check = getimagesize($_FILES["item_img"]["tmp_name"])) {
    if (move_uploaded_file($_FILES["item_img"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["item_img"]["name"])). " has been uploaded.";
    }
    else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

