<?php
/**
 * this is car-input.php
 *  here we wil insert the data into the databse
 * 
 */
 
include 'db-connect.php';

if( isset( $_POST['car_brand']) && isset($_POST['car_model'] ) ) {
  $brand = $_POST['car_brand'];
  $model = $_POST['car_model'];
  // echo $car_brand;

  $qr = "INSERT INTO cars(brand, model) VALUES('$brand', '$model')";
  $insert_query = mysqli_query($connection, $qr);

  if( !$insert_query ) {
    die( "Query Failed: " . mysqli_error($connection) );
  }

  header("Location: index.html");
}



mysqli_close($connection);
?>