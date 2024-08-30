<?php
defined( 'ABSPATH' ) or die();

// The menu settings
$primary_menu_args = array(
	'theme_location'  => 'primary',
	'container'       => false,
	'menu_class'      => 'menu menu-primary',
	'fallback_cb'     => 'nanofit_page_menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0
);

$contact_info           = nanofit_option( 'header__info__text' );
$header_nav_extras      = nanofit_option( 'header__extras' );
$sliding_sidebarLable   = nanofit_option( 'sliding__sidebarLable' );

$header_classes         = array( 'site-header-sticky' );
$header_classes[]       = sprintf( 'header-%s', nanofit_option( 'header__sticky__style' ) );

if ( nanofit_option( 'header__sticky__width' ) === 'on' ) {
	$header_classes[] = 'header-full';
}

if ( nanofit_option( 'header__sticky__shadow' ) === 'on' ) {
	$header_classes[] = 'header-shadow';
}

?>

<div id="site-header-sticky" class=" <?php echo esc_attr( join( ' ', $header_classes ) ) ?>">
	<div class="site-header-inner wrap">
		<div class="header-brand">
			<a href="<?php echo esc_attr( site_url() ) ?>" class="brand">
				<?php nanofit_logo( nanofit_option( 'header__sticky__logo' ) ) ?>
			</a>
		</div>

		<nav class="navigator" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
			<?php if ( is_active_sidebar( 'off-canvas-left' ) ): ?>
				<a href="javascript:;" data-target="off-canvas-left" class="off-canvas-toggle">
					<span><?php echo nanofit_cleanup( $sliding_sidebarLable ) ?></span>
				</a>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'primary' ) ): ?>
				<?php wp_nav_menu( $primary_menu_args ) ?>
			<?php endif ?>
		</nav>

		<div class="extras">
			<?php if ( ! empty( $contact_info ) ): ?>
				<div class="header-info-text">
					<?php echo do_shortcode( $contact_info ) ?>
				</div>
			<?php endif ?>
		
			<?php if ( ! empty( $header_nav_extras ) ): ?>
				<ul class="navigator menu-extras">
					<?php foreach ( $header_nav_extras as $type ): ?>
						<?php get_template_part( 'tmpl/header-icon', $type ); ?>
					<?php endforeach ?>
				</ul>
			<?php endif ?>

			<?php nanofit_social_icons( array( 'location' => 'sticky' ) ) ?>

			<?php get_template_part( 'tmpl/header-sliding-toggle' ) ?>
		</div>
	</div>
	<!-- /.site-header-inner -->
</div>
	<!-- /.site-header -->