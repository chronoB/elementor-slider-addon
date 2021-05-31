<?php

namespace Elementor_Slider_Addon\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Elementor_Slider_Addon extends Widget_Base
{
    public static $slug = 'elementor-slider-addon';

    public function get_name()
    {
        return self::$slug;
    }

    public function get_title()
    {
        return __('Elementor Slider Addon', self::$slug);
    }

    public function get_icon()
    {
        return 'fa fa-stream';
    }

    public function get_categories()
    {
        return [ 'general' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Options', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Use the repeater to define one one set of the items we want to repeat look like
        $repeater = new Repeater();

        $repeater->add_control(
            'option_value',
            [
                'label' => __('Option Value', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("Gysi über seinen Fußball-Sachverstand:", self::$slug),
                'placeholder' => __('Value Attribute', self::$slug),
            ]
        );

        $repeater->add_control(
            'option_contents',
            [
                'label' => __('Option Contents', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('"Ich bin der klassische deutsche Sachverständige von Fußball: Ich habe keine Ahnung, schaue mir alles an und weiß alles besser. ... Nicht, dass ich wirklich was davon verstünde. Aber das schätze ich ja auch, trotzdem dann meine Meinung zu sagen."', self::$slug),
                'placeholder' => __('Option Contents', self::$slug),
            ]
        );

        $repeater->add_control(
            'option_image',
            [
                'label' => __('Choose Image', self::$slug),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Add the
        $this->add_control(
            'options_list',
            [
                'label' => __('Repeater List', self::$slug),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
                'title_field' => '{{{ option_value }}}'
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
    }


    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script('siema_slider_js', plugins_url('/assets/js/siema.js', __FILE__), [ 'elementor-frontend' ], '1.0.1', true);
    }

    public function get_script_depends()
    {
        return [ 'siema_slider_js' ];
    }

    public function get_style_depends()
    {
        return [ 'elementor_slider_addon_css' ];
    }
}
