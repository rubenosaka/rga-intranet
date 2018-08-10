<?php

final class hooks{
	/**
	 * Enqueue the theme scripts
	 * NOTE: this hook is fired in wp_footer action to always load the last one (after any shortcode script)
	 *
	 * @since 3.0.0
	 */

	public function enqueue_styles() {

		// Enqueue Styles
		wp_enqueue_style( 'bootstrap', INT_STYLES_PATH . 'bootstrap.min.css', array(), INT_THEME_VERSION );
		wp_enqueue_style( 'font-awesome', INT_STYLES_PATH . 'font-awesome.min.css', array(), INT_THEME_VERSION );
		wp_enqueue_style( 'intranet-styles', INT_STYLES_PATH . 'styles.css', array(), INT_THEME_VERSION );

		wp_enqueue_style( 'intranet', INT_THEME_PATH . 'style.css', array('owl-carousel', 'owl-theme', 'intranet-styles'), INT_THEME_VERSION );
	}

	/**
	 * Enqueue the theme scripts
	 * NOTE: this hook is fired in wp_footer action to always load the last one (after any shortcode script)
	 *
	 * @since 3.0.0
	 */
	public function enqueue_scripts() {
		// Load jQuery in header to avoid issues with some plugins adding JQuery code to the site's body
		wp_enqueue_script('jquery');
		// Enqueue Scripts

		wp_enqueue_script( 'bootstrap-js', INT_JS_PATH . 'bootstrap.min.js', INT_THEME_VERSION, TRUE );
			wp_enqueue_script( 'intranet-js', INT_JS_PATH . 'scripts.js', INT_THEME_VERSION, TRUE );

	}

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_footer', array( $this, 'enqueue_scripts' ) );
	}
}
