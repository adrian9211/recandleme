<?php include('includes/apheader.php'); ?>
<script src="js/users.js"></script>
<?php
$query = "SELECT * FROM users ORDER BY reg_date";
$result = mysqli_query($dbc, $query);


echo '<div class="row w3-blue me-2">';
echo '<div class="col-1">Actions</div><div class="col-1">USER ID</div><div class="col-1">Username</div><div class="col-2">Email</div><div class="col-2">Phone Number</div><div class="col-1">Date Joined</div>';
echo '</div>';
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$phpdate = strtotime($row['reg_date']);  
$dateReformat = date("d.m.Y", $phpdate);
$usersName = $row['user_name'];
echo '<div class="row w3-light-blue me-2">';
echo '<div class="col-1"><a class="adminBtn" onclick="deleteUser(\''.$usersName.'\', \''.$row['user_id'].'\')" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove User">&#9940;</a> <a class="adminBtn" onclick="userAdmin(\''.$usersName.'\', \''.$row['user_id'].'\', \''.$row['admin'].'\')" data-bs-toggle="tooltip" data-bs-placement="bottom"'; 
if ($row['admin'] != 1) {
    echo ' title="Make Admin">&#127344;';
}        
else {
    echo ' title="Remove as Admin">&#9989;';
}        
echo '</a></div><div class="col-1">'.$row['user_id'].'</div><div class="col-1">'.$row['user_name'].'</div><div class="col-2"';
if ($row['active'] == 1) {
    echo ' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Verified">&#10004; ';
}
else {
    echo '>';
}
echo $row['email'].'</div><div class="col-2">'.$row['phone'].'</div><div class="col-1">'.$dateReformat.'</div>';
echo '</div>';
}

?>

<?php include('includes/apfooter.php'); ?>

