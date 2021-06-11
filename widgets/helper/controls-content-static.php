<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

$this->start_controls_section(
    'static_content_section',
    [
        'label' => __('Static Content', 'elementor-slider-addon'),
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
        'label' => __('Title', 'elementor-slider-addon'),
        'type' => Controls_Manager::TEXT,
        'default' => __("This is the headline", 'elementor-slider-addon'),
        'placeholder' => __('Value Attribute', 'elementor-slider-addon'),
    ]
);
$repeater->add_control(
    'repeater_headline_tag',
    [
        'label' => __('Title HTML Tag', 'elementor-slider-addon'),
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
        'label' => __('Description', 'elementor-slider-addon'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __('This is the description.', 'elementor-slider-addon'),
        'placeholder' => __('Option Contents', 'elementor-slider-addon'),
    ]
);

$repeater->add_control(
    'repeater_thumbnail',
    [
        'label' => __('Choose Image', 'elementor-slider-addon'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);
$repeater->add_control(
    'repeater_read_more_url',
    [
        'label' => __('URL', 'elementor-slider-addon'),
        'type' => Controls_Manager::URL,
        'placeholder' => __('https://your-link.com', 'elementor-slider-addon'),
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
        'label' => __('Read More Text', 'elementor-slider-addon'),
        'type' => Controls_Manager::TEXT,
        'default' => __("Read More", 'elementor-slider-addon'),
        'placeholder' => __('Value Attribute', 'elementor-slider-addon'),
    ]
);
$repeater->add_control(
    'repeater_read_more_icon',
    [
        'label' => __('Read More Symbol', 'elementor-slider-addon'),
        'type' => Controls_Manager::ICONS,
        'placeholder' => __('Value Attribute', 'elementor-slider-addon'),
        'default' => [
            'value' => 'fas fa-chevron-right',
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
        'label' => __('Content Elements', 'elementor-slider-addon'),
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
        'label' => __('Use Title as Link', 'elementor-slider-addon'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'elementor-slider-addon'),
        'label_off' => __('No', 'elementor-slider-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->end_controls_section();
