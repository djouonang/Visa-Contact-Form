$(function() {
$(".btn").click(function() {
$(".btn-other").removeClass("active");
$(".frame").removeClass("frame-short").addClass("frame-long");

$(".passport-active").removeClass("passport-inactive");
$(".signup-inactive").removeClass("signup-active");
$(".form-passport-left").removeClass("form-passport-left").addClass("form-passport");
//$(".form-passport").removeClass("form-passport-left");
$(".form-signup").removeClass("form-signup-left");
$(this).removeClass("idle").addClass("active");
});
});

$(function() {
$(".btn-other").click(function() {
	$(".btn").removeClass("active");
	var className = $('#getframe').hasClass('frame-test');
	
	if (className == false){

		$(".frame").removeClass("frame-long").addClass("frame-short");
	}
	$(".signup-inactive").addClass("signup-active");
	$(".passport-active").addClass("passport-inactive");
	//$(".form-signup").addClass("form-signup-left");
	$(".form-signup").addClass("form-signup-left");
	$(".form-passport").removeClass("form-passport").addClass("form-passport-left");
$(".forgot").toggleClass("forgot-left");
$(this).removeClass("idle").addClass("active");
});
});




function getField(that) {
	var dropdownarray =  $('#front_hidden').val();

     var nameArr = dropdownarray.split(',');
     
var dropfield = document.getElementById('dropfield');

var field = dropfield.options[dropfield.selectedIndex].value;


    if (dropdownarray.includes(field)){

        document.getElementById("showfield").style.display = "block";
	
	
		document.getElementById("showfield0").style.display = "none";
		
		 document.getElementById("showfield1").style.display = "none";
		 
		 document.getElementById("getframe").classList.remove("frame-short");
		 document.getElementById("getframe").classList.add("frame-new", "frame-test");

    }else {
        document.getElementById("showfield1").style.display = "block";
		      document.getElementById("showfield0").style.display = "none";
		   document.getElementById("showfield").style.display = "none";
		   
		 document.getElementById("getframe").classList.remove("frame-long");
		 document.getElementById("getframe").classList.add("frame-short");
    }
	
	
}