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
        wp_register_script('item_ratio_js', plugins_url('../assets/js/itemRatio.js', __FILE__), ['elementor-frontend'], '1.0.1', true);
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
        return __('Elementor Slider Addon', 'elementor-slider-addon');
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
        return [ 'item_ratio_js', 'siema_slider_js', 'siema_slider_framework_js'];
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
        $settings  = $this->get_settings_for_display();
        if($settings['navigation_position'] == "above" || $settings['navigation_position'] == "around"){
            $this->render_navigation_elements($settings);
        }
        if ($settings['slide-content'] == 'query') {
            //render query
            $this->query_posts($settings);

            $wp_query = $this->get_query();

            $this->get_posts_tags($settings);

            $this->render_loop_header($settings);


            while ($wp_query->have_posts()) {
                $wp_query->the_post();

                $this->render_post($settings);
            }

            $this->render_loop_footer();

            wp_reset_postdata();
        } elseif ($settings['slide-content'] == 'static') {
            //render static content
            $this->render_loop_header($settings);

            $items = $settings['repeater'];
            if ($items) {
                foreach ($items as $item) {
                    $this->render_static_item($settings, $item);
                }
            }

            $this->render_loop_footer();
        }
        if($settings['navigation_position'] == "below"){
            $this->render_navigation_elements();
        }
    }

    protected function render_navigation_elements($settings)
    {
        //add the navigation elements if wanted
        if (!$settings['show_navigation']) {
            return;
        }
        ?>
        <div class="elementor-slider-addon-arrow elementor-slider-addon-arrow-left prev">
            <?php
            Icons_Manager::render_icon($settings['icon-prev'], ['aria-hidden' => 'true']);
            ?>
        </div>
        <div class="elementor-slider-addon-arrow elementor-slider-addon-arrow-right next">
            <?php
            Icons_Manager::render_icon($settings['icon-next'], ['aria-hidden' => 'true']);
            ?>
        </div>
        <?php
    }

    public function query_posts($settings)
    {
        $query_args = [
            'posts_per_page' => $settings['number_posts'],
        ];
        /** @var Module_Query $elementor_query */
        $elementor_query = Module_Query::instance();
        $this->_query = $elementor_query->get_query($this, 'posts', $query_args, []);
    }

    public function get_query()
    {
        return $this->_query;
    }

    protected function get_posts_tags($settings)
    {
        $taxonomy = $settings['taxonomy'];

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

    protected function render_loop_header($settings)
    {
        if ($settings['show_filter_bar']) {
            $this->render_filter_menu();
        } ?>
        <div class="elementor-slider-addon elementor-grid elementor-posts-container siema" style="overflow:<?php echo $settings['siema_overflow'] ? '' : 'hidden'; ?>">
        <?php
    }

    protected function render_post($settings)
    {
        $this->render_post_header($settings);
        $this->render_post_thumbnail($settings);
        $this->render_post_content($settings);
        $this->render_footer($settings);
    }

    protected function render_post_header($settings)
    {
        global $post;

        $tags_classes = array_map(function ($tag) {
            return 'elementor-filter-' . $tag->term_id;
        }, $post->tags);

        $classes = [
            'elementor-slider-addon-item',
            'elementor-post',
            $settings['content_above_thumbnail'] ?  'content-above-thumbnail' :  '',
            implode(' ', $tags_classes),
        ]; ?>
        <article <?php post_class($classes);?>>
        <?php
    }

    protected function render_post_thumbnail($settings)
    {
        ?>

        <a class="elementor-slider-addon-item-thumbnail" href="<?php echo get_permalink(); ?>">
            <div class="elementor-slider-addon-item-thumbnail__img elementor-post__thumbnail">
                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), $settings['query-image_size']); ?>
            </div>
        </a>

        <?php
    }

    protected function render_post_content($settings)
    {
        $this->render_content_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_post_title($settings);
        $this->render_post_categories($settings);
        $this->render_post_excerpt($settings);
        $this->render_post_read_more($settings);
        if($this->get_query()->query["post_type"]==="product")
            $this->render_post_product($settings);
        $this->render_content_footer();
    }

    protected function render_content_header()
    {
        ?>
        <div class="elementor-slider-addon-item-content">
        <?php
    }

    protected function render_post_title($settings)
    {
        if (!$settings['show_title']) {
            return;
        }
        

        $tag = Utils::validate_html_tag($settings['title_tag']); ?>
        <<?php echo $tag; ?> class="elementor-slider-addon-item-content__title" style="order:<?php echo $settings['title_order'] ?>">
        <?php
        if($settings['slide-content']=="query" && $settings['query_title_as_link']){
            ?>
            <a href="<?php echo $item['repeater_read_more_url']['url'] ?>">
                <?php
                the_title();
                ?>
            </a>
            <?php
        }
        else{
            the_title();
        }
        ?>
        </<?php echo $tag; ?>>
        <?php
    }

    protected function render_post_categories($settings)
    {
        if (!$settings['show_categories']) {
            return;
        }
        $categories = get_the_category();
        if (!empty($categories)) {
            $separator = $settings['category_delimiter'];
            $output = '<div class="elementor-slider-addon-item-content__categories" style="order:' . $settings['categories_order'] . '">';
            foreach ($categories as $category) {
                $output .= '<a class="elementor-slider-addon-item-content__category" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>' . $separator;
            }
            $output=rtrim($output, $settings['category_delimiter']);
            $output .= '</div>';
            echo trim($output, $separator);
        }
    }

    protected function render_post_excerpt($settings)
    {
        if (!$settings['show_excerpt']) {
            return;
        } ?>
        <div class="elementor-slider-addon-item-content__excerpt" style="order:<?php echo $settings['excerpt_order'] ?>">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }

    protected function render_post_product($settings)
    {
        if (!$settings['show_product_data']) {
            return;
        } 
        ?>
        
        <div class="elementor-slider-addon-item-content__product" style="order:<?php echo $settings['excerpt_order'] ?>">
            <?php 
                global $post;
                do_action( 'woocommerce_after_shop_loop_item' );
                do_shortcode( '[add_to_cart id="' . $post->ID . '"]' );
            ?>
        </div>
        <?php
    }

    protected function render_post_read_more($settings)
    {
        if (!$settings['show_read_more']) {
            return;
        } ?>
        <a class="elementor-slider-addon-item-content__read-more" href="<?php echo $this->current_permalink; ?>"style="order:<?php echo $settings['read-more_order'] ?>">
            <span><?php echo $settings['read_more_text'];?></span>
            <?php Icons_Manager::render_icon($settings['read_more_symbol'], ['aria-hidden' => 'true']); ?>
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

    protected function render_static_item($settings, $item)
    {
        $this->render_static_header($settings);
        $this->render_static_thumbnail($settings, $item);
        $this->render_static_content($settings, $item);
        $this->render_footer($settings);
    }

    protected function render_static_header($settings)
    {
        ?>
        <article class='elementor-slider-addon-item <?php echo $settings['content_above_thumbnail'] ?  'content-above-thumbnail' :  ''; ?>'>
        <?php
    }

    protected function render_static_thumbnail($settings, $item)
    {
        ?>
        <a class="elementor-slider-addon-item-thumbnail" href="<?php echo $item['repeater_read_more_url']['url']; ?>">
            <div class="elementor-slider-addon-item-thumbnail__img elementor-post__thumbnail">
                <?php echo wp_get_attachment_image($item['repeater_thumbnail']['id'], $settings['static-image_size']); ?>
            </div>
        </a>

        <?php

    }

    protected function render_static_content($settings, $item)
    {
        $this->render_content_header();
        //TODO: Anordnung der Elemente als control anlegen und hier anpassen (oder per grid?)
        $this->render_static_title($settings, $item);
        $this->render_static_description($settings, $item);
        $this->render_static_read_more($settings, $item);
        $this->render_content_footer();

    }
    
    protected function render_static_title($settings, $item)
    {
        $tag = Utils::validate_html_tag($item['repeater_headline_tag']); ?>
        <<?php echo $tag; ?> class="elementor-slider-addon-item-content__title" style="order:<?php echo $settings['title_order'] ?>">
        <?php 
        if($settings['static_title_as_link']){
            ?>
            <a href="<?php echo $item['repeater_read_more_url']['url'] ?>">
            <?php
            echo $item['repeater_headline'] ;
            ?>
            </a>
            <?php
        }
        else{
            echo $item['repeater_headline'] ;
        }
        
        ?>
        </<?php echo $tag; ?>>
        <?php
    }

    protected function render_static_description($settings, $item)
    {
        ?>
        <div class="elementor-slider-addon-item-content__excerpt" style="order:<?php echo $settings['excerpt_order'] ?>">
            <?php echo $item['repeater_description'] ?>
        </div>
        <?php

    }

    protected function render_static_read_more($settings, $item)
    {
        if (!$item['repeater_read_more_url']) {
            return;
        }
        ?>
        <a class="elementor-slider-addon-item-content__read-more" href="<?php echo $item['repeater_read_more_url']['url']; ?>" style="order:<?php echo $settings['read-more_order'] ?>">
            <span><?php echo $item['repeater_read_more_text'];?></span>
            <?php Icons_Manager::render_icon($item['repeater_read_more_icon'], ['aria-hidden' => 'true']);
            ?>
        </a>
        <?php

    }
}
