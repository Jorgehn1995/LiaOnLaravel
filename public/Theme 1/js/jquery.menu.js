$(document).ready(function(){
  var cambio = false;
  $('#navigation li a').each(function(index) {
    if(this.href.trim() == window.location){
      $(this).parent().addClass("active");
      cambio = true;
    }
  });
  if(!cambio){
    $('#navigation li:first').addClass("active");
  }
});
