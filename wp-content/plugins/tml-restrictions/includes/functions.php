<?php

/**
 * Theme My Login Restrictions Functions
 *
 * @package Theme_My_Login_Restrictions
 * @subpackage Functions
 */

/**
 * Get the Restrictions plugin instance.
 *
 * @since 1.0
 *
 * @return Theme_My_Login_Restrictions The Restrictions plugin instance.
 */
function tml_restrictions() {
	return theme_my_login()->get_extension( 'theme-my-login-restrictions' );
}

/**
 * Add shortcodes.
 *
 * @since 1.0
 */
function tml_restrictions_add_shortcodes() {
	add_shortcode( 'tml-require-role', 'tml_restrictions_require_role_shortcode' );
	add_shortcode( 'tml-require-user', 'tml_restrictions_require_user_shortcode' );
}

/**
 * Process the "tml-require-role" shortcode.
 *
 * @since 1.0
 *
 * @param array  $atts    The shortcode attributes.
 * @param string $content The content contained within the shortcode.
 * @return string The content.
 */
function tml_restrictions_require_role_shortcode( $atts, $content = '' ) {
	$atts = shortcode_atts( array(
		'role'         => '',
		'replace_with' => '',
	), $atts );

	if ( strpos( $content, '[else]' ) !== false ) {
		list( $content, $replace_with ) = explode( '[else]', $content, 2 );
	} else {
		$replace_with = $atts['replace_with'];
	}

	$required_roles = explode( '|', $atts['role'] );
	if ( empty( $required_roles ) ) {
		return $content;
	}

	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		if ( ! array_intersect( $required_roles, $user->roles ) ) {
			$content = $replace_with;
		}
	} else {
		$content = $replace_with;
	}

	return do_shortcode( $content );
}

/**
 * Process the "tml-require-user" shortcode.
 *
 * @since 1.0
 *
 * @param array  $atts    The shortcode attributes.
 * @param string $content The content contained within the shortcode.
 * @return string The content.
 */
function tml_restrictions_require_user_shortcode( $atts, $content = '' ) {
	$atts = shortcode_atts( array(
		'id'           => '',
		'email'        => '',
		'login'        => '',
		'replace_with' => '',
	), $atts );

	if ( strpos( $content, '[else]' ) !== false ) {
		list( $content, $replace_with ) = explode( '[else]', $content, 2 );
	} else {
		$replace_with = $atts['replace_with'];
	}

	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		if ( empty( $atts['id'] ) && empty( $atts['email'] )  && empty( $atts['login'] ) ) {
			return $content;
		} else {
			if ( ! empty( $atts['id'] ) && in_array( $user->ID, explode( '|', $atts['id'] ) ) ) {
				return $content;
			} elseif ( ! empty( $atts['email'] ) && in_array( $user->user_email, explode( '|', $atts['email'] ) ) ) {
				return $content;
			} elseif ( ! empty( $atts['login'] ) && in_array( $user->user_login, explode( '|', $atts['login'] ) ) ) {
				return $content;
			} else {
				$content = $replace_with;
			}
		}
	} else {
		$content = $replace_with;
	}

	return do_shortcode( $content );
}

/**
 * Determine if a post requires log in or not.
 *
 * @since 1.0
 *
 * @param int|WP_Post $post The post ID or object.
 * @return bool True if the post requires log in, false if not.
 */
function tml_restrictions_post_requires_login( $post = null ) {
	if ( ! $post = get_post( $post ) ) {
		return false;
	}

	$require = get_post_meta( $post->ID, 'require_login', true );

	return (bool) apply_filters( 'tml_restrictions_post_requires_login', $require, $post->ID );
}

/**
 * Get the roles allowed to view the post.
 *
 * @since 1.0
 *
 * @param int|WP_Post $post The post ID or object.
 * @return array The array of allowed roles.
 */
function tml_restrictions_get_post_allowed_roles( $post = null ) {
	if ( ! $post = get_post( $post ) ) {
		return array();
	}

	$roles = get_post_meta( $post->ID, 'allowed_roles' );
	if ( ! is_array( $roles ) ) {
		$roles = array();
	}

	return (array) apply_filters( 'tml_restrictions_get_post_allowed_roles', $roles, $post->ID );
}

