<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

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

$this->start_controls_section(
    'static_content_section',
    [
        'label' => __('Static Content', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
        'condition' => [
            'slide-content' => 'static'
        ]
    ]
);
// TODO: Add the repeater for the static slides.
// Use the repeater to define one one set of the items we want to repeat look like
$repeater = new Repeater();

$repeater->add_control(
    'repeater_headline',
    [
        'label' => __('Title', self::$slug),
        'type' => Controls_Manager::TEXT,
        'default' => __("This is the headline", self::$slug),
        'placeholder' => __('Value Attribute', self::$slug),
    ]
);
$repeater->add_control(
    'repeater_headline_tag',
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
    ]
);

$repeater->add_control(
    'repeater_description',
    [
        'label' => __('Description', self::$slug),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __('This is the description.', self::$slug),
        'placeholder' => __('Option Contents', self::$slug),
    ]
);

$repeater->add_control(
    'repeater_thumbnail',
    [
        'label' => __('Choose Image', self::$slug),
        'type' => Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);
$repeater->add_control(
    'repeater_read_more_url',
    [
        'label' => __('URL', self::$slug),
        'type' => Controls_Manager::URL,
        'placeholder' => __('https://your-link.com', self::$slug),
        'show_external' => true,
        'default' => [
            'url' => '',
            'is_external' => true,
            'nofollow' => true,
        ],
    ]
);
$repeater->add_control(
    'repeater_read_more_text',
    [
        'label' => __('Read More Text', self::$slug),
        'type' => Controls_Manager::TEXT,
        'default' => __("Read More", self::$slug),
        'placeholder' => __('Value Attribute', self::$slug),
    ]
);
$repeater->add_control(
    'repeater_read_more_icon',
    [
        'label' => __('Read More Symbol', self::$slug),
        'type' => Controls_Manager::ICONS,
        'placeholder' => __('Value Attribute', self::$slug),
        'default' => [
            'value' => 'fas fa-arrow-right',
            'library' => 'fa-solid',
        ],
        'skin' => 'inline',
        'label_block' => false,
        'frontend_available' => true,
    ]
);

// Add the
$this->add_control(
    'repeater',
    [
        'label' => __('Content Elements', self::$slug),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            []
        ],
        'title_field' => '{{{ repeater_headline }}}'
    ]
);


$this->end_controls_section();

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
            'value' => 'fas fa-arrow-right',
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

//TODO: Add configuration from siema api
$this->start_controls_section(
    'siema_content_section',
    [
        'label' => __('Slider Configuration', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);

$this->end_controls_section();
