<?php

/*
Plugin Name: Contact form
Plugin URI: www.test.com
Description: This is a dynamic visa contact form plugin where end users can make visa application inquiries depending on their contry of citizenship
Version: 1.0
Author: Djouonang Landry
Text Domain: Contact-form
Domain Path: /lang
Author URI: 


*/

/**
 * Reminder
 * Jquery library 
 **/


defined( 'ABSPATH' ) or die( 'Access denied buddy!' );

/**
 * Define some useful constants for shortening of path URLs
 **/
define('CF_FORM_VERSION', '1.0');
define('CF_FORM_DIR', plugin_dir_path(__FILE__));
define('CF_FORM_URL', plugin_dir_url(__FILE__));

/**
 * Load files
 * 
 **/
 
 function cf_form_loader(){
		
    require_once(CF_FORM_DIR.'includes/admin_options.php');
     
}


cf_form_loader();

/**
 * Enqueue Scripts
 * 
 **/
 
 add_action( 'wp_enqueue_scripts', 'cf_form_enqueue_scriptfiles' );

function cf_form_enqueue_scriptfiles() {
	
wp_register_script('jquery1', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', false, '3.5.1');
wp_register_script('jquery2', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', false, '1.12.1');
 wp_register_script( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
  wp_register_script( 'cf_form', CF_FORM_URL."assets/js/cf_form.js", array( 'jquery' ) );
	
	wp_enqueue_script('jquery1');
	wp_enqueue_script('jquery2');
	wp_enqueue_script('select2');
	wp_enqueue_script('cf_form');
	
	
	}
	
	add_action( 'wp_enqueue_scripts', 'frontend_enqueue_scriptfiles' );
	
function frontend_enqueue_scriptfiles() {
		
		wp_register_script( 'ajax_form_builder', CF_FORM_URL."assets/js/ajax.js", array('jquery') );
		 
		wp_enqueue_script('ajax_form_builder');
        wp_localize_script( 'ajax_form_builder', 'form_ajax_call',  array( 'ajaxurl' => admin_url('admin-ajax.php')) );
		
			}
	

	

add_action( 'admin_enqueue_scripts', 'cf_enqueue_scripts' );

function cf_enqueue_scripts() {
 
 // wp_register_script('maskedinput',CF_FORM_URL.'/includes/js/jquery.maskedinput.min.js', array('jquery')); for later use

wp_register_style( 'cf-css1', CF_FORM_URL."assets/css/bootstrap.min.css");

wp_register_style( 'cf-css3', CF_FORM_URL."assets/css/admin-form.css");

wp_register_style( 'cf-css01', CF_FORM_URL."assets/css/formentry-main.css");

 wp_register_style( 'select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );

  wp_enqueue_style( 'select2css' );

if ( isset( $_GET['page'] ) && $_GET['page'] == 'contact_form' || $_GET['page'] == 'update_formentry'  ) {

wp_enqueue_style('cf-css1');
wp_enqueue_style('cf-css3');
wp_enqueue_style('cf-css01');

}
}

add_action( 'wp_enqueue_scripts', 'front_script' );


function front_script(){

wp_register_script('jquery01', 'https://www.google.com/recaptcha/api.js', false, '3.5.1');

wp_register_script( 'cfc-js', CF_FORM_URL."assets/js/cf_formin.js", array('jquery'), null, true);


wp_enqueue_script('jquery01');
wp_enqueue_script('cfc-js');

}


	add_action( 'wp_enqueue_scripts', 'frontend_enqueue_files' );
	
function frontend_enqueue_files() {

wp_register_style( 'cf-css2', CF_FORM_URL."assets/css/cf_form.css");
wp_register_style( 'select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );

// wp_enqueue_style( 'cf-css2' );
  wp_enqueue_style( 'select2css' );

}
 
 

add_action( 'admin_enqueue_scripts', 'enqueue_select2_jquery' );


function enqueue_select2_jquery() {
   
    wp_register_script( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
  
    wp_enqueue_script( 'select2' );
}


add_action( 'admin_enqueue_scripts', 'enqueue_script_now' );


function enqueue_script_now(){

wp_register_script( 'cf-js', CF_FORM_URL."assets/js/cf_formadmin.js", array('jquery'), null, true);
wp_register_script('jquery1', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', false, '3.5.1');
wp_register_script('jquery2', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', false, '1.12.1');
 wp_register_script( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
  wp_register_script( 'cf-js', CF_FORM_URL."assets/js/cf_formadmin.js", array( 'jquery' ) );
	
	wp_enqueue_script('jquery1');
	wp_enqueue_script('jquery2');
	
wp_enqueue_script('cf-js');

}




function db_activation_function() {
 global $wpdb;
 

 $table_name2 = $wpdb->prefix . 'countries';
 
  $table_name1 = $wpdb->prefix . 'contactformsetting';
  
 $table_name = $wpdb->prefix . 'contactform';
 
 
 
 $charset_collate = $wpdb->get_charset_collate();
 
 
   $sql2 = "CREATE TABLE $table_name2 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
   visa_countries varchar(5000),

  UNIQUE KEY id (id)
 ) $charset_collate;";
 
  $sql1 = "CREATE TABLE $table_name1 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  email varchar(255),
   countries varchar(7000),
    selected_countries varchar(5000),

  UNIQUE KEY id (id)
 ) $charset_collate;";
 
 $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  nationality varchar(255),
  name varchar(255),
  email varchar(255),
  age varchar(255),
  phonenumber varchar(255),
  UNIQUE KEY id (id)
 ) $charset_collate;";

$result = $wpdb->query($sql2);  
$result = $wpdb->query($sql1);  
$result = $wpdb->query($sql); 

}

function insertdefaultcountries(){

global $wpdb;
$table_name = $wpdb->prefix . "countries"; 

$countries = 'Albania,Andorra,United States of America,Austria,Belgium,Bulgaria,Croatia,Cyprus,Czech Republic,Denmark,Estonia,Finland,France,Germany,Greece,Holland,Hungary,Iceland,Ireland,Italy,Latvia,Liechtenstein,Lithuania,Malta,Monaco,Montenegro,Norway,Poland,Portugal,Romania,Russia,San Marino,Slovakia,Slovenia,Spain,Sweden,Switzerland,Ukraine,United Kingdom';

$result_check = $wpdb->insert( $table_name, array(
     'visa_countries' => $countries,
   ) );
   
}

function insertcountries(){

global $wpdb;
$table_name = $wpdb->prefix . "contactformsetting"; 


$countries = 'Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, Antarctica, Antigua and Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Bouvet Island, Brazil, British Indian Ocean Territory, Brunei Darussalam, Bulgaria, Burkina Faso, Burundi, Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, Chad, Chile, China, Christmas Island, Cocos, Colombia, Comoros, Congo, Cook Islands, Costa Rica, Ivory Coast, Croatia, Hrvatska, Cuba, Cyprus, Czech Republic, Denmark, Djibouti, Dominica, Dominican Republic, East Timor, Ecuador, Egypt, El Salvador, Equatorial Guinea, Eritrea, Estonia, Ethiopia, Falkland Islands (Malvinas), Faroe Islands, Fiji, Finland, France, France, Metropolitan, French Guiana, French Polynesia, French Southern Territories, Gabon, Gambia, Georgia, Germany, Ghana, Gibraltar, Greece, Greenland, Grenada, Guadeloupe, Guam, Guatemala, Guinea, Guinea-Bissau, Guyana, Haiti, Heard and McDonald Islands, Honduras, Hong Kong, Hungary, Iceland, India, Indonesia, Iran, Iraq, Ireland, Israel, Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, Korea (North), Korea (South), Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Lesotho, Liberia, Libya, Liechtenstein, Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malawi, Malaysia, Maldives, Mali, Malta, Marshall Islands, Martinique, Mauritania, Mauritius, Mayotte, Mexico, Micronesia, Moldova, Monaco, Mongolia, Montserrat, Morocco, Mozambique, Myanmar, Namibia, Nauru, Nepal, Netherlands, Netherlands Antilles, New Caledonia, New Zealand, Nicaragua, Niger, Nigeria, Niue, Norfolk Island, Northern Mariana Islands, Norway, Oman, Pakistan, Palau, Panama, Papua New Guinea, Paraguay, Peru, Philippines, Pitcairn, Poland, Portugal, Puerto Rico, Qatar, Reunion, Romania, Russian Federation, Rwanda, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and The Grenadines, Samoa, San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Seychelles, Sierra Leone, Singapore, Slovakia, Slovenia, Solomon Islands, Somalia, South Africa, S. Georgia and S. Sandwich Isls., Spain, Sri Lanka, St. Helena, St. Pierre and Miquelon, Sudan, Suriname, Svalbard and Jan Mayen Islands, Swaziland, Sweden, Switzerland, Syria, Taiwan, Tajikistan, Tanzania, Thailand, Togo, Tokelau, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Turks and Caicos Islands, Tuvalu, Uganda, Ukraine, United Arab Emirates, United Kingdom, United States of America, US Minor Outlying Islands, Uruguay, Uzbekistan, Vanuatu, Vatican City State, Venezuela, Viet Nam, Virgin Islands (British), Virgin Islands (US), Wallis and Futuna Islands, Western Sahara, Yemen, Yugoslavia, Zaire, Zambia, Zimbabwe';


$result_check = $wpdb->insert( $table_name, array(
     'countries' => $countries,
   ) );
}
register_activation_hook(__FILE__,'db_activation_function');
register_activation_hook(__FILE__,'insertcountries');
register_activation_hook(__FILE__,'insertdefaultcountries');
/*
function delete_tables(){

        global $wpdb;
        $tableArray = [   
          $wpdb->prefix . "countries",
          $wpdb->prefix . "contactformsetting",
   
          $wpdb->prefix . "contactform",
       ];

      foreach ($tableArray as $tablename) {
         $wpdb->query("DROP TABLE IF EXISTS $tablename");
      }
    }

    register_deactivation_hook(__FILE__, 'delete_tables');
	*/