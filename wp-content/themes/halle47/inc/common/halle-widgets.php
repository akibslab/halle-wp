<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function halle_widgets_init() {
    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'halle'),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="ss-sidebar__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="ss-sidebar-widget__head"><h3 class="ss-sidebar-widget__title">',
        'after_title'   => '</h3></div>',
    ]);


    $footer_columns = get_theme_mod('footer_widget_column', 4);
    // footer default
    for ($num = 1; $num <= $footer_columns; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer Column %1$s', 'halle'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('This widget content will be show widget %1$s', 'halle'), $num),
            'before_widget' => '<div id="%1$s" class="ss-footer__widget footer-column__' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="ss-footer-widget_title">',
            'after_title'   => '</h5>',
        ]);
    }
}
add_action('widgets_init', 'halle_widgets_init');
