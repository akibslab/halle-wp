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
class SS_About extends Widget_Base {

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
        return 'about';
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
        return __('SS About', 'ss-addons');
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
                'default' => ss_kses('La Halle 47, <br><b>Tout un programme !</b>'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_section_description',
            [
                'label' => esc_html__('Section Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => ss_kses('En préfiguration du réaménagement du quartier Souys à Floirac, au coeur de la
                métropole bordelaise, un ambitieux projet d’urbanisme transitoire se met en place.
                Le quartier réaménagé par l’EPA Euratlantique, conservera les traces singulières
                de son passé industriel et en particulier une immense nef centenaire en structure
                béton, désormais baptisée La Halle 47. <br><br>
  
                Avant sa réhabilitation programmée à compter de 2026, cette halle accueillera
                pendant 3 saisons des évènements culturels ou d’échanges développés par des
                porteurs de projet aux cotés de Fayat Immobilier, propriétaire du site. <br><br>
  
                Ouverte à des thématiques variées et pluridisciplinaires, La Halle 47 accueillera
                des évènements remarquables et fédérateurs, préfigurant la programmation
                définitive. Dès juin 2023, un Opéra immersif sera organisé dans le cadre du
                festival Pulsations, porté par Pygmalion. Un festival de Street Art, des brocantes,
                une programmation de cinéma de plein air sont également en développement.
                Ces expériences donneront lieu à de riches rencontres au cours desquelles une
                multitude d’acteurs pourront échanger et partager : artistes, public métropolitain,
                riverains, réseaux associatifs… <br><br>
  
                Opérateur incontournable d’une transition urbaine harmonieuse et responsable,
                Fayat Immobilier réaffirme par ce projet sa volonté de réinvestir et de sublimer le
                patrimoine industriel de la métropole bordelaise.'),
                'label_block' => true,
                'rows' => 10,
            ]
        );
        $this->end_controls_section();


        // Features group
        $this->start_controls_section(
            'ss_slider',
            [
                'label' => esc_html__('About Slider', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'about_slider_img',
            [
                'label' => esc_html__('Upload Slider Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'ss_about_sliders',
            [
                'label' => esc_html__('About Sliders', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'about_slider_img' =>  [
                            'url' => get_template_directory_uri() . '/assets/img/about/1.jpg',
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
        $ss_about_sliders = $settings['ss_about_sliders'];
?>

        <!-- About Section Start -->
        <section class="about-section overflow-hidden" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-lg-end">
                        <div class="left-area">
                            <?php if (!empty($ss_section_title)) : ?>
                                <div class="section-title">
                                    <h2><?php echo $ss_section_title; ?></h2>
                                </div>
                            <?php endif;

                            if (!empty($ss_about_sliders)) :
                            ?>
                                <div class="slider">
                                    <div class="owl-carousel owl-theme about-carousel">
                                        <?php foreach ($ss_about_sliders as $key => $slider) : ?>
                                            <div>
                                                <a href="<?php echo esc_url($slider['about_slider_img']['url']); ?>" data-lightbox="about-carousel">
                                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/zoom.png' ?>" class="zoom-icon" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
                                                </a>
                                                <img src="<?php echo esc_url($slider['about_slider_img']['url']); ?>" class="d-block w-100" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-area">
                            <?php if (!empty($ss_section_description)) : ?>
                                <p><?php echo $ss_section_description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->

<?php
    }
}

$widgets_manager->register(new SS_About());
