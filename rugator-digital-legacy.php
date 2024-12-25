<?php
/**
 * Plugin Name: 		Rugator Digital Legacy Plugin
 * Plugin URI: 			https://rugator.com
 * Description: 		Schedules the deletion of user accounts after a period of inactivity and allows users to set their preferences. [rugator_digital_legacy]
 * Version: 			0.0.1
 *
 * Requires at least: 	4.0
 * Requires PHP: 		5.6
 *
 * Author: 				RUGATOR
 * Author URI:			https://rugator.com/
 * License: 			MIT License
 * License URI: 		https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: 			https://rugator.com/
 * Text Domain: 		digital-legacy
 * Domain Path: 		/languages 
 */

// Verifica si se accede directamente al archivo del plugin y redirige al usuario
if (!defined('ABSPATH')) {
    exit; // Sal del archivo si se accede directamente
}

/**
 * Adds a privacy policy statement.
 */
function wporg_add_privacy_policy_content() {
	if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
		return;
	}
	$content = '<p class="privacy-policy-tutorial">' . __( 'Some introductory content for the suggested text.', 'text-domain' ) . '</p>'
			. '<strong class="privacy-policy-tutorial">' . __( 'Suggested Text:', 'my_plugin_textdomain' ) . '</strong> '
			. sprintf(
				__( 'When you leave a comment on this site, we send your name, email address, IP address and comment text to example.com. Example.com does not retain your personal data. The example.com privacy policy is <a href="%1$s" target="_blank">here</a>.', 'text-domain' ),
				'https://rugator.com/privacidad'
			);
	wp_add_privacy_policy_content( 'Example Plugin', wp_kses_post( wpautop( $content, false ) ) );
}

add_action( 'admin_init', 'wporg_add_privacy_policy_content' );


// Function to get the last time a user logged in
function get_last_login($user_id) {
    return get_user_meta($user_id, 'last_login', true);
}

// Function to delete a user account
function delete_user_account($user_id) {
    if (wp_delete_user($user_id)) {
        // Add any other actions you want to perform upon account deletion here.
    }
}

// Function to schedule deletion of inactive accounts
function schedule_account_deletion() {
    $inactivity_periods = array(
        'disabled' => -1, // Opción "Desactivado" con valor -1
        '1-month' => 30 * 24 * 60 * 60,
        '3-months' => 90 * 24 * 60 * 60,
        '6-months' => 180 * 24 * 60 * 60,
        '1-year' => 365 * 24 * 60 * 60,
        '2-years' => 730 * 24 * 60 * 60,
        '5-years' => 1825 * 24 * 60 * 60,
    );

    $users = get_users();

    foreach ($users as $user) {
        $last_login = get_last_login($user->ID);

        foreach ($inactivity_periods as $period_key => $inactivity_period) {
            if ($inactivity_period === -1) {
                // No se aplica eliminación
                break;
            }

            $custom_notification_days = get_option('rt_digital_legacy_custom_notification_days', 15); // Get customizable notification days

            if (current_time('timestamp') - $last_login >= ($inactivity_period - $custom_notification_days * 24 * 60 * 60)) {
                // Send a notification email
                $to = $user->user_email;
                $subject = __('Digital Legacy Notification', 'rugator-digital-legacy');
                $message = sprintf(__('Your account will be scheduled for deletion in %s due to inactivity. To prevent deletion, please log in to your account.', 'rugator-digital-legacy'), $period_key);
                wp_mail($to, $subject, $message);
                
                // Add a notice in the header for the affected user
                add_action('wp_head', function() use ($period_key, $custom_notification_days) {
                    echo '<div class="notice notice-warning"><p>' . sprintf(__('Your account will be deleted in %s due to inactivity in the next %d days. Please log in to prevent this.', 'rugator-digital-legacy'), $period_key, $custom_notification_days) . '</p></div>';
                });
                break;
            }
        }
    }
}

// Schedule the function to run daily
function schedule_activation() {
    if (!wp_next_scheduled('rt_digital_legacy_schedule')) {
        wp_schedule_event(time(), 'daily', 'rt_digital_legacy_schedule');
    }
}
add_action('admin_menu', 'rt_digital_legacy_menu');

// Add a menu in the admin area
function rugator_digital_legacy_menu() {
    add_menu_page(
        __('Digital Legacy Settings', 'rt-digital-legacy'),
        __('Digital Legacy', 'rt-digital-legacy'),
        'manage_options',
        'rt-digital-legacy-settings',
        'rt_digital_legacy_settings_page',
        'dashicons-privacy' // Icono personalizado en Administración
    );
}

