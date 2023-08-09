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
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		/*if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				milena_krastev_posted_on();
				milena_krastev_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; */?>
	</header><!-- .entry-header -->

	<?php milena_krastev_post_thumbnail(); ?>

	<div class="entry-content">
<?php
	/*$type = 'drawings';

	$taxonomy_objects = get_object_taxonomies( 'oeuvre', 'objects' ); // récupération des objets des taxonomies des oeuvres

	foreach ( $taxonomy_objects as $taxonomy_slug => $taxonomy ){
		

		$terms = get_terms( 
			array (
			 'taxonomy' => $taxonomy_slug, //empty string(''), false, 0 don't work, and return empty array
			 'orderby' => 'meta_value_num', //if the meta_key (population) is numeric use meta_value_num instead
			 'meta_key' => 'ordre', //setting the meta_key which will be used to order
			)
		);
		if ( !empty( $terms ) ) {
		   foreach ( $terms as $term ) {  */
			 do_action( 'displaying_oeuvres_by_type' );                          
		  /* }
		 
		 }

	}
wp_reset_postdata();*/	
		

?>
		<?php /*
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */ /*
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'milena-krastev' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'milena-krastev' ),
				'after'  => '</div>',
			)
		);*/
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php milena_krastev_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
