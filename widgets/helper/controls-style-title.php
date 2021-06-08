<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

$this->start_controls_section(
    'title_style',
    [
        'label' => __('Title', self::$slug),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'global' => [
                'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
            'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__title, {{WRAPPER}} .elementor-slider-addon-item-content__title a',
            
        ]
    );
    $this->add_control(
        'title_padding',
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
                '{{WRAPPER}} .elementor-slider-addon-item-content__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'title_spacing',
        [
            'label' => __( 'Spacing', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->start_controls_tabs( 'title_effects_tabs' );

        $this->start_controls_tab( 'title_normal',
            [
                'label' => __( 'Normal', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__title, {{WRAPPER}} .elementor-slider-addon-item-content__title a' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'title_hover',
            [
                'label' => __( 'Hover', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'title_hover_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__title:hover, {{WRAPPER}} .elementor-slider-addon-item-content__title:hover a' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_tab();

    $this->end_controls_tabs();
$this->end_controls_section();
