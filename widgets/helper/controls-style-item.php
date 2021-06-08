<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

$this->start_controls_section(
    'item_style',
    [
        'label' => __('Item', self::$slug),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);
    $this->add_control(
        'box_border_width',
        [
            'label' => __( 'Border Width', 'elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'box_padding',
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
                '{{WRAPPER}} .elementor-slider-addon-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'box_content_padding',
        [
            'label' => __( 'Content Padding', 'elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    $this->add_control(
        'item-alignment',
        [
            'label' => __( 'Alignment', 'elementor-pro' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'elementor-pro' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'elementor-pro' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __( 'Right', 'elementor-pro' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'prefix_class' => 'elementor-slider-addon--align-',
        ]
    );
    
    $this->start_controls_tabs( 'bg_effects_tabs' );

        $this->start_controls_tab( 'classic_style_normal',
            [
                'label' => __( 'Normal', 'elementor-pro' ),
            ]
        );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item',
                ]
            );

            $this->add_control(
                'box_bg_color',
                [
                    'label' => __( 'Background Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'box_border_color',
                [
                    'label' => __( 'Border Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'classic_style_hover',
            [
                'label' => __( 'Hover', 'elementor-pro' ),
            ]
        );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow_hover',
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item:hover',
                ]
            );

            $this->add_control(
                'box_bg_color_hover',
                [
                    'label' => __( 'Background Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'box_border_color_hover',
                [
                    'label' => __( 'Border Color', 'elementor-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-slider-addon-item:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_tab();

    $this->end_controls_tabs();

$this->end_controls_section();
