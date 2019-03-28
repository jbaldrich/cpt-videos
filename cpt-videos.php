<?php
/**
 * CPT Videos plugin
 *
 * @package cpt-videos
 *
 * Plugin Name: CPT Videos
 * Plugin URI: https://jacobaldrich.com
 * Description: Videos Custom Post Type
 * Version: 1.0
 * Author: Jaco Baldrich
 * Author URI: https://jacobaldrich.com
 * License: GPL12
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'CPT_VIDEOS_VERSION', '1.0.0' );

/**
 * Currently plugin name.
 */
define( 'CPT_VIDEOS_NAME', 'cpt-videos' );

/**
 * Plugin run.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
if ( ! function_exists( 'cpt_videos_register_cpt' ) ) {

	/**
	 * Register Vídeos Custom Post Type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function cpt_videos_register_cpt() {
		$labels = array(
			'name'                  => 'Vídeos',
			'singular_name'         => 'Vídeo',
			'add_new'               => 'Añadir nuevo',
			'add_new_item'          => 'Añadir nuevo Vídeo',
			'edit_item'             => 'Editar Vídeo',
			'view_item'             => 'Ver Vídeos',
			'all_items'             => 'Todos los Vídeos',
			'search_items'          => 'Buscar Vídeos',
			'not_found'             => 'No se han encontrado vídeos.',
			'not_found_in_trash'    => 'No hay vídeos en la papelera.',
			'attributes'            => 'Atributos de vídeo',
			'insert_into_item'      => 'Insertar en el vídeo',
			'uploaded_to_this_item' => 'Subido a este vídeo',
			'featured_image'        => 'Imagen destacada',
			'set_featured_image'    => 'Establecer imagen destacada',
			'remove_featured_image' => 'Borrar imagen destacada',
			'use_featured_image'    => 'Usar como imagen destacada',
			'filter_items_list'     => 'Lista de vídeos filtrados',
			'items_list_navigation' => 'Navegación por el listado de vídeos',
			'items_list'            => 'Lista de vídeos',
		);

		$args = array(
			'labels'        => $labels,
			'description'   => 'Description.',
			'public'        => true,
			'show_in_menu'  => true,
			'show_in_rest'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-video-alt',
			'query_var'     => true,
			'rewrite'       => array( 'slug' => 'videos' ),
			'has_archive'   => true,
			'hierarchical'  => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
		);

		register_post_type( 'videos', $args );
	}

	/**
	 * Template loader.
	 *
	 * This function will check if WP is loading a template for this Custom Post Type
	 * and will try to load the template from the plugin 'templates' directory.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template   Template file that is being loaded.
	 * @return string            Template file that should be loaded.
	 */
	function cpt_videos_template_loader( $template ) {
		$file = '';
		if ( is_singular( 'videos' ) ) {
			$file = plugin_dir_path( __FILE__ ) . 'templates/single-videos.php';
		} elseif ( is_archive( 'videos' ) ) {
			$file = plugin_dir_path( __FILE__ ) . 'templates/archive-videos.php';
		}
		if ( file_exists( $file ) ) {
			$template = $file;
		}
		return $template;
	}

	/**
	 * Styles loader.
	 *
	 * This function enqueues styles when needed
	 *
	 * @since 1.0.0
	 */
	function cpt_videos_style_loader() {
		if ( 'videos' === get_post_type() ) {
			wp_enqueue_style( CPT_VIDEOS_NAME, plugin_dir_url( __FILE__ ) . 'css/cpt-videos.css', array(), CPT_VIDEOS_VERSION, 'all' );
		}
	}

	// Load CPT Videos.
	add_action( 'init', 'cpt_videos_register_cpt' );

	// Load templates.
	add_filter( 'template_include', 'cpt_videos_template_loader' );

	// Enqueue styles.
	add_action( 'wp_enqueue_scripts', 'cpt_videos_style_loader' );
}
