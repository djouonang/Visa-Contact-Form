<?php


   function formsetting_table(){
	
	   global $wpdb;
	   
     $table_name = $wpdb->prefix.'contactformsetting';
	
	$num_row = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

	if($num_row == 0):
	
    $result_check = $wpdb->insert( $table_name, array(
     'email' => $_POST['email_address'],

   ) );
  
   else:
  
   $result_check =   $wpdb->query( $wpdb->prepare( "UPDATE $table_name SET email = %s WHERE id = %d", $_POST['email_address'], 1 ) );

   
   endif;
   
   
   if(isset($result_check)):
   
   echo '<div class="alert alert-success">';
    echo 'Information saved!';
    echo '</div>';
	else:
	
	 echo '<div class="alert alert-danger">';
    echo 'Error saving information!';
    echo '</div>';
	
	endif;
}

/*

function export_formentries(){

  global $wpdb;
	   
     $table_name = $wpdb->prefix.'contactform';
     
     $result = $wpdb->get_results("SELECT * FROM $table_name");
     
     
	// file creation
	$wp_filename = "form".date("d-m-y").".csv";
	
	// Clean object
	ob_end_clean ();
	
	// Open file
	$wp_file = fopen($wp_filename,"w");
	
	// loop for insert data into CSV file
	foreach ($result as $result1)
	{
		$wp_array = array(
		
			$name = $result1->name,
		    $nationality = $result1->nationality,
		    $email = $result1->email,
			$age = $result1->age,
			$phone = $result1->phonenumber
		);
		
		fputcsv($wp_file,$wp_array);
	}
	
	// Close file
	fclose($wp_file);
	
	// download csv file
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=".$wp_filename);
	header("Content-Type: application/csv;");
	readfile($wp_filename);
	exit;


}
*/

 function formcountries_table(){
 
 
	   global $wpdb;
	   
     $table_name = $wpdb->prefix.'countries';
     
     $num_row = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

   $countries = implode(',', $_POST['country']);
   
if(!empty($countries)):
	if($num_row == 0):
	
    $result_check = $wpdb->insert( $table_name, array(
     'visa_countries' => $countries,
   ) );
   
   else:
   
   $result_check =   $wpdb->query( $wpdb->prepare( "UPDATE $table_name SET visa_countries = %s WHERE id = %d", $countries, 1 ) );

   
   endif;
   endif;
     
 }


function addquote($str) {
    return sprintf("'%s'", $str);
}

function getformsaved(){
	
	global $wpdb;
	   
	$table_name = $wpdb->prefix.'contactform';
	
	$result = $wpdb->get_results("SELECT * FROM $table_name");
	 
	return $result;
}

function getformsetting(){
	
	   global $wpdb;
	   
	$table_name = $wpdb->prefix.'contactformsetting';
	
	$result = $wpdb->get_row("SELECT * FROM $table_name WHERE id = 1");
	
	// $email = $result->email;
	 
	 return $result;
}
function getcountries(){
	
	   global $wpdb;
	   
	$table_name = $wpdb->prefix.'countries';
	
	$result = $wpdb->get_row("SELECT * FROM $table_name WHERE id = 1");
	
	// $email = $result->email;
	 
	 return $result;
}

 ?>