<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;



$this->start_controls_section(
    'navigation_style_section',
    [
        'label' => __('Navigation', self::$slug),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'show_navigation' => 'yes'
        ],
    ]
);
$this->add_control(
    'navigation_position',
    [
        'label' => __('Position', self::$slug),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'above' => __('Above', self::$slug),
            'around' => __('Around', self::$slug),
            'below' => __('Below', self::$slug),
        ],
        'default' => 'around',
        'toggle' => true,
        'prefix_class' => 'elementor-slider-addon-arrow--position-',
    ]
);
$this->add_control(
    'navigation_alignment',
    [
        'label' => __('Alignment', self::$slug),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', self::$slug),
                'icon' => 'fa fa-align-left',
            ],
            'center' => [
                'title' => __('Center', self::$slug),
                'icon' => 'fa fa-align-center',
            ],
            'right' => [
                'title' => __('Right', self::$slug),
                'icon' => 'fa fa-align-right',
            ],
        ],
        'conditions' => [
            'relation' => 'and',
            'terms' => [
                [
                    'name' => 'show_navigation',
                    'operator' => '==',
                    'value' => 'yes'
                ],
                [
                    'name' => 'navigation_position',
                    'operator' => '!=',
                    'value' => 'around'
                ]
            ]
        ],
        'default' => 'center',
        'toggle' => true,
        'prefix_class' => 'elementor-slider-addon-arrow--align-',
    ]
);

$this->add_control(
    'nav_bg_width',
    [
        'label' => __( 'Background Width', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
                'step' => 1,
            ],
            '%' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-arrow' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);
$this->add_control(
    'nav_bg_height',
    [
        'label' => __( 'Background Height', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
                'step' => 1,
            ],
            '%' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-arrow' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);
$this->add_control(
    'nav_bg_width_offset',
    [
        'label' => __( 'Icon Width Offset', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => -50,
                'max' => 50,
                'step' => 1,
            ]
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-arrow-left' => 'margin-left: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .elementor-slider-addon-arrow-right' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
        'conditions' => [
            'relation' => 'and',
            'terms' => [
                [
                    'name' => 'show_navigation',
                    'operator' => '==',
                    'value' => 'yes'
                ],
                [
                    'name' => 'navigation_position',
                    'operator' => '==',
                    'value' => 'around'
                ]
            ]
        ],
    ]
);
$this->add_control(
    'nav_bg_height_offset',
    [
        'label' => __( 'Icon Height Offset', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'range' => [
            'px' => [
                'min' => -100,
                'max' => 100,
                'step' => 1,
            ],
            '%' => [
                'min' => -50,
                'max' => 50,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-arrow-left' => 'top: calc( 50% - {{SIZE}}{{UNIT}});',
            '{{WRAPPER}} .elementor-slider-addon-arrow-right' => 'top: calc( 50% - {{SIZE}}{{UNIT}});',
        ],
        'default' => [
            'unit' => 'px',
            'size' => 0,
        ],
        'conditions' => [
            'relation' => 'and',
            'terms' => [
                [
                    'name' => 'show_navigation',
                    'operator' => '==',
                    'value' => 'yes'
                ],
                [
                    'name' => 'navigation_position',
                    'operator' => '==',
                    'value' => 'around'
                ]
            ]
        ],
    ]
);
$this->add_control(
    'nav_border_radius',
    [
        'label' => __( 'Border Radius', 'elementor-pro' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%' ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->start_controls_tabs( 'navigation_bg_effects_tabs' );

    $this->start_controls_tab( 'nav_classic_style_normal',
        [
            'label' => __( 'Normal', 'elementor-pro' ),
        ]
    );
        $this->add_control(
            'nav_icon_color',
            [
                'label' => __( 'Icon Color', self::$slug ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'navigation_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-slider-addon-arrow',
            ]
        );

        $this->add_control(
            'nav_bg_color',
            [
                'label' => __( 'Background Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nav_border_color',
            [
                'label' => __( 'Border Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow' => 'border-color: {{VALUE}}',
                ],
            ]
        );

    $this->end_controls_tab();

    $this->start_controls_tab( 'nav_classic_style_hover',
        [
            'label' => __( 'Hover', 'elementor-pro' ),
        ]
    );
        $this->add_control(
            'nav_icon_color_hover',
            [
                'label' => __( 'Icon Color', self::$slug ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-slider-addon-arrow:hover',
            ]
        );

        $this->add_control(
            'nav_bg_color_hover',
            [
                'label' => __( 'Background Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nav_border_color_hover',
            [
                'label' => __( 'Border Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-arrow:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

    $this->end_controls_tab();

$this->end_controls_tabs();

$this->end_controls_section();
