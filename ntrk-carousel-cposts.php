<?php
/*
Plugin Name: Netireki – Custom Posts Carousel
Plugin URI: https://www.netireki.com/plugins/ntrk-carousel-cposts
Description: Create animated and responsive Custom Posts Carousels, and insert them in any page or post using a shortcode.
Version: 1.0.0
Author: Ricardo Otxoa
Author URI: https://www.netireki.com
Plugin Type: Piklist
License: MIT
*/

// Check if Picklist is installed and activated
function check_ntrk_carousel_cposts_dependencies(){
	if(is_admin()){
   		include_once('classes/class-piklist-checker.php');

   		if (!piklist_checker::check(__FILE__)){
     		return;
   		}
  	}
}
add_action('init', 'check_ntrk_carousel_cposts_dependencies');


// Enqueue styles and scripts
function ntrk_carousel_enqueue() {
	wp_register_style( 'slick', plugins_url( 'slick/slick.css', __FILE__ ));
	wp_register_script( 'slick', plugins_url( 'slick/slick.min.js', __FILE__ ), array('jquery'), '1.8', true);
	wp_enqueue_style( 'slick' );
	wp_enqueue_script( 'slick' );

	wp_register_style( 'slick-theme', plugins_url( 'slick/slick-theme.css', __FILE__ ));
	wp_enqueue_style( 'slick-theme' );

	wp_register_style( 'ntrk-carousel-cposts', plugins_url( 'assets/carousel.css', __FILE__ ));
	wp_register_script( 'ntrk-carousel-cposts', plugins_url( 'assets/carousel.js', __FILE__ ), array('jquery'), '1.0', true);
	wp_enqueue_style( 'ntrk-carousel-cposts' );
	wp_enqueue_script( 'ntrk-carousel-cposts' );
}
add_action( 'wp_enqueue_scripts', 'ntrk_carousel_enqueue' );


// Register Custom Post Type
function ntrk_carousel_cposts() {

	$labels = array(
		'name'                  => _x( 'Carousels', 'Post Type General Name', 'ntrk_carousel_cposts' ),
		'singular_name'         => _x( 'Carousel', 'Post Type Singular Name', 'ntrk_carousel_cposts' ),
		'menu_name'             => __( 'NETIREKI Carousels', 'ntrk_carousel_cposts' ),
		'name_admin_bar'        => __( 'NETIREKI Carousels', 'ntrk_carousel_cposts' ),
		'archives'              => __( 'Item Archives', 'ntrk_carousel_cposts' ),
		'attributes'            => __( 'Item Attributes', 'ntrk_carousel_cposts' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ntrk_carousel_cposts' ),
		'all_items'             => __( 'All Carousels', 'ntrk_carousel_cposts' ),
		'add_new_item'          => __( 'Add new Carousel', 'ntrk_carousel_cposts' ),
		'add_new'               => __( 'Add new', 'ntrk_carousel_cposts' ),
		'new_item'              => __( 'New Carousel', 'ntrk_carousel_cposts' ),
		'edit_item'             => __( 'Edit Carousel', 'ntrk_carousel_cposts' ),
		'update_item'           => __( 'Update Carousel', 'ntrk_carousel_cposts' ),
		'view_item'             => __( 'View Carousel', 'ntrk_carousel_cposts' ),
		'view_items'            => __( 'View Carousels', 'ntrk_carousel_cposts' ),
		'search_items'          => __( 'Search Carousel', 'ntrk_carousel_cposts' ),
		'insert_into_item'      => __( 'Insert into Carousel', 'ntrk_carousel_cposts' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Carousel', 'ntrk_carousel_cposts' ),
		'items_list'            => __( 'Carousels List', 'ntrk_carousel_cposts' ),
	);
	$args = array(
		'label'                 => __( 'Carousel', 'ntrk_carousel_cposts' ),
		'description'           => __( 'Custom Posts Carousel', 'ntrk_carousel_cposts' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-share',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'ntrk_carousel_cpost', $args );

}
add_action( 'init', 'ntrk_carousel_cposts', 0 );


// Add Shortcode
function ntrk_carousel_shortcode( $atts ) {
	// Return variable
	$html = "";

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts,
		'ntrk-carousel-cposts'
	);

	// Query
	$args = array(
		'p' => $atts['id'],
		'post_type' => 'ntrk_carousel_cpost'
	);

	$carousels = new WP_Query( $args );
	while ( $carousels->have_posts() ) : $carousels->the_post();
		$id = get_the_ID();

		$slides = get_post_meta($id, 'slides');

		if ( $slides ) {

			$slides = maybe_unserialize($slides);

			$meta = get_post_meta($id);
			$dots = ( 1 == $meta['dots'][0] ? 'true' : 'false' );
			$infinite = ( 1 == $meta['infinite'][0] ? 'true' : 'false' );
			$slidesToShow = $meta['slides_to_show'][0];
			$slidesToScroll = $meta['slides_to_scroll'][0];

			$html .= "<div class='ntrk-carousel-wrap' data-slick='{\"autoplay\": true, \"arrows\": false, \"dots\": $dots, \"infinite\": $infinite, \"slidesToShow\": $slidesToShow, \"slidesToScroll\": $slidesToScroll}' data-slick-responsive='$responsive'>";

			foreach ( $slides[0] as $slide ) {
				$img = wp_get_attachment_image($slide['image'][0]);
				$txt = $slide['text'];
				$html .= "<div class='ntrk-slide'>
								<div class='ntrk-image'>$img</div>
								<div class='ntrk-text'>$txt</div>
						  </div> <!-- .ntrk-slide -->";
			}

			$html .= "</div> <!-- .ntrk-carousel-wrap -->";

			// Responsive Settings
			$responsive = "";
			$responsive_settings = get_post_meta($id, 'responsive_settings');
			if ( $responsive_settings ) {
				$responsive .= "[";
				foreach( $responsive_settings[0] as $options ) {
					foreach( $options as $setting ) {
						$breakpoint = $setting['width'];
						$show = $setting['slides_to_show'];
						$scroll = $setting['slides_to_scroll'];
						$responsive .= "{
							breakpoint: $breakpoint,
							settings: {
								slidesToShow: $show,
								slidesToScroll: $scroll,
							}
						},";
					}
				}
				$responsive .= "]";
			}
			$inline_js = "jQuery(document).ready(function($){
								console.log('kaixo');
								$('.ntrk-carousel-wrap').slick('slickSetOption', 'responsive' , $responsive, true);
						  });";
			wp_add_inline_script( 'ntrk-carousel-cposts', $inline_js);
		}
	endwhile;

	return $html;

}
add_shortcode( 'ntrk-carousel-cposts', 'ntrk_carousel_shortcode' );

?>
