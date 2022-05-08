<?php
$dbc = mysqli_connect( 'HOST' , 'USER' , 'PASS' , 'DATABASE' ) 
OR die (mysqli_connect_error());
mysqli_set_charset( $dbc , 'utf8' );
?>
