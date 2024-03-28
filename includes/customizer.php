<?php
function darkout_customize_register( $wp_customize ) {

//This is the theme option for the customizer
$wp_customize->add_panel( 'theme_options', array(
    'title'		=> 'Theme Options',
    'priority'	=> 20,
	)
);
// **************************************** BASIC SETTINGS STARTS ********************************************* //

//This is the section of basic setting
$wp_customize->add_section(
	'basic_settings',
		array(
			'title'     	=> __( 'Basic Settings', 'stocky' ),
			'panel'			=> 'theme_options',
			'priority'   	=> 10,
			'capability'  	=> 'edit_theme_options',
			'description' 	=> __('Change basic settings here.', 'stocky'),
		)
);

//Basic settings Starts

//Insert the logo image in home page
$wp_customize->add_setting(
	'logo',
		array(
			'default' 			=> 'Logo',
			'sanitize_callback' => 'theme_slug_sanitize_image'
		)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'logo',
		array(
			'label'			=> __( 'Logo', 'stocky' ),
			'description'	=> __( 'Upload your logo.', 'stocky' ),
			'section'		=> 'basic_settings',
			'settings'		=> 'logo',
			'priority'   	=> 10
		)
));


//Insert the Favicon image in the tab
$wp_customize->add_setting(
	'favicon',
		array(
			'default'			=> '',
			'sanitize_callback' => 'theme_slug_sanitize_image'
		)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'favicon',
		array(
			'label'			=> __( 'Favicon', 'stocky' ),
			'description'	=> __( 'The Favicon is the little 16x16 icon that appears next to your URL in the browser. It is not required, but recommended.', 'stocky' ),
			'section'		=> 'basic_settings',
			'settings'		=> 'favicon',
			'priority'   	=> 12
		)
));


// **************************************** BASIC SETTINGS ENDS ********************************************* //

// **************************************** HEADER SETTINGS STARTS ********************************************* //

//This is the section of Header setting
$wp_customize->add_section(
	'header_settings',
		array(
			'title'     	=> __( 'Header Settings', 'stocky' ),
			'panel'			=> 'theme_options',
			'priority'   	=> 11,
			'capability'  	=> 'edit_theme_options',
			'description' 	=> __('Change Header settings here.', 'stocky'),
		)
);

// header logo url
$wp_customize->add_setting(
	'header_logo_url',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'header_logo_url',
		array(
			'label' 		=> __( 'Header logo link', 'stocky' ),
			'description' 	=> __( 'Enter the URL for the header logo.', 'stocky' ),
			'section' 		=> 'header_settings',
			'settings' 		=> 'header_logo_url',
			'type' 			=> 'text',
			'priority'    	=> 10
		)
);

  //sticky header settings
  $wp_customize->add_setting(
  	'sticky',
  		array(
  			'default' 			=> '',
			  'sanitize_callback' => 'theme_slug_sanitize_checkbox',
  		)
  );

  $wp_customize->add_control(
  	'sticky',
  		array(
  			'label' 		=> __( 'Sticky Header', 'stocky' ),
  			'description' 	=> __( 'Checking this box will make the header sticky', 'stocky' ),
  			'section' 		=> 'header_settings',
  			'settings' 		=> 'sticky',
  			'type' 			=> 'checkbox',
  			'priority'    	=> 13
  		)
  );

// **************************************** HEADER SETTINGS ENDS ********************************************* //
// **************************************** HOME PAGE STARTS ********************************************* //
// home page settings
$wp_customize->add_section(
	'home_settings',
		array(
			'title'      	=> __( 'Home Settings', 'stocky' ),
			'panel'			=> 'theme_options',
			'priority'   	=> 12,
			'capability' 	=> 'edit_theme_options',
		)
);

// **************************************** HOME PAGE ENDS ********************************************* //

// **************************************** FOOTER SETTINGS START ************************************* //

