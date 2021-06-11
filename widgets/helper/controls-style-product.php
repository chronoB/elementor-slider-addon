<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

$this->start_controls_section(
    'product_style',
    [
        'label' => __('Product', 'elementor-slider-addon'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'product_typography',
        'global' => [
            'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
        ],
        'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__product, {{WRAPPER}} .elementor-slider-addon-item-content__product a',
        
    ]
);
$this->add_control(
    'product_padding',
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
            '{{WRAPPER}} .elementor-slider-addon-item-content__product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        ],
    ]
);
$this->add_control(
    'product_spacing',
    [
        'label' => __( 'Spacing', 'elementor-pro' ),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-slider-addon-item-content__product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'product_order',
    [
        'label' => __( 'Position in the content section', 'elementor-slider-addon' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
    ]
);
$this->start_controls_tabs( 'product_effects_tabs' );

    $this->start_controls_tab( 'product_normal',
        [
            'label' => __( 'Normal', 'elementor-pro' ),
        ]
    );

        $this->add_control(
            'product_color',
            [
                'label' => __( 'Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-item-content__product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'product_bg_color',
            [
                'label' => __( 'Background Color', 'elementor-slider-addon' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-item-content__product' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_border',
                'label' => __( 'Border', 'elementor-slider-addon' ),
                'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__product',
            ]
        );

    $this->end_controls_tab();

    $this->start_controls_tab( 'product_hover',
        [
            'label' => __( 'Hover', 'elementor-pro' ),
        ]
    );

        $this->add_control(
            'product_hover_color',
            [
                'label' => __( 'Color', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-item-content__product:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'product_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementor-slider-addon' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-slider-addon-item-content__product:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_hover_border',
                'label' => __( 'Border', 'elementor-slider-addon' ),
                'selector' => '{{WRAPPER}} .elementor-slider-addon-item-content__product:hover',
            ]
        );

    $this->end_controls_tab();

$this->end_controls_tabs();
    
$this->end_controls_section();
