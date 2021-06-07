<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

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
        'selectors' => [
            '{{WRAPPER}} ' => ' --grid-column-gap: {{SIZE}}{{UNIT}}',
        ],
    ]
);
// Option to Show/Hide Overflow
$this->add_control(
    'section_overflow',
    [
        'label' => __('Section Overflow', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'hide-left',
    [
        'label' => __('Hide Slides on the Left', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Hide', self::$slug),
        'label_off' => __('Show', self::$slug),
        'return_value' => '1',
        'default' => '1',
        'frontend_available' => true,
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'static_content_style',
    [
        'label' => __('Static Content', self::$slug),
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
    ]
);

$this->end_controls_section();
