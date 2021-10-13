<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress or ClassicPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.nicolasmahler.fr
 * @since             1.0.0
 * @package           Fh_Special_Menu
 *
 * @wordpress-plugin
 * Plugin Name:       Menus spéciaux
 * Plugin URI:        https://plugin.com/fh-special-menu-uri/
 * Description:       Afficher les menus spéciaux du restaurant
 * Version:           1.0.0
 * Author:            Nicolas MAHLER
 * Requires at least: 1.0.0
 * Tested up to:      5.8
 * Author URI:        https://www.nicolasmahler.fr/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fh-special-menu
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FH_SPECIAL_MENU_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 *
 * This action is documented in includes/class-fh-special-menu-activator.php
 * Full security checks are performed inside the class.
 */
function fh_special_menu_activate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-fh-special-menu-activator.php';
	Fh_Special_Menu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 *
 * This action is documented in includes/class-fh-special-menu-deactivator.php
 * Full security checks are performed inside the class.
 */
function fh_special_menu_deactivate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-fh-special-menu-deactivator.php';
	Fh_Special_Menu_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'fh_special_menu_activate');
register_deactivation_hook(__FILE__, 'fh_special_menu_deactivate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-fh-special-menu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Generally you will want to hook this function, instead of callign it globally.
 * However since the purpose of your plugin is not known until you write it, we include the function globally.
 *
 * @since    1.0.0
 */
function fh_special_menu_run()
{

	$plugin = new Fh_Special_Menu();
	$plugin->run();
}
fh_special_menu_run();
