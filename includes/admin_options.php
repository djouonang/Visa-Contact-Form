<?php

add_action('admin_menu', 'admin_options');

function admin_options() {
	
	 $page_title = 'Contact Form Settings';
	 $menu_title = 'Contact Form Settings';
	 $capability = 'edit_posts';
     $menu_slug = 'contact_form';
     $function = 'formconfig';
     $icon_url = '';
     $position = 24;
	 
	 	 
$page_title_create_formentry = 'Update Form Entry';
	 $submenu_title_create_formentry = 'Update Form Entry';
	 $submenuformentry_slug = 'update_formentry';
	 $page_callback__formentry = 'update_formentry';
	 
add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	 
add_submenu_page(null, $page_title_create_formentry, $submenu_title_create_formentry, 'edit_posts', $submenuformentry_slug, $page_callback__formentry);


}

require_once("formsetting.php");
require_once("form.php");
require_once("updateformentry.php");