<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Rga Intranet Config',
		'menu_title'	=> 'Rga Intranet',
		'menu_slug' 	=> 'rga-intranet-config',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Company Info',
		'menu_title'	=> 'Company Info',
		'parent_slug'	=> 'rga-intranet-config',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}
