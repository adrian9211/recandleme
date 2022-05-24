<?php 
# Set page title
$page_title = "Email Confirmation";
# Include header file
include('assets/includes/header.php'); 
?>

<?php
include('../../htdocs/db/dbaccess.php');
if (isset($_GET['ref']) && $_GET['ref'] != '') {
    $decodedHash = urldecode($_GET['ref']);
    $safeHash = $dbc->real_escape_string($decodedHash);
    $searchQuery = "select email, date_created, status from emailvalidate where pass_key = '{$safeHash}'";
    if (($searchResult = $dbc->query($searchQuery)) && $searchResult->num_rows > 0) {
        $row = $searchResult->fetch_assoc();
        $email = $row['email'];
        $updateQuery = "update users set active = 1 where email ='{$email}'";
        $updateResult = mysqli_query($dbc, $updateQuery);
        if ($updateResult) {
            messageModal('Thank you for confirming your email address');
        }
    }
}
?>


<?php
# Include footer
include('assets/includes/footer.php'); 
?>