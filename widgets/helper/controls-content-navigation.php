<?php
use Elementor\Controls_Manager;



$this->start_controls_section(
    'navigation_content_section',
    [
        'label' => __('Navigation', 'elementor-slider-addon'),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
$this->add_control(
    'show_navigation',
    [
        'label' => __('Show Arrows', 'elementor-slider-addon'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'elementor-slider-addon'),
        'label_off' => __('Hide', 'elementor-slider-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'icon-prev',
    [
        'label' => __('Previous Icon', 'elementor-slider-addon'),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-chevron-left',
            'library' => 'fa-solid',
        ],
        'condition' => [
            'show_navigation' => 'yes'
        ],
        'skin' => 'inline',
        'label_block' => false,
        'frontend_available' => true,
    ]
);
$this->add_control(
    'icon-next',
    [
        'label' => __('Next Icon', 'elementor-slider-addon'),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-chevron-right',
            'library' => 'fa-solid',
        ],
        'condition' => [
            'show_navigation' => 'yes'
        ],
        'skin' => 'inline',
        'label_block' => false,
        'frontend_available' => true,
    ]
);
$this->add_control(
    'show_navigation_dots',
    [
        'label' => __('Show Dots', 'elementor-slider-addon'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'elementor-slider-addon'),
        'label_off' => __('Hide', 'elementor-slider-addon'),
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
);

$this->end_controls_section();
