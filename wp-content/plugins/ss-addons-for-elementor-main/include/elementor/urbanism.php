<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_Urbanism extends Widget_Base {

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
    return 'urbanism';
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
    return __('SS Urbanism', 'ss-addons');
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
    return 'ss-icon eicon-columns';
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
        'default' => ss_kses('L’Urbanisme transitoire <b>en vue de:</b>'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'ss_section_description',
      [
        'label' => esc_html__('Section Description', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => Controls_Manager::WYSIWYG,
        'default' => ss_kses('<b>Préfigurer le projet<br>
        urbain,</b> activer le quartier<br><br>

        <b>Communiquer sur le projet urbain,</b>
        obtenir l’adhésion des riverains<br><br>

        <b>Amorcer une image du futur quartier</b><br><br>

        <b>Accompagner une montée <br>en engagement de la Société Civile,</b>
        odes Associations et des Sociétés <br> de l’Economie Sociale et Solidaire'),
        'label_block' => true,
        'rows' => 10,
      ]
    );
    $this->end_controls_section();


    // Features group
    $this->start_controls_section(
      'ss_urbanism_image',
      [
        'label' => esc_html__('Image', 'ss-addons'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'urbanism_desktop_img',
      [
        'label' => esc_html__('Desktop Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/urbanism/urbanism.png',
        ],
      ]
    );
    $this->add_control(
      'urbanism_mobile_img',
      [
        'label' => esc_html__('Mobile Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => get_template_directory_uri() . '/assets/img/urbanism/urbanism-mobile.png',
        ],
      ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
      'ss_bottom_heading',
      [
        'label' => esc_html__('Bottom Heading', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_bottom_title',
      [
        'label' => esc_html__('Title', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => Controls_Manager::TEXT,
        'default' => ss_kses('La Halle Desse, <br> <b>un morceau d’histoire</b>'),
        'label_block' => true,
      ]
    );
    $this->end_controls_section();

    // style
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
    $urbanism_desktop_img = $settings['urbanism_desktop_img'];
    $urbanism_mobile_img = $settings['urbanism_mobile_img'];
    $ss_bottom_title = $settings['ss_bottom_title'];
?>
    <!-- Urbanism Section Start -->
    <section class="urbanism-section overflow-hidden" id="urbanism">
      <div class="container-fluid gx-0 gx-md-4">
        <div class="row">
          <div class="col-md-12">
            <?php if (!empty($ss_section_title)) : ?>
              <div class="section-title-2">
                <h2><?php echo ss_kses($ss_section_title); ?></h2>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-center">
            <div class="left-area">

              <?php if (!empty($ss_section_title)) : ?>
                <p>
                  <?php echo ss_kses($ss_section_description); ?>
                </p>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="right-area">
              <?php if (!empty($urbanism_desktop_img)) : ?>
                <img class="desktop d-none d-lg-block" src="<?php echo esc_url($urbanism_desktop_img['url']); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
              <?php endif;
              if (!empty($urbanism_mobile_img)) : ?>
                <img class="mobile d-lg-none" src="<?php echo esc_url($urbanism_mobile_img['url']); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="bottom-text-box">
          <div class="row">
            <div class="col-md-12 text-center">
              <?php if (!empty($ss_bottom_title)) : ?>
                <h2><?php echo ss_kses($ss_bottom_title); ?></h2>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Urbanism Section End -->

<?php
  }
}

$widgets_manager->register(new SS_Urbanism());
