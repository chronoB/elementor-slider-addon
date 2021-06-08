<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

$this->start_controls_section(
    'query_content_style',
    [
        'label' => __('Query Content', self::$slug),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'slide-content' => 'query',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Image_Size::get_type(),
    [
        'name' => 'query-image', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        'exclude' => [],
        'include' => [],
        'default' => 'medium',
    ]
);

$this->end_controls_section();
