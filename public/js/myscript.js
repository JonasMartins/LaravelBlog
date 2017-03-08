$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

/*comments*/
$('#comments-button').on('click', function(){
  $('#comments-section').slideToggle(500, function(){
    //$('#comment_body').focus();
  });
});