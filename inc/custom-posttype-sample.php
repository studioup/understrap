<?php



function custom_post_example() {
	// creating (registering) the custom type
	register_post_type( 'attivita', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Area di Attività', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Area', 'jointswp'), /* This is the individual type */
			'all_items' => __('Tutte le aree', 'jointswp'), /* the all items menu item */
			'add_new' => __('Aggiungi Nuova', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Aggiungi nuova area', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Modifica', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Modifica Area', 'jointswp'), /* Edit Display Title */
			'new_item' => __('Nuova Area di attività', 'jointswp'), /* New Display Title */
			'view_item' => __('Visualizza Area', 'jointswp'), /* View Display Title */
			'search_items' => __('Cerca area di attività', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'aree-attivita', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
          'post_tag',
      ), // Add Category and Post Tags support
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title','page-attributes', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'attivita');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'attivita');

}

	// adding the function to the Wordpress init
	//add_action( 'init', 'custom_post_example');

?>
