<?php

/**
 * Breadcrumbs for Halle47 theme.
 *
 * @package     Halle47
 * @author      Securesofts
 * @copyright   Copyright (c) 2022, Securesofts
 * @link        https://itanvir.net
 * @since       Halle47 1.0.0
 */

function halle_breadcrumb_func() {
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    // title
    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'halle'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'halle'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_single() && 'product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'halle'));
    } elseif (is_single() && 'courses' == get_post_type()) {
        $title = esc_html__('Course Details', 'halle');
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'halle') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'halle');
    } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
        $title = get_theme_mod('breadcrumb_shop', __('Shop', 'halle'));
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    // id
    $_id = get_the_ID();

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';

    if (!empty($_GET['s'])) {
        $is_breadcrumb = null;
    }

    if (empty($is_breadcrumb) && $breadcrumb_show == 1) {

        $halle_page_bg_image = function_exists('get_field') ? get_field('breadcrumb_background_image', $_id) : '';
        $customizer_bg_img = get_theme_mod('breadcrumb_bg_img');

        $bg_color = get_theme_mod('breadcrumb_bg_color', '#343a40');

        $breadcrumb_info_switch = get_theme_mod('breadcrumb_info_switch', true);

        if (is_single() && 'post' == get_post_type()) {
            $bg_img = has_post_thumbnail() ? get_the_post_thumbnail_url() : $customizer_bg_img;
        } elseif (!empty($halle_page_bg_image)) {
            $bg_img = $halle_page_bg_image['url'];
        } else {
            $bg_img = $customizer_bg_img;
        }
?>

        <!-- page title area start -->
        <section class="ss-breadcrumb__area d-flex align-items-center <?php print esc_attr($breadcrumb_class); ?>" data-bg-color="<?php echo esc_attr($bg_color); ?>" data-background="<?php echo esc_url($bg_img); ?>">
            <?php if (!empty($breadcrumb_info_switch)) : ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="ss-breadcrumb__wrapper">
                                <div class="ss-breadcrumb__menu">
                                    <?php if (function_exists('bcn_display')) {
                                        bcn_display();
                                    } ?>
                                </div>
                                <h3 class="ss-breadcrumb__title"><?php echo halle_kses($title); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <!-- page title area end -->
    <?php
    }
}
add_action('halle_before_main_content', 'halle_breadcrumb_func');

// halle_search_form
function halle_search_form() {
    ?>

    <!-- modal-search-start -->
    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                    <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Enter Your Keyword', 'halle'); ?>">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- modal-search-end -->
<?php
}
add_action('halle_before_main_content', 'halle_search_form');
