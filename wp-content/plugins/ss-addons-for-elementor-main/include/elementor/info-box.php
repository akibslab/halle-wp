<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_Info_Box extends Widget_Base {

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
        return 'ss-info-box';
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
        return __('SS Info Box', 'ss-addons');
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
        return 'ss-icon eicon-info-circle-o';
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
                'default' => ss_kses('Et demain ?'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        // Features group
        $this->start_controls_section(
            'ss_info_box',
            [
                'label' => esc_html__('Info Box', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'info_image',
            [
                'label' => esc_html__('Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $repeater->add_control(
            'info_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Title', 'ss-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'info_description',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => ss_kses('Info Description'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ss_info_boxes',
            [
                'label' => esc_html__('Info Boxes', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'info_title' => esc_html__('Venir en Voiture', 'ss-addons'),
                        'info_description' => ss_kses('Sed consequat orci ante, vitae imperdiet neque suscipit a. Nunc mattis purus at tincidunt porta. Vivamus
                        posuere tellus venenatis'),
                        'info_image' => [
                            'url' => get_template_directory_uri() . '/assets/img/info/car.png',
                        ],
                    ],
                    [
                        'info_title' => esc_html__('Venir en bus', 'ss-addons'),
                        'info_description' => ss_kses('Sed eleifend diam sit amet lacus sollicitudin accumsan. Duis ut varius elit. Integer justo ante, eleifend'),
                        'info_image' => [
                            'url' => get_template_directory_uri() . '/assets/img/info/rail.png',
                        ],
                    ],
                    [
                        'info_title' => esc_html__('Venir à pieds', 'ss-addons'),
                        'info_description' => ss_kses('par la promenade des berges <br> de la Garonne'),
                        'info_image' => [
                            'url' => get_template_directory_uri() . '/assets/img/info/foot.png',
                        ],
                    ],
                ],
                'title_field' => '{{{ info_title }}}',
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
        $ss_info_boxes = $settings['ss_info_boxes'];

?>

        <!-- Info Section Start -->
        <section class="info-section" id="info">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (!empty($ss_section_title)) : ?>
                            <div class="section-title-2">
                                <h2><?php echo ss_kses($ss_section_title); ?></h2>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($ss_info_boxes)) : ?>
                    <div class="row">
                        <?php foreach ($ss_info_boxes as $box) : ?>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <?php if (!empty($box['info_image'])) : ?>
                                        <div class="icon-box d-flex align-items-center">
                                            <img src="<?php echo esc_url($box['info_image']['url']); ?>" alt="">
                                        </div>
                                    <?php endif;
                                    if (!empty($box['info_title'])) : ?>
                                        <h5><?php echo ss_kses($box['info_title']); ?></h5>
                                    <?php endif;
                                    if (!empty($box['info_description'])) : ?>
                                        <p><?php echo ss_kses($box['info_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <!-- Info Section End -->


<?php
    }
}

$widgets_manager->register(new SS_Info_Box());
