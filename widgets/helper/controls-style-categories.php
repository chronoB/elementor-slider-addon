<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

$this->start_controls_section(
    'categories_style',
    [
        'label' => __('Categories', self::$slug),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'categories_typography',
            'global' => [
                'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
            'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__categories, {{WRAPPER}} .elementor-slider-addon-item-content__categories a',
            
        ]
    );
    $this->add_control(
        'categories_padding',
        [
            'label' => __( 'Padding', 'elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__categories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'categories_spacing',
        [
            'label' => __( 'Spacing', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
        'categories_spacing_internal',
        [
            'label' => __( 'Spacing between elements', self::$slug ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__category:first-child' => 'margin-right: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .elementor-slider-addon-item-content__category:last-child' => 'margin-left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-slider-addon-item-content__category:not(:first-child):not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->start_controls_tabs( 'categories_effects_tabs' );

        $this->start_controls_tab( 'categories_normal',
            [
                'label' => __( 'Normal', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'categories_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__categories, {{WRAPPER}} .elementor-slider-addon-item-content__categories a' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'categories_hover',
            [
                'label' => __( 'Hover', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'categories_hover_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__categories:hover, {{WRAPPER}} .elementor-slider-addon-item-content__categories:hover a' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_tab();

    $this->end_controls_tabs();
$this->end_controls_section();
