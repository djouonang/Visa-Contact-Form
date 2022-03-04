<?php

 include_once("function.php");
 
 function update_formentry(){
    global $wpdb;
	$table_certificate = $wpdb->prefix.'contactform';
	$id = $_GET["id"];
	$status = $_GET["status"]; // To differentiate between update and delete operation
	$result1 = $wpdb->get_row("SELECT * FROM $table_certificate WHERE id = '{$id}' ");
     $name = $result1->name;
		                $nationality = $result1->nationality;
						$email = $result1->email;
						
						$phone = $result1->phonenumber;
	
		
		// Delete operation takes place if ($status == "delete") condition is met
		
		if($status == "delete") {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_certificate WHERE id = %s", $id));
		
		  ?>
            <div class="updated"><p>Form Entry deleted</p>
            <a class="button" href="<?php echo admin_url('admin.php?page=contact_form') ?>">&laquo; Back to Form Entries</a>
            </div>
<?php 
     } 
 
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	
    $fullname = trim($_POST["fullname"]);

	$email = trim($_POST["email"]);
	$nationality = trim($_POST["nationality"]);
	$phone = trim($_POST["phone"]);
	
	// Update values to database
	
	$wpdb->update($table_certificate, 
		 array('name' => $fullname,

			   'nationality' => $nationality,
	           'phonenumber' => $phonenumber,
			   'email' => $email
			  ), 
			   array('id' => $id), array('%s','%s','%d','%d','%s'),
         array('%d'));
		
		/** updating company and training course should be reviewed so that company and course field should be drown down fields with values
		from the database just as it is on insert company and training course forms. With that updating the company and training course table
		from the update form will work without issues
		
	$wpdb->update($table_name1, 
		 array('titre' => $updatedgetcompany),
			   array('idsociete' => $getidsociete), 
			   array('%s'),
               array('%d'));
			   
			   **/
	
 ?>
            <div class="updated"><p>Form entry updated</p>
            <a class="button" href="<?php echo admin_url('admin.php?page=contact_form') ?>">&laquo; Back to Form Entries</a>
            </div>
        <?php }elseif($status == "update") { ?>
			<div class="container">  
   
          <form id="contact"  action="<?php $_SERVER['REQUEST_URI'] ?>"   method="post" >
    <h3>Update Form Entry</h3>
	
	<?php
	
	 if ( isset( $_POST['submit'] ) ) {
 
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
  
  <h4>Full name:</h4>
			  <fieldset>
		<input class="form-styling" id="fullname" type="text" name="fullname" placeholder="" value="<?php  echo $name; ?>" required/>
		      </fieldset>
			  
			 
			 
			  <h4>Email:</h4>
			  <fieldset>
			<input class="form-styling" id="email" type="text" name="email" placeholder="" value="<?php echo $email; ?>" required/>
			 </fieldset>
			 
			 <h4>Phone:</h4>
			  <fieldset>
			 <input class="form-styling" id="phone" type="text" name="phone"  value="<?php echo $phone; ?>" placeholder="Enter phone number" required/>
	 </fieldset>
    
  
 
    <input type="hidden" id=""  name="countries_hidden" value="" >
    
 
    <h4>Choose country:</h4>
    <fieldset>
  <select class="countries-dropdown0" id="get_country" data-placeholder="Choose Country"  name="nationality"  style="width: 100%" required autofocus>

 
                <option selected="selected" value="<?php echo $nationality; ?>"><?php echo $nationality; ?></option>
			
             
                  <?php   
                  
   $result1 = getcountries();
  
   $visa_country = $result1->visa_countries;
   
  $visa_country = explode(",", $visa_country);
   
  if(is_array($visa_country) || is_object($visa_country)):
            foreach($visa_country as $country):

     echo '<option value="' .$country. '" >'. $country. '</option>';
    endforeach;
	 endif;
                   ?>
                </select>
				    </fieldset>
   
  <br/>
 <fieldset>

      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>

    </fieldset>
  </form>
</div>
        <?php
		} 		
		}