<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Milena_Krastev
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="entry-title">
				<?php
				single_cat_title();
				?>
				</h1>
			</header><!-- .page-header -->

			<?php

do_action( 'displaying_oeuvres_from_type' );                          

			//the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
