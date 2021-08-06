<?php

/**
 * Theme My Login Restrictions Admin Functions
 *
 * @package Theme_My_Login_Restrictions
 * @subpackage Administration
 */

/**
 * Enqueue admin scripts.
 *
 * @since 1.1
 */
function tml_restrictions_admin_enqueue_scripts() {
	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'tml-restrictions-admin', tml_restrictions()->get_url() . "assets/scripts/tml-restrictions-admin$suffix.js", array(), tml_restrictions()->get_version() );
}

/**
 * Render the Restrictions meta box.
 *
 * @since 1.0
 *
 * @param WP_Post $post The post object.
 */
function tml_restrictions_admin_meta_box( $post ) {
	$allowed_roles = tml_restrictions_get_post_allowed_roles( $post );
	?>

	<p>
		<input type="checkbox" name="require_login" id="require_login" value="1" <?php checked( tml_restrictions_post_requires_login( $post ) ); ?> />
		<label for="require_login"><?php esc_html_e( 'Require users to be logged in', 'theme-my-login-restrictions' ); ?></label>
	</p>

	<div id="tml-restrictions-required-roles" style="display: <?php echo tml_restrictions_post_requires_login( $post ) ? 'block' : 'none'; ?>;">
		<p><?php esc_html_e( 'Require one of the following roles:', 'theme-my-login-restrictions' ); ?></p>
		<ul>
			<?php foreach ( wp_roles()->get_names() as $role => $role_name ) : ?>
				<li>
					<input type="checkbox" name="allowed_roles[]" id="allowed_roles-<?php echo $role; ?>" value="<?php echo $role; ?>" <?php checked( in_array( $role, $allowed_roles ) ); ?> />
					<label for="allowed_roles-<?php echo $role; ?>"><?php echo translate_user_role( $role_name ); ?></label>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
	do_action( 'tml_restrictions_meta_box', $post );
	wp_nonce_field( 'tml_restrictions_meta_box_save', 'tml_restrictions_meta_box' );
}

/**
 * Add the Restrictions meta box.
 *
 * @since 1.0
 */
function tml_restrictions_admin_add_meta_box() {
	global $typenow;

	add_meta_box( 'tml_restrictions',
		__( 'Restrictions', 'theme-my-login-restrictions' ),
		'tml_restrictions_admin_meta_box',
		get_post_types( array(
			'public' => true,
		) ),
		'side'
	);
}

/**
 * Save the Restrictions meta box.
 *
 * @since 1.0
 *
 * @param int $post_id The post ID.
 */
function tml_restrictions_admin_save_meta_box( $post_id ) {
	if ( ! isset( $_POST['tml_restrictions_meta_box'] ) || ! wp_verify_nonce( $_POST['tml_restrictions_meta_box'], 'tml_restrictions_meta_box_save' ) ) {
		return;
	}

	update_post_meta( $post_id, 'require_login', isset( $_POST['require_login'] ) );

	if ( ! empty( $_POST['allowed_roles'] ) && isset( $_POST['require_login'] ) ) {
		$allowed_roles = get_post_meta( $post_id, 'allowed_roles' );
		if ( ! is_array( $allowed_roles ) ) {
			$allowed_roles = array();
		}
		foreach ( array_diff( $_POST['allowed_roles'], $allowed_roles ) as $add_role ) {
			add_post_meta( $post_id, 'allowed_roles', $add_role );
		}
		foreach ( array_diff( $allowed_roles, $_POST['allowed_roles'] ) as $remove_role ) {
			delete_post_meta( $post_id, 'allowed_roles', $remove_role );
		}
	} else {
		delete_post_meta( $post_id, 'allowed_roles' );
	}
}

/**
 * Add the restirctions fields to the manage nav menu columns.
 *
 * @since 1.0
 *
 * @param array $columns The manage nav menu columns.
 * @return array The manage nav menu columns.
 */
function tml_restrictions_admin_nav_menu_manage_columns( $columns ) {
	return array_merge( $columns, array(
		'restrict-to' => __( 'Viewable By', 'theme-my-login-restrictions' ),
		'restrict-to-roles' => __( 'Required Roles', 'theme-my-login-restrictions' ),
	) );
}

/**
 * Get the Restrictions settings sections.
 *
 * @since 1.0
 *
 * @return array The restrictions settings sections.
 */
function tml_restrictions_admin_get_settings_sections() {
	return array(
		// General
		'tml_restrictions_settings_general' => array(
			'title' => '',
			'callback' => '__return_null',
			'page' => 'theme-my-login-restrictions',
		),
	);
}

/**
 * Get the restrictions settings fields.
 *
 * @since 1.0
 *
 * @return array The restrictions settings fields.
 */
function tml_restrictions_admin_get_settings_fields() {
	return array(
		// General
		'tml_restrictions_settings_general' => array(
			// Private site
			'tml_restrictions_private_site' => array(
				'title'             => __( 'Private Site', 'theme-my-login' ),
				'callback'          => 'tml_admin_setting_callback_checkbox_field',
				'sanitize_callback' => 'intval',
				'args' => array(
					'label_for' => 'tml_restrictions_private_site',
					'label'     => __( 'Require users to be logged in to view site', 'theme-my-login-restrictions' ),
					'value'     => '1',
					'checked'   => get_site_option( 'tml_restrictions_private_site' ),
				),
			),
		),
	);
}
