<?php

namespace Elementor_Slider_Addon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use ElementorPro\Core\Utils;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use ElementorPro\Modules\QueryControl\Module as Module_Query;

//TODO: check if you could rewrite this query stuff without elementor pro

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Elementor_Slider_Addon extends Widget_Base
{
    public static $slug = 'elementor-slider-addon';

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('siema_slider_js', plugins_url('../assets/js/createSiema.js', __FILE__), ['elementor-frontend'], '1.0.1', true);
        wp_register_script('siema_slider_framework_js', plugins_url('../assets/js/siemaFramework.js', __FILE__), ['elementor-frontend'], '1.0.1', true);

        wp_register_style('elementor_slider_addon_css', plugins_url('../assets/css/sliderAddon.css', __FILE__));
    }

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
        return ['general'];
    }


    //#####################################################################################################################################

    public function get_script_depends()
    {
        return ['siema_slider_js', 'siema_slider_framework_js'];
    }

    public function get_style_depends()
    {
        return ['elementor_slider_addon_css'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content Type', self::$slug),
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

        //###################################
        // STYLING
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
                    '{{WRAPPER}}' => ' --grid-column-gap: {{SIZE}}{{UNIT}}',
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
                'label' => __('Static Content', 'elementor-pro'),
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
    }

    protected function render()
    {
        $this->render_navigation_elements();
        if ($this->get_settings('slide-content') == 'query') {
            //render query
            $this->query_posts();

            $wp_query = $this->get_query();

            $this->get_posts_tags();

            $this->render_loop_header();


            while ($wp_query->have_posts()) {
                $wp_query->the_post();

                $this->render_post();
            }

            $this->render_loop_footer();

            wp_reset_postdata();
        } elseif ($this->get_settings('slide-content') == 'static') {
            //render static content
            $this->render_loop_header();

            $items = $this->get_settings('repeater');
            if ($items) {
                foreach ($items as $item) {
                    $this->render_static_item($item);
                }
            }

            $this->render_loop_footer();
        }
    }

    protected function render_navigation_elements()
    {
        //add the navigation elements if wanted
        if (!$this->get_settings('show_navigation')) {
            return;
        }
        ?>
        <div class="arrow-right prev">
            <?php
            Icons_Manager::render_icon($this->get_settings('icon-prev'), ['aria-hidden' => 'true']);
            ?>
        </div>
        <div class="arrow-left next">
            <?php
            Icons_Manager::render_icon($this->get_settings('icon-next'), ['aria-hidden' => 'true']);
            ?>
        </div>
        <?php
    }

    public function query_posts()
    {
        $query_args = [
            'posts_per_page' => $this->get_settings('posts_per_page'),
        ];

        /** @var Module_Query $elementor_query */
        $elementor_query = Module_Query::instance();
        $this->_query = $elementor_query->get_query($this, 'posts', $query_args, []);
    }

    public function get_query()
    {
        return $this->_query;
    }

    protected function get_posts_tags()
    {
        $taxonomy = $this->get_settings('taxonomy');

        foreach ($this->_query->posts as $post) {
            if (!$taxonomy) {
                $post->tags = [];

                continue;
            }

            $tags = wp_get_post_terms($post->ID, $taxonomy);

            $tags_slugs = [];

            foreach ($tags as $tag) {
                $tags_slugs[$tag->term_id] = $tag;
            }

            $post->tags = $tags_slugs;
        }
    }

    protected function render_loop_header()
    {
        if ($this->get_settings('show_filter_bar')) {
            $this->render_filter_menu();
        } ?>
        <div class="elementor-slider-addon elementor-grid elementor-posts-container siema" data-overflow="<?php echo $this->get_settings('section_overflow') ? '' : 'hidden'; ?>">
        <?php
    }

    protected function render_post()
    {
        $this->render_post_header();
        $this->render_post_thumbnail();
        $this->render_post_content();
        $this->render_footer();
    }

protected function render_post_header()
{
    global $post;

    $tags_classes = array_map(function ($tag) {
        return 'elementor-filter-' . $tag->term_id;
    }, $post->tags);

    $classes = [
        'elementor-slider-addon-item',
        'elementor-post',
        implode(' ', $tags_classes),
    ]; ?>
    <article <?php post_class($classes); ?>>
    <?php
}

    protected function render_post_thumbnail()
    {
        $settings = $this->get_settings();

        $settings['thumbnail_size'] = [
            'id' => get_post_thumbnail_id(),
        ];

        $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail_size'); ?>

        <a class="elementor-post__thumbnail__link" href="<?php echo get_permalink(); ?>">
            <div class="elementor-slider-addon-item__img elementor-post__thumbnail">
                <?php echo $thumbnail_html; ?>
            </div>
        </a>

        <?php
    }

    protected function render_post_content()
    {
        $this->render_text_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_post_title();
        $this->render_post_categories();
        $this->render_post_excerpt();
        $this->render_post_read_more();
        $this->render_text_footer();
    }

protected function render_text_header()
{
    ?>
    <div class="elementor-slider-addon-item__text">
    <?php
}

protected function render_post_title()
{
    if (!$this->get_settings('show_title')) {
        return;
    }

    $tag = Utils::validate_html_tag($this->get_settings('title_tag')); ?>
    <<?php echo $tag; ?> class="elementor-slider-addon-item__title">
    <?php the_title(); ?>
    </<?php echo $tag; ?>>
    <?php
}

    protected function render_post_categories()
    {
        if (!$this->get_settings('show_categories')) {
            return;
        }
        $categories = get_the_category();
        if (!empty($categories)) {
            $separator = ' ';
            $output = '<div class="elementor-slider-addon-item__categories">';
            foreach ($categories as $category) {
                $output .= '<a class="elementor-slider-addon-item__category" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>' . $separator;
            }
            $output .= '</div>';
            echo trim($output, $separator);
        }
    }

    protected function render_post_excerpt()
    {
        if (!$this->get_settings('show_excerpt')) {
            return;
        } ?>
        <div class="elementor-slider-addon-item__excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }

    protected function render_post_read_more()
    {
        if (!$this->get_settings('show_read_more')) {
            return;
        } ?>
        <a class="elementor-post__read-more" href="<?php echo $this->current_permalink; ?>">
            <?php echo $this->get_settings('read_more_text');
            Icons_Manager::render_icon($this->get_settings('read_more_symbol'), ['aria-hidden' => 'true']); ?>
        </a>
        <?php
    }

    protected function render_text_footer()
    {
        ?>
        </div>
        <?php
    }

    protected function render_footer()
    {
        ?>
        </article>
        <?php
    }

    protected function render_loop_footer()
    {
        ?>
        </div>
        <?php
    }

    protected function render_static_item($item)
    {
        $this->render_static_header();
        $this->render_static_thumbnail($item);
        $this->render_static_content($item);
        $this->render_footer();
    }

    protected function render_static_header()
    {
        ?>
        <article class='elementor-slider-addon-item'>
        <?php
    }

    protected function render_static_thumbnail($item)
    {
        ?>

        <a class="elementor-post__thumbnail__link" href="<?php echo $item['repeater_read_more_url']; ?>">
            <div class="elementor-slider-addon-item__img elementor-post__thumbnail">
                <?php echo wp_get_attachment_image($item['repeater_thumbnail']['id'], $this->get_settings('static-image_size')); ?>
            </div>
        </a>

        <?php

    }

    protected function render_static_content($item)
    {
        $this->render_text_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_static_title($item);
        $this->render_static_description($item);
        $this->render_static_read_more($item);
        $this->render_text_footer();

    }
    
    protected function render_static_title($item)
    {
        $tag = Utils::validate_html_tag($item['repeater_headline_tag']); ?>
        <<?php echo $tag; ?> class="elementor-slider-addon-item__title">
        <?php echo $item['repeater_headline'] ?>
        </<?php echo $tag; ?>>
        <?php
    }

    protected function render_static_description($item)
    {
        ?>
        <div class="elementor-slider-addon-item__excerpt">
            <?php echo $item['repeater_description'] ?>
        </div>
        <?php

    }

    protected function render_static_read_more($item)
    {
        if (!$item['repeater_read_more_url']) {
            return;
        }
        ?>
        <a class="elementor-post__read-more" href="<?php echo $item['repeater_read_more_url']; ?>">
            <?php
            echo $item['repeater_read_more_text'];
            Icons_Manager::render_icon($item['repeater_read_more_icon'], ['aria-hidden' => 'true']);
            ?>
        </a>
        <?php

    }
}
