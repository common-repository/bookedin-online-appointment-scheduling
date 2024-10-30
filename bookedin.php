<?php

/**
 * Plugin Name:  Bookedin Wordpress Appointment Scheduling Plugin
 * Plugin URI:   http://bookedin.com/plugins/wordpress
 * Description:  Get Bookedin's appointment scheduling plugin & eliminate the stress of managing bookings so that you can get back to enjoying your business.
 * Author:       Bookedin
 * Author URI:   https://bookedin.com/?cid=265
 * Contributors: Kelvin De Moya
 * Version:      7.0.0
 * Text Domain:  booked-in
 * Domain Path:  /languages
 * License:      GPLv2+
 * License URI:  LICENSE.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bookedin-activator.php
 */
function activate_plugin_name() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-bookedin-activator.php';
    BookedIn_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bookedin-deactivator.php
 */
function deactivate_plugin_name() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-bookedin-deactivator.php';
    BookedIn_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_plugin_name');
register_deactivation_hook(__FILE__, 'deactivate_plugin_name');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-bookedin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bookedin() {
    $plugin = new BookedIn();
    $plugin->run();
}

run_bookedin();
