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
			
			// test du carctère parent de la taxonomie
			if( ($oeuvres_group_term->parent==0) ) :
				// test de la présence d'oeuvres dans ce type 
				$args_have_oeuvre_in_type = array (
					'post_type' => 'oeuvre',
					'tax_query' 		=> array(
						array (
							'taxonomy' => 'type-doeuvre',
							'field' => 'slug',
							'terms' => $oeuvres_group_term->slug,
							'operator' => 'IN',
						),
						),
					'meta_query' => array(
						array(
							'key'   => 'presente_en_page_daccueil',
							'value' => '1',
						),
					)
					);
				$have_oeuvre = new WP_Query( $args_have_oeuvre_in_type );
				if ( $have_oeuvre->have_posts() ) : 
					echo "<h2>".$oeuvres_group_term->name."</h2>";
					echo "<br>";
				endif;

				
				// boucles d'affichage des oeuvres par type
				if ($oeuvres_group_query->have_posts()) : while ($oeuvres_group_query->have_posts()) : $oeuvres_group_query->the_post();
					if (get_field('presente_en_page_daccueil')) : // test de l'affichage en homepage
						echo "<div class='oeuvre_homesection_conteneur'>";
							echo "<div class='oeuvre_homesection_description'>";
							echo "<h3>".the_title()."</h3>";
							echo "<span>".the_field('date')."</span>";
							echo "</div><div class='oeuvre_homesection_image'>";
							$image = get_field('image');
							echo wp_get_attachment_image( $image, 'full' );		
							echo "</div>";
						echo "</div>";		
					endif;
				endwhile;
				endif;
			endif;


		endforeach;
	}
add_action( 'displaying_oeuvres_by_type',  'displaying_oeuvres_by_type' );


