<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.nicolasmahler.fr
 * @since      1.0.0
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the public-facing stylesheet and JavaScript.
 * As you add hooks and methods, update this description.
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/public
 * @author     Your Name <contact@nicolasmahler.fr>
 */
class Fh_Special_Menu_Public
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
	 * @param      string $fh_special_menu      The name of the plugin.
	 * @param      string $plugin_prefix          The unique prefix of this plugin.
	 * @param      string $version          The version of this plugin.
	 */
	public function __construct($fh_special_menu, $plugin_prefix, $version)
	{

		$this->fh_special_menu   = $fh_special_menu;
		$this->plugin_prefix = $plugin_prefix;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style($this->fh_special_menu, plugin_dir_url(__FILE__) . 'css/fh-special-menu-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script($this->fh_special_menu, plugin_dir_url(__FILE__) . 'js/fh-special-menu-public.js', array('jquery'), $this->version, true);
	}

	/**
	 * Example of Shortcode processing function.
	 *
	 * Shortcode can take attributes like [fh-special-menu-shortcode attribute='123']
	 * Shortcodes can be enclosing content [fh-special-menu-shortcode attribute='123']custom content[/fh-special-menu-shortcode].
	 *
	 * @see https://developer.wordpress.org/plugins/shortcodes/enclosing-shortcodes/
	 *
	 * @since    1.0.0
	 * @param    array  $atts    ShortCode Attributes.
	 * @param    mixed  $content ShortCode enclosed content.
	 * @param    string $tag    The Shortcode tag.
	 */
	public function fh_special_menu_shortcode_func($atts, $content = null, $tag)
	{

		/**
		 * Combine user attributes with known attributes.
		 *
		 * @see https://developer.wordpress.org/reference/functions/shortcode_atts/
		 *
		 * Pass third paramter $shortcode to enable ShortCode Attribute Filtering.
		 * @see https://developer.wordpress.org/reference/hooks/shortcode_atts_shortcode/
		 */
		$atts = shortcode_atts(
			array(
				'attribute' => 123,
			),
			$atts,
			$this->plugin_prefix . 'shortcode'
		);

		/**
		 * Build our ShortCode output.
		 * Remember to sanitize all user input.
		 * In this case, we expect a integer value to be passed to the ShortCode attribute.
		 *
		 * @see https://developer.wordpress.org/themes/theme-security/data-sanitization-escaping/
		 */
		$out = intval($atts['attribute']);

		/**
		 * If the shortcode is enclosing, we may want to do something with $content
		 */
		if (!is_null($content) && !empty($content)) {
			$out = do_shortcode($content); // We can parse shortcodes inside $content.
			$out = intval($atts['attribute']) . ' ' . sanitize_text_field($out); // Remember to sanitize your user input.
		}

		// ShortCodes are filters and should always return, never echo.
		return $out;
	}

	/**
	 * Actual shortcode function
	 *
	 * @param [type] $atts
	 * @param [type] $content
	 * @param [type] $tag
	 * @return void
	 */
	public function shortcode_special_menu($atts, $content = null, $tag)
	{
		/**
		 * Combine user attributes with known attributes.
		 *
		 * @see https://developer.wordpress.org/reference/functions/shortcode_atts/
		 *
		 * Pass third paramter $shortcode to enable ShortCode Attribute Filtering.
		 * @see https://developer.wordpress.org/reference/hooks/shortcode_atts_shortcode/
		 */
		$atts = shortcode_atts(
			array(
				'published' => $this->get_published(),
				'name' 		=> $this->get_name(),
				'price' 	=> $this->get_price(),
				'entree' 	=> $this->get_entree(),
				'plat' 		=> $this->get_plat(),
				'dessert' 	=> $this->get_dessert(),
				'nfo' 		=> $this->get_nfo(),
			),
			$atts,
			$this->plugin_prefix . 'special_menu'
		);

		/**
		 * Build our ShortCode output.
		 * Remember to sanitize all user input.
		 * @see https://developer.wordpress.org/themes/theme-security/data-sanitization-escaping/
		 */
		// ShortCodes are filters and should always return, never echo.
		// Display content only if set to published
		if (intval($atts['published']) == 1) {

			include(__DIR__ . '/partials/fh-special-menu-public-display.php');
			return $output;
		}
	}

	/**
	 * Get published value
	 *
	 * @return void
	 */
	public function get_published()
	{
		return get_option('fh_Special_Menu_settings')['select_field'];
	}

	/**
	 * Get name value
	 *
	 * @return void
	 */
	public function get_name()
	{
		return get_option('fh_Special_Menu_settings')['name_textfield'];
	}

	/**
	 * Get price value
	 *
	 * @return void
	 */
	public function get_price()
	{
		return get_option('fh_Special_Menu_settings')['price_textfield'];
	}

	/**
	 * Get entree value
	 *
	 * @return void
	 */
	public function get_entree()
	{
		return get_option('fh_Special_Menu_settings')['entree_textareafield'];
	}

	/**
	 * Get plat value
	 *
	 * @return void
	 */
	public function get_plat()
	{
		return get_option('fh_Special_Menu_settings')['plat_textareafield'];
	}

	/**
	 * Get dessert value
	 *
	 * @return void
	 */
	public function get_dessert()
	{
		return get_option('fh_Special_Menu_settings')['dessert_textareafield'];
	}

	/**
	 * Get nfo value
	 *
	 * @return void
	 */
	public function get_nfo()
	{
		return get_option('fh_Special_Menu_settings')['nfo_textareafield'];
	}
}
