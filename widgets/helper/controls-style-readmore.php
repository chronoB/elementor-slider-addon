<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

$this->start_controls_section(
    'read-more_style',
    [
        'label' => __('Read more', 'elementor-slider-addon'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'read-more_typography',
            'global' => [
                'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
            ],
            'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__read-more, {{WRAPPER}} .elementor-slider-addon-item-content__read-more a',
            
        ]
    );
    $this->add_control(
        'read-more_padding',
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
                '{{WRAPPER}} .elementor-slider-addon-item-content__read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'read-more_spacing',
        [
            'label' => __( 'Spacing', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__read-more' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
        'read-more_spacing_internal',
        [
            'label' => __( 'Spacing between text and icon', 'elementor-slider-addon' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 5,
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__read-more i' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
        'read-more_icon_size',
        [
            'label' => __( 'Icon Size', 'elementor-slider-addon' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 10,
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content__read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
        'read-more_order',
        [
            'label' => __( 'Position in the content section', 'elementor-slider-addon' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
        ]
    );
    $this->start_controls_tabs( 'read-more_effects_tabs' );

        $this->start_controls_tab( 'read-more_normal',
            [
                'label' => __( 'Normal', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'read-more_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__read-more' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'read-more_bg_color',
                [
                    'label' => __( 'Background Color', 'elementor-slider-addon' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__read-more' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'read-more_border',
                    'label' => __( 'Border', 'elementor-slider-addon' ),
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__read-more',
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'read-more_hover',
            [
                'label' => __( 'Hover', 'elementor-pro' ),
            ]
        );

            $this->add_control(
                'read-more_hover_color',
                [
                    'label' => __( 'Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__read-more:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'read-more_hover_bg_color',
                [
                    'label' => __( 'Background Color', 'elementor-slider-addon' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item-content__read-more:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'read-more_hover_border',
                    'label' => __( 'Border', 'elementor-slider-addon' ),
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__read-more:hover',
                ]
            );

        $this->end_controls_tab();

    $this->end_controls_tabs();
$this->end_controls_section();
