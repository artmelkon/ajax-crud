<?php
ob_start();

$server     = "127.0.0.1";
$user       = "root";
$password   = "";
$database   = "ajax";

$connection = mysqli_connect( $server, $user, $password, $database );

if( !$connection ) {
  die( "Connection Faild: " . mysqli_error($connection) );
}

?>