<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Milena_Krastev
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	
<div class='cursor' id="cursor">
<img src="http://milena.local/wp-content/uploads/2023/08/souris.webp"/></div>



<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'milena-krastev' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
		<?php //the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$milena_krastev_description = get_bloginfo( 'description', 'display' );
			if ( $milena_krastev_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $milena_krastev_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div> 

		<nav id="site-navigation" class="main-navigation">

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'milena-krastev' ); ?></button>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>

<div class='footer-menu'>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1'))?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2'))?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3'))?>
</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
