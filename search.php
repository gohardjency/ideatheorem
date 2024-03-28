<?php get_header();?>

<section class="full-width-banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/contact-banner.png');">
    <article class="banner">
        <?php
        // Check if the search query parameter exists
        if (isset($_GET['s'])) {
            // Get the search query value
            $search_query = sanitize_text_field($_GET['s']);
            if ($search_query) {
                ?>
                <h1>Search - <span class="purple"><?php echo esc_html($search_query); ?></span></h1>
            <?php } else {
                // Check if vendor ID and vendor name exist in the query parameters
                if (isset($_GET['vendor_id']) && isset($_GET['vendor_name'])) {
                    $vendor_name = sanitize_text_field($_GET['vendor_name']);
                    ?>
                    <h1>Vendor - <span class="purple"><?php echo esc_html($vendor_name); ?></span></h1>
                <?php } else {
                    // Display banner for author
                    $author_name = get_the_author();
                    ?>
                    <h1>Author - <span class="purple"><?php echo esc_html($author_name); ?></span></h1>
                <?php }
            }
        }
        ?>
    </article>
</section>


<section class="main-content darkout-section">
    <div class="Blog-archive container-fluid">
        <div class="row">
            <?php
			$vendor_products = '';
            // Check if the vendor ID is present in the query parameters
            if (isset($_GET['vendor_id'])) {
                $vendor_id = absint($_GET['vendor_id']);

				// Get user data based on the vendor ID
    $vendor_data = get_userdata($vendor_id);
				
				  $vendor_name = $vendor_data->display_name;
                // Query arguments to fetch vendor-specific products
                $args = array(
                    'post_type' => 'download',  // Assuming 'download' is the post type for EDD products
                    'posts_per_page' => -1,
                    'author' => $vendor_id,
					'paged' => get_query_var('paged') ?: 10,
                );

                $vendor_products = new WP_Query($args);

                // Check if there are vendor products
                if ($vendor_products->have_posts()) :
                    while ($vendor_products->have_posts()) : $vendor_products->the_post();
                        // Display vendor product information
                        ?>
                        <div class="product-items blog-grid col-md-3">
                            <div class="archive-post">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="featured-image text-center">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid">
                                        </a>
                                    </div>
                                <?php } else { ?>
									<div class="featured-image text-center">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/12/Frame-215.png" class="img-fluid">
                                        </a>
                                    </div>
								<?php } ?>
                                <div class="p-3">
                                    <div class="archive-contents">
                                        <p class="archive-author m-0">By
                                           <a href="<?php echo esc_url(home_url('/')) . '?s=&vendor_id=' . esc_attr($vendor_id) . '&vendor_name=' . esc_attr($vendor_name); ?>">
												<?php the_author(); ?>
											</a>

                                        </p>
                                        <p class="archive-time m-0"><?php the_time(); ?></p>
                                    </div>
                                    <div class="archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;

                    // Reset post data
                    wp_reset_postdata();
                else :
                    // No vendor products found
                    ?>
                    <div class="col-12">
                        <p>No products found for this vendor.</p>
                    </div>
                    <?php
                endif;
            } else {
                // Default behavior for non-vendor search
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        // Display regular search results
                        ?>
                        <div class="product-items blog-grid col-md-3">
                            <div class="archive-post">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="featured-image text-center">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid">
                                        </a>
                                    </div>
                                <?php } else { ?>
									<div class="featured-image text-center">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/12/Frame-215.png" class="img-fluid">
                                        </a>
                                    </div>
								<?php } ?>
                                <div class="p-3">
                                    <div class="archive-contents">
                                        <p class="archive-author m-0">By
											
                                            <a href="<?php echo esc_url(home_url('/')); ?>?s=<?php echo esc_attr($search_query); ?>&author_name=<?php echo esc_attr(get_the_author()); ?>">
                                                <?php the_author(); ?>
                                            </a>
                                        </p>
                                        <p class="archive-time m-0"><?php the_time(); ?></p>
                                    </div>
                                    <div class="archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                    // No search results found
                    ?>
                    <div class="col-12">
                        <p>No search results found.</p>
                    </div>
                    <?php
                endif;
            }
            ?>
        </div>
    </div>
	
	<?php 
	
	if($vendor_products){?>
		<div class="pagination">
			<?php
			echo paginate_links(array(
				'total' => $vendor_products->max_num_pages,
				'current' => max(1, get_query_var('paged')),
				'prev_text' => '<i class="fas fa-chevron-left"></i>', // Change this to your desired text or HTML
				'next_text' => '<i class="fas fa-chevron-right"></i>',
			));
			?>
		</div>
	<?php }else{?>
		<div class="pagination">
			<?php
			echo paginate_links(array(
				'total' => $wp_query->max_num_pages,
				'current' => max(1, get_query_var('paged')),
				'prev_text' => '<i class="fas fa-chevron-left"></i>', // Change this to your desired text or HTML
				'next_text' => '<i class="fas fa-chevron-right"></i>',
			));
			?>
		</div>
	<?php }?>
</section>


<?php get_footer();?>
