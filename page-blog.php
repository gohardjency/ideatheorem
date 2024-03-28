<?php
/* 
Template Name:Blog Page
*/?>

<?php get_header();

	?>
        

    <section class="full-width-banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/6.jpg');">
		<article class="banner">
				<h1>Work</h1>
		</article>
	</section>


<section class="Blog-archive" id="category-posts">
    <div class="container-fluid">
        <div class="row product-layout">

            <?php

         
            $args = array(
                'post_type' => 'post', // Specify post type as 'post'
                'post_status' => 'publish',
                'posts_per_page' => 10,
                'paged' => $paged,
            );
            $custom_query = new WP_Query($args);
    // echo '<pre>';
    //     print_r($custom_query);
    //     echo '</pre>';
            if ($custom_query -> have_posts()) {
                while($custom_query -> have_posts() ): $custom_query -> the_post();
                    setup_postdata($post);
                    $view_count = get_post_meta(get_the_ID(), '_product_view_count', true);?>

                    <div class="product-items blog-grid col-md-3 ">
                        <div class="archive-post">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="featured-image text-center">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="img-fluid">
                                    </a>
                                </div>
                            <?php } else { ?>
							<div class="featured-image "><img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-image.jpg" alt="default-stocky-image " class="img-fluid"></div>
							<?php } ?>
                            <div class="p-3">
                                <div class="archive-contents">
                                    <p class="archive-author m-0">By
										<a href="<?php echo esc_url($author_link); ?>">
                                            <?php echo esc_html(get_the_author()); ?>
                                        </a>
                                    </p>
                                    <p class="archive-time m-0"><?php echo the_time(); ?></p>
                                </div>
                                <div class="archive-title"><a href="<?php echo the_permalink(); ?>"><h3><?php echo the_title(); ?></h3></a></div>
                            </div>
                        </div>
                    </div>
    
                <?php endwhile; ?>
            <?php
            wp_reset_postdata();   
            }
            else {  ?>// If no posts are found
			<div class="no-product-text">
                <p>Sorry, we came up empty-handed. Let&rsquo;s broaden our search and help you find<br> what you&rsquo;re looking for.</p>
            </div>
               <?php } ?>
    
        </div>
    </div>
   
</section>        



<?php
get_footer();
?>