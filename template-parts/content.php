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
		// recup catégorie d'oeuvre si existante
		$cat_oeuvres = get_the_terms( get_the_ID(), 'type-doeuvre');
		foreach ($cat_oeuvres as $cat_oeuvre) :
			if ($cat_oeuvre->parent == 0) :
				$parent = $cat_oeuvre->name;
			else: $child = $cat_oeuvre->name;
			endif;
		endforeach;
		echo "<h2>".$parent."</h2>";
		echo "<h3>".$child."</h3>";
	?>
</header> 		

	

	<div class="entry-content">
	<?php
	do_action( 'displaying_oeuvres_single' ); 
	?>
	
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php milena_krastev_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
