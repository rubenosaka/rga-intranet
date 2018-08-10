<?php
/*
Plugin Name:  Intranet Projects Functionality
Plugin URI:   https://www.rubenwebmaster.com
Description:  Add Projects functionality and compability to the website
Version:      1.0.0
Author:       Ruben Gonzalez Aranda
Author URI:   https://www.rubenwebmaster.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if( function_exists('acf_add_local_field_group') ):

  /**
  *
  * CREATING CUSTOM POST TYPE
  *
  */

  function projects_post_type() {
    register_post_type( 'projects',
      array(
        'labels' => array(
          'name' => __( 'Projects' ),
          'singular_name' => __( 'Projects' )
        ),
        'public' => true,
        'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'projects_post_type',11 );

  /**
  *
  * TAXONOMIES
  *
  */
  function projects_taxonomies() {
    register_taxonomy(
      'clients',
      'projects',
      array(
        'label' => __( 'Clients' ),
        'rewrite' => array( 'slug' => 'clients' ),
        'hierarchical' => true,
        'show_in_quick_edit' => false,
        'meta_box_cb' => false
      )
    );
  }
  add_action( 'init', 'projects_taxonomies' );


  /**
  *
  * INCLUDES
  *
  */

  include('includes/project-info.php');


endif;
