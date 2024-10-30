<?php
/**
 * livephotos.php
 *
 * Copyright (c) 2017 Antonio Blanco http://www.eggemplo.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author eggemplo
 * @package livephotos
 * @since livephotos 0.1
 *
 * Plugin Name: Live Photos
 * Plugin URI: http://www.eggemplo.com/plugins/livephotos
 * Description: Displays Live Photos on Wordpress
 * Version: 0.1
 * Author: eggemplo
 * Author URI: http://www.eggemplo.com
 * Text Domain: livephotos
 * Domain Path: /languages
 * License: GPLv3
 */

define( 'LIVEPHOTOS_DOMAIN', 'livephotos' );
define( 'LIVEPHOTOS_PLUGIN_NAME', 'livephotos' );

define( 'LIVEPHOTOS_FILE', __FILE__ );

if ( !defined( 'LIVEPHOTOS_CORE_DIR' ) ) {
	define( 'LIVEPHOTOS_CORE_DIR', WP_PLUGIN_DIR . '/livephotos/core' );
}

define( 'LIVEPHOTOS_PLUGIN_URL', plugin_dir_url( LIVEPHOTOS_FILE ) );

class LivePhotos_Plugin {

	private static $notices = array();

	public static function init() {

		load_plugin_textdomain( LIVEPHOTOS_DOMAIN, null, LIVEPHOTOS_PLUGIN_NAME . '/languages' );

		/*
		register_activation_hook( LIVEPHOTOS_FILE, array( __CLASS__, 'activate' ) );
		register_deactivation_hook( LIVEPHOTOS_FILE, array( __CLASS__, 'deactivate' ) );

		register_uninstall_hook( LIVEPHOTOS_FILE, array( __CLASS__, 'uninstall' ) );
		*/

		add_action( 'init', array( __CLASS__, 'wp_init' ) );
		add_action( 'wp_footer', array( __CLASS__, 'wp_footer' ) );

	}

	public static function wp_init() {
		if ( !class_exists( "LivePhotos" ) ) {
			include_once 'core/class-livephotos.php';
			include_once 'core/class-livephotos-shortcodes.php';
		}
		
	}

	public static function wp_footer() {
		self::livephotos_enqueue_scripts();
	}

	/**
	 * Load frontend scripts.
	 */
	public static function livephotos_enqueue_scripts() {
		// css
		wp_register_style( 'livephotos-styles', LIVEPHOTOS_PLUGIN_URL . 'css/livephotos-styles.css' );
		wp_enqueue_style ('livephotos-styles');

		// javascript
		wp_register_script ( 'livephotoskit', 'https://cdn.apple-livephotoskit.com/lpk/1/livephotoskit.js' );
		wp_register_script ( 'livephotos', LIVEPHOTOS_PLUGIN_URL . '/js/livephotos.js', array ( 'livephotoskit' ), '0.1', true );
		wp_enqueue_script('livephotoskit');
		wp_enqueue_script('livephotos');
	}

	public static function admin_notices() { 
		if ( !empty( self::$notices ) ) {
			foreach ( self::$notices as $notice ) {
				echo $notice;
			}
		}
	}

	/**
	 * Plugin activation work.
	 * 
	 */
	public static function activate() {

	}

	/**
	 * Plugin deactivation.
	 *
	 */
	public static function deactivate() {

	}

	/**
	 * Plugin uninstall. Delete database table.
	 *
	 */
	public static function uninstall() {

	}

}
LivePhotos_Plugin::init();
