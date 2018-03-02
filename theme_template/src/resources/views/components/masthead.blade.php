<header id="masthead" class="site-header" role="banner">
    This is our masthead

	@if( has_nav_menu( 'top' ) )
    <div class="navigation-top">
        <div class="wrap">
			<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
        </div><!-- .wrap -->
    </div><!-- .navigation-top -->
	@endif

</header>