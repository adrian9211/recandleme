<?php 
include('includes/apheader.php');?>

<div class="h5 w3-text-blue">Edit Product</div>

<?php
include('../../db/dbaccess.php');
$q = "SELECT * FROM products WHERE item_id = '". $_GET['id']."'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) :?>
    <?php $row=mysqli_fetch_assoc($r); $old_img = $row['img_url'];?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-10 mt-2">
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Item Name</span>
                <input type="text" class="form-control" name="name" value="<?php echo $row['item_name'];?>">
                </div>
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Description</span>
                <textarea name="desc" id="description" rows="3" class="form-control" maxlength="200"><?php echo $row['item_desc'];?></textarea>
                </div>
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Current Image: </span> <label class="m-1 fst-italic"> <?php echo $row['img_url'];?></label>
                </div>
                <div class="input-group mb-3 input-group-sm">
                <img src="../shop/<?php echo $row['img_url'];?>" style="width:5rem">
                </div>
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Replace</span>
                <input type="file" name="img_url" class="form-control">
                </div>
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Price</span>
                <input type="number" class="form-control" name="price" value="<?php echo $row['item_price'];?>" placeholder='0.00' step="0.01" min="0.00">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="form-check" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show this product in the shop">
                        <label class="form-check-label">Visible</label>
                        <input class="form-check-input" type="checkbox" id="visible" name="visible" <?php if($row['visible']){ echo 'checked'; }?>>
                    </div>
                </div>
                <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Stock</span>
                <input type="number" class="form-control" min="0" name="stock" value="<?php echo $row['stock'];?>">
                </div>
            </div>
            <input type="hidden" name="shop_id" value="<?php echo $_GET['id'];?>"><input type="hidden" name="old_img" value="<?php echo $old_img;?>">
        </div>
        <div class="row"><div class="col-xl-6 col-lg-8 col-md-10 d-grid"><button type="submit" class="btn btn-sm btn-block w3-blue" name="submit">Update</button></div></div>
    </form>

<?php endif;

if (mysqli_num_rows($r) < 1) {
    echo '<script>alert("Product not found, please try again");</script>';
    echo '<script>location.href="adminmanageproducts.php";</script>';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_POST['visible']) || is_null($_POST['visible'])) { $visible = 0;} 
    else { $visible = 1;} 
    
    if ($_FILES['img_url']['size'] == 0) {
        $qu = "UPDATE products SET item_name = '".$_POST['name']."', item_desc = '".$_POST['desc']."', item_price = '".$_POST['price']."', visible = '".$visible."' WHERE item_id = '".$_POST['shop_id']."'";
    }
    else if($_FILES['img_url']['size'] != 0) {
        $filename = $_FILES['img_url']['name'];
        $tempname = $_FILES['img_url']['tmp_name'];                     
        $folder = "shop/".$filename;
        $folderlg = "shop/lg/".$filename;
        # Upload File
        if (move_uploaded_file($tempname, $folder))
        {
            $img = $filename;                                                   
        }
        else {
            echo 'File Upload Failed';
        }
        if (copy($folder, $folderlg)) {
            $img = $filename;
            $oldimg = "shop/".$_POST['old_img'];
            $oldimg_lg = "shop/lg/".$_POST['old_img'];
            unlink ($oldimg);
            unlink ($oldimg_lg);
        }  
        else { 
            echo 'File copy to lg folder failed';
        }
        $qu = "UPDATE products SET item_name = '".$_POST['name']."', item_desc = '".$_POST['desc']."', img_url = '".$img."', item_price = '".$_POST['price']."', visible = '".$visible."', stock = '".$_POST['stock']."' WHERE item_id = '".$_POST['shop_id']."'";
    }

    $ar = mysqli_query($dbc, $qu);               

    if ($ar)
    {
        echo '<script>alert("Item Updated!");</script>';
        echo '<script>location.href="adminmanageproducts.php";</script>';
    }

} 






mysqli_close($dbc);

include('includes/apfooter.php');

?>