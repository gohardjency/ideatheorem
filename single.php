<?php get_header();
?>
   <!-- Hero -->
   <section class="single-archive page">
    
   <section class="banner-section" style=" background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/1.png');">
  <div class="container-fluid">
    <div class="banner-padding">
    <div class="btn-back">
    <a href="javascript:void(0);" onclick="goBack()"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/Arrow.png" alt=""> BACK TO WORK</a>
</div>

    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post();
    $company_logo = get_field('company_logo');
    $author = get_field('author');
    $author_designation = get_field('author_designation');
    $author_image = get_field('author_image');
    $author_content = get_field('author_content');
    $testimonial_title = get_field('testimonial_title');
            ?>
    <div class="row">
      <div class="col-lg-6">
        <div class=" banner-padding banner-content">
          <img src="<?php echo esc_url($company_logo['url']); ?>" alt="" class="img-woodbine">
          <h1><?php echo $testimonial_title; ?></h1>
          <div class="author-content">
            <p><?php echo $author_content; ?></p>
            <div class="author-detail">
              <div>
                <img src="<?php echo esc_url($author_image['url']); ?>" alt="">
              </div>
              <div>
                <h5><?php echo $author; ?></h5>
                <p><?php echo $author_designation; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
       
       </div>
    </div>
    <?php endwhile;
else :
    echo '<p>No content found</p>';

endif;
?>
  </div>
</section>

<section class="challenge-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <h3>The <span style="color:#FA4321">Challenge</span></h3>
        <p><?php the_content(); ?></p>
      </div>
      <div class="col-lg-8">
        <div class="challenge-image">
        <?php
            $img_url = get_the_post_thumbnail_url($post->ID,'full');
            if(!empty($img_url)){ ?>
            
            <img src="<?php echo esc_url($img_url); ?>" class="img-fluid " alt="<?php echo esc_html(get_image_alt($post->ID));?>">
            <?php }
            else{
                echo wp_kses_post(get_default_image());
            }?>
        </div>
      </div>
    </div>
  </div>
</section>
</section>

<script>function goBack() {
    window.history.back();
}</script>

<?php get_footer(); ?>
