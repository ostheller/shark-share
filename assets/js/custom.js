$document.ready() {
$('request_form').submit(function(){
  $.ajax({  
    type: "POST",  
    url: "samples/request",  
    data: $('form').serialize(),  
    success: function() {  
      alert('Request added to basket');
    }  
  });
}
