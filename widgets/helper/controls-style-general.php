<?php

use Elementor\Controls_Manager;

$this->start_controls_section(
    'section_design_layout',
    [
        'label' => __('General', 'elementor-pro'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);
//Option to add distance between elements
$this->add_control(
    'column_gap',
    [
        'label' => __('Columns Gap', 'elementor-pro'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 20,
        ],
        'selectors' => [
            '{{WRAPPER}}' => '--item-gap: {{SIZE}}{{UNIT}}',
        ],
    ]
);
// Option to Show/Hide Overflow
$this->add_control(
    'siema_overflow',
    [
        'label' => __('Slider Overflow', 'elementor-slider-addon'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'elementor-slider-addon'),
        'label_off' => __('Hide', 'elementor-slider-addon'),
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
);
$this->add_control(
    'hide-left',
    [
        'label' => __('Hide Slides on the Left', 'elementor-slider-addon'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Hide', 'elementor-slider-addon'),
        'label_off' => __('Show', 'elementor-slider-addon'),
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
);

$this->end_controls_section();
