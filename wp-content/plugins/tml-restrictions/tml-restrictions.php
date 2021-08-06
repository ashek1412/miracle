<?php

/**
 * The Theme My Login Restrictions Extension
 *
 * @package Theme_My_Login_Restrictions
 */

/*
Plugin Name: Theme My Login Restrictions
Plugin URI: https://thememylogin.com/extensions/restrictions
Description: Adds restrictions support to Theme My Login.
Author: Theme My Login
Author URI: https://thememylogin.com
Version: 1.1
Text Domain: theme-my-login-restrictions
Network: true
*/

// Bail if TML is not active
if ( ! class_exists( 'Theme_My_Login_Extension' ) ) {
	return;
}

/**
 * The class used to implement the Restrictions extension.
 */
class Theme_My_Login_Restrictions extends Theme_My_Login_Extension {

	/**
	 * The extension name.
	 *
	 * @var string
	 */
	protected $name = 'theme-my-login-restrictions';

	/**
	 * The extension version.
	 *
	 * @var string
	 */
	protected $version = '1.1';

	/**
	 * The extension's documentation URL.
	 *
	 * @var string
	 */
	protected $documentation_url = 'https://docs.thememylogin.com/category/71-restrictions';

	/**
	 * The extension's support URL.
	 *
	 * @var string
	 */
	protected $support_url = 'https://thememylogin.com/support';

	/**
	 * The extension's store URL.
	 *
	 * @var string
	 */
	protected $store_url = 'https://thememylogin.com';

	/**
	 * The extension's item ID.
	 *
	 * @var int
	 */
	protected $item_id = 103;

	/**
	 * The option name used to store the license key.
	 *
	 * @var string
	 */
	protected $license_key_option = 'tml_restrictions_license_key';

	/**
	 * The option name used to store the license status.
	 *
	 * @var string
	 */
	protected $license_status_option = 'tml_restrictions_license_status';

	/**
	 * Set class properties.
	 *
	 * @since 1.0
	 */
	protected function set_properties() {
		$this->title = __( 'Restrictions', 'theme-my-login-restrictions' );
	}

	/**
	 * Include extension files.
	 *
	 * @since 1.0
	 */
	protected function include_files() {
		require $this->path . 'includes/functions.php';

		if ( is_admin() ) {
			require $this->path . 'includes/admin.php';
		}
	}

	/**
	 * Add extension actions.
	 *
	 * @since 1.0
	 */
	protected function add_actions() {
		// Add shortcodes
		add_action( 'init', 'tml_restrictions_add_shortcodes' );

		// Handle restriction of content
		add_action( 'template_redirect', 'tml_restrictions_handle_restrictions' );

		// Restrict posts from the WP_Query
		add_action( 'pre_get_posts', 'tml_restrictions_restrict_posts' );

		// Add restrictions to nav menu items
		add_action( 'wp_nav_menu_item_custom_fields', 'tml_restrictions_nav_menu_item_fields' );

		// Save the nav menu item restrictions
		add_action( 'wp_update_nav_menu_item', 'tml_restrictions_update_nav_menu_item', 10, 3 );

		// Add restrictions to widgets
		add_action( 'in_widget_form', 'tml_restrictions_widget_fields', 10, 3 );

		if ( is_admin() ) {
			// Enqueue scripts
			add_action( 'admin_enqueue_scripts', 'tml_restrictions_admin_enqueue_scripts' );

			// Add the meta box
			add_action( 'add_meta_boxes', 'tml_restrictions_admin_add_meta_box' );

			// Save the meta box
			add_action( 'attachment_updated', 'tml_restrictions_admin_save_meta_box' );
			add_action( 'post_updated', 'tml_restrictions_admin_save_meta_box' );
		}
	}

	/**
	 * Add extension filters.
	 *
	 * @since 1.0
	 */
	protected function add_filters() {
		// Apply the nav menu item restrictions
		add_filter( 'wp_get_nav_menu_items', 'tml_restrictions_filter_nav_menu_items' );

		// Save the widget restrictions
		add_filter( 'widget_update_callback', 'tml_restrictions_widget_update_callback', 10, 4 );

		// Apply the widget restrictions
		add_filter( 'widget_display_callback', 'tml_restrictions_widget_display_callback', 10, 3 );

		if ( is_admin() ) {
			// Add the restrictions fields to the nav menu columns
			add_filter( 'manage_nav-menus_columns', 'tml_restrictions_admin_nav_menu_manage_columns', 11 );
		}
	}

	/**
	 * Get the extension settings page args.
	 *
	 * @since 1.0
	 *
	 * @return array The extension settings page args.
	 */
	public function get_settings_page_args() {
		return array(
			'page_title' => __( 'Theme My Login Restrictions Settings', 'theme-my-login-restrictions' ),
			'menu_title' => __( 'Restrictions', 'theme-my-login-restrictions' ),
			'menu_slug' => 'theme-my-login-restrictions',
		);
	}

	/**
	 * Get the extension settings sections.
	 *
	 * @since 1.0
	 *
	 * @return array The extension settings sections.
	 */
	public function get_settings_sections() {
		return tml_restrictions_admin_get_settings_sections();
	}

	/**
	 * Get the extension settings fields.
	 *
	 * @since 1.0
	 *
	 * @return array The extension settings fields.
	 */
	public function get_settings_fields() {
		return tml_restrictions_admin_get_settings_fields();
	}

	/**
	 * Update the extension.
	 *
	 * @since 1.0
	 */
	protected function update() {
		global $wpdb;

		$version = get_site_option( '_tml_restrictions_version' );

		if ( version_compare( $version, $this->version, '>=' ) ) {
			return;
		}

		if ( version_compare( $version, '1.0.1', '<' ) ) {
			if ( $results = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'allowed_roles'" ) ) {
				foreach ( $results as $result ) {
					delete_post_meta( $result->post_id, 'allowed_roles' );
					$allowed_roles = maybe_unserialize( $result->meta_value );
					if ( is_array( $allowed_roles ) ) {
						foreach ( $allowed_roles as $allowed_role ) {
							add_post_meta( $result->post_id, 'allowed_roles', $allowed_role );
						}
					}
				}
			}
		}

		update_site_option( '_tml_restrictions_version', $this->version );
	}
}

tml_register_extension( new Theme_My_Login_Restrictions( __FILE__ ) );
