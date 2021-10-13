<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.nicolasmahler.fr
 * @since      1.0.0
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the admin-facing stylesheet and JavaScript.
 * As you add hooks and methods, update this description.
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/admin
 * @author     Your Name <contact@nicolasmahler.fr>
 */
class Fh_Special_Menu_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $fh_special_menu    The ID of this plugin.
	 */
	private $fh_special_menu;

	/**
	 * The unique prefix of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_prefix    The string used to uniquely prefix technical functions of this plugin.
	 */
	private $plugin_prefix;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $fh_special_menu       The name of this plugin.
	 * @param      string $plugin_prefix    The unique prefix of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct($fh_special_menu, $plugin_prefix, $version)
	{

		$this->fh_special_menu   = $fh_special_menu;
		$this->plugin_prefix = $plugin_prefix;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_styles($hook_suffix)
	{

		wp_enqueue_style($this->fh_special_menu, plugin_dir_url(__FILE__) . 'css/fh-special-menu-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts($hook_suffix)
	{

		wp_enqueue_script($this->fh_special_menu, plugin_dir_url(__FILE__) . 'js/fh-special-menu-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Register admin menu
	 *
	 * @return void
	 */
	public function setup_menu()
	{
		add_menu_page(
			__('Menus spéciaux du restaurant', 'fh-special-menu'),
			__('Menus spéciaux du restaurant', 'fh-special-menu'), // item name
			'manage_options', // droits
			'fh-special-menu', // slug 
			array(__CLASS__, 'admin_page_contents'), // function
			'dashicons-food', // icone
			3	// menu positions
		);
	}

	/**
	 * Fields
	 *
	 * @return void
	 */
	public function settings_init()
	{

		/**
		 * Name and published fields
		 */
		register_setting(
			'fhSpecialMenu',
			'fh_Special_Menu_settings'
		);

		add_settings_section(
			'settings_section',
			__('', 'wordpress'),
			array(__CLASS__, 'settings_section_callback'),
			'fhSpecialMenu'
		);

		/**
		 * textfield : name
		 */
		add_settings_field(
			'name_textfield',
			__('Nom du menu', 'wordpress'),
			array(__CLASS__, 'name_textfield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * textfield : price
		 */
		add_settings_field(
			'price_textfield',
			__('Prix du menu', 'wordpress'),
			array(__CLASS__, 'price_textfield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * selectfield : published
		 */
		add_settings_field(
			'select_field',
			__('Statut', 'wordpress'),
			array(__CLASS__, 'select_field_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * textarea : entrées
		 */
		add_settings_field(
			'entree_textareafield',
			__('Description de l\'entrée', 'wordpress'),
			array(__CLASS__, 'entree_textareafield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * textarea : plat
		 */
		add_settings_field(
			'plat_textareafield',
			__('Description du plat', 'wordpress'),
			array(__CLASS__, 'plat_textareafield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * textarea : dessert
		 */
		add_settings_field(
			'dessert_textareafield',
			__('Description du dessert', 'wordpress'),
			array(__CLASS__, 'dessert_textareafield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);

		/**
		 * textarea : nfo
		 */
		add_settings_field(
			'nfo_textareafield',
			__('Infos complémentaires (optionnel)', 'wordpress'),
			array(__CLASS__, 'nfo_textareafield_callback'),
			'fhSpecialMenu',
			'settings_section'
		);
	}


	/**
	 * Create text field
	 *
	 * @return void
	 */
	public static function name_textfield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$name = ($options) ? $options['name_textfield'] : '';

		echo "<input 
		type='text' 
		name='fh_Special_Menu_settings[name_textfield]' 
		id='fh_Special_Menu_settings[name_textfield]' 
		value='" . $name . "'
		>";
	}

	/**
	 * Create price text field
	 *
	 * @return void
	 */
	public static function price_textfield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$price = ($options) ? $options['price_textfield'] : '';

		echo "<input 
		type='text' 
		name='fh_Special_Menu_settings[price_textfield]' 
		id='fh_Special_Menu_settings[price_textfield]' 
		value='" . $price . "'
		>";
	}

	/**
	 * Create entree textarea field
	 *
	 * @return void
	 */
	public static function entree_textareafield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$entree = ($options) ? $options['entree_textareafield'] : '';

		echo "<textarea 
		name='fh_Special_Menu_settings[entree_textareafield]' 
		id='fh_Special_Menu_settings[entree_textareafield]' 
		>" . $entree . "</textarea>";
	}

	/**
	 * Create plat textarea field
	 *
	 * @return void
	 */
	public static function plat_textareafield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$plat = ($options) ? $options['plat_textareafield'] : '';

		echo "<textarea 
		name='fh_Special_Menu_settings[plat_textareafield]' 
		id='fh_Special_Menu_settings[plat_textareafield]' 
		>" . $plat . "</textarea>";
	}

	/**
	 * Create dessert textarea field
	 *
	 * @return void
	 */
	public static function dessert_textareafield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$dessert = ($options) ? $options['dessert_textareafield'] : '';

		echo "<textarea 
		name='fh_Special_Menu_settings[dessert_textareafield]' 
		id='fh_Special_Menu_settings[dessert_textareafield]' 
		>" . $dessert . "</textarea>";
	}

	/**
	 * Create nfo textarea field
	 *
	 * @return void
	 */
	public static function nfo_textareafield_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$nfo = ($options) ? $options['nfo_textareafield'] : '';

		echo "<textarea 
		name='fh_Special_Menu_settings[nfo_textareafield]' 
		id='fh_Special_Menu_settings[nfo_textareafield]' 
		>" . $nfo . "</textarea>";
	}

	/**
	 * Create select field
	 *
	 * @return void
	 */
	public static function select_field_callback()
	{
		$options = get_option('fh_Special_Menu_settings');
		$select = ($options) ? $options['select_field'] : '';

		echo "<select name='fh_Special_Menu_settings[select_field]'>
            <option value='1'";
		selected($select, 1);
		echo "'>Activé</option>
            <option value='0'";
		selected($select, 0);
		echo "'>Désactivé</option>
        </select>";
	}


	public static function settings_section_callback()
	{
		echo __('', 'wordpress');
	}

	/**
	 * Admin template location
	 *
	 * @return void
	 */
	public static function admin_page_contents()
	{
		include(__DIR__ . '/partials/fh-special-menu-admin-display.php');
	}
}
