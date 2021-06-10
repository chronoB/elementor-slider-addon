<?php
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

$this->start_controls_section(
    'query_content_section',
    [
        'label' => __('Query', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
        'condition' => [
            'slide-content' => 'query'
        ]
    ]
);

$this->add_group_control(
    Group_Control_Related::get_type(),
    [
        'name' => 'posts',
        'presets' => ['full'],
        'exclude' => [
            'posts_per_page', //use the one from Layout section
        ],
    ]
);

$this->end_controls_section();


$this->start_controls_section(
    'content_settings_section',
    [
        'label' => __('Content Settings', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
        'condition' => [
            'slide-content' => 'query'
        ]
    ]
);

$this->add_control(
    'show_title',
    [
        'label' => __('Show Title', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'title_tag',
    [
        'label' => __('Title HTML Tag', self::$slug),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
            'div' => 'div',
            'span' => 'span',
            'p' => 'p',
        ],
        'default' => 'h3',
        'condition' => [
            'show_title' => 'yes',
        ],
    ]
);
$this->add_control(
    'query_title_as_link',
    [
        'label' => __('Use Title as Link', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Yes', self::$slug),
        'label_off' => __('No', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'show_categories',
    [
        'label' => __('Show Categories', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'category_delimiter',
    [
        'label' => __('Category delimiter', self::$slug),
        'type' => Controls_Manager::TEXT,
        'default' => __("/", self::$slug),
        'placeholder' => __('Value Attribute', self::$slug),
        'condition' => [
            'show_categories' => 'yes',
        ],
    ]
);
$this->add_control(
    'show_excerpt',
    [
        'label' => __('Show Excerpt', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->add_control(
    'show_read_more',
    [
        'label' => __('Show Read More', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Show', self::$slug),
        'label_off' => __('Hide', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);
$this->add_control(
    'read_more_text',
    [
        'label' => __('Read More Text', self::$slug),
        'type' => Controls_Manager::TEXT,
        'default' => __("Read More", self::$slug),
        'placeholder' => __('Value Attribute', self::$slug),
        'condition' => [
            'show_read_more' => 'yes',
        ],
    ]
);
$this->add_control(
    'read_more_symbol',
    [
        'label' => __('Read More Symbol', self::$slug),
        'type' => Controls_Manager::ICONS,
        'placeholder' => __('Value Attribute', self::$slug),
        'default' => [
            'value' => 'fas fa-chevron-right',
            'library' => 'fa-solid',
        ],
        'skin' => 'inline',
        'label_block' => false,
        'frontend_available' => true,
        'condition' => [
            'show_read_more' => 'yes',
        ],
    ]
);
$this->end_controls_section();
