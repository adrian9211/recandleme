<?php function messageModal($msg) { ?>

<div class="modal" id="alertModal" style="display:block">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Alert</h6>
        <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo $msg; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">OK</a>
      </div>

    </div>
  </div>
</div>

<?php }  ?>

<?php function confirmModal($msg, $modalTitle) { ?>
  <form method="post">
    <div class="modal">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h6 class="modal-title"><?php echo $modalTitle; ?></h6>
              <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
              <?php echo $msg; ?>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" name="confirmBtn" href="">OK</button>
              <a class="btn btn-danger btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">Cancel</a>
          </div>
          </div>
      </div>
    </div>
  </form>
<?php if(isset($_POST['confirmBtn'])) { return true; } else { return false; }
} ?>

<?php function dbClose() {
  # Close database connection.
  if (isset($dbc)) {
    $dbc->close();
  }
}
?>

<?php function contactFunction() {
  if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
    messageModal('Please fill in all the required fields');
  }
  else {
    include('../db/dbaccess.php');
    $query = "select admin_email from settings where id=1";
    $result = mysqli_query($dbc, $query);
    $row = $result->fetch_assoc();

    $name_safe = mysqli_real_escape_string($dbc, $_POST['name']);
    $mail_safe = mysqli_real_escape_string($dbc, $_POST['email']);
    $msg_safe = mysqli_real_escape_string($dbc, $_POST['message']);
    # Send email
    $to = $row['admin_email'];
            $subject = "Contact from RecandleMe";
            $message = "
            <html>
            <head>
            <title>You have a new message from your contact form!</title>\r\n
            </head>
            <body>
            <p>Name: $name_safe</p>
            <p>Email: $mail_safe</p>
            <p>Message: $msg_safe</p>
            <p>". date('l jS \of F Y \a\t h:i:s A'). "</p>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= "From: <$to>" . "\r\n";
            
            $email = mail($to,$subject,$message,$headers);

            $q = "insert into messages (name, email, message, send_date) values ('$name_safe','$mail_safe','$msg_safe', NOW())";
            $r = mysqli_query($dbc, $q);
            if($r && $email) {
              messageModal('Message sent!');
            }
  }
}
?>