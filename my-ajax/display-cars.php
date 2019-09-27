<?php
// ini_set('memory_limit', '1024' ); // increasing processing memory 1G

// connection
include 'db-connect.php';

$qr = "SELECT * FROM cars";
$output_query = mysqli_query( $connection, $qr );

if( !$output_query ) {
  die( "Query Failed: " . mysqli_error( $connection ) );
}

while( $row = mysqli_fetch_array( $output_query ) ) {
?>
  <tr>
    <td><?php echo $row['ID']; ?></td>
    <td><a rel='<?php echo $row['ID']; ?>' class="car-link" href="javascript:void(0)"><?php echo $row['brand'] . " " . $row['model']; ?></<a>
  </tr>
<?php } ?>

<script>
$(function() {
  // $('#action-container').hide();
  $('.car-link').on('click', function() {
    // alert($(this).attr('class'));
    $('#action-container').show();
    let id = $(this).attr('rel');
    // alert(id)
    let url = 'process.php',
        dataid = {id:id};
    $.post( url, dataid, function(data) {
      $('#action-container').html(data)
    });
  });
});
</script>
