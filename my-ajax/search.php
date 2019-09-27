<?php
// this is search.php file
include 'db-connect.php';
// echo "Connected Successfuly";

$search = $_POST['search'];
if( !empty($search) ) {
  $query = "SELECT * from cars where brand like '$search%' ";
  $search_query = mysqli_query( $connection, $query );
  $row_count = mysqli_num_rows($search_query);
  if ( !$search_query ) {
    die( "Qquery faild". mysqli_error($connection) ) ;
  } elseif ( $row_count <= 0) {  // validate if the value exists in the database
    echo "Sorr we cound not find your query!";
  }

?>
<ul class="list-unstyled">
<?php
  while( $row = mysqli_fetch_array($search_query) ) {
    $brand = $row['brand'];
    $model = $row['model'];
    echo "<li>{$brand}  {$model} in stock</li>";
  }
?>
</ul>
<?php
}

mysqli_close($connection);
?>