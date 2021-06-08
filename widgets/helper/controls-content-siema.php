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

$this->end_controls_section();
