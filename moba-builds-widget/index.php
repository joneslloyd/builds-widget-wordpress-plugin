<?php

/*
Plugin Name: Mobalytics builds widgets
Plugin URI:  https://mobalytics.gg
Description: A WordPress plugin for easy use of builds widgets
Version:     0.1
Author:      Lloyd Jones <lj@mobalyticshq.com, lloyd@lloydjones.io>
Author URI:  https://github.com/joneslloyd
Contributors: joneslloyd
Stable tag: v0.1.12-alpha
Tested up to: 5.7
Requires at least: 4.7
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

//Update this as per the release version of the widget in GitHub
define('MOBA_BUILDS_WIDGET_VERSION', 'v0.1.12-alpha');

//For enqueueing the script
define('MOBA_BUILDS_WIDGET_SCRIPT_URL', 'https://cdn.jsdelivr.net/gh/joneslloyd/builds-widget@'.MOBA_BUILDS_WIDGET_VERSION.'/dist/index.bundle.js');

//Name, for Script handle for WP + shortcode
define('MOBA_BUILDS_WIDGET_NAME', 'moba-builds-widget');


/**
 * Enqueue the script
 */
add_action('wp_enqueue_scripts', 'moba_builds_widget_enqueue_scripts');
function moba_builds_widget_enqueue_scripts() {
    wp_enqueue_script( MOBA_BUILDS_WIDGET_NAME, MOBA_BUILDS_WIDGET_SCRIPT_URL, [], MOBA_BUILDS_WIDGET_VERSION, true );
}

add_action('init', 'moba_builds_widget_add_shortcode');
function moba_builds_widget_add_shortcode() {
    add_shortcode( MOBA_BUILDS_WIDGET_NAME, 'moba_builds_widget_do_output_shortcode' );
}

function moba_builds_widget_do_output_shortcode($atts = array()) {

     $atts = shortcode_atts( array(
        'champion' => 'amumu',
        'layout' => 'full'
    ), $atts, MOBA_BUILDS_WIDGET_NAME );

        ob_start();
        ?>
        <div data-moba-widget="build">
            <script type="application/json">
                {
                    "champion": "<?php echo $atts['champion']; ?>",
                    "layout": "<?php echo $atts['layout']; ?>"
                }
            </script>
        </div>
        <?php
        return ob_get_clean();
}