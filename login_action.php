<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
require ( 'connect_db.php' ) ;
require ( 'login_tools.php' ) ;
list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;
if ( $check )
{
  $id = array('quantity', 'price');
  session_start();
  $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
  $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
  $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
  $_SESSION[ 'admin_perm' ] = $data[ 'admin_perm' ] ;
  $_SESSION[ 'cart' ] = $id ;
  load ( 'home.php' ) ;
}
else { $errors = $data; }
mysqli_close( $link ) ;
include ( 'login.php' ) ;
?>