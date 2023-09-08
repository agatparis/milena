<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Milena_Krastev
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->


<div class='footer-container'>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1'))?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2'))?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3'))?>
</div>

<?php wp_footer(); ?>

</body>
</html>
