<?php get_header(); ?>

<section class="main-content">

        <?php
        // Check if it's the posts page
        if (is_home()) {
          get_template_part('page-blog');
        } else { ?>
    <div class="container-fluid py-5">
			
           <?php // Display design for other pages
            while (have_posts()) : the_post(); ?>
		
		<?php
                echo '<h2>' . esc_html(get_the_title()) . '</h2>';
                the_content(); ?>
            <?php endwhile; ?>
    </div>
			
         <?php }
        ?>

</section>
<?php get_footer(); ?>
