<?php
// Main plugin file: rugator-digital-legacy.php
/**
 * Plugin Name: Rugator Digital Legacy Plugin
 * Plugin URI: https://rugator.com
 * Description: Schedules the deletion of user accounts after a period of inactivity and allows users to set their preferences. [rugator_digital_legacy]
 * Version: 0.0.1
 * Requires at least: 4.0
 * Requires PHP: 5.6
 * Author: RUGATOR
 * Author URI: https://rugator.com/
 * License: MIT License
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://rugator.com/
 * Text Domain: digital-legacy
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include modular files
require_once plugin_dir_path(__FILE__) . 'includes/privacy-policy.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-management.php';
require_once plugin_dir_path(__FILE__) . 'includes/scheduling.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Load plugin text domain for translation
function rugator_digital_legacy_load_textdomain() {
    load_plugin_textdomain('digital-legacy', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'rugator_digital_legacy_load_textdomain');

// Schedule tasks on activation
register_activation_hook(__FILE__, 'rugator_digital_legacy_schedule_activation');
