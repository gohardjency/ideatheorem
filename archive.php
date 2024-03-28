<?php get_header();

		$cat = get_queried_object();
		$category_slug = $cat->slug;
        $taxonomy_name = $cat->taxonomy;
	?>
        

    <section class="full-width-banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bird-banner.png');">
		<article class="banner"><?php
			$current_url = esc_url( get_permalink() );
			$search_string = 'download';
			if (strpos($current_url, $search_string)){?>
				<h1>Download - <span class="purple">Archive</span></h1><?php
			}else{?>
				<h1>Blog - <span class="purple">Archive</span></h1><?php
			} ?>
		</article>
	</section>


<div class="all-in-one-filter-block container-fluid m-0">
    <?php
       // Define the search keyword
    $archive_search = isset($_GET['archive-search']) ? sanitize_text_field($_GET['archive-search']) : '';

        // Get all categories
        $args1 = array(
            'taxonomy' => 'download_category',
            'orderby' => 'name',
            'order'   => 'ASC'
        );
        $categories = get_categories();
        $download_categories = get_categories($args1);
        // Check if a category and sorting option are selected
        $selected_category = isset($_GET['category']) ? $_GET['category'] : 'all';
        $selected_sorting = isset($_GET['sorting']) ? $_GET['sorting'] : 'all'; // Default to 'All'
       
        // Modify the query based on the search keyword
        if (!empty($archive_search)) {
            $args1['s'] = $archive_search;
        }

        if ($selected_sorting === 'trending') {
            $args['orderby'] = 'comment_count'; // Use comment count as a proxy for trending
            $args['order'] = 'ASC';
        } elseif ($selected_sorting === 'newest') {
            $args['orderby'] = 'date'; // Sort by post date for newest
            $args['order'] = 'DESC';
        }
    ?>

   <!-- Category Filter -->
    <div class="video-category-filter download-category-filter archive-category filter-width">
        <select name="category" class ="archive-select" id="category-dropdown" onchange="changeCategory()">
             <!-- Show all downloads -->
            <?php
            foreach ($categories as $category1) {
                echo '<option value="' . $category1->slug . '" ' . selected($category1->slug, $selected_category, false) . '>';
                echo '<a href="' . get_site_url() . '/category/' . $category1->slug . '">' . $category1->slug . '</a>';
                echo '</option>';
            }
            foreach ($download_categories as $category) {
                echo '<option value="download-' . $category->slug . '" ' . selected($category->slug, $selected_category, false) . '>';
                echo '<a href="' . get_site_url() . 'download/category/' . $category->slug . '">' . $category->slug . '</a>';
                echo '</option>';
            }
            
            ?>
        </select>
    </div>

    <!-- trending filter -->
    <div class="download-category-filter archive-category filter-width">
        <?php
            echo '<select name="archive-sorting" class="archive-select" id="archive-sorting-dropdown">';
            echo '<option value="all" ' . selected('all', $selected_sorting, false) . '>All</option>';
            echo '<option value="trending" ' . selected('trending', $selected_sorting, false) . '>Trending</option>';
            echo '<option value="newest" ' . selected('newest', $selected_sorting, false) . '>Newest</option>';
            echo '</select>';
        ?>
    </div>

    <!-- Display the search form -->
    <form method="GET" action="" class="video-product-section download-category-filter category-filter-form filter-width">
        <div class="video-search-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 20l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
            <input type="text" id="archive-search" name="archive-search" placeholder="Search..." value="<?php echo esc_attr($archive_search); ?>">
        </div>
    </form>

    <!-- toggle button  -->
    <div class="layout-toggle-button d-none d-md-flex">
        <button id="list-button" class="active" type="button"><i class="fas fa-th"></i></button>
        <button id="grid-button" type="button"><i class="fas fa-th-large"></i></button>
    </div>
</div>
    
