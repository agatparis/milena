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


function displaying_oeuvres_from_type () {

	echo "<div class='oeuvres_archive_grid'>";

	// recup de la liste des sous-catégories d'oeuvres
	$current_cat = get_queried_object(); 
	$current_cat_children =  get_term_children($current_cat->term_id, 'type-doeuvre');	

	//recup des formats d'oeuvres pour les catégories de l'archive	
	$formats = get_terms( array (
		 'taxonomy' => 'format',			
		),
	);

		foreach ($formats as $format) :

			$args_oeuvres = array (
				'post_type' => 'oeuvre',
				'tax_query' => array (
					array (
						'taxonomy' => 'type-doeuvre',
						'terms' =>  $current_cat_children, 
					),
					array(
						'taxonomy' => 'format',
						'terms' => $format,
					),
				),
			);
			$oeuvres_from_cat = new WP_Query($args_oeuvres);
			
			echo "<div class='oeuvre_row'>";
			if ($oeuvres_from_cat->have_posts()) : while ($oeuvres_from_cat->have_posts()) : $oeuvres_from_cat->the_post();
				echo "<a href='".get_permalink()."'>";
				
				$image = get_field('image');
				$hauteur = get_field('hauteur', $format);
				echo "<div class='oeuvre_card' style='background-image:url(".$image."); height:".$hauteur."px'>";
				echo "<div class='oeuvre-cat-content' style='height:".$hauteur."px;'>";
				// sub cat	
				$cat_child = get_the_terms( get_the_ID(), 'type-doeuvre' );
				foreach ($cat_child as $current_cat_child) :
					if ($current_cat_child->parent) :
						echo "<div class='oeuvre-cat-subtax'>";
						echo $current_cat_child->name;
						echo "</div>";
					endif;
				endforeach;
				
				echo "<div class='oeuvre-cat-title'>";
					echo the_title();
					echo "</div>";
					echo "<div class='oeuvre-cat-year'>";
					echo the_field('date');
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</a>";
				endwhile;
			endif;
			echo "</div>";
		endforeach;

	echo "</div>";
wp_reset_postdata();
}
add_action( 'displaying_oeuvres_from_type',  'displaying_oeuvres_from_type' );


function displaying_oeuvres_single () {
	echo "<div class='single_content'>";

	echo "<div class='single_images'>";
	// recup des images
	$images_tab = array();
	
	$images_tab[0] = get_field('image');
	$i = 1;
	$images_galerie = get_field('galerie');
	if ($images_galerie) :
		foreach( $images_galerie as $image_galerie ): 
			$images_tab[$i] = esc_url($image_galerie['url']);
			$i++;
		endforeach;
	endif;


	// affichage des images en diaporama
	echo "<div id='tabs' class='single_galerie'>";

	

    echo "<ul id='accordion' class=single_slides'>";
	for ($j = 0; $j<count($images_tab); $j++) :
		echo "<li>";
		if ($j == 0) :
			echo "<a href='#tabs-".$j."' class='active'>";
		else :
			echo "<a href='#tabs-".$j."'>";
		endif; 
			echo "<div class='tag'>";
			/*echo "<div class='icon'>";
			echo "<div class='block'>";
				echo "<div class='circle'></div>";
			echo "</div>";
			echo "</div>";*/
			echo "<div class='single_slide_thumbnail'><img src='".$images_tab[$j]."'></div>";
			echo "</div>";
		echo "</a>";
		echo "</li>";
	endfor;
	echo "</ul>";

	reset($images_tab);
	echo "<div class='browser'>";
		echo "<div class='top-bar'>";		
			echo "<span class='dot'><img src='http://milena.local/wp-content/uploads/2023/08/souris.webp'><span class='dot-title'>".get_the_title()."</span></span>"; 
		echo "</div>";
	for ($k = 0; $k<count($images_tab); $k++) :
			echo "<div id='tabs-".$k."'><img src='".$images_tab[$k]."'></div>"; 
		endfor;
		echo "</div>";
	echo "</div>";
	echo "</div>";


	echo "<div class='single_descr'>";
	the_title( '<h1 class="entry-title">', '</h1>' );
	echo "<h4>".get_field('date')."</h4>";
	echo "<p>".get_field('descriptif')."</p>";
	echo "</div>";

	echo "</div>";
	
	wp_reset_postdata();


}
add_action( 'displaying_oeuvres_single',  'displaying_oeuvres_single' );