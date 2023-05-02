<?php

/**
 * halle customizer
 *
 * @package halle
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Added Panels & Sections
 */
function halle_customizer_panels_sections($wp_customize) {

  //Add panel
  $wp_customize->add_panel('halle_customizer', [
    'priority' => 10,
    'title'    => esc_html__('Halle47 Customizer', 'halle'),
  ]);

  /**
   * Customizer Section
   * 
   * General
   */
  // $wp_customize->add_section('halle_theme_general_settings', [
  //   'title'       => esc_html__('General', 'halle'),
  //   'description' => '',
  //   'priority'    => 10,
  //   'capability'  => 'edit_theme_options',
  //   'panel'       => 'halle_customizer',
  // ]);
  // Logos & Favicon
  $wp_customize->add_section('halle_theme_logos_favicon', [
    'title'       => esc_html__('Site Logos', 'halle'),
    'description' => '',
    'priority'    => 11,
    'capability'  => 'edit_theme_options',
    'panel'       => 'halle_customizer',
  ]);
  // Header Top Bars
  // $wp_customize->add_section('header_top_bar', [
  //   'title'       => esc_html__('Header Top Bar', 'halle'),
  //   'description' => '',
  //   'priority'    => 12,
  //   'capability'  => 'edit_theme_options',
  //   'panel'       => 'halle_customizer',
  // ]);
  // Header Settings
  $wp_customize->add_section('header_settings', [
    'title'       => esc_html__('Header Setting', 'halle'),
    'description' => '',
    'priority'    => 12,
    'capability'  => 'edit_theme_options',
    'panel'       => 'halle_customizer',
  ]);
  // Breadcrumb Settings
  // $wp_customize->add_section('breadcrumb_setting', [
  //   'title'       => esc_html__('Breadcrumb Setting', 'halle'),
  //   'priority'    => 15,
  //   'capability'  => 'edit_theme_options',
  //   'panel'       => 'halle_customizer',
  // ]);
  // $wp_customize->add_section('blog_setting', [
  //   'title'       => esc_html__('Blog Setting', 'halle'),
  //   'description' => '',
  //   'priority'    => 15,
  //   'capability'  => 'edit_theme_options',
  //   'panel'       => 'halle_customizer',
  // ]);
  $wp_customize->add_section('footer_setting', [
    'title'       => esc_html__('Footer Settings', 'halle'),
    'description' => '',
    'priority'    => 16,
    'capability'  => 'edit_theme_options',
    'panel'       => 'halle_customizer',
  ]);
  $wp_customize->add_section('404_page', [
    'title'       => esc_html__('404 Page', 'halle'),
    'description' => '',
    'priority'    => 18,
    'capability'  => 'edit_theme_options',
    'panel'       => 'halle_customizer',
  ]);
  $wp_customize->add_section('typo_setting', [
    'title'       => esc_html__('Typography Setting', 'halle'),
    'description' => '',
    'priority'    => 21,
    'capability'  => 'edit_theme_options',
    'panel'       => 'halle_customizer',
  ]);
}
add_action('customize_register', 'halle_customizer_panels_sections');


/************************************ Customizer Fields *********************************
 * 
 * General Settings
 */
function _theme_general_settings_fields($fields) {
  // preloader
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_preloader',
    'label'    => esc_html__('Preloader?', 'halle'),
    'description' => esc_html__('Show preloader.', 'halle'),
    'section'  => 'halle_theme_general_settings',
    'default'  => '0',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  // backToTop
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_backtotop',
    'label'    => esc_html__('Back to Top', 'halle'),
    'description'    => esc_html__('Show back to top button', 'halle'),
    'section'  => 'halle_theme_general_settings',
    'default'  => '0',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  return $fields;
}
add_filter('kirki/fields', '_theme_general_settings_fields');

// logos & favicon fields
function _theme_logos_favicon_fields($fields) {
  // site logo
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'site_logo',
    'label'       => esc_html__('Site Logo', 'halle'),
    'description' => esc_html__('Upload Your Logo.', 'halle'),
    'section'     => 'halle_theme_logos_favicon',
    'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
  ];
  // navigation logo
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'navigation_logo',
    'label'       => esc_html__('Navigation Logo', 'halle'),
    'description' => esc_html__('Upload Your Logo.', 'halle'),
    'section'     => 'halle_theme_logos_favicon',
    'default'     => get_template_directory_uri() . '/assets/img/logo/site-logo.png',
  ];
  // navigation logo
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'mobile_logo',
    'label'       => esc_html__('Mobile Logo', 'halle'),
    'description' => esc_html__('Upload Your Logo.', 'halle'),
    'section'     => 'halle_theme_logos_favicon',
    'default'     => get_template_directory_uri() . '/assets/img/logo/mobile-logo.png',
  ];
  // navigation logo
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'mobile_bottom_logo',
    'label'       => esc_html__('Mobile Bottom Logo', 'halle'),
    'description' => esc_html__('Upload Your Logo.', 'halle'),
    'section'     => 'halle_theme_logos_favicon',
    'default'     => get_template_directory_uri() . '/assets/img/logo/fayat.png',
  ];

  return $fields;
}
add_filter('kirki/fields', '_theme_logos_favicon_fields');


