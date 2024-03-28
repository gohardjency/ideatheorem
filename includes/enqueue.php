<?php
// adding the files
function darkout_script_enqueue() { 

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all');
	wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome/all.css', array(), false, 'all');
	wp_register_style( 'themestyle', get_template_directory_uri() . '/assets/css/darkout.css?v16.58', array(), 4, 'all');
	wp_register_style( 'Header-1', get_template_directory_uri() . '/assets/css/header-1.css?v14.7', array(), false, 'all');

	wp_register_style( 'style', get_template_directory_uri() . '/style.css?v14.8', array(), false, 'all');

	wp_enqueue_style('bootstrap');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('themestyle');
	wp_enqueue_style('Header-1');
	wp_enqueue_style('style');
	

	// load WP's included jQuery library
	wp_enqueue_script('jquery');


	wp_enqueue_script( 'jquery-ajax', get_template_directory_uri() . '/assets/js/jquery-ajax.min.js','', '1',false);

	wp_enqueue_script( 'popperjs', get_template_directory_uri() . '/assets/js/popper.min.js','', '1',true);
  	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js','', '1',true);
	
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/assets/js/darkout.js?v14.62','', '5',true);
	
	  // Localize the script with the AJAX URL
	  wp_localize_script('customjs', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts','darkout_script_enqueue');

function load_admin_files() {

wp_register_style('admin_css', get_template_directory_uri() . '/assets/css/admin.css', array(), false, 'all');
wp_enqueue_style('admin_css');
wp_enqueue_script( 'adminjs', get_template_directory_uri() . '/assets/js/darkout-admin.js','', '1',true);

}

// calling function to load admin files
add_action('admin_enqueue_scripts', 'load_admin_files');
?>