<section class="Blog-archive" id="category-posts">
    <div class="container-fluid">
        <div class="row product-layout">

            <?php

            // Get the selected category filter
            $selected_category = isset($_GET['category']) ? $_GET['category'] : '';
            // $post_order = isset($_GET['sorting']) ? $_GET['sorting'] : 'all';
    
            // Get the selected sorting filter
            $selected_sorting = isset($_GET['sorting']) ? $_GET['sorting'] : 'all';
            
            // Calculate the offset based on the current page number            
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => array('post','download'),
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy_name,
                        'field'  => 'slug',
                        'terms' => $category_slug
                    ),
                ),
                'posts_per_page' => 10, // Set 9 posts per page
                'paged' => $paged,
                
            );

            if (!empty($archive_search)) {
                $args['s'] = $archive_search;
            }
            
            if ($selected_sorting === 'trending') {
                $args['meta_key'] = '_product_view_count'; // Replace with the actual meta key for view count
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC'; // Sort in descending order
            } elseif ($selected_sorting === 'newest') {
                $args['orderby'] = 'date';
            }
            $search_query = get_search_query(); // Initialize $search_query
           
            
            $custom_query = new WP_Query($args);
    // echo '<pre>';
    //     print_r($args);
    //     echo '</pre>';
            if ($custom_query -> have_posts()) {
                while($custom_query -> have_posts() ): $custom_query -> the_post();
                    setup_postdata($post);
                    $view_count = get_post_meta(get_the_ID(), '_product_view_count', true);?>

                    <div class="product-items blog-grid col-md-6 col-lg-3 ">
            
                        <div class="archive-post">
            
                        
                        
                            <div class="featured-image text-center">
                                <a href="<?php the_permalink(); ?>">
									<?php if(!empty( get_the_post_thumbnail_url( get_the_ID() ) )){?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php echo esc_html(get_image_alt(get_the_ID())); ?>" class="img-fluid">
									<?php }
									else{
										echo wp_kses_post(get_default_image());
									}?>
									
                                </a>
                            </div>
                            
                        
							<div class="mb-4">
								<div class="archive-contents">
                            <p class="archive-author m-0">By <?php
							$author_id = get_the_author_meta('ID');

							// Check if the user has the "vendor" role
							$check_status = get_user_status($author_id, []);

							if ($check_status == 'vendor') {
								// Get the vendor ID using the author ID
								$vendor_id = $author_id;

								// Get the vendor name using the author ID
								$user_data = get_userdata($vendor_id);
								$vendor_name = $user_data->display_name;

								// Generate the link with the vendor ID and vendor name
								$author_link = esc_url(home_url('/')) . '?s=' . esc_attr(get_search_query()) . '&vendor_id=' . esc_attr($vendor_id) . '&vendor_name=' . esc_attr($vendor_name);
							} else {
								// Generate the link without the vendor ID
								$author_link = esc_url(home_url('/')) . '?s=' . esc_attr(get_search_query()) . '&author=' . esc_attr($author_id) . '&author_name=' . esc_attr(get_the_author());
							}
							
								?>

								<a href="<?php echo esc_url($author_link); ?>">
									<?php echo esc_html(get_the_author()); ?>
								</a>
								</p>
                            <p class="archive-time m-0"><?php the_time(); ?></p></div>
                            <div class="archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							</div>
                        
                        </div>
                    </div>
    
                <?php endwhile; ?>
            <?php
            wp_reset_postdata();   
            }
            else { ?>
              <div class="no-product-text">
				  <img src="https://dev.scube.co/stockynew/wp-content/uploads/sites/48/2023/12/Search.png" alt="">
					  <h2><?php echo esc_html__('No Result Found!', 'stocky'); ?></h2>
					  <p>Sorry, we came up empty-handed. Let&rsquo;s broaden our search and help you find<br> what you&rsquo;re looking for.</p>
				  </div>
            <?php } ?>
    
        </div>
    </div>
    <div class="pagination">
      <?php
        // Get the pagination links
        echo paginate_links(array(
          'total' => $custom_query->max_num_pages, // Get the total number of pages
          'prev_text' => '<i class="fas fa-chevron-left"></i>', // Change this to your desired text or HTML
          'next_text' => '<i class="fas fa-chevron-right"></i>',
        ));
      ?>
    </div>
</section>        

<script>
window.onload = function() {
    // Get the current category from the URL
    var currentCategory = getCurrentCategoryFromUrl();

    // Set default value based on the current category
    var categoryDropdown = document.getElementById("category-dropdown");

    if (currentCategory) {
        // Log the current category for debugging
        console.log("Current Category:", currentCategory);

        // Set the value directly without using the loop
        categoryDropdown.value = currentCategory;

        // Log the selected value after setting it
        console.log("Selected Value After Setting:", categoryDropdown.value);
    } else {
        console.log("Current category not found in URL.");
    }
};

function getCurrentCategoryFromUrl() {
    var url = window.location.href;
    var match = url.match(/\/(?:category|downloads\/category)\/([^\/?#]+)/);

    // Check if "downloads" is in the URL
    var isDownload = url.includes('/downloads/');
    
    // Log the match, URL, and check for debugging
    console.log("URL:", url);
    console.log("Match:", match);
    console.log("Is Download:", isDownload);

    if (match) {
        // Extracted category name
        var categoryName = match[1];

        // Modify the category name if it's from a download
        if (isDownload) {
            categoryName = "download-" + categoryName;
        }

        // Return the modified category name or the regular category name
        return categoryName;
    } else {
        // Return null if no match found in URL
        return null;
    }
}




  function changeCategory() {
        var select = document.getElementById("category-dropdown");
        var selectedCategory = select.value;

        var selectSorting = document.getElementById("archive-sorting-dropdown");
        var selectedSorting = selectSorting.value;

        // Store the selected category and sorting in local storage
        localStorage.setItem("selectedCategory", selectedCategory);
        localStorage.setItem("selectedSorting", selectedSorting);

        if (selectedCategory !== "all") {
            if (selectedCategory.startsWith("download-")) {
                // It's a download category, so construct the download category URL
                var downloadCategorySlug = selectedCategory.replace("download-", "");
                var redirectUrl = "<?php echo get_site_url(); ?>/downloads/category/" + downloadCategorySlug;
                if (selectedSorting !== "all") {
                    redirectUrl += "?sorting=" + selectedSorting;
                }
                window.location.href = redirectUrl;
            } else {
                // It's a post category, so construct the post category URL
                var postCategorySlug = selectedCategory;
                var redirectUrl = "<?php echo get_site_url(); ?>/category/" + postCategorySlug;
                if (selectedSorting !== "all") {
                    redirectUrl += "?sorting=" + selectedSorting;
                }
                window.location.href = redirectUrl;
            }
        } else {
            // Redirect to the default URL for "All Categories"
            var redirectUrl = "<?php echo get_site_url(); ?>";
            if (selectedSorting !== "all") {
                redirectUrl += "?sorting=" + selectedSorting;
            }
            window.location.href = redirectUrl;
        }
    }
	
	// Capitalize text for all option elements under .download-category-filter select
document.querySelectorAll('.download-category-filter select option').forEach(function(option) {
    option.textContent = option.textContent.charAt(0).toUpperCase() + option.textContent.slice(1);
});


</script>

<?php  get_footer();   ?>