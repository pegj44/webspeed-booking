<?php

namespace Webspeed\Booking\Application\Entities;

use \Webspeed\Booking\Core\Entity;

class Events extends Entity
{
	public function hooks()
	{
		// add_action('wp-bookings-before-add-event', [$this, 'beforeAddEvent']);
		// add_action('wp-bookings-after-add-event', [$this, 'afterAddEvent']);
	}

	public static function add($args)
	{
		$args['post_type'] = 'wp-bookings-events';

		wp_insert_post($args);
	}

	public function addPostType()
	{
		$events = [
			'wp-bookings-events' => [
				'label'                 => __( 'WP Bookings Events', 'wp-bookings' ),
				'description'           => __( 'WP Bookings post type', 'wp-bookings' ),
				'labels'                => [
					'name'                  => _x( 'Events', 'Post Type General Name', 'wp-bookings' ),
					'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'wp-bookings' ),
					'menu_name'             => __( 'Post Types', 'wp-bookings' ),
					'name_admin_bar'        => __( 'Post Type', 'wp-bookings' ),
					'archives'              => __( 'Item Archives', 'wp-bookings' ),
					'attributes'            => __( 'Item Attributes', 'wp-bookings' ),
					'parent_item_colon'     => __( 'Parent Item:', 'wp-bookings' ),
					'all_items'             => __( 'All Items', 'wp-bookings' ),
					'add_new_item'          => __( 'Add New Item', 'wp-bookings' ),
					'add_new'               => __( 'Add New Event', 'wp-bookings' ),
					'new_item'              => __( 'New Item Event', 'wp-bookings' ),
					'edit_item'             => __( 'Edit Item', 'wp-bookings' ),
					'update_item'           => __( 'Update Item', 'wp-bookings' ),
					'view_item'             => __( 'View Item', 'wp-bookings' ),
					'view_items'            => __( 'View Items', 'wp-bookings' ),
					'search_items'          => __( 'Search Item', 'wp-bookings' ),
					'not_found'             => __( 'Not found', 'wp-bookings' ),
					'not_found_in_trash'    => __( 'Not found in Trash', 'wp-bookings' ),
					'featured_image'        => __( 'Featured Image', 'wp-bookings' ),
					'set_featured_image'    => __( 'Set featured image', 'wp-bookings' ),
					'remove_featured_image' => __( 'Remove featured image', 'wp-bookings' ),
					'use_featured_image'    => __( 'Use as featured image', 'wp-bookings' ),
					'insert_into_item'      => __( 'Insert into item', 'wp-bookings' ),
					'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-bookings' ),
					'items_list'            => __( 'Items list', 'wp-bookings' ),
					'items_list_navigation' => __( 'Items list navigation', 'wp-bookings' ),
					'filter_items_list'     => __( 'Filter items list', 'wp-bookings' ),
				],
				'supports'              => ['title', 'editor', 'custom-fields'],
				'hierarchical'          => false,
				'public'                => false,
				// 'show_ui'               => false,
				'show_ui'               => true,
				// 'show_in_menu'          => false,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => false,
				'show_in_nav_menus'     => false,
				'can_export'            => true,
				'has_archive'           => false,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
				'show_in_rest'          => false,
			]
		];		

		return $events;
	}

}