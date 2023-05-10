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
class SS_Memory extends Widget_Base {

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
    return 'memory';
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
    return __('SS Memory', 'ss-addons');
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
        'default' => ss_kses('La Halle Desse, <br><span>Mémoire du site industriel</span>'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'ss_section_description',
      [
        'label' => esc_html__('Section Description', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => Controls_Manager::WYSIWYG,
        'default' => esc_html__('CIMT: Compagnie Industrielle de Matériel de Transport <br>
        La CIMT résulte de la fusion des forges Frémeaux et des établissements Gustave
        CARDE et Fils. Installée sur les terrains de la compagnie ferroviaire du Midi, la
        CIMT sera spécialement affectée aux réparations du matériel ferroviaire en
        reprenant la division matériel roulant des Etablissements CARDE dès 1919.<br>
        Face à la crise économique des années 20 la<br>
        CIMT est dans l’obligation de varier ses activités. En 1925 la CIMT adapte ses
        moyens de fabrication à l’industrie automobile et fabrique des carrosseries et des
        accessoires pour Ford. De 900 ouvriers en 1918 on passe à 550 en 1982 puis 30
        salariés en 1989.<br>
        L’après-guerre voit disparaitre les activités de la CIMT qui n’a pas réussi ses
        tentatives de reconversion même si, ponctuellement, il y eut des réussites comme
        cette construction, entre la fin de 1947 et mai 1948 d’une rame de 6 voiture en
        alliage léger montées sur pneumatiques et destinées à la ligne Paris Strasbourg,
        malheureusement sans lendemain.<br>
        L’activité, gisement d’emplois pour toute la région bordelaise, cesse en 1965.
        Sur ce vaste site industriel, plusieurs entreprises viennent s’implanter, dont les Ets
        Desse spécialisés dans la construction métallique et la fabrication d’usines clés en
        main, majoritairement destinées à l’exportation.', 'ss-addons'),
        'label_block' => true,
        'rows' => 10,
      ]
    );
    $this->end_controls_section();


    // Features group
    $this->start_controls_section(
      'ss_slider',
      [
        'label' => esc_html__('Memory Slider', 'ss-addons'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'memory_slider_img',
      [
        'label' => esc_html__('Upload Slider Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
      ]
    );
    $this->add_control(
      'ss_memory_sliders',
      [
        'label' => esc_html__('About Sliders', 'ss-addons'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'memory_slider_img' =>  [
              'url' => get_template_directory_uri() . '/assets/img/memory/1.jpg',
            ],
          ],
          [
            'memory_slider_img' =>  [
              'url' => get_template_directory_uri() . '/assets/img/memory/1.jpg',
            ],
          ],
          [
            'memory_slider_img' =>  [
              'url' => get_template_directory_uri() . '/assets/img/memory/1.jpg',
            ],
          ],
        ],
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
    $ss_memory_sliders = $settings['ss_memory_sliders'];
?>

    <!-- Memory Section Start -->
    <section class="memory-section d-flex flex-wrap" id="memory">

      <?php if (!empty($ss_memory_sliders)) : ?>
        <div class="slider-box align-self-center">
          <div class="owl-carousel owl-theme memory-carousel">
            <?php foreach ($ss_memory_sliders as $key => $slider) : ?>
              <div>
                <img src="<?php echo esc_url($slider['memory_slider_img']['url']); ?>" class="d-block w-100" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="contents-box d-flex justify-content-center align-items-center">
        <div class="contents-inner">
          <?php if (!empty($ss_section_title)) : ?>
            <h4 class="d-none d-lg-block"><?php echo ss_kses($ss_section_title); ?></h4>
          <?php endif;
          if (!empty($ss_section_description)) : ?>
            <p><?php echo ss_kses($ss_section_description); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Memory Section End -->

<?php
  }
}

$widgets_manager->register(new SS_Memory());