//This is the section of  footer setting
$wp_customize->add_section(
	'footer_settings',
		array(
			'title'      	=> __( 'Footer Settings', 'stocky' ),
			'panel'			=> 'theme_options',
			'priority'   	=> 13,
			'capability' 	=> 'edit_theme_options',
		)
);

// Footer settings options starts

// Linkedin account details
$wp_customize->add_setting(
	'linkedin',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'linkedin',
		array(
			'label' 		=> __( 'Linkedin', 'stocky' ),
			'description' 	=> __( 'Enter the URL for your Linkedin profile.', 'stocky' ),
			'section' 		=> 'footer_settings',
			'settings' 		=> 'linkedin',
			'type' 			=> 'text',
			'priority'    	=> 10
		)
);

// Twitter account details
$wp_customize->add_setting(
	'twitter',
		array(
			'default' 			=> '#',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'twitter',
		array(
			'label' 		=> __( 'Twitter', 'stocky' ),
		 	'description'	=> __( 'Enter the URL for your Twitter profile.', 'stocky' ),
		 	'section'	 	=> 'footer_settings',
		 	'settings' 		=> 'twitter',
		 	'type' 			=> 'text',
			'priority'    	=> 11
		)
);

// facebook account details
$wp_customize->add_setting(
	'facebook',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'facebook',
		array(
			'label' 		=> __( 'Facebook', 'stocky' ),
			'description' 	=> __( 'Enter the URL for your Facebook profile.', 'stocky' ),
			'section' 		=> 'footer_settings',
			'settings' 		=> 'facebook',
			'type' 			=> 'text',
			'priority'    	=> 12
		)
);

// Youtube account details
$wp_customize->add_setting(
	'youtube',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'youtube',
		array(
			'label' 		=> __( 'Youtube', 'stocky' ),
			'description' 	=> __( 'Enter the URL for your Youtube profile.', 'stocky' ),
			'section' 		=> 'footer_settings',
			'settings' 		=> 'youtube',
			'type' 			=> 'text',
			'priority'    	=> 13
		)
);

// Insert the logo image in footer
$wp_customize->add_setting(
	'footer_logo',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'theme_slug_sanitize_image'
		)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'footer_logo',
		array(
			'label'			=> __( 'Footer Logo', 'stocky' ),
			'description'	=> __( 'Upload your footer logo.', 'stocky' ),
			'section'		=> 'footer_settings',
			'settings'		=> 'footer_logo',
			'priority'   	=> 16
		)
));

// Footer logo url
$wp_customize->add_setting(
	'footer_logo_url',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
);

$wp_customize->add_control(
	'footer_logo_url',
		array(
			'label' 		=> __( 'Footer Logo link', 'stocky' ),
			'description' 	=> __( 'Enter the URL for the footer logo.', 'stocky' ),
			'section' 		=> 'footer_settings',
			'settings' 		=> 'footer_logo_url',
			'type' 			=> 'text',
			'priority'    	=> 17
		)
);

// **************************************** FOOTER SETTINGS ENDS ********************************************* //


}
add_action( 'customize_register', 'darkout_customize_register' );


// customizer sanitization functions starts

//radio box sanitization function
  function theme_slug_sanitize_radio( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

  }
				//image control sanitization function
	function theme_slug_sanitize_image( $input, $default = ''  ) {
			return esc_url_raw( theme_slug_validate_image( $input, $default ) );
	}

	function theme_slug_validate_image( $input, $default = ''  ) {
			// Array of valid image file types
			// The array includes image mime types
			// that are included in wp_get_mime_types()
			$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
			);
			// Return an array with file extension
			// and mime_type
			$file = wp_check_filetype( $input, $mimes );
			// If $input has a valid mime_type,
			// return it; otherwise, return
			// the default.
			return $input;
	}

		 //checkbox sanitization function
 	function theme_slug_sanitize_checkbox( $input ) {
 			return ( ( isset( $input ) && true == $input ) ? true : false );
 	}

	// customizer sanitization functions ends

?>
