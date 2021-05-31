<?php
/**
 * Elementor Slider Addon WordPress Plugin
 *
 * @package ElementorSliderAddon
 *
 * Plugin Name: Elementor Slider Addon
 * Description: Lightweight easy-to-use slider widget for Elementor.
 * Plugin URI:  https://github.com/chronoB/elementor-slider-addon
 * Version:     1.0.0
 * Author:      Parallachs
 * Author URI:  https://parallachs.de
 * Text Domain: elementor-slider-addon
 */

define('ELEMENTOR_SLIDER_ADDON', __FILE__);

/**
 * Include the Elementor_Slider_Addon class.
 */
require plugin_dir_path(ELEMENTOR_SLIDER_ADDON) . 'class-elementor-slider-addon.php';
