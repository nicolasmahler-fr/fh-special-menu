<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.nicolasmahler.fr
 * @since      1.0.0
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

/**
 * Swith tpl location
 */
$output = "<div class='fhl_download_pdf_btn_wrapper'>";
$output .= $atts['name'] . "<br>";
$output .= $atts['price'] . "<br>";
$output .= $atts['entree'] . "<br>";
$output .= $atts['plat'] . "<br>";
$output .= $atts['dessert'] . "<br>";
$output .= "<em>" . $atts['nfo'] . "</em><br>";
$output .= "</div>";
