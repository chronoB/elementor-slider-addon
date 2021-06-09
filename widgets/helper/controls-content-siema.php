<?php
use Elementor\Controls_Manager;

//TODO: Add configuration from siema api
$this->start_controls_section(
    'siema_content_section',
    [
        'label' => __('Slider Configuration', self::$slug),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
  
  $this->add_control(
    'siema_duration',
    [
        'label' => __( 'Duration', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 1000,
                'step' => 10,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => '200',
        ],
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_easing',
    [
        'label' => __('Easing Function', self::$slug),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'ease' => 'ease',
            'ease-in' => 'ease-in',
            'ease-out' => 'ease-out',
            'ease-in-out' => 'ease-in-out',
            'linear' => 'linear',
        ],
        'default' => 'ease',
        'frontend_available' => true,
    ]
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
  $this->add_control(
    'siema_startIndex',
    [
        'label' => __('Start Index', self::$slug),
        'type' => Controls_Manager::SELECT,
        'options' => [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ],
        'default' => '1',
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_draggable',
    [
        'label' => __( 'Draggable', self::$slug ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_multipleDrag',
    [
        'label' => __( 'Multiple Drag', self::$slug ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_threshold',
    [
        'label' => __( 'Threshold', self::$slug ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 500,
                'step' => 10,
            ],
            
        ],
        'default' => [
            'unit' => 'px',
            'size' => '20',
        ],
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_loop',
    [
        'label' => __( 'Loop', self::$slug ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
  );
  $this->add_control(
    'siema_rtl',
    [
        'label' => __( 'RTL', self::$slug ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => '',
        'frontend_available' => true,
    ]
  );
  
$this->end_controls_section();
