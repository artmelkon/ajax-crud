<?php

/**
 * this is process.php
 *  here we update the data in the database
 * 
 */

 include 'db-connect.php';

 if( isset( $_POST['id'] ) ) {

 $carId = mysqli_real_escape_string( $connection, $_POST['id'] );

 $qr = "SELECT * FROM cars WHERE ID = {$carId}";
  $output_query = mysqli_query( $connection, $qr );
  
  if( !$output_query ) {
    die( "Query Failed: " . mysqli_error( $connection ) );
  }
  
  while( $row = mysqli_fetch_array( $output_query ) ) {
  ?>
    <p id="feedback" class="bg-success"></p>
    <input type="text" class="form-control mb-3 brand-input" name="" id="<?php echo $row['ID']; ?>" value="<?php echo $row['brand']; ?>">
    <input type="button" class="btn btn-primary" id="update" value="Update">
    <input type="button" class="btn btn-danger" id="delete" value="Delete">
    <input type="button" class="btn btn-secondary" id="close" value="close">
<?php }
 } 
 
 /**
  *  UPDATE DATA IN THE DATABASE
  */
 if( isset( $_POST[ 'updatethis' ] ) ) {
  $id     = mysqli_real_escape_string( $connection, $_POST['id'] );
  $brand  = mysqli_real_escape_string( $connection, $_POST['brand'] );

  $qr = "UPDATE cars set brand = '$brand' where ID = $id ";
  $update_query = mysqli_query( $connection, $qr );

  if( ! $update_query ) {
    die( "Update Fail: " . mysqli_error( $connection ) );
  }
}

/**
 *  DELTE DATA FROM DATABASE
 */

if( isset( $_POST['deletethis'] ) ) {
  $id = mysqli_real_escape_string( $connection, $_POST['id']);

  $qr = "DELETE FROM cars WHERE ID = $id";
  $delete_query = mysqli_query( $connection, $qr );

  if( ! $delete_query ) {
    die( "Unable to delete the query! " . mysqli_error( $connection ) );
  }
}
 ?>

 <script>
   $(function() {
     var id, brand;
     var updatethis = 'update';
     var deletethis      =  'delete';

    $('.brand-input').on( 'input', function () {
      id = $(this).attr('id');
      brand = $(this).val();
    } );

    // update the value of the data
    $('#update').on( 'click', function() {
      $.post( 'process.php', {id:id, brand:brand, updatethis:updatethis}, function(data) {
        $('#feedback').text( 'Record updated successfully!');
      });
    });                                  

    // delet function from database
    $('#delete').on( 'click', function() {
      var id = $('.brand-input').attr('id')
      $.post( 'process.php', {id:id, deletethis:deletethis}, function(data) {
        confirm( "Are you shoure you want to delete this item?");
        $('#action-container').hide();
      });
    });

    // close action form page
    $('#close').on( 'click', function() {
      $('#action-container').hide();
    })
   });
 </script>
