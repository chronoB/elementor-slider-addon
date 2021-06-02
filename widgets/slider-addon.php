<?php

namespace Elementor_Slider_Addon\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Controls_Manager;

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
                'label' => __('Content Type', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        //Selector if the content is static or should come from a query
        $this->add_control(
            'slide-content',
            [
                'label' => __('Slider Content', self::$slug),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'static',
                'options' => [
                    'static' => __('Static', self::$slug),
                    'query' => __('Query', self::$slug),
                ],
            ],
        );
        $this->add_responsive_control(
			'number-slides',
			[
				'label' => __( 'Number of Slides', self::$slug ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				/*
                TODO: Add stuff here to add functionality! -> this code is copied from the portfolio of elementor pro
                'prefix_class' => 'elementor-grid%s-',
				'frontend_available' => true,
				'selectors' => [
					'.elementor-msie {{WRAPPER}} .elementor-portfolio-item' => 'width: calc( 100% / {{SIZE}} )',
				],*/
			]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'static_content_section',
            [
                'label' => __('Static Content', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slide-content' => 'static'
                ]
            ]
        );
        /* TODO: Add the repeater for the static slides.
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
        );*/
        $this->end_controls_section();
        
        $this->start_controls_section(
            'query_content_section',
            [
                'label' => __('Query', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slide-content' => 'query'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Related::get_type(),
			[
				'name' => 'posts',
				'presets' => [ 'full' ],
				'exclude' => [
					'posts_per_page', //use the one from Layout section
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'navigation_content_section',
            [
                'label' => __('Navigation', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'navigation_show',
            [
                'label' => __( 'Show', self::$slug ),
				'type' => \Elementor\Controls_Manager::SWITCHER ,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
        $this->add_control(
			'navigation_position',
			[
				'label' => __( 'Position', self::$slug ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Above', self::$slug ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Around', self::$slug ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Below', self::$slug ),
						'icon' => 'fa fa-align-right',
					],
				],
                'condition' => [
                    'navigation_show' => 'yes'
                ],
				'default' => 'center',
				'toggle' => true,
			]
		);
        $this->add_control(
			'navigation_alignment',
			[
				'label' => __( 'Alignment', self::$slug ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', self::$slug ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', self::$slug ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', self::$slug ),
						'icon' => 'fa fa-align-right',
					],
				],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'navigation_show',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'navigation_position',
                            'operator' => '!=',
                            'value' => 'center'
                        ]
                    ]
                ],
				'default' => 'center',
				'toggle' => true,
			]
		);
        $this->add_control(
			'icon-prev',
			[
				'label' => __( 'Previous Icon', self::$slug ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'navigation_show' => 'yes'
                ],
				'skin' => 'inline',
				'label_block' => false,
				'frontend_available' => true,
			]
		);
        $this->add_control(
			'icon-next',
			[
				'label' => __( 'Next Icon', self::$slug ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'navigation_show' => 'yes'
                ],
				'skin' => 'inline',
				'label_block' => false,
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

        //TODO: Add configuration from siema api

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
