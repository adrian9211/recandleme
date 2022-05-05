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
        <a class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">Ok</a>
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
              <button type="submit" class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" name="confirmBtn" href="">Ok</button>
              <a class="btn btn-danger btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">Cancel</a>
          </div>
          </div>
      </div>
    </div>
  </form>
<?php if(isset($_POST['confirmBtn'])) { return true; } else { return false; }
} ?>


