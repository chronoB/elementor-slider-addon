<?php

namespace Elementor_Slider_Addon\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use ElementorPro\Core\Utils;
//TODO: check if you could rewrite this query stuff without elementor pro
use ElementorPro\Modules\QueryControl\Module as Module_Query;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Elementor_Slider_Addon extends Widget_Base
{
    public static $slug = 'elementor-slider-addon';

    public function get_name()
    {
        return self::$slug;
    }

    public function get_title()
    {
        return __('Elementor Slider Addon', self::$slug);
    }

    public function get_icon()
    {
        return 'fa fa-stream';
    }

    public function get_categories()
    {
        return [ 'general' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content Type', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        //Selector if the content is static or should come from a query
        $this->add_control(
            'slide-content',
            [
                'label' => __('Slider Content', self::$slug),
                'type' => \Elementor\Controls_Manager::SELECT,
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
				'label' => __( 'Number of Slides', self::$slug ),
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
				/*
                TODO: Add stuff here to add functionality! -> this code is copied from the portfolio of elementor pro
                'prefix_class' => 'elementor-grid%s-',
				'frontend_available' => true,
				'selectors' => [
					'.elementor-msie {{WRAPPER}} .elementor-portfolio-item' => 'width: calc( 100% / {{SIZE}} )',
				],*/
			]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'static_content_section',
            [
                'label' => __('Static Content', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slide-content' => 'static'
                ]
            ]
        );
        /* TODO: Add the repeater for the static slides.
        // Use the repeater to define one one set of the items we want to repeat look like
        $repeater = new Repeater();

        $repeater->add_control(
            'option_value',
            [
                'label' => __('Option Value', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("Gysi über seinen Fußball-Sachverstand:", self::$slug),
                'placeholder' => __('Value Attribute', self::$slug),
            ]
        );

        $repeater->add_control(
            'option_contents',
            [
                'label' => __('Option Contents', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('"Ich bin der klassische deutsche Sachverständige von Fußball: Ich habe keine Ahnung, schaue mir alles an und weiß alles besser. ... Nicht, dass ich wirklich was davon verstünde. Aber das schätze ich ja auch, trotzdem dann meine Meinung zu sagen."', self::$slug),
                'placeholder' => __('Option Contents', self::$slug),
            ]
        );

        $repeater->add_control(
            'option_image',
            [
                'label' => __('Choose Image', self::$slug),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Add the
        $this->add_control(
            'options_list',
            [
                'label' => __('Repeater List', self::$slug),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
                'title_field' => '{{{ option_value }}}'
            ]
        );*/
        $this->end_controls_section();
        
        $this->start_controls_section(
            'query_content_section',
            [
                'label' => __('Query', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slide-content' => 'query'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Related::get_type(),
			[
				'name' => 'posts',
				'presets' => [ 'full' ],
				'exclude' => [
					'posts_per_page', //use the one from Layout section
				],
			]
		);
        $this->add_control(
            'show_title',
            [
                'label' => __('Show Title', self::$slug),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
        $this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', self::$slug ),
				'type' => \Elementor\Controls_Manager::SELECT,
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
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Excerpt', self::$slug),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'navigation_content_section',
            [
                'label' => __('Navigation', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'navigation_show',
            [
                'label' => __( 'Show', self::$slug ),
				'type' => \Elementor\Controls_Manager::SWITCHER ,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
        $this->add_control(
			'navigation_position',
			[
				'label' => __( 'Position', self::$slug ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Above', self::$slug ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Around', self::$slug ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Below', self::$slug ),
						'icon' => 'fa fa-align-right',
					],
				],
                'condition' => [
                    'navigation_show' => 'yes'
                ],
				'default' => 'center',
				'toggle' => true,
			]
		);
        $this->add_control(
			'navigation_alignment',
			[
				'label' => __( 'Alignment', self::$slug ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', self::$slug ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', self::$slug ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', self::$slug ),
						'icon' => 'fa fa-align-right',
					],
				],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'navigation_show',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'navigation_position',
                            'operator' => '!=',
                            'value' => 'center'
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
				'label' => __( 'Previous Icon', self::$slug ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'navigation_show' => 'yes'
                ],
				'skin' => 'inline',
				'label_block' => false,
				'frontend_available' => true,
			]
		);
        $this->add_control(
			'icon-next',
			[
				'label' => __( 'Next Icon', self::$slug ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'navigation_show' => 'yes'
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
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->end_controls_section();

        //###################################
        // STYLING
        $this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'General', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        //Option to add distance between elements
        $this->add_control(
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => ' --grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
        // Option to Show/Hide Overflow
        $this->add_control(
            'section_overflow',
            [
                'label' => __( 'Section Overflow', self::$slug),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', self::$slug ),
				'label_off' => __( 'Hide', self::$slug ),
				'return_value' => 'yes',
				'default' => 'yes',

            ]
        );

    }

    public function query_posts() {

		$query_args = [
			'posts_per_page' => $this->get_settings( 'posts_per_page' ),
		];

		/** @var Module_Query $elementor_query */
		$elementor_query = Module_Query::instance();
		$this->_query = $elementor_query->get_query( $this, 'posts', $query_args, [] );
	}
	public function get_query() {
		return $this->_query;
	}
    protected function get_posts_tags() {
		$taxonomy = $this->get_settings( 'taxonomy' );

		foreach ( $this->_query->posts as $post ) {
			if ( ! $taxonomy ) {
				$post->tags = [];

				continue;
			}

			$tags = wp_get_post_terms( $post->ID, $taxonomy );

			$tags_slugs = [];

			foreach ( $tags as $tag ) {
				$tags_slugs[ $tag->term_id ] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}

    protected function render_loop_header() {
		if ( $this->get_settings( 'show_filter_bar' ) ) {
			$this->render_filter_menu();
		}
		?>
		<div class="elementor-slider-addon elementor-grid elementor-posts-container siema" style="overflow:<?php echo $this->get_settings( 'section_overflow' ) ? 'scroll' : 'hidden'; ?>">
		<?php
	}

	protected function render_loop_footer() {
		?>
		</div>
		<?php
	}
    protected function render_post_header() {
		global $post;

		$tags_classes = array_map( function( $tag ) {
			return 'elementor-filter-' . $tag->term_id;
		}, $post->tags );

		$classes = [
			'elementor-slider-item',
			'elementor-post',
			implode( ' ', $tags_classes ),
		];

		?>
		<article <?php post_class( $classes ); ?>>
			<a class="elementor-post__thumbnail__link" href="<?php echo get_permalink(); ?>">
		<?php
	}

	protected function render_post_footer() {
		?>
		</a>
		</article>
		<?php
	}
    protected function render_text_header() {
		?>
		<div class="elementor-slider-item__text">
		<?php
	}

	protected function render_text_footer() {
		?>
		</div>
		<?php
	}
	protected function render_title() {
		if ( ! $this->get_settings( 'show_title' ) ) {
			return;
		}

		$tag = Utils::validate_html_tag( $this->get_settings( 'title_tag' ) );
		?>
		<<?php echo $tag; ?> class="elementor-slider-item__title">
		<?php the_title(); ?>
		</<?php echo $tag; ?>>
		<?php
	}
    protected function render_categories() {
        if ( ! $this->get_settings( 'show_categories' ) ) {
			return;
		}
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $separator = ' ';
            $output = '<div class="elementor-slider-item__categories">';
            foreach( $categories as $category ) {
                
                $output .= '<a class="elementor-slider-item__category" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
            $output .= '</div>';
            echo trim( $output, $separator );
        }
    }
    protected function render_excerpt() {
        if ( ! $this->get_settings( 'show_excerpt' ) ) {
			return;
		}
        ?>
            <div class="elementor-slider-item__excerpt">
                <?php the_excerpt(); ?>
            </div>
		<?php

    }
    protected function render_thumbnail() {
		$settings = $this->get_settings();

		$settings['thumbnail_size'] = [
			'id' => get_post_thumbnail_id(),
		];

		$thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
		?>
		<div class="elementor-portfolio-item__img elementor-post__thumbnail">
			<?php echo $thumbnail_html; ?>
		</div>
		<?php
	}

    protected function render_post_content(){
		$this->render_text_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
		$this->render_title();
        $this->render_categories();
        $this->render_excerpt();
		$this->render_text_footer();
    }

    protected function render_post() {
		$this->render_post_header();
		$this->render_thumbnail();
        $this->render_post_content();
		$this->render_post_footer();
	}

    protected function render()
    {
        if ($this->get_settings( 'slide-content' ) == 'query'){
            //render query
            $this->query_posts();

            $wp_query = $this->get_query();

            $this->get_posts_tags();
            $this->render_loop_header();

            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();

                $this->render_post();
            }

            $this->render_loop_footer();

            wp_reset_postdata();

        }else if($this->get_settings('slide-content') == 'static'){
            //render static content
            //$items = $this->get_settings('lists')
        }
		
    }


    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script('siema_slider_js', plugins_url('/assets/js/siema.js', __FILE__), [ 'elementor-frontend' ], '1.0.1', true);
    }

    public function get_script_depends()
    {
        return [ 'siema_slider_js' ];
    }

    public function get_style_depends()
    {
        return [  ];
    }
}