/**
 * Determine if a user has the required roles for a post.
 *
 * @since 1.0
 *
 * @param int|WP_Post $post The post ID or object.
 * @param int|WP_User $user The user ID or object.
 * @return bool True if the user has the proper role, false if not.
 */
function tml_restrictions_user_can_view_post( $post = null, $user = null ) {
	if ( ! $post = get_post( $post ) ) {
		return false;
	}

	if ( is_int( $user ) ) {
		$user = get_userdata( $user );
	} elseif ( empty( $user ) ) {
		$user = wp_get_current_user();
	}

	if ( ! $user instanceof WP_User ) {
		return false;
	}

	$can_view = true;

	$allowed_roles = tml_restrictions_get_post_allowed_roles( $post );
	if ( ! empty( $allowed_roles ) ) {
		$can_view = (bool) array_intersect( $allowed_roles, $user->roles );
	}

	return apply_filters( 'tml_restrictions_user_can_view_post', $can_view, $post->ID, $user->ID );
}

/**
 * Determine whether to enforce the private site option or not.
 *
 * @since 1.0
 *
 * @return bool Whether to enforce the private site option or not.
 */
function tml_restrictions_enforce_private_site() {
	$enforce = get_site_option( 'tml_restrictions_private_site' );

	/**
	 * Filter whether to enforce the private site option or not.
	 *
	 * @since 1.0
	 *
	 * @var bool $enfore True to enforce the private site option, false to not enforce it.
	 */
	return apply_filters( 'tml_restrictions_enforce_private_site', $enforce );
}

/**
 * Restrict posts from the query.
 *
 * @since 1.0.1
 *
 * @param WP_Query $wp_query The query object.
 */
function tml_restrictions_restrict_posts( $wp_query ) {
	if ( ! ( $wp_query->is_archive || $wp_query->is_home ) ) {
		return;
	}

	$roles = is_user_logged_in() ? wp_get_current_user()->roles : array( false );

	$meta_query = $wp_query->get( 'meta_query' );
	if ( ! is_array( $meta_query ) ) {
		$meta_query = array();
	}

	$meta_query['relation'] = 'AND';

	if ( ! is_user_logged_in() ) {
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key' => 'require_login',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key' => 'require_login',
				'value' => '',
			),
		);
	} else {
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key' => 'allowed_roles',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key' => 'allowed_roles',
				'value' => $roles,
				'compare' => 'IN',
			),
		);
	}

	$wp_query->set( 'meta_query', $meta_query );
}

/**
 * Restrict content.
 *
 * @since 1.0
 */
function tml_restrictions_handle_restrictions() {
	if ( ! is_user_logged_in() && ! tml_is_action() && tml_restrictions_enforce_private_site() ) {
		$redirect_to = add_query_arg( 'login', 'required', wp_login_url( $_SERVER['REQUEST_URI'] ) );
		$redirect_to = apply_filters( 'tml_restrictions_authentication_redirect', $redirect_to );
		wp_redirect( $redirect_to );
		exit;
	} elseif ( is_singular() ) {
		if ( tml_restrictions_post_requires_login() && ! is_user_logged_in() ) {
			$redirect_to = add_query_arg( 'login', 'required', wp_login_url( $_SERVER['REQUEST_URI'] ) );
			$redirect_to = apply_filters( 'tml_restrictions_authentication_redirect', $redirect_to );
			wp_redirect( $redirect_to );
			exit;
		} elseif ( ! tml_restrictions_user_can_view_post() ) {
			$redirect_to = add_query_arg( 'access', 'denied', home_url() );
			$redirect_to = apply_filters( 'tml_restrictions_authorization_redirect', $redirect_to );
			wp_redirect( $redirect_to );
			exit;
		}
	} elseif ( tml_is_action( 'login' ) ) {
		if ( isset( $_REQUEST['login'] ) && 'required' == $_REQUEST['login'] ) {
			tml_add_error( 'login_required', __( 'Please log in to continue.', 'theme-my-login-restrictions' ), 'message' );
		}
	}
}

