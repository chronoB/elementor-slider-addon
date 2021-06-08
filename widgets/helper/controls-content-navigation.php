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
    'navigation_position',
    [
        'label' => __('Position', self::$slug),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'above' => __('Above', self::$slug),
            'around' => __('Around', self::$slug),
            'Below' => __('Below', self::$slug),
        ],
        'condition' => [
            'show_navigation' => 'yes'
        ],
        'default' => 'around',
        'toggle' => true,
    ]
);
$this->add_control(
    'navigation_alignment',
    [
        'label' => __('Alignment', self::$slug),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', self::$slug),
                'icon' => 'fa fa-align-left',
            ],
            'center' => [
                'title' => __('Center', self::$slug),
                'icon' => 'fa fa-align-center',
            ],
            'right' => [
                'title' => __('Right', self::$slug),
                'icon' => 'fa fa-align-right',
            ],
        ],
        'conditions' => [
            'relation' => 'and',
            'terms' => [
                [
                    'name' => 'show_navigation',
                    'operator' => '==',
                    'value' => 'yes'
                ],
                [
                    'name' => 'navigation_position',
                    'operator' => '!=',
                    'value' => 'around'
                ]
            ]
        ],
        'default' => 'center',
        'toggle' => true,
    ]
);
$this->add_control(
    'icon-prev',
    [
        'label' => __('Previous Icon', self::$slug),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-arrow-left',
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
            'value' => 'fas fa-arrow-right',
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
