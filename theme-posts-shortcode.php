<?php
/**
 * Plugin Name: Theme Posts Shortcode
 * Plugin URI:  http://github.com/joemcgill/theme-posts-shortcode
 * Description: Include a set of posts on a page
 * Version:     1.0.0
 * Author:      Joe McGill
 * Author URI:  http://joemcgill.net
 * License:     GPLv2 or later
 */

 // Exit early if this file is called directly.
 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

 /**
	* Registers a shortcode that can be used to display a list of posts on any page.
	*/
Class Theme_Posts_Shortcode {

	/**
	 * Placeholder method
	 *
	 * @since 1.0.0
	 */
	public function __construct() { }

	/**
	 * Return a singleton instance of the class and call setup functions.
	 *
	 * @since 1.0.0
	 * @return Theme_Posts_Shortcode
	 */
	public static function factory() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
			$instance->setup();
		}

		return $instance;
	}

	/**
	 * Register settings, add filters, etc.
	 *
	 * @since 1.0.0
	 */
	public function setup() {
		add_shortcode( 'show-posts', array( $this, 'theme_posts_shortcode' ) );
	}

	/**
	 * Shortcode functionality to show posts.
	 *
	 * @since 1.0.0
	 */
	function theme_posts_shortcode( $atts ) {
		$output = false;

		// Pull in shortcode attributes and set defaults
		$defaults = array(
			'category'       => '',
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => '10',
			'tag'            => '',
		);

		// Process shortcode attribtues
		$atts = shortcode_atts( $defaults, $atts, 'show-posts' );

		// Set up initial query for post
		$args = array(
			'category_name'       => $atts['category'],
			'order'               => $atts['order'],
			'orderby'             => $atts['orderby'],
			'posts_per_page'      => $atts['posts_per_page'],
			'tag'                 => $atts['tag'],
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => true,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			global $wp_query;

			// Backup the main query.
			$saved_query = $wp_query;

			// Replace the main query by reference.
			$wp_query = $query;

			// Capture the output so we can return it to the shortcode process.
			ob_start();

			echo '<div class="show-posts-wrapper">';

			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();

				get_template_part( 'content', get_post_format() );

			}

			echo '</div>';

			$output = ob_get_clean();

			// Clean up after ourselves.
			$wp_query = $saved_query;
			wp_reset_postdata();
		}

		return $output;
	}

}

Theme_Posts_Shortcode::factory();
