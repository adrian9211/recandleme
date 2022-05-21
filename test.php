<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container mt-3">
    <h3>Tooltip Example</h3>

    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Hooray!">
      Hover over me!
    </button>
  </div>

  <?php
  session_start();
  # $a = "small £13.00";
  $a = 'eh111ab';
  $b[] = '';
  # preg_match("/^[a-zA-Z]+\s/", $a, $b);
  # preg_match("/[0-9\.]+$/", $a, $b);
  preg_match("/^[A-Za-z]+[0-9]+[A-Za-z]?\s*[0-9]{1}[A-Za-z]{2}$/", $a, $b);

  echo $b[0];
  echo '<br><br><br>';
  # print_r($_SESSION);
  ?>

  <script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>

</body>

</html>