// Plugin settings page
function rugator_digital_legacy_settings_page() {
    // Check for admin capability
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to access this page.', 'rt-digital-legacy'));
    }

    // Process the form when submitted
    if (isset($_POST['submit_settings'])) {
        // Retrieve and save user inactivity settings
        $selected_period = sanitize_text_field($_POST['inactivity_period']);
        $custom_notification_days = intval($_POST['custom_notification_days']); // New field

        $inactivity_periods = array(
            'disabled',
            '1-month',
            '3-months',
            '6-months',
            '1-year',
            '2-years',
            '5-years',
        );

        if (in_array($selected_period, $inactivity_periods)) {
            update_option('rt_digital_legacy_inactivity_period', $selected_period);
            update_option('rt_digital_legacy_custom_notification_days', $custom_notification_days); // Save customizable notification days
            echo '<div class="notice notice-success"><p>' . __('Settings saved successfully.', 'rt-digital-legacy') . '</p></div>';
        }
    }

    // Get the current settings
    $current_inactivity_period = get_option('rt_digital_legacy_inactivity_period', '1-month');
    $current_custom_notification_days = get_option('rt_digital_legacy_custom_notification_days', 15); // Default value of 15 days

    // Display the settings form
    ?>
    <div class="wrap">
        <h2><?php _e('Digital Legacy Settings', 'rt-digital-legacy'); ?></h2>
        <form method="post">
            <label for="inactivity_period"><?php _e('Inactivity Period:', 'rt-digital-legacy'); ?></label>
            <select name="inactivity_period" id="inactivity_period">
                <option value="disabled" <?php selected($current_inactivity_period, 'disabled'); ?>><?php _e('Disabled', 'rugator-digital-legacy'); ?></option>
                <option value="1-month" <?php selected($current_inactivity_period, '1-month'); ?>><?php _e('1 month', 'rugator-digital-legacy'); ?></option>
                <option value="3-months" <?php selected($current_inactivity_period, '3-months'); ?>><?php _e('3 months', 'rugator-digital-legacy'); ?></option>
                <option value="6-months" <?php selected($current_inactivity_period, '6-months'); ?>><?php _e('6 months', 'rugator-digital-legacy'); ?></option>
                <option value="1-year" <?php selected($current_inactivity_period, '1-year'); ?>><?php _e('1 year', 'rugator-digital-legacy'); ?></option>
                <option value="2-years" <?php selected($current_inactivity_period, '2-years'); ?>><?php _e('2 years', 'rugator-digital-legacy'); ?></option>
                <option value="5-years" <?php selected($current_inactivity_period, '5-years'); ?>><?php _e('5 years', 'rugator-digital-legacy'); ?></option>
            </select>
            <p><?php _e('Select the inactivity period before account deletion is scheduled.', 'rt-digital-legacy'); ?></p>
            
            <!-- New field for customizable notification days -->
            <label for="custom_notification_days"><?php _e('Customizable Notification Days:', 'rt-digital-legacy'); ?></label>
            <input type="number" name="custom_notification_days" id="custom_notification_days" value="<?php echo $current_custom_notification_days; ?>" min="1">
            <p><?php _e('Enter the number of days before deletion that you want to receive a custom notification.', 'rugator-digital-legacy'); ?></p>
            <p><input type="submit" name="submit_settings" class="button-primary" value="<?php _e('Save Settings', 'rugator-digital-legacy'); ?>"></p>
        </form>
    </div>
    <?php
}

// Load plugin text domain for translation
function load_rugator_digital_legacy_translation() {
    $plugin_dir = plugin_dir_path(__FILE__);
    load_plugin_textdomain('rt-digital-legacy', false, basename($plugin_dir) . '/languages/');
}
add_action('plugins_loaded', 'load_rt_digital_legacy_translation');									  

// Hook to register deletion and scheduling functions
add_action('rt_digital_legacy_schedule', 'schedule_account_deletion');
register_activation_hook(__FILE__, 'schedule_activation');

// Function to update the last time a user logged in
function update_last_login($user_login, $user) {
    update_user_meta($user->ID, 'last_login', current_time('timestamp'));
}
add_action('wp_login', 'update_last_login', 10, 2);

