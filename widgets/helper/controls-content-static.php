<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

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

$this->add_control(
    'static_title_as_link',
    [
        'label' => __('Use Title as Link', self::$slug),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Yes', self::$slug),
        'label_off' => __('No', self::$slug),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->end_controls_section();
