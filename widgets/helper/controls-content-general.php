<?php
use Elementor\Controls_Manager;

$this->start_controls_section(
    'general',
    [
        'label' => __('General', 'elementor-slider-addon'),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
//Selector if the content is static or should come from a query
$this->add_control(
    'slide-content',
    [
        'label' => __('Slider Content', 'elementor-slider-addon'),
        'type' => Controls_Manager::SELECT,
        'default' => 'query',
        'options' => [
            'static' => __('Static', 'elementor-slider-addon'),
            'query' => __('Query', 'elementor-slider-addon'),
        ],
    ]
);
$this->add_control(
    'number_posts',
    [
        'label' => __( 'Number of Posts', 'elementor-slider-addon' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 6,
    ]
);
$this->add_responsive_control(
  'number-slides',
  [
      'label' => __('Number of Slides', 'elementor-slider-addon'),
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
