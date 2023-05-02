<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_Gallery extends Widget_Base {

  /**
   * Retrieve the widget name.Gallery
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'gallery';
  }

  /**
   * Retrieve the widget title.
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __('SS Gallery', 'ss-addons');
  }

  /**
   * Retrieve the widget icon.
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'ss-icon  eicon-accordion';
  }

  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return ['ss-addons'];
  }

  /**
   * Retrieve the list of scripts the widget depended on.
   *
   * Used to set scripts dependencies required to run the widget.
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return array Widget scripts dependencies.
   */
  public function get_script_depends() {
    return ['ss-addons'];
  }

  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.0.0
   *
   * @access protected
   */
  protected function register_controls() {

    // layout Panel
    $this->start_controls_section(
      'ss_desktop',
      [
        'label' => esc_html__('Desktop', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_desktop_default',
      [
        'label' => esc_html__('Default Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/gallery/1.jpg',
        ],
      ]
    );
    $this->add_control(
      'ss_desktop_hover',
      [
        'label' => esc_html__('Hover Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/gallery/2.jpg',
        ],
      ]
    );
    $this->end_controls_section();

    // layout Panel
    $this->start_controls_section(
      'ss_mobile',
      [
        'label' => esc_html__('Mobile', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_mobile_default',
      [
        'label' => esc_html__('Default Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/gallery/mobile-1.png',
        ],
      ]
    );
    $this->add_control(
      'ss_mobile_hover',
      [
        'label' => esc_html__('Hover Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/gallery/mobile-2.png',
        ],
      ]
    );
    $this->end_controls_section();


    // TAB_STYLE
    $this->start_controls_section(
      'section_style',
      [
        'label' => __('Style', 'ss-addons'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->end_controls_section();
  }

  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   *
   * @access protected
   */
  protected function render() {
    $settings = $this->get_settings_for_display();
    $ss_desktop_default = $settings['ss_desktop_default'];
    $ss_desktop_hover = $settings['ss_desktop_hover'];
    $ss_mobile_default = $settings['ss_mobile_default'];
    $ss_mobile_hover = $settings['ss_mobile_hover'];
?>
    <!-- Gallery Section Start -->
    <section class="gallery-section" id="gallery">
      <?php if (!empty($ss_desktop_default)) : ?>
        <img class="image d-none d-md-block" src="<?php echo esc_url($ss_desktop_default['url']); ?>" data-src="<?php echo esc_url($ss_desktop_default['url']); ?>" data-hover="<?php echo esc_url($ss_desktop_hover['url']); ?>" alt="">
      <?php endif;
      if (!empty($ss_mobile_default)) : ?>
        <img class="image d-md-none" src="<?php echo esc_url($ss_mobile_default['url']); ?>" data-src="<?php echo esc_url($ss_mobile_default['url']); ?>" data-hover="<?php echo esc_url($ss_mobile_hover['url']); ?>" alt="">
      <?php endif; ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/bottom.png" class="bottom-border" alt="">
    </section>
    <!-- Gallery Section End -->

<?php
  }
}

$widgets_manager->register(new SS_Gallery());
