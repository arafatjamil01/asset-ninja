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

define( 'ASN_ASSETS_DIR', plugin_dir_url( __FILE__ ) . 'assets/' );
define( 'ASN_ASSETS_PUBLIC_DIR', plugin_dir_url( __FILE__ ) . 'assets/public' );
define( 'ASN_ASSETS_ADMIN_DIR', plugin_dir_url( __FILE__ ) . 'assets/admin' );
define( 'ASN_VERSION', time() ); // Set time for cache busting.

class AssetNinja {
	public function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_front_assets' ) );
	}

	public function load_front_assets() {
		wp_enqueue_style( 'asn-style', ASN_ASSETS_PUBLIC_DIR . '/css/style.css', array(), ASN_VERSION, 'all' );
		wp_enqueue_script( 'asn-script', ASN_ASSETS_PUBLIC_DIR . '/js/main.js', array( 'jquery', 'asn-another' ), ASN_VERSION, true ); // It will load after the another script for sure. since dependency.
		wp_enqueue_script( 'asn-another', ASN_ASSETS_PUBLIC_DIR . '/js/another.js', array( 'jquery' ), ASN_VERSION, true );

		// NOTE: You can't have the third script depend on the first script again -> circular dependency. 3rd script can depend on the 2nd script. 2nd can depend on the 1st script. but 1st can't depend on the 3rd script.
		// This will create an infinite loop, the software will crash. 

		// Passing data to JS from php
		$data = [
			'name' => "Arafat Jamil",
			'github' => "https://github.com/arafatjamil01"
		];

		wp_localize_script( 'asn-script', 'araf', $data ); // araf is the name of the object you can define yourself.
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'assetsninja', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

new AssetNinja();
