<?php
/*
Plugin Name:  Intranet Events Functionality
Plugin URI:   https://www.rubenwebmaster.com
Description:  Add Events functionality and compability to the website
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

  function event_post_type() {
    register_post_type( 'events',
      array(
        'labels' => array(
          'name' => __( 'Event' ),
          'singular_name' => __( 'Event' )
        ),
        'public' => true,
        'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'event_post_type' );

endif;
