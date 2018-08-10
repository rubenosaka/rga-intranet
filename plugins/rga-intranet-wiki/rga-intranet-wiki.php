<?php
/*
Plugin Name:  Intranet Wiki Functionality
Description:  Add Wiki functionality and compability to the website
Version:      1.0.0
Author:       Ruben Gonzalez Aranda
Author URI:   https://www.rubenwebmaster.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



if( function_exists('acf_add_local_field_group') ):

  function wiki_post_type() {
    register_post_type( 'wiki',
      array(
        'labels' => array(
          'name' => __( 'Wiki' ),
          'singular_name' => __( 'Wiki' )
        ),
        'public' => true,
        'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'wiki_post_type', 9 );

  /**
  *
  * TAXONOMIES
  *
  */
  function wiki_taxonomies() {
    register_taxonomy(
      'wiki_categories',
      'wiki',
      array(
        'label' => __( 'Wiki Categories' ),
        'rewrite' => array( 'slug' => 'wiki_categirues' ),
        'hierarchical' => true,
        'show_in_quick_edit' => false,
        'meta_box_cb' => false
      )
    );
  }
  add_action( 'init', 'wiki_taxonomies' );


endif;
