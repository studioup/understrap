<?php
$container = get_theme_mod( 'understrap_container_type' );
?>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">

<?php if ( 'container' == $container ) : ?>
  <div class="container">
<?php endif; ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>

      <!-- Your site title as branding in the menu -->
      <?php if ( ! has_custom_logo() ) { ?>
      <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
         title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php bloginfo( 'name' ); ?>
      </a>

      <?php } else {
        the_custom_logo();
      } ?><!-- end custom logo -->

    <!-- The WordPress Menu goes here -->
    <div id="navbarNavDropdown" class="collapse navbar-main navbar-collapse align-items-center ">
    <?php wp_nav_menu(
      array(
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'navbar-nav',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'walker'          => new WP_Bootstrap_Navwalker(),
      )
    ); ?>
    <?php get_template_part("page-templates/nav","alt-links"); ?>
    </div>
  <?php if ( 'container' == $container ) : ?>
  </div><!-- .container -->
  <?php endif; ?>

</nav><!-- .site-navigation -->