// Shortcode to display user settings
function rugator_digital_legacy_shortcode() {
    // Get the current settings
    $current_inactivity_period = get_option('rt_digital_legacy_inactivity_period', '1-month');
    $current_custom_notification_days = get_option('rt_digital_legacy_custom_notification_days', 15); // Default value of 15 days

    // Display the settings form
    ob_start();
    ?>
    <div class="rt-digital-legacy-settings">
        <h3><?php _e('Digital Legacy Settings', 'rt-digital-legacy'); ?></h3>
        <form method="post">
            <label for="inactivity_period"><?php _e('Inactivity Period:', 'rt-digital-legacy'); ?></label>
            <select name="inactivity_period" id="inactivity_period">
                <option value="disabled" <?php selected($current_inactivity_period, 'disabled'); ?>><?php _e('Disabled', 'rugator-digital-legacy'); ?></option>
                <option value="1-month" <?php selected($current_inactivity_period, '1-month'); ?>><?php _e('1 month', 'rugator-digital-legacy'); ?></option>
                <option value="3-months" <?php selected($current_inactivity_period, '3-months'); ?>><?php _e('3 months', 'rugator-digital-legacy'); ?></option>
                <option value="6-months" <?php selected($current_inactivity_period, '6-months'); ?>><?php _e('6 months', 'rugator-digital-legacy'); ?></option>
                <option value="1-year" <?php selected($current_inactivity_period, '1-year'); ?>><?php _e('1 year', 'rugator-digital-legacy'); ?></option>
                <option value="2-years" <?php selected($current_inactivity_period, '2-years'); ?>><?php _e('2 years', 'rugator-digital-legacy'); ?></option>
                <option value="5-years" <?php selected($current_inactivity_period, '5-years'); ?>><?php _e('5 years', 'rugator-digital-legacy'); ?></option>
            </select>
            <p><?php _e('Select the inactivity period before account deletion is scheduled.', 'rt-digital-legacy'); ?></p>
            
            <!-- New field for customizable notification days -->
            <label for="custom_notification_days"><?php _e('Customizable Notification Days:', 'rt-digital-legacy'); ?></label>
            <input type="number" name="custom_notification_days" id="custom_notification_days" value="<?php echo $current_custom_notification_days; ?>" min="1">
            <p><?php _e('Enter the number of days before deletion that you want to receive a custom notification.', 'rt-digital-legacy'); ?></p>
            
            <p><input type="submit" name="submit_settings" class="button-primary" value="<?php _e('Save Settings', 'rt-digital-legacy'); ?>"></p>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('rt_digital_legacy', 'rt_digital_legacy_shortcode');

// Function to add the settings form to user profiles
function rugator_digital_legacy_user_profile_fields($user) {
    ?>
    <h3><?php _e('Digital Legacy Settings', 'rt-digital-legacy'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="inactivity_period"><?php _e('Inactivity Period', 'rt-digital-legacy'); ?></label></th>
            <td>
                <select name="inactivity_period" id="inactivity_period">
                    <option value="disabled" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), 'disabled'); ?>><?php _e('Disabled', 'rt-digital-legacy'); ?></option>
                    <option value="1-month" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '1-month'); ?>><?php _e('1 month', 'rt-digital-legacy'); ?></option>
                    <option value="3-months" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '3-months'); ?>><?php _e('3 months', 'rt-digital-legacy'); ?></option>
                    <option value="6-months" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '6-months'); ?>><?php _e('6 months', 'rt-digital-legacy'); ?></option>
                    <option value="1-year" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '1-year'); ?>><?php _e('1 year', 'rt-digital-legacy'); ?></option>
                    <option value="2-years" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '2-years'); ?>><?php _e('2 years', 'rt-digital-legacy'); ?></option>
                    <option value="5-years" <?php selected(get_user_meta($user->ID, 'inactivity_period', true), '5-years'); ?>><?php _e('5 years', 'rt-digital-legacy'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="custom_notification_days"><?php _e('Customizable Notification Days', 'rt-digital-legacy'); ?></label></th>
            <td>
                <input type="number" name="custom_notification_days" id="custom_notification_days" value="<?php echo esc_attr(get_user_meta($user->ID, 'custom_notification_days', true)); ?>" min="1">
                <p class="description"><?php _e('Enter the number of days before deletion that you want to receive a custom notification.', 'rt-digital-legacy'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

// Function to save the custom user profile fields
function rugator_digital_legacy_save_user_profile_fields($user_id) {
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'inactivity_period', sanitize_text_field($_POST['inactivity_period']));
        update_user_meta($user_id, 'custom_notification_days', intval($_POST['custom_notification_days']));
    }
}

// Hook to add the custom user profile fields
add_action('show_user_profile', 'rt_digital_legacy_user_profile_fields');
add_action('edit_user_profile', 'rt_digital_legacy_user_profile_fields');
add_action('personal_options_update', 'rt_digital_legacy_save_user_profile_fields');
add_action('edit_user_profile_update', 'rt_digital_legacy_save_user_profile_fields');
