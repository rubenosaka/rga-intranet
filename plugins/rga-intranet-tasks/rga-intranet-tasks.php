<?php
/*
Plugin Name:  Intranet Tasks Functionality
Plugin URI:   https://www.rubenwebmaster.com
Description:  Add Tasks functionality and compability to the website
Version:      1.0.0
Author:       Ruben Gonzalez Aranda
Author URI:   https://www.rubenwebmaster.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if( function_exists('acf_add_local_field_group') ):

  function tasks_post_type() {
    register_post_type( 'tasks',
      array(
        'labels' => array(
          'name' => __( 'Task' ),
          'singular_name' => __( 'Task' )
        ),
        'public' => true,
        'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'tasks_post_type', 9 );

  /**
  *
  * CUSTOM FUCTIONS
  *
  */

  function task_knowledge_msg(){
      $screen = get_current_screen();
      $task_id =  $_GET['post'];

      $nk = get_field('knowledge_requirements',$task_id);
      if($nk){
        $employees = get_field('asign_task_to_employee',$task_id);
        if($employees):

            foreach( $employees as $employee):
                setup_postdata($employee);
                $employee_id = $employee->ID;

                $term_list = wp_get_post_terms( $employee_id, 'knowledge', array("fields" => "ids"));

                $nk = array_diff($nk, $term_list);

            endforeach;

       endif;


        if( $screen->id !='tasks')
            return;

          ?>

          <div class="error">
            <p>
              This Project needs employees with more knowledge:
            </p>
            <ul>
              <?php
              foreach($nk as $needed){
                $name = get_term( $needed, 'knowledge');
                echo '<li> - '.$name->name.'</li>';
              }
              ?>
            </ul>
          </div>

         <?php
       }
   }
   add_action('admin_notices','task_knowledge_msg');

  /**
  *
  * INCLUDES
  *
  */

  include('includes/acf-fields.php');
endif;
