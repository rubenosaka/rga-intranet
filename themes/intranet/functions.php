<?php

defined('ABSPATH') or die;

/**
*
* CONSTANTS and DEFINITIOS - GLOBAL VARS
*
*/

	if ( ! defined('INT_THEME_PATH') ){
		define( 'INT_THEME_PATH', trailingslashit( get_template_directory_uri() ) );
	}

	if ( ! defined('INT_STYLES_PATH') ){
		define( 'INT_STYLES_PATH', trailingslashit( get_template_directory_uri().'/Assets/css/' ) );
	}

	if ( ! defined('INT_JS_PATH') ){
		define( 'INT_JS_PATH', trailingslashit( get_template_directory_uri().'/Assets/js/' ) );
	}

	if ( ! defined('INT_IMG_PATH') ) {
		define( 'INT_IMG_PATH', trailingslashit( get_template_directory_uri().'/Assets/img/' ) );
	}

	if ( ! defined('INT_THEME_VERSION') ) {
		define( 'INT_THEME_VERSION', '1.0.0' );
	}

/**
*
* INCLUDES, CLASSES and EXTERNALS CALLS
*
*/

	include_once('includes/rga-config.php');

	include_once('classes/hooks.php');

	$hooks =  new hooks;
	$hooks->__construct();

	/**
	*
	* PLUGINS TRIGGER FUNCTIONS
	*
	*/

		function employees_functions(){
			if ( function_exists( 'birthday_init' ) )	{
			    	birthday_init();
			}
			if ( function_exists( 'employees_tools_init' ) )	{
			    	employees_tools_init();
			}
		}


		/* EXEC THIS ONLY IF TASK PLUGIN AND PROJECT PLUGIN IS ACTIVATED */

		if ( function_exists( 'projects_post_type' ) &&  function_exists( 'tasks_post_type' ))	{
			add_action('admin_notices','related_project_tasks');
			add_action('admin_head', 'project_styles');
		}
