<?php
if(!defined('Darkout')) {
	define('Darkout', dirname(__FILE__));
}


require_once( Darkout . '/includes/customizer.php' );
require_once( Darkout . '/includes/enqueue.php' );
require_once( Darkout . '/includes/widgets.php' );



/* ========================================= Featured Images ========================================= */

add_theme_support( 'post-thumbnails');
add_image_size( 'product_med', 280, 280, true );
add_image_size( 'product_main', 548, 9999, false );
add_image_size( 'product_page_image', 1560, 9999, false );
set_post_thumbnail_size( 245, 245 );

// create a menu
function darkout_theme_setup() {
	// add_theme_support('menus');
	register_nav_menu('primary','Primary Header Navigation');
}
add_action('init','darkout_theme_setup');

// post featured image options
add_theme_support('post-thumbnails');

// header nav menu class starts

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item)
{
  if( in_array( 'current-menu-item', $classes ) ||
  in_array( 'current-menu-ancestor', $classes ) ||
  in_array( 'current-menu-parent', $classes ) ||
  in_array( 'current_page_parent', $classes ) ||
  in_array( 'current_page_ancestor', $classes )) 
    {
       $classes[] = "active";
    }
   return $classes;
}
if (function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}
if (!isset($content_width)) {
    $content_width = 900; // Set your desired maximum content width in pixels
}
function my_theme_setup() {
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'my_theme_setup');

function add_class_to_items_link( $atts, $item, $args ) {
	// check if the item has children
	$hasChildren = (in_array('menu-item-has-children', $item->classes));
	if ($hasChildren) {
		// add the desired attributes:
		$atts['class'] = 'dropdown-toggle nav-link';
		$atts['data-toggle'] = 'dropdown';
		$atts['data-target'] = '#';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_items_link', 10, 3 );


function add_classes_on_li($classes, $item, $args) {
	$classes[] = 'nav-item dropdown';
	return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);


function wpse156165_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link dropdown-link'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );

class MY_Menu_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
	}
	
	  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names . '>';
		$atts = array();
		$atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target) ? $item->target : '';
		$atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
		$atts['href'] = !empty($item->url) ? $item->url : '';
		$atts['class'] = 'nav-link';
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
		$attributes = '';
		foreach ($atts as $attr => $value) {
		  if (!empty($value)) {
			$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
			$attributes .= ' ' . $attr . '="' . $value . '"';
		  }
		}
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= apply_filters('the_title', $item->title, $item->ID);
		if (in_array('menu-item-has-children', $classes)) {
		  $item_output .= '<i class="fas fa-chevron-down"></i>';
		}
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	  }
}
// header nav menu class ends

// comment
function theme_enqueue_comments_reply() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        // Include comment-reply script
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_comments_reply');

/* =================================== TGM Required plugins =================================== */

// require_once get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'st_register_required_plugins' );

function st_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(

		array(
			'name'      => 'Easy Digital Downloads',
			'slug'      => 'easy-digital-downloads',
			'required'  => true,
		),

		array(
			'name'      => 'CMB2',
			'slug'      => 'cmb2',
			'required'  => true,
		),

		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

    array(
      'name'      => 'Advanced Custom Fields',
      'slug'      => 'advanced-custom-fields',
      'required'  => true,
  ), 

		array(
			'name'               => 'Stocky Addon',
			'slug'               => 'stocky-addon',
			'source'             => get_template_directory() . '/includes/plugins/stocky-addon.zip',
			'required'           => true,
			'version'            => '2.0.0',
			'force_activation'   => true,
			'force_deactivation' => true,
		),

		// array(
		// 	'name'               => 'Options Framework',
		// 	'slug'               => 'options-framework',
		// 	'source'             => get_template_directory() . '/includes/plugins/options-framework.zip',
		// 	'required'           => true,
		// 	'version'            => '',
		// 	'force_activation'   => true,
		// 	'force_deactivation' => true,
		// ),

	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'stocky',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'stocky-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'stocky' ),
			'menu_title'                      => __( 'Install Plugins', 'stocky' ),
			'installing'                      => __( 'Installing Plugin: %s', 'stocky' ),
			'updating'                        => __( 'Updating Plugin: %s', 'stocky' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'stocky' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'stocky'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'stocky'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'stocky'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'stocky'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'stocky'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'stocky'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'stocky'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'stocky'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'stocky'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'stocky' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'stocky' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'stocky' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'stocky' ),
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'stocky' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'stocky' ),
			'dismiss'                         => __( 'Dismiss this notice', 'stocky' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'stocky' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'stocky' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );
}

