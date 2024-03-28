<?php get_header();

if (have_posts()) : while(have_posts()) : the_post();

	$backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

	if ($backgroundImg && is_array($backgroundImg)) {
		$bg_image_url = $backgroundImg[0];
	} else {
		$bg_image_url = ''; // Set a default image URL or leave it empty as per your requirement
	}


	if (function_exists('get_field')) {
		// ACF is active, you can use get_field() safely
		$sub_title = get_field('sub_title');
		$title = get_the_title();
		// Rest of your code
	} else {
		// ACF is not active, handle it accordingly
		$sub_title = ''; // Set to a default value or leave it empty
		$title = get_the_title();
		// Rest of your code
	}

	// Check if $sub_title exists, then modify $title and add a class to the span tag
	if (!empty($sub_title)) {
		$title = $sub_title;
	}
	?>

	<section class="full-width-banner" style="background-image: url('<?php echo esc_url($bg_image_url); ?>');">
		<article class="banner">
			<h1><?php echo wp_kses($title, 'post'); ?></h1>
		</article>
	</section>


	<div class="container-fluid">
		<div class="inbuild-content">					
			
			<?php the_content();?>
			
		</div>	
	</div>

<?php endwhile; endif;?>
 


<?php  get_footer();?>