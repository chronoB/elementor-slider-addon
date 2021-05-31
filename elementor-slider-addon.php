<?php
/**
 * Plugin Name: Elementor Slider Addon
 * Description: A simple Elementor Widget that creates an Timeline List
 * Author URI:  https://www.parallachs.de
 * Version:     1.0.0
 * Author:      Finn Bayer
 * Text Domain: elementor-slider-addon
 */

namespace Elementor_Slider_Addon;

use Elementor\Plugin;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

// The Widget_Base class is not available immediately after plugins are loaded, so
// we delay the class' use until Elementor widgets are registered
add_action('elementor/widgets/widgets_registered', function () {
    require_once('widgets/slider-addon.php');

    $elementor_slider_addon =	new Widgets\Elementor_Slider_Addon();
    // Let Elementor know about our widget
    Plugin::instance()->widgets_manager->register_widget_type($elementor_slider_addon);
});
