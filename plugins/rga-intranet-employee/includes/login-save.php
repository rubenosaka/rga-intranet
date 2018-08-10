<?php

function create_data($user_login, $user) {
  global $wpdb;
    $id = $user->ID;

    $posts = get_posts(array(
    	'posts_per_page'	=> 1,
    	'post_type'			=> 'employees',
      'meta_key'		=> 'wp_user_id',
  	  'meta_value'	=> $id
    ));

    if(!$posts){
      $user_info = get_user_by( 'id', $id );
      if($user_info){
        // vars
        $my_post = array(
          'post_title'	=> $user_info->user_login,
          'post_type'		=> 'employees',
          'post_status'	=> 'publish'
        );

        // insert the post into the database
        $post_id = wp_insert_post( $my_post );

        $field_key = "wp_user";
        $value = $user_info->user_login;
        update_field( $field_key, $value, $post_id );

        $field_key = "wp_user_id";
        $value = $id;
        update_field( $field_key, $value, $post_id );

        $field_key = "wp_user_email";
        $value = $user_info->user_email;
        update_field( $field_key, $value, $post_id );

      }

    }
}
add_action('wp_login', 'create_data',10, 2);
