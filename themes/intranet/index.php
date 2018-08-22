<?php
acf_form_head();
acf_enqueue_uploader();
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$currentUser =  wp_get_current_user();

//var_dump($currentUser);

$cu_id = $currentUser->ID;
//echo '$currentUser ID is '.$cu_id.'<br/>';

$cu_data = get_employee_post($cu_id);
//print_r($cu_data);


$checks = get_field('home_panel',$cu_data->ID);
//print_r($checks);

if(in_array("coworkers", $checks)){
  coworkers($cu_id, $cu_data->ID);
}


Timber::render( 'templates/index.twig', $context );




?>