/* =================================== One Click Demo Import =================================== */

add_filter( 'ocdi/import_files', 'stocky_import_demo' );
add_action( 'ocdi/after_import', 'stocky_after_import_setup' );

function stocky_import_demo() {
	return array(
		array(
			'import_file_name'             => 'Demo',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/demo/stocky.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/demo/stocky-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/demo/stocky-customizer.dat',
		),

	);
}

function stocky_after_import_setup() {
	// Assign menus to their locations.
	
	$main_menu = get_term_by( 'name', 'Menu 1', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Photography Marketplace' );
	// $blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	// update_option( 'page_for_posts', $blog_page_id->ID );
	
  // Update theme options after import
  $dark_url="http://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/08/compliancer-Logo_standard-1.png";
  $light_url="http://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/08/white.png";
		$fav_icon="http://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/11/favicon.png";
		$banner_img="http://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/11/Rectangle-38-1.png";
  $updated_options = array(
    'theme_style' => 'dark_theme',
    'header_logo_url' => '/',
    'dark_logo' => $dark_url,
    'light_logo' => $light_url,
    'favicon' => $fav_icon,
    'sticky' => '',
    'linkedin' => 'https://www.linkedin.com/company/scubeco/',
    'twitter' => 'https://twitter.com/scubeco',
    'facebook' => 'https://www.facebook.com/thescube',
    'youtube' => 'https://www.youtube.com/channel/UCrlec1bEogZmLPhxyFSRapw',
    'footer_logo' => $light_url,
    'footer_logo_url' => '/',
    'single_download_banner' => $banner_img,

    // Add more options as needed
  );

  // Retrieve existing theme options
  $existing_options = get_option('theme_mods_stocky', array());

  // Merge existing options with the updated ones
  $merged_options = array_merge($existing_options, $updated_options);

  // Update the theme options
  update_option('theme_mods_stocky', $merged_options);


		// Update customizer options
    // $customizer_data = file_get_contents(trailingslashit(get_template_directory()) . 'includes/demo/stocky-customizer.dat');
    // $customizer_options = maybe_unserialize($customizer_data);

    // if ($customizer_options && is_array($customizer_options)) {
    //     // Update customizer options
    //     foreach ($customizer_options as $option_name => $option_value) {
    //         update_option($option_name, $option_value);
    //     }
    // }
    // $my_options= get_option('theme_mods_stocky');
    // update_option('theme_mods_stocky', $my_options);
}
/* =================================== Options Framework =================================== */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = 'false') {

		$optionsframework_settings = get_option('optionsframework');

		// Gets the unique option id
		if( is_array($optionsframework_settings) ){
		$option_name = $optionsframework_settings['id'];
		}

		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}

		if ( !empty($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

/* ====================================================== VIEW COUNT FUNCTION ====================================================== */
// Function to add a custom field for view counts to EDD products
function add_view_count_field($post_id) {
  add_post_meta($post_id, '_product_view_count', 0, true);
}

// Hook into EDD to add the custom field when a new product is created
add_action('edd_insert_download', 'add_view_count_field');

function get_product_view_count($download_id) {
  $view_count = get_post_meta($download_id, '_product_view_count', true);
  return "$view_count views";
}

function increment_product_view_count($download_id) {
  $key = '_product_view_count';
  $count = (int) get_post_meta($download_id, $key, true);
  $count++;
  update_post_meta($download_id, $key, $count);
}


/* ====================================================== EDD STUFF ====================================================== */

// filter the EDD downloads shortcode
function dcs_shortcode_atts_downloads( $atts ) {
	$atts[ 'full_content' ] = false;
	$atts[ 'buy_button' ] = false;
	$atts[ 'excerpt' ] = false;
	$atts[ 'price' ] = false;

	return $atts;
}
add_filter( 'shortcode_atts_downloads', 'dcs_shortcode_atts_downloads' );

// Echo downloads list if EDD is active
function dcs_edd_downloads() {
	if ( function_exists('edd_get_settings') ){


		$home_categories = get_theme_mod( 'home_download_categories', 'none' );
		$categories = '';
		if ( ! empty( $home_categories ) ) :
			$categories = implode( ',', array_keys( array_filter( $home_categories ) ) );
		endif;

		$home_products_total = 25;
		if ('' != get_theme_mod('number_of_products_on_home_page','')) :
			$home_products_total = esc_attr(get_theme_mod( 'number_of_products_on_home_page' ));
		endif;

		//echo edd_downloads_query( array( 'category' => $categories, 'relation' => 'IN' ) );
		echo do_shortcode('[downloads category="'. $categories .'" number="'. $home_products_total .'" ]');
	}
}

// ***************************************** CHECK USER STATUS (VENDOR,MEMBER,ADMIN) ************************

function get_user_status($user_id,$user_roles){
	if(!empty($user_id) || $user_roles){
    if(check_plugin_status('edd-fes/edd-fes.php')){

      $vendors_db     = new FES_DB_Vendors();						// Get Vendors Database.

      $vendors        = $vendors_db->get_vendors( array(			// Get Vendor Details as Array Object.
        'number' => 999999999999
      ) );

    }

		$validate_user = '';

    if($vendors){
      foreach($vendors as $vendors){
        if($user_id == $vendors->user_id){						// Check Current user ID is Vendor.
          $validate_user = 'vendor';
          break;
        }
      }
    }

		if($validate_user != 'vendor'){
			if(in_array('administrator',$user_roles ) ){			// Check Current User ID is Admin.
				$validate_user = 'admin';
			}
			else{
				$validate_user = 'member';
			}
		}
		return $validate_user;
	}
	else{
		return "Need User ID and User Roles to Check Status.";
	}
}

// ***************************************** CHECK PLUGIN ACTIVE STATUS **************************

function check_plugin_status($plugin_path) {
  $active_plugins = get_option('active_plugins');
  return in_array($plugin_path, $active_plugins);
}




// Function to display variable pricing range
function display_variable_pricing_range($download_id) {
    $prices = edd_get_variable_prices($download_id);

    if ($prices) {
        $min_price = min(array_column($prices, 'amount'));
        $max_price = max(array_column($prices, 'amount'));

        echo edd_currency_filter($min_price);
        echo ' - ';
        echo edd_currency_filter($max_price);
    }
}

// Function to return alt text for images

function get_image_alt($postid){
	$attachment_id = get_post_thumbnail_id($postid);
	$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	if( $alt ){
		return $alt;
	}
	else{
		return "image";
	}
}

function modify_comment_form_title($args) {		// Edit Comment title and buton.
	
    $args['title_reply'] = 'Leave A Comment'; // Change 'Leave a Reply' to 'Leave a Comment'
	$args['submit_button']  = '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="Submit" />';
	
    return $args;
}
add_filter('comment_form_defaults', 'modify_comment_form_title');

// Function to return default img with img tag

function get_default_image(){
	
	$image = '';
	
	$image .= '<img src="'.get_template_directory_uri().'/assets/img/default-image.png" alt="default-stocky-image" class="img-fluid">';
	
	return $image;
	
}


// file upload restriction function starts
function filter_image_pre_upload($file)
{
    $image_max_allowed_size = 10240 * 2000;
	$document_max_allowed_size = 10240 * 310000;
	
	if ($file['type'] != "application/pdf") {
		if ($file['size'] > $image_max_allowed_size) {
            $file['error'] = 'Please reduce the size of your image to 10 MB or less before uploading it.';
        }
	} else {
		if ($file['size'] > $document_max_allowed_size) {
            $file['error'] = 'Please reduce the size of your document to 10 MB or less before uploading it.';
        }
	}

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'filter_image_pre_upload', 20);

function b5f_increase_upload( $bytes )
{
    return 10240 * 310000;
}
add_filter( 'upload_size_limit', 'b5f_increase_upload' );
// file upload restriction function ends
