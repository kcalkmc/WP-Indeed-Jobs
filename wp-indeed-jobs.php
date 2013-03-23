<?php
/*
 Plugin Name: WP Indeed Jobs
 Plugin URI: http://wpconsult.net
 Description: job search engine from Indeed API
 Author: Paul de Wouters
Author URI: http://pauldewouters.com/
 Version: 0.3
 Author URI: http://wpconsult.net/
License: GNU General Public License v2.0 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/*
	Copyright 2012	 Paul de Wouters	 (email : paul@wpconsult.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class WPIndeedJobs {

	/**
	 * Constructor
	 */
	function __construct() {
		add_action( 'plugins_loaded', array( &$this, 'perform_checks' ), 1 );

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 2 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 3 );

		add_action( 'plugins_loaded', array( &$this, 'includes' ), 4 );

		// Load the admin files.
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 5 );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_plugin_styles' ), 6 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_plugin_scripts' ), 7 );

		// Include the Ajax library on the front end
		add_action( 'wp_head', array( &$this, 'add_ajax_library' ), 8 );

		// Register activation hook.
		//register_activation_hook( __FILE__, array( &$this, 'activation' ) );


	}

	/**
	 * Adds the WordPress Ajax Library to the frontend.
	 */
	function add_ajax_library() {

		$html = '<script type="text/javascript">';
		$html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
		$html .= ';var nonce = "' . wp_create_nonce() . '"';
		$html .= ';var ajaxloaderurl = "' . INDEED_URI . 'includes/images/ajax-loader.gif' . '"';
		$html .= '</script>';

		echo $html;

	} // end add_ajax_library

	/**
	 * Loads the translation files.
	 */
	function i18n() {

		/** Load the plugin textdomain for internationalizing strings */
		load_plugin_textdomain( 'wp-indeed-jobs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	function perform_checks() {
		$meets_requirements = true;
		$message            = "";
		// Requires at least PHP version 5.2
		if ( version_compare( PHP_VERSION, '5.2', '<' ) ) {
			$meets_requirements = false;
			$message            = "WP Indeed Jobs and WordPress since 3.2 require PHP version 5.2 to be available to function. The plugin has now disabled itself.";
		}

		if ( ! $meets_requirements ) {
			if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
				require_once ABSPATH . '/wp-admin/includes/plugin.php';
				deactivate_plugins( __FILE__ );
				wp_die( __( $message, 'wp-indeed-jobs' ) );
			} else {
				return;
			}
		}

	}

	/**
	 * Define plugin constants
	 */
	function constants() {
		/* Set the version number of the plugin. */
		define( 'INDEED_VERSION', '0.3.0' );

		/* Set the database version number of the plugin. */
		define( 'INDEED_DB_VERSION', 1 );

		/* Set constant path to the members plugin directory. */
		define( 'INDEED_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set constant path to the members plugin URL. */
		define( 'INDEED_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the members includes directory. */
		define( 'INDEED_INCLUDES', INDEED_DIR . trailingslashit( 'includes' ) );

		/* Set the constant path to the members admin directory. */
		define( 'INDEED_ADMIN', INDEED_DIR . trailingslashit( 'admin' ) );
	}

	/**
	 * Include plugin files
	 */
	function includes() {
		require_once INDEED_INCLUDES . 'class-wpij-search-form.php';

	}

	/**
	 * Registers the CSS stylesheet for inclusion
	 */
	function register_plugin_styles() {
		// load twitter bootstrap styles
		wp_register_style( 'bootstrap-styles', INDEED_URI . '/includes/css/bootstrap.min.css' );

	}

	/**
	 * Registers the plugin javascripts for later inclusion
	 */
	function register_plugin_scripts() {
		wp_register_script( 'wp-indeed-jobs', INDEED_URI . 'includes/js/wp-indeed-jobs.js', array( 'jquery' ), INDEED_VERSION );

	}

	/**
	 * Loads the admin functions and files.
	 */
	function admin() {

		/* Only load files if in the WordPress admin. */
		if ( is_admin() ) {

			/* Load the main admin file. */
			require_once( INDEED_ADMIN . 'admin.php' );

		}
	}

}

/** Instantiate the class */
new WPIndeedJobs();
