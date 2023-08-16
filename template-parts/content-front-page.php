<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Milena_Krastev
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!--<header class="entry-header">
		<?php
		
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				milena_krastev_posted_on();
				milena_krastev_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header> .entry-header -->

	<?php milena_krastev_post_thumbnail(); ?>

	<div class="entry-content">
<?php
			 do_action( 'displaying_oeuvres_by_type' );                          
?>
		<?php 
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php milena_krastev_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
