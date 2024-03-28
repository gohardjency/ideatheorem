<?php
$linkedin = get_theme_mod('linkedin');
$twitter = get_theme_mod('twitter');
$facebook = get_theme_mod('facebook');
$youtube = get_theme_mod('youtube');
$footer_logo = get_theme_mod('footer_logo');
$footer_logo_url = get_theme_mod('footer_logo_url');
?>

<div id="footer-1" class="footer-1">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-3 footer-widget">
        <?php if( $footer_logo != "") { ?>
          <a class="footer-brand-logo" href="<?php echo esc_url( $footer_logo_url !== '' ? $footer_logo_url : home_url() ); ?>">

          <img src="<?php echo esc_url($footer_logo); ?>" alt="logo" class="footer-logo-image" width="auto">
          </a>
        <?php } ?>
      </div>
      <div class="col-lg-7 footer-widget">
          <?php dynamic_sidebar( 'darkout_footer' ); ?>
      </div>
      <div class="col-lg-2">

        <?php if ( $linkedin != '' || $twitter != '' || $facebook != '' || $youtube != '' ) { ?>
        <p class="social-text">Follow Us</p>

          <div class="social-icons">
            <?php if ( $linkedin != '' ){ ?>
              <a href="<?php echo esc_url($linkedin); ?>" target="_blank"><span><i class="fab fa-linkedin-in"></i></span></a>
            <?php } ?>
            <?php if ( $twitter != '' ){ ?>
              <a href="<?php echo esc_url($twitter); ?>" target="_blank"><span><i class="fab fa-twitter"></i></span></a>
            <?php } ?>
            <?php if ( $facebook != '' ){ ?>
              <a href="<?php echo esc_url($facebook); ?>" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a>
            <?php } ?>
            <?php if ( $youtube != '' ){ ?>
              <a href="<?php echo esc_url($youtube); ?>" target="_blank"><span><i class="fab fa-youtube"></i></span></a>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div> 
    <div id="footer_copy">
						&copy; <?php bloginfo('name'); ?>, <?php echo date("Y"); ?> 
    </div>   
  </div>
</div>
