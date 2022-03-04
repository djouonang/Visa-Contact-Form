jQuery(document).ready(function($){
$('#ajax').on('submit', function(e){
   e.preventDefault();
   
   var that = $(this),
   url = that.attr('action'),
   type = that.attr('method');
   var fullname = $('#fullname').val();

   var email = $('#email').val();
   var phone = $('#phone').val();
   var firstNumber = $('#firstNumber').val();
   var secondNumber = $('#secondNumber').val();

   var nationality = $('#nationality').val();
   var captchaResult = $('#captchaResult').val();

   var data = {
        action: 'send_notification', // here php function 
        fullname: fullname,

         email: email,
         phone: phone,
         nationality: nationality,
         firstNumber: firstNumber,
         secondNumber: secondNumber,
         captchaResult: captchaResult,
    };
   
jQuery.post(form_ajax_call.ajaxurl, data, function(response) {
         jQuery("#receiving_response").html(response);
    });
  });
});

jQuery(document).ready(function($){
$('#newform').on('submit', function(e){
   e.preventDefault();
   
   var that = $(this),
   url = that.attr('action'),
   type = that.attr('method');
   var fullname = $('#fullnam').val();

   var email = $('#email1').val();
   var phone = $('#phoneform').val();
   var firstNumber = $('#firstNumber2').val();
   var secondNumber = $('#secondNumber2').val();
   var captchaResult = $('#captchaResult2').val();
   var nationality = $('#dropfield').find(":selected").text();
   
   var data = {
        action: 'send_notification', // here php function 
        fullname: fullname,
   
         email: email,
         phone: phone,
         nationality: nationality,
         firstNumber: firstNumber,
         secondNumber: secondNumber,
         captchaResult: captchaResult,
    };
   
jQuery.post(form_ajax_call.ajaxurl, data, function(response) {
         jQuery("#receivin_response").html(response);
    });
  });
});