/**
 * Render the nav menu item restriction fields.
 *
 * @since 1.0
 *
 * @param int $item_id The nav menu item ID.
 */
function tml_restrictions_nav_menu_item_fields( $item_id ) {
	$restrict_to = get_post_meta( $item_id, '_menu_item_restrict_to', true );
	$restrict_to_roles = get_post_meta( $item_id, '_menu_item_restrict_to_roles', true );
	if ( ! is_array( $restrict_to_roles ) ) {
		$restrict_to_roles = array();
	}
?>

	<p class="field-restrict-to description description-wide">
		<label for="edit-menu-item-restrict-to-<?php echo $item_id; ?>"><?php esc_html_e( 'Viewable By', 'theme-my-login-restrictions' ); ?></label>
		<br />
		<select name="menu-item-restrict-to[<?php echo $item_id; ?>]" id="edit-menu-restrict-to-<?php echo $item_id; ?>">
			<option value=""><?php esc_html_e( 'Everyone', 'theme-my-login-restrictions' ); ?></option>
			<option value="authenticated" <?php selected( $restrict_to, 'authenticated' ); ?>><?php esc_html_e( 'Authenticated Users only', 'theme-my-login-restrictions' ); ?></option>
			<option value="unauthenticated" <?php selected( $restrict_to, 'unauthenticated' ); ?>><?php esc_html_e( 'Guests only', 'theme-my-login-restrictions' ); ?></option>
		</select>
	</p>

	<p class="field-restrict-to-roles description description-wide">
		<span class="label"><?php esc_html_e( 'Required Roles', 'theme-my-login-restrictions' ); ?></span>
		<br />
		<?php foreach ( wp_roles()->get_names() as $role => $role_name ) : ?>
			<input type="checkbox" name="menu-item-restrict-to-roles[<?php echo $item_id; ?>][]" id="menu-item-restrict-to-roles-<?php echo $item_id; ?>-<?php echo $role; ?>" value="<?php echo $role; ?>" <?php checked( in_array( $role, $restrict_to_roles ) ); ?> />
			<label for="menu-item-restrict-to-roles-<?php echo $item_id; ?>-<?php echo $role; ?>"><?php echo translate_user_role( $role_name ); ?></label>
			<br />
		<?php endforeach; ?>
	</p>

<?php
}

/**
 * Save the nav menu item restrictions.
 *
 * @since 1.0
 *
 * @param int $menu_id The menu ID.
 * @param int $item_id The item ID.
 */
function tml_restrictions_update_nav_menu_item( $menu_id, $item_id ) {
	$restrict_to = isset( $_POST['menu-item-restrict-to'][ $item_id ] )
		? $_POST['menu-item-restrict-to'][ $item_id ]
		: '';
	update_post_meta( $item_id, '_menu_item_restrict_to', $restrict_to );

	$restrict_to_roles = ! empty( $_POST['menu-item-restrict-to-roles'][ $item_id ] )
		? array_unique( (array) $_POST['menu-item-restrict-to-roles'][ $item_id ] )
		: array();
	update_post_meta( $item_id, '_menu_item_restrict_to_roles', $restrict_to_roles );
}

/**
 * Apply the nav menu item restrictions.
 *
 * @since 1.0
 *
 * @param array $items The nav menu items.
 * @return array The nav menu items.
 */
function tml_restrictions_filter_nav_menu_items( $items ) {
	if ( is_admin() ) {
		return $items;
	}

	foreach ( $items as $key => $item ) {
		if ( $restrict_to = get_post_meta( $item->ID, '_menu_item_restrict_to', true ) ) {
			if ( 'authenticated' == $restrict_to && ! is_user_logged_in() ) {
				unset( $items[ $key ] );
			} elseif ( 'unauthenticated' == $restrict_to && is_user_logged_in() ) {
				unset( $items[ $key ] );
			}
		}

		if ( $restrict_to_roles = get_post_meta( $item->ID, '_menu_item_restrict_to_roles', true ) ) {
			if ( ! is_user_logged_in() ) {
				unset( $items[ $key ] );
			} else {
				$user = wp_get_current_user();
				if ( ! array_intersect( $restrict_to_roles, $user->roles ) ) {
					unset( $items[ $key ] );
				}
			}
		}
	}

	return $items;
}

