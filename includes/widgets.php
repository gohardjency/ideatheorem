<?php

// widget function starts

function darkout_widget_setup() {
  register_sidebar(array(
      'name'=>'Siderbar',
      'id' => 'darkout_sidebar',
      'class' => 'custom',
      'description' => 'Standard Sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="box_title widgettitle"><h4>',
			'after_title' => '</h4></div>'
    )
  );
register_sidebar(array(
			'name' => __('Footer', 'stocky'),
			'id' => 'darkout_footer',
			'description' => __('Widgets for the footer of your site. They will resize based on how many you use.', 'stocky'),
			// 'before_widget' => '<div class="col-lg-4 col-md-6 footer-widget">',
			// 'after_widget' => '</div>',
			'before_title' => '<div class="title"><h5>',
			'after_title' => '</h5><div class="footer-title-border"></div></div>'
		)
	);
}
add_action( 'widgets_init','darkout_widget_setup' );

// widget function ends

?>
