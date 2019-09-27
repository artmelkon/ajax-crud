$(document).ready(function() {

  /* ===================================
    READING DATA FROM DB
  ====================================== */
  $('#search').keyup( function() {
    let search = $('#search').val();
    // alert(search);

    $.ajax({
      url: "search.php",
      // data: { search: search },
      data: { search:search},
      type: "POST",
      success: function( data ) {
        if( !data.error ) {
          $('#result').html(data);
        }
      }
    })
  });

  /* ====================================
    ENTRINT DATA INTO DB
    ===================================== */

  $('#addCarsForm').submit( function( evt ) {
    evt.preventDefault();
    var postData = $(this).serialize();
    let url = $(this).attr('action');
      // alert(url);
      // alert(postData);
      $.post(url, postData, function(php_table_data) {
        $('#input-result').html(php_table_data);
        $('#addCarsForm')[0].reset();
      });
  });  // END OF INPUT OF DATA

  /**
   * ====================================
   * THIS CODE WILL DISPLAYS OUTPUT FROM DB
   * ====================================
   */
  setInterval( updateCars, 400 );

  function updateCars() {
    $.ajax({
      url: 'display-cars.php',
      type: 'POST',
      success: function(show_cars) {
        if( !show_cars.error ) {
          $('#show-cars').html(show_cars);
        }
      }
    });
  }



  // END OF JQUERY DOCUMENT!
});
