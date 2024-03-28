<?php
$logo = get_theme_mod('logo');
$header_logo_url = get_theme_mod('header_logo_url');
$dark_logo = get_theme_mod( 'logo' );

 ?>

<!-- header section starts -->


<div class="header-1"> 
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-block">
      <div class="d-flex align-items-center justify-content-between">
        <!-- Brand -->
        <div>
          <a class="navbar-brand" href="<?php echo esc_url( $header_logo_url !== '' ? $header_logo_url : home_url() ); ?>">
          <?php if ( $logo != "" ) { ?>
            <img src="<?php echo esc_url($logo); ?>" alt="logo" class="logo-image" width="auto">
            <?php } else { ?>
              <h2>Idea Theorem </h2>
            <?php } ?>
          </a>
        </div>
        
        <div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <i class="fas fa-bars"></i>
          </button>

          <!-- Navbar links -->
          <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
              <?php if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'depth' => '9',
                    'container_class' => 'custom-menu',
                    'menu_id' => 'menu3',
                    'menu_class' => 'navbar-nav menu',
                    'walker' => new MY_Menu_Walker,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'sub_menu' => '<i class="fas fa-caret-down"></i>',
                    'sub_menu_class' => 'menu-item-has-children',
                    'sub_menu_depth' => '0',
                ) );
              } else { ?>
                <?php _e( 'Set your&nbsp;  <strong> Header Menu</strong>&nbsp;  under <strong>&nbsp;  Appearance > Menus</strong>', 'stocky' ); ?>
              <?php } ?>
          </div>
        </div>
        <!-- Toggler/collapsibe Button -->
      </div>
      
    </div>
  </nav>
 
</div>


<!-- header section ends -->
