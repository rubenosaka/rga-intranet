<?php
/*
Plugin Name:  Intranet Eployee Functionality
Plugin URI:   https://www.rubenwebmaster.com
Description:  Add Employee functionality and compability to the website
Version:      1.0.0
Author:       Ruben Gonzalez Aranda
Author URI:   https://www.rubenwebmaster.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( function_exists('acf_add_local_field_group') ):

  function employee_post_type() {
    register_post_type( 'employees',
      array(
        'labels' => array(
          'name' => __( 'Employee' ),
          'singular_name' => __( 'Employee' )
        ),
        'public' => true,
        'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'employee_post_type' );

  /**
  *
  * TAXONOMIES
  *
  */

  function employee_taxonomies() {


    /* DEPARTMENTS TAX */
  	register_taxonomy(
  		'departments',
  		'employees',
  		array(
  			'label' => __( 'Department' ),
  			'rewrite' => array( 'slug' => 'departments' ),
        'hierarchical' => true
  		)
  	);

    /* KNOWELDGES TAX */
    register_taxonomy(
  		'knowledge',
  		'employees',
  		array(
  			'label' => __( 'Knowledge' ),
  			'rewrite' => array( 'slug' => 'knowledge ' ),
        'hierarchical' => true,
        'show_in_quick_edit' => false,
        'meta_box_cb' => false
  		)
  	);


  }
  add_action( 'init', 'employee_taxonomies' );

  /**
  *
  *  CUSTOM FUNCTIONS
  *
  */

  function get_employe_data($data){
    $user =  wp_get_current_user();

    $result = $user->$data;

    return $result;
  }

  /**
  *
  *  TEMPLATES
  *
  */

  function add_custom_templates_select( $post_templates, $wp_theme, $post, $post_type ) {

      // Add custom template named template-custom.php to select dropdown
      $post_templates['employees-profile.php'] = __('Eployees Profile');

      return $post_templates;
  }

  add_filter( 'theme_page_templates', 'add_custom_templates_select', 10, 4 );


  /**
   * Check if current page has our custom template. Try to load
   * template from theme directory and if not exist load it
   * from root plugin directory.
   */
  function wpse_288589_load_plugin_template( $template ) {

      if(  get_page_template_slug() === 'employees-profile.php' ) {

          if ( $theme_file = locate_template( array( 'employees-profile.php' ) ) ) {
              $template = $theme_file;
          } else {
              $template = plugin_dir_path( __FILE__ ) . 'employees-profile.php';
          }
      }

      if($template == '') {
          throw new \Exception('No template found');
      }

      return $template;
  }

  add_filter( 'template_include', 'wpse_288589_load_plugin_template' );

  /**
  *
  * INCLUDES
  *
  */

  include('includes/acf-fields.php');

  include('includes/login-save.php');

  include('includes/birthday.php');

  include('includes/tools.php');



endif;
