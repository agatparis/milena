<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Milena_Krastev
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function milena_krastev_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'milena_krastev_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function milena_krastev_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'milena_krastev_pingback_header' );

/**
	* Displaying oeuvres sections of the front page 
 */

function displaying_oeuvres_by_type () {
		$args_oeuvres_group_query = array (
			'taxonomy' => 'type-doeuvre',
			'meta_key' => 'ordre',
			'orderby' => 'meta_value',
		);

		$oeuvres_group_terms = get_terms( $args_oeuvres_group_query );		
		foreach ( $oeuvres_group_terms as $oeuvres_group_term ) :
			$oeuvres_group_query = new WP_Query( array(
				'post_type'			=> 'oeuvre',
				'tax_query' 		=> array(
					array (
						'taxonomy' => 'type-doeuvre',
						'field' => 'slug',
						'terms' => array( $oeuvres_group_term->slug ),
						'operator' => 'IN',
					)
					),
			) );
			
			if($oeuvres_group_term->parent==0) :
				echo "<h2>".$oeuvres_group_term->name."</h2>";
				echo "<br>";
				// boucles d'affichage des oeuvres par type
				if ($oeuvres_group_query->have_posts()) : while ($oeuvres_group_query->have_posts()) : $oeuvres_group_query->the_post();
				if (get_field('presente_en_page_daccueil')) : // test de l'affichage en homepage
							the_title();
							echo "<br>";
							the_field('date');
							echo "<br>";
							the_field('descriptif');
							$image = get_field('image');
							echo wp_get_attachment_image( $image, 'thumbnail' );					
							echo "<br>";
						endif;
					endwhile;
				endif;
			endif;


		endforeach;
	}
add_action( 'displaying_oeuvres_by_type',  'displaying_oeuvres_by_type' );


