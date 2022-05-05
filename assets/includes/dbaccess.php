<?php
$dbc = mysqli_connect( 'localhost' , 'root' , '' , 'recandleme_db' ) 
OR die (mysqli_connect_error());
mysqli_set_charset( $dbc , 'utf8' );
?>