// Header Top Bar
function _header_top_bar_fields($fields) {
  // Header Top Bar
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'header_topbar_switch',
    'label'    => esc_html__('Topbar Swicher', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => '0',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];
  // header top info
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_top_info',
    'label'    => esc_html__('Top Info', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('Free Home Delivery', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_topbar_switch',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // heder socials
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'header_social_switcher',
    'label'    => esc_html__('Header Socials', 'halle'),
    'description'    => esc_html__('Show header socials.', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => '0',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
    'active_callback' => [
      [
        'setting'  => 'header_topbar_switch',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // facebook
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_fb_link',
    'label'    => esc_html__('Facebook Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://facebook.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // instagram
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_ig_link',
    'label'    => esc_html__('Instagram Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://instagram.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // linkedin
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_linkedin_link',
    'label'    => esc_html__('Linkedin Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://linkedin.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // twitter
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_twitter_link',
    'label'    => esc_html__('Twitter Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://twitter.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // pnterest
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_pinterest_link',
    'label'    => esc_html__('Pinterest Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://pinterest.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  // youtube
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_youtube_link',
    'label'    => esc_html__('Youtube Link', 'halle'),
    'section'  => 'header_top_bar',
    'default'  => esc_html__('https://youtube.com/', 'halle'),
    'priority' => 10,
    'active_callback' => [
      [
        'setting'  => 'header_social_switcher',
        'operator' => '==',
        'value'    => true,
      ],
    ],
  ];
  return $fields;
}
add_filter('kirki/fields', '_header_top_bar_fields');

// Header Settings
function _header_setting_fields($fields) {
  // Address
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_tagline',
    'label'    => esc_html__('Header Tagline', 'halle'),
    'section'  => 'header_settings',
    'default'  => esc_html__('Tout un programme !', 'halle'),
    'priority' => 10,
  ];
  // phone
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_description',
    'label'    => esc_html__('Header Description', 'halle'),
    'section'  => 'header_settings',
    'default'  => esc_html__('Lieu de culture et d’échanges à Floirac', 'halle'),
    'priority' => 10,
  ];
  // right button text
  $fields[] = [
    'type'     => 'text',
    'settings' => 'header_right_contact_text',
    'label'    => esc_html__('Contact Text', 'halle'),
    'section'  => 'header_settings',
    'default'  => esc_html__('Contact', 'halle'),
    'priority' => 10,
  ];
  // right button link
  $fields[] = [
    'type'     => 'link',
    'settings' => 'header_right_contact_link',
    'label'    => esc_html__('Contact Link', 'halle'),
    'section'  => 'header_settings',
    'default'  => esc_html__('#', 'halle'),
    'priority' => 10,
  ];
  $fields[] = [
    'type'     => 'textarea',
    'settings' => 'header_mobile_bottom_text',
    'label'    => esc_html__('Mobile Bottom Text', 'halle'),
    'section'  => 'header_settings',
    'default'  => halle_kses('Adresse / <a href="#">Mentions légales</a> / Conception et réalisation : <a class="illusio" href="https://www.illusio.fr/" target="_blank">illusio.fr</a>'),
    'priority' => 10,
  ];

  return $fields;
}
add_filter('kirki/fields', '_header_setting_fields');

// Breadcrumb Settings
function _breadcrumb_setting_fields($fields) {
  // Breadcrumb Setting
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'breadcrumb_bg_img',
    'label'       => esc_html__('Background Image', 'halle'),
    'description' => esc_html__('', 'halle'),
    'section'     => 'breadcrumb_setting',
    // 'default'     => get_template_directory_uri() . '/assets/img/bg/page-bg.jpg',
  ];
  $fields[] = [
    'type'        => 'color',
    'settings'    => 'breadcrumb_bg_color',
    'label'       => __('Background Color', 'halle'),
    'description' => esc_html__('', 'halle'),
    'section'     => 'breadcrumb_setting',
    'default'     => '#343a40',
    'priority'    => 10,
  ];

  $fields[] = [
    'type'     => 'switch',
    'settings' => 'breadcrumb_info_switch',
    'label'    => esc_html__('Breadcrumb Info switch', 'halle'),
    'section'  => 'breadcrumb_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  return $fields;
}
add_filter('kirki/fields', '_breadcrumb_setting_fields');

/*
Header Social
*/
function _header_blog_fields($fields) {
  // Blog Setting
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_blog_btn_switch',
    'label'    => esc_html__('Blog BTN On/Off', 'halle'),
    'section'  => 'blog_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_blog_cat',
    'label'    => esc_html__('Blog Category Meta On/Off', 'halle'),
    'section'  => 'blog_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_blog_author',
    'label'    => esc_html__('Blog Author Meta On/Off', 'halle'),
    'section'  => 'blog_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_blog_date',
    'label'    => esc_html__('Blog Date Meta On/Off', 'halle'),
    'section'  => 'blog_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];
  $fields[] = [
    'type'     => 'switch',
    'settings' => 'halle_blog_comments',
    'label'    => esc_html__('Blog Comments Meta On/Off', 'halle'),
    'section'  => 'blog_setting',
    'default'  => '1',
    'priority' => 10,
    'choices'  => [
      'on'  => esc_html__('Enable', 'halle'),
      'off' => esc_html__('Disable', 'halle'),
    ],
  ];

  $fields[] = [
    'type'     => 'text',
    'settings' => 'breadcrumb_blog_title',
    'label'    => esc_html__('Blog Page Title', 'halle'),
    'section'  => 'blog_setting',
    'default'  => esc_html__('Blog', 'halle'),
    'priority' => 10,
  ];

  $fields[] = [
    'type'     => 'text',
    'settings' => 'halle_blog_btn',
    'label'    => esc_html__('Blog Button text', 'halle'),
    'section'  => 'blog_setting',
    'default'  => esc_html__('Read More', 'halle'),
    'priority' => 10,
  ];


  $fields[] = [
    'type'     => 'text',
    'settings' => 'breadcrumb_blog_title_details',
    'label'    => esc_html__('Blog Details Title', 'halle'),
    'section'  => 'blog_setting',
    'default'  => esc_html__('Blog Details', 'halle'),
    'priority' => 10,
  ];
  return $fields;
}
add_filter('kirki/fields', '_header_blog_fields');

/*
Footer
*/
function _footer_setting_fields($fields) {


  $fields[] = [
    'type'        => 'image',
    'settings'    => 'footer_logo',
    'label'       => esc_html__('Footer Logo', 'halle'),
    'section'     => 'footer_setting',
    'default'     => get_template_directory_uri() . '/assets/img/logo/fayat.png'
  ];


  $fields[] = [
    'type'     => 'textarea',
    'settings' => 'footer_text',
    'label'    => esc_html__('Footer Text', 'halle'),
    'section'  => 'footer_setting',
    'default'  => halle_kses('<a href="#">Adresse</a> / <a href="#">Mentions légales</a> / Conception et réalisation : <a href="https://www.illusio.fr/" target="_blank">illusio.fr</a>'),
    'priority' => 10,
  ];

  return $fields;
}
add_filter('kirki/fields', '_footer_setting_fields');


// 404
function halle_404_fields($fields) {
  // 404 settings
  $fields[] = [
    'type'        => 'image',
    'settings'    => 'halle_404_bg',
    'label'       => esc_html__('404 Image.', 'halle'),
    'description' => esc_html__('404 Image.', 'halle'),
    'section'     => '404_page',
  ];
  $fields[] = [
    'type'     => 'text',
    'settings' => 'halle_error_title',
    'label'    => esc_html__('Not Found Title', 'halle'),
    'section'  => '404_page',
    'default'  => esc_html__('Page not found', 'halle'),
    'priority' => 10,
  ];
  $fields[] = [
    'type'     => 'textarea',
    'settings' => 'halle_error_desc',
    'label'    => esc_html__('404 Description Text', 'halle'),
    'section'  => '404_page',
    'default'  => esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted', 'halle'),
    'priority' => 10,
  ];
  $fields[] = [
    'type'     => 'text',
    'settings' => 'halle_error_link_text',
    'label'    => esc_html__('404 Link Text', 'halle'),
    'section'  => '404_page',
    'default'  => esc_html__('Back To Home', 'halle'),
    'priority' => 10,
  ];
  return $fields;
}
add_filter('kirki/fields', 'halle_404_fields');


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function Halle47_Theme_option($name) {
  $value = '';
  if (class_exists('halle')) {
    $value = Kirki::get_option(halle_get_theme(), $name);
  }

  return apply_filters('Halle47_Theme_option', $value, $name);
}

/**
 * Get config ID
 *
 * @return string
 */
function halle_get_theme() {
  return 'halle';
}
