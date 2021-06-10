<?php
use Elementor\Controls_Manager;



$this->start_controls_section(
    'navigation_content_section',
    [
        'label' => __('Navigation', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
$this->add_control(
    'show_navigation',
    [
        'label' => __('Show', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'icon-prev',
    [
        'label' => __('Previous Icon', self::$slug),
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
        'label' => __('Next Icon', self::$slug),
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

$this->end_controls_section();
