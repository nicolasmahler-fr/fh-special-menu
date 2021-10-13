<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.nicolasmahler.fr
 * @since      1.0.0
 *
 * @package    Fh_Special_Menu
 * @subpackage Fh_Special_Menu/admin/partials
 */

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>
        <?php esc_html_e('Menus spéciaux du restaurant', 'fh-special-menu-textdomain'); ?>
    </h1>

    <form method="post" action="options.php" id="target" enctype="multipart/form-data">

        <?php
        settings_fields('fhSpecialMenu');
        do_settings_sections('fhSpecialMenu');
        submit_button();
        ?>

    </form>


</div>