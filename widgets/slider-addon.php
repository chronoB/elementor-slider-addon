<?php

namespace Elementor_Slider_Addon\Widgets;

use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Core\Utils;
use Elementor\Group_Control_Image_Size;

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
        include_once('helper/controls.php');
        
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
        <div class="elementor-slider-addon elementor-grid elementor-posts-container siema" style="overflow:<?php echo $this->get_settings('section_overflow') ? '' : 'hidden'; ?>">
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

        <a class="elementor-slider-addon-item-thumbnail" href="<?php echo get_permalink(); ?>">
            <div class="elementor-slider-addon-item__thumbnail__img">
                <?php echo $thumbnail_html; ?>
            </div>
        </a>

        <?php
    }

    protected function render_post_content()
    {
        $this->render_content_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_post_title();
        $this->render_post_categories();
        $this->render_post_excerpt();
        $this->render_post_read_more();
        $this->render_content_footer();
    }

    protected function render_content_header()
    {
        ?>
        <div class="elementor-slider-addon-item-content">
        <?php
    }

    protected function render_post_title()
    {
        if (!$this->get_settings('show_title')) {
            return;
        }

        $tag = Utils::validate_html_tag($this->get_settings('title_tag')); ?>
        <<?php echo $tag; ?> class="elementor-slider-addon-item-content__title">
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
            $output = '<div class="elementor-slider-addon-item-content__categories">';
            foreach ($categories as $category) {
                $output .= '<a class="elementor-slider-addon-item-content__category" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>' . $separator;
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
        <div class="elementor-slider-addon-item-content__excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }

    protected function render_post_read_more()
    {
        if (!$this->get_settings('show_read_more')) {
            return;
        } ?>
        <a class="elementor-slider-addon-item-content__read-more" href="<?php echo $this->current_permalink; ?>">
            <?php echo $this->get_settings('read_more_text');
            Icons_Manager::render_icon($this->get_settings('read_more_symbol'), ['aria-hidden' => 'true']); ?>
        </a>
        <?php
    }

    protected function render_content_footer()
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

        <a class="elementor-slider-addon-item-thumbnail" href="<?php echo $item['repeater_read_more_url']; ?>">
            <div class="elementor-slider-addon-item-thumbnail__img">
                <?php echo wp_get_attachment_image($item['repeater_thumbnail']['id'], $this->get_settings('static-image_size')); ?>
            </div>
        </a>

        <?php

    }

    protected function render_static_content($item)
    {
        $this->render_content_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_static_title($item);
        $this->render_static_description($item);
        $this->render_static_read_more($item);
        $this->render_content_footer();

    }
    
    protected function render_static_title($item)
    {
        $tag = Utils::validate_html_tag($item['repeater_headline_tag']); ?>
        <<?php echo $tag; ?> class="elementor-slider-addon-item-content__title">
        <?php echo $item['repeater_headline'] ?>
        </<?php echo $tag; ?>>
        <?php
    }

    protected function render_static_description($item)
    {
        ?>
        <div class="elementor-slider-addon-item-content__excerpt">
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
        <a class="elementor-slider-addon-item-content__read-more" href="<?php echo $item['repeater_read_more_url']; ?>">
            <?php
            echo $item['repeater_read_more_text'];
            Icons_Manager::render_icon($item['repeater_read_more_icon'], ['aria-hidden' => 'true']);
            ?>
        </a>
        <?php

    }
}
