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
class SS_News extends Widget_Base {

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
    return 'news';
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
    return __('SS News', 'ss-addons');
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
    return 'ss-icon eicon-gallery-justified';
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
      'ss_news_heading',
      [
        'label' => esc_html__('Heading', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_section_title',
      [
        'label' => esc_html__('Section Title', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Actualités', 'ss-addons'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'ss_section_desc',
      [
        'label' => esc_html__('Section Description', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Hier, aujourd’hui et demain à La Halle 47. Ouverte à des thématiques variées et pluridisciplinaires, La
        Halle 47 accueillera des évènements remarquables et fédérateurs, préfigurant la programmation définitive.', 'ss-addons'),
        'label_block' => true,
      ]
    );
    $this->end_controls_section();

    // Service group
    $this->start_controls_section(
      'ss_news_items',
      [
        'label' => esc_html__('News Item', 'ss-addons'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'ss_news_title',
      [
        'label' => esc_html__('Title', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => ss_kses('News Title'),
        'label_block' => true,
      ]
    );
    $repeater->add_control(
      'ss_news_excerpt',
      [
        'label' => esc_html__('Excerpt', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => ss_kses('News Excerpt'),
        'label_block' => true,
      ]
    );
    $repeater->add_control(
      'ss_news_image',
      [
        'label' => esc_html__('Upload News Image', 'ss-addons'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
      ]
    );
    $repeater->add_control(
      'show_on_mobile',
      [
        'label' => esc_html__('Show on Mobile', 'ss-addons'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Show', 'ss-addons'),
        'label_off' => esc_html__('Hide', 'ss-addons'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $this->add_control(
      'ss_news',
      [
        'label' => esc_html__('News List', 'ss-addons'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'ss_news_title' => esc_html__('Euripides Laskaridis', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Elenit - 12>15.04.2023 <br> #théâtre #danse #performance'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/1.jpg',
            ],
          ],
          [
            'ss_news_title' => esc_html__('Pulsations', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Festival Pulsations - Jusqu’au 21.05.2023 <br> #exposition #pulsations'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/2.jpg',
            ],
          ],
          [
            'ss_news_title' => esc_html__('Circulation(s) 2023', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Festival de la jeune photographie européenne - Jusqu’au 21.05.2023 <br> #exposition #photographie'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/3.jpg',
            ],
          ],
          [
            'ss_news_title' => esc_html__('Circulation(s) 2023', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Festival de la jeune photographie européenne - Jusqu’au 21.05.2023 <br> #exposition #photographie'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/4.jpg',
            ],
          ],
          [
            'ss_news_title' => esc_html__('Appel à opérateur', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Lorem I-sum dolor sit met- Jusqu’au 21.05.2023 <br> #exposition #photographie'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/5.jpg',
            ],
          ],
          [
            'ss_news_title' => esc_html__('Euripides Laskaridis', 'ss-addons'),
            'ss_news_excerpt' => ss_kses('Elenit - 12>15.04.2023 <br>#théâtre #danse #performance'),
            'ss_news_image' => [
              'url' => get_template_directory_uri() . '/assets/img/news/6.jpg',
            ],
          ],
        ],
        'title_field' => '{{{ ss_news_title }}}',
      ]
    );
    $this->end_controls_section();

    // layout Panel
    $this->start_controls_section(
      'ss_all_news',
      [
        'label' => esc_html__('All News', 'ss-addons'),
      ]
    );
    $this->add_control(
      'ss_all_news_text',
      [
        'label' => esc_html__('All News Text', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('VOIR TOUTES LES ACTUALITÉS', 'ss-addons'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'ss_all_news_link',
      [
        'label' => esc_html__('All News Link', 'ss-addons'),
        'description' => ss_get_allowed_html_desc('basic'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('#', 'ss-addons'),
        'label_block' => true,
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
    $ss_section_title = $settings['ss_section_title'];
    $ss_section_desc = $settings['ss_section_desc'];
    $ss_news = $settings['ss_news'];
    $ss_all_news_text = $settings['ss_all_news_text'];
    $ss_all_news_link = $settings['ss_all_news_link'];
?>

    <!-- News Section Start -->
    <section class="news-section overflow-hidden" id="news">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/news/top.png" class="top-border" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title">
              <?php if (!empty($ss_section_title)) : ?>
                <h2><?php echo esc_html($ss_section_title); ?></h2>
              <?php endif;
              if (!empty($ss_section_desc)) : ?>
                <p><?php echo $ss_section_desc; ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php if (!empty($ss_news)) : ?>
          <div class="row grid-row d-none d-lg-block">
            <div class="col-md-12">
              <div class="grid">
                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>

                <?php foreach ($ss_news as $key => $news) :                ?>
                  <div class="grid-item d-flex flex-column justify-content-end grid-item-<?php echo esc_attr($key + 1); ?>" style="background-image:url(<?php echo esc_url($news['ss_news_image']['url']); ?>);">
                    <div class="contents">
                      <?php if (!empty($news['ss_news_title'])) : ?>
                        <h3><?php echo esc_html($news['ss_news_title']) ?></h3>
                      <?php endif;
                      if (!empty($news['ss_news_excerpt'])) : ?>
                        <p><?php echo ss_kses($news['ss_news_excerpt']); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        <?php endif;

        if (!empty($ss_news)) :
        ?>
          <!-- mobile news -->
          <div class="row d-lg-none">
            <div class="col-md-12">
              <div class="mobile_news">
                <?php foreach ($ss_news as $key => $news) :
                  if ('yes' == $news['show_on_mobile']) :
                ?>
                    <div class="grid-item d-flex flex-column justify-content-end" style="background-image:url(<?php echo esc_url($news['ss_news_image']['url']); ?>);">
                      <div class="contents">
                        <?php if (!empty($news['ss_news_title'])) : ?>
                          <h3><?php echo esc_html($news['ss_news_title']) ?></h3>
                        <?php endif;
                        if (!empty($news['ss_news_excerpt'])) : ?>
                          <p><?php echo ss_kses($news['ss_news_excerpt']); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                <?php endif;
                endforeach; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </section>
    <?php if (!empty($ss_all_news_text)) : ?>
      <div class="mobile_all_news d-lg-none">
        <a href="<?php echo esc_url($ss_all_news_link) ?>"><?php echo esc_html($ss_all_news_text) ?></a>
      </div>
    <?php endif; ?>
    <!-- News Section End -->

<?php
  }
}

$widgets_manager->register(new SS_News());
