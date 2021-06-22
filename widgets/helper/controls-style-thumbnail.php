<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

$this->start_controls_section(
    'thumbnail_style',
    [
        'label' => __('Thumbnail', 'elementor-slider-addon'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'static-image', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
            'exclude' => [],
            'include' => [],
            'default' => 'medium',
            'condition' => [
                'slide-content' => 'static'
            ]
        ]
    );
    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'query-image', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
            'exclude' => [],
            'include' => [],
            'default' => 'medium',
            'condition' => [
                'slide-content' => 'query'
            ]
        ]
    );
    $this->add_responsive_control(
        'slider_max_height',
        [
            'label' => __( 'Max. Height of Thumbnail ', 'elementor-slider-addon' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 300,
            ],
            'tablet_default' => [
                'size' => '',
            ],
            'mobile_default' => [
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => '--slider-max-height: {{SIZE}}{{UNIT}}',
            ],
            'frontend_available' => true,
        ]
    );
    $this->add_responsive_control(
        'item_ratio',
        [
            'label' => __( 'Image Ratio', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 0.66,
            ],
            'tablet_default' => [
                'size' => '',
            ],
            'mobile_default' => [
                'size' => 0.5,
            ],
            'range' => [
                'px' => [
                    'min' => 0.1,
                    'max' => 2,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon .elementor-slider-addon-item-thumbnail' => 'padding-bottom: min(var(--slider-max-height), {{SIZE}} * 100% );',
                '{{WRAPPER}}:after' => 'content: "{{SIZE}}";',
            ],
            'frontend_available' => true,
        ]
    );
    $this->add_responsive_control(
        'image_width',
        [
            'label' => __( 'Image Width', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
                'px' => [
                    'min' => 10,
                    'max' => 600,
                ],
            ],
            'default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'tablet_default' => [
                'size' => '',
                'unit' => '%',
            ],
            'mobile_default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'size_units' => [ '%', 'px' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-thumbnail__img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->add_control(
        'img_border_radius',
        [
            'label' => __( 'Border Radius', 'elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-thumbnail__img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'thumbnail_padding',
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
                '{{WRAPPER}} .elementor-slider-addon-item-thumbnail__img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
    
    $this->add_control(
        'image_spacing',
        [
            'label' => __( 'Spacing', 'elementor-pro' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-slider-addon-item-thumbnail__img' => 'margin-bottom: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

    $this->start_controls_tabs( 'thumbnail_effects_tabs' );

        $this->start_controls_tab( 'thumbnail_normal',
            [
                'label' => __( 'Normal', 'elementor-pro' ),
            ]
        );

            $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'thumbnail_filters',
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item-thumbnail img',
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'thumbnail_hover',
            [
                'label' => __( 'Hover', 'elementor-pro' ),
            ]
        );

            $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'thumbnail_hover_filters',
                    'selector' => '{{WRAPPER}} .elementor-slider-addon-item-thumbnail:hover img',
                ]
            );

        $this->end_controls_tab();

    $this->end_controls_tabs();
$this->end_controls_section();
