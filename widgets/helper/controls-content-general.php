<?php
use Elementor\Controls_Manager;

$this->start_controls_section(
    'general',
    [
        'label' => __('General', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
//Selector if the content is static or should come from a query
$this->add_control(
    'slide-content',
    [
        'label' => __('Slider Content', self::$slug),
        'type' => Controls_Manager::SELECT,
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
        'label' => __('Number of Slides', self::$slug),
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
        'selectors' => [
            '{{WRAPPER}} .siema' => 'grid-template-columns: repeat({{options}},1fr);',
        ],
        'frontend_available' => true,
    ]
);
$this->end_controls_section();