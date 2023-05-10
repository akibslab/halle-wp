<?php

/**
 * halle_scripts description
 * @return [type] [description]
 */
function halle_scripts() {

    /**
     * all css files
     */

    // wp_enqueue_style('halle-fonts', halle_fonts_url(), [], '1.0.0');

    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', STARTER_THEME_CSS_DIR . 'bootstrap.rtl.min.css', []);
    } else {
        wp_enqueue_style('bootstrap', STARTER_THEME_CSS_DIR . 'bootstrap.min.css', []);
    }
    wp_enqueue_style('owl-carousel', STARTER_THEME_CSS_DIR . 'owl.carousel.min.css', []);
    wp_enqueue_style('lightbox', STARTER_THEME_CSS_DIR . 'lightbox.min.css', []);
    wp_enqueue_style('halle-core', STARTER_THEME_CSS_DIR . 'halle-core.css', []);
    wp_enqueue_style('halle-unit', STARTER_THEME_CSS_DIR . 'halle-unit.css', []);
    wp_enqueue_style('halle-responsive', STARTER_THEME_CSS_DIR . 'halle-responsive.css', []);
    wp_enqueue_style('halle-custom', STARTER_THEME_CSS_DIR . 'halle-custom.css', []);
    wp_enqueue_style('halle-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', STARTER_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('owl-carousel', STARTER_THEME_JS_DIR . 'owl.carousel.min.js', ['jquery'], '', true);
    wp_enqueue_script('isotope-pkgd', STARTER_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('lightbox', STARTER_THEME_JS_DIR . 'lightbox.min.js', ['jquery'], false, true);
    wp_enqueue_script('googlemap', 'https://maps.google.com/maps/api/js?key=AIzaSyDthaqv4kJg7rlueGHuBXek7O1KDeWpT-I&sensor=false', ['jquery'], false, true);
    wp_enqueue_script('halle-main', STARTER_THEME_JS_DIR . 'main.js', ['jquery'], false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'halle_scripts');

/*
Register Fonts
 */
function halle_fonts_url() {
    $font_url = '';
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'halle')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap';
    }
    return $font_url;
}
