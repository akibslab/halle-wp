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
class SS_Subscription extends Widget_Base {

  /**
   * Retrieve the widget name.
   *
   * @since 1.0.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'subscription';
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
    return __('SS Subscription', 'ss-addons');
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
    return 'ss-icon  eicon-form-vertical';
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


  public function get_ss_contact_form() {
    if (!class_exists('WPCF7')) {
      return;
    }
    $ss_cfa         = array();
    $ss_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
    $ss_forms       = get_posts($ss_cf_args);
    $ss_cfa         = ['0' => esc_html__('Select Form', 'ss-addons')];
    if ($ss_forms) {
      foreach ($ss_forms as $ss_form) {
        $ss_cfa[$ss_form->ID] = $ss_form->post_title;
      }
    } else {
      $ss_cfa[esc_html__('No contact form found', 'ss-addons')] = 0;
    }
    return $ss_cfa;
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
      'ss_heading',
      [
        'label' => esc_html__('Section Title', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_section_title',
      [
        'label' => esc_html__('Section Title', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => Controls_Manager::TEXT,
        'default' => ss_kses('Contact <br> <b>suivre notre actualité</b>'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'ss_section_description',
      [
        'label' => esc_html__('Section Description', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => ss_kses('Inscrivez-vous pour être informés de nos prochains événements.'),
        'label_block' => true,
      ]
    );
    $this->end_controls_section();


    $this->start_controls_section(
      'ss_contact',
      [
        'label' => esc_html__('Contact Form', 'ss-addons'),
      ]
    );

    $this->add_control(
      'ss_select_contact_form',
      [
        'label'   => esc_html__('Select Form', 'ss-addons'),
        'type'    => Controls_Manager::SELECT,
        'default' => '0',
        'options' => $this->get_ss_contact_form(),
      ]
    );

    $this->end_controls_section();

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
    $ss_section_title = $settings['ss_section_title'];
    $ss_section_description = $settings['ss_section_description'];
    $ss_select_contact_form = $settings['ss_select_contact_form'];

?>

    <!-- Subscription Section Start -->
    <section class="subscription-section" id="subscription">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title-2">
              <?php if (!empty($ss_section_title)) : ?>
                <h2><?php echo ss_kses($ss_section_title); ?></h2>
              <?php endif;
              if (!empty($ss_section_description)) : ?>
                <p><?php echo ss_kses($ss_section_description); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php if (!empty($ss_select_contact_form)) : ?>
              <div class="subscription_form">
                <?php echo do_shortcode('[contact-form-7  id="' . $ss_select_contact_form . '"]'); ?>
                <!-- <div class="subscription-box halle-form d-flex flex-wrap">
  <input class="form-control" type="email" placeholder="Email">
  <button type="submit" class="btn button-primary">Je m’inscris</button>
</div> -->
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- Subscription Section End -->

<?php
  }
}

$widgets_manager->register(new SS_Subscription());
