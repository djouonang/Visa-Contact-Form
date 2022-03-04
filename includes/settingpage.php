<?php

 include_once("function.php");
 
 echo cf_contact_form();
 
function cf_contact_form(){
 

?>

  <div class="container">  
  <form id="contact"  action="<?php $_SERVER['REQUEST_URI'] ?>"   method="post" >
    <h3>Form settings</h3>
	
	<?php
	
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

 formsetting_table();
 
 formcountries_table();

 }

 $result = getformsetting();
 
  $result1 = getcountries();
  
   $visa_country = $result1->visa_countries;
   
   $visa_country = explode(",", $visa_country);
   

   
  $email = $result->email;
   
 $countries = $result->countries;
 
 $countries_array = explode (", ", $countries); 

 ?>
  <!-- One "tab" for each step in the form: -->
    <h4>Email address:</h4>
    
   <fieldset>
   <input type="email" placeholder="Enter Email to receive notifications"  name="email_address" value="<?php echo  $email; ?>" required autofocus>
   <p>Enter Email to receive form submission notifications</p>
 <br/>
    <input type="hidden" id="get_hidden"  name="countries_hidden" value="<?php
    
    foreach($visa_country as $visa):
    $myArray = array();
    $myArray[] =  $visa.",";
     

echo implode( ', ', $myArray); endforeach; ?>" >
    
  </fieldset>
  
    <h4>Choose countries:</h4>
    <fieldset>
  <select class="countries-dropdown" data-placeholder="List of countries"  name="country[]" multiple="multiple" style="width: 100%" required autofocus>


		<?php
	 
	  if(is_array($countries_array) || is_object($countries_array)):
            foreach($countries_array as $country):

     echo '<option value="' .$country. '" >'. $country. '</option>';
    endforeach;
	 endif;
    ?>
	
    </select>
 
  </fieldset>
     <p style="padding-top: 2px">Choose countries to show on the visa application form</p>
     <br/>
  

      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Save Information</button>

    </fieldset>
  </form>
</div>

<?php

}