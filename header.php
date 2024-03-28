<!DOCTYPE html>
<!-- html tag starts -->
<html lang="en" <?php language_attributes(); ?>>
<!-- head meta tag starts -->
<head>
	<title><?php wp_title( '| Stocky', true, 'right' ); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=0">
	<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
     <?php if ( get_theme_mod( 'favicon','' ) != '') { ?>
    <link rel="shortcut icon" href="<?php echo stripslashes( get_theme_mod( 'favicon' ) ); ?>" />
<?php } ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KZT8M2P');</script>
<!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>
<!-- head meta tag ends -->

<body data-spy="scroll" data-target=".doc-menu" data-offset="100"  <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZT8M2P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- header layout and style options starts -->
<?php
  $sticky_header = get_theme_mod( 'sticky' );

   if ( $sticky_header == 1 ) {
        $sticky = 'sticky-header';
   }
   else {
        $sticky='';
   }
?>


<!-- css styles Ends -->
<!-- header layout and style options ends -->

<!-- header type starts -->	
<header id='header' class='header <?php echo esc_attr( $sticky . ' ' . $theme_style); ?>'>


<?php
    require_once( Darkout . '/template-parts/header/header-1.php' );
 ?>

</header>

<!-- header type ends -->
<?php if ( $sticky_header == 1 ) { ?>
     <div class="d-lg-block d-none" style="height:79px;"></div>
     <div class="d-lg-none d-block" style="height:56px;"></div>
<?php } ?>

