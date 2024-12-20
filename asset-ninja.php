<?php
/**
 * Plugin Name:       Assets Ninja
 * Plugin URI:        https://github.com/arafatjamil01/asset-ninja
 * Description:       Asset management done proper way in WordPress, dummy plugin.
 * Version:           1.0
 * Author:            Arafat Jamil
 * Author URI:        https://github.com/arafatjamil01
 * License:           GPL v2 or later
 * Text Domain:       assetsninja
 * Domain Path:       /languages/
 */

class AssetNinja {
	public function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_front_assets' ) );
	}

	public function load_front_assets() {
		wp_enqueue_style( 'assetsninja-style', plugin_dir_url( __FILE__ ) . 'assets/public/css/style.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'assetsninja-script', plugin_dir_url( __FILE__ ) . 'assets/public/js/main.js', array( 'jquery' ), '1.0', true );
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'assetsninja', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

new AssetNinja();