/**
 * Render the widget restriction fields.
 *
 * @since 1.1
 *
 * @param WP_Widget $widget   The widget instance.
 * @param null      $return   The return value.
 * @param array     $instance The widet instance settings.
 */
function tml_restrictions_widget_fields( $widget, $return, $instance ) {
	$restrict_to = ! empty( $instance['restrict_to'] ) ? $instance['restrict_to'] : '';
	$restrict_to_roles = ! empty( $instance['restrict_to_roles'] ) ? $instance['restrict_to_roles'] : array();
	if ( ! is_array( $restrict_to_roles ) ) {
		$restrict_to_roles = array();
	}
?>

	<p>
		<label for="<?php echo $widget->get_field_id( 'restrict-to' ); ?>"><?php esc_html_e( 'Viewable By', 'theme-my-login-restrictions' ); ?></label>
		<br />
		<select name="<?php echo $widget->get_field_name( 'restrict_to' ); ?>" id="<?php echo $widget->get_field_id( 'restrict-to' ); ?>">
			<option value=""><?php esc_html_e( 'Everyone', 'theme-my-login-restrictions' ); ?></option>
			<option value="authenticated" <?php selected( $restrict_to, 'authenticated' ); ?>><?php esc_html_e( 'Authenticated Users only', 'theme-my-login-restrictions' ); ?></option>
			<option value="unauthenticated" <?php selected( $restrict_to, 'unauthenticated' ); ?>><?php esc_html_e( 'Guests only', 'theme-my-login-restrictions' ); ?></option>
		</select>
	</p>

	<p>
		<span class="label"><?php esc_html_e( 'Required Roles', 'theme-my-login-restrictions' ); ?></span>
		<br />
		<?php foreach ( wp_roles()->get_names() as $role => $role_name ) : ?>
			<input type="checkbox" name="<?php echo $widget->get_field_name( 'restrict_to_roles[]' ); ?>" id="<?php echo $widget->get_field_id( 'restrict-to-roles-' . $role ); ?>" value="<?php echo $role; ?>" <?php checked( in_array( $role, $restrict_to_roles ) ); ?> />
			<label for="<?php echo $widget->get_field_id( 'restrict-to-roles-' . $role ); ?>"><?php echo translate_user_role( $role_name ); ?></label>
			<br />
		<?php endforeach; ?>
	</p>

<?php
}

/**
 * Filter the widget settings.
 *
 * @since 1.1
 *
 * @param array     $instance     The current widget instance's settings.
 * @param array     $new_instance An array of new widget settings.
 * @param array     $old_instance An array of old widget settings.
 * @param WP_Widget $widget       The current widget instance.
 * @return array The current widget instance's settings.
 */
function tml_restrictions_widget_update_callback( $instance, $new_instance, $old_instance, $widget ) {
	$instance['restrict_to'] = isset( $new_instance['restrict_to'] ) ? $new_instance['restrict_to'] : '';
	$instance['restrict_to_roles'] = isset( $new_instance['restrict_to_roles'] ) ? $new_instance['restrict_to_roles'] : array();
	return $instance;
}

/**
 * Filter the widget output.
 *
 * @since 1.1
 *
 * @param array     $instance The current widget instance's settings.
 * @param WP_Widget $widget   The current widget instance.
 * @param array     $args     An array of default widget arguments.
 * @return array|bool The current widget instance's settings or false if it should be restricted.
 */
function tml_restrictions_widget_display_callback( $instance, $widget, $args ) {
	if ( ! empty( $instance['restrict_to'] ) ) {
		if ( 'authenticated' == $instance['restrict_to'] && ! is_user_logged_in() ) {
			return false;
		} elseif ( 'unauthenticated' == $instance['restrict_to'] && is_user_logged_in() ) {
			return false;
		}
	}

	if ( ! empty( $instance['restrict_to_roles'] ) ) {
		if ( ! is_user_logged_in() ) {
			return false;
		} else {
			$user = wp_get_current_user();
			if ( ! array_intersect( $instance['restrict_to_roles'], $user->roles ) ) {
				return false;
			}
		}
	}

	return $instance;
}
