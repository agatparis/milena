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
	echo "<div class='oeuvres_homesection_conteneur'>";

			$oeuvres_home_query = new WP_Query( array(
				'post_type'	=> 'oeuvre',
				'meta_query' => array(
					array (
						'key' => 'presente_en_page_daccueil',
						'value' => 1,
					)
				),				
				'meta_key' => 'ordre_dapparition_sur_la_page_daccueil',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => 20,
			),
			);		

			if ($oeuvres_home_query->have_posts()) : while ($oeuvres_home_query->have_posts()) : $oeuvres_home_query->the_post() ;
					$oeuvre_ID = get_the_ID();
					$oeuvre_taxonomies = get_the_terms( $oeuvre_ID, 'type-doeuvre');
					foreach ($oeuvre_taxonomies as $oeuvre_taxonomy) :	
						if ($oeuvre_taxonomy->parent) :
							$tax_name = $oeuvre_taxonomy->name;
							$tax_link = get_term_link( $oeuvre_taxonomy->parent, 'type-doeuvre' );				
						endif;
						if ($oeuvre_taxonomy->parent == 0) :
							$tax_parent_name = $oeuvre_taxonomy->name;
						endif ;
					endforeach;
					echo "<a href='".$tax_link."'>";
					echo "<div class='oeuvre-home-wrap' style='background:url(".get_field('image').")'>";
					echo "<div class='oeuvre-home-content'>";
					echo "<div class='oeuvre-home-tax'>";
					echo $tax_parent_name;
					echo "</div>";
					if ($tax_parent_name != $tax_name) :
						echo "<div class='oeuvre-home-subtax'>";
						echo $tax_name;
						echo "</div>";
					endif;
					echo "<div class='oeuvre-home-title'>";
					echo the_title();
					echo "</div>";
					echo "<div class='oeuvre-home-year'>";
					echo the_field('date');
					echo "</div>";
					echo "</div></div></a>";
				endwhile;
			endif;	


					echo "</div>";
		wp_reset_postdata();


	}
add_action( 'displaying_oeuvres_by_type',  'displaying_oeuvres_by_type' );


