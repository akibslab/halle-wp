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
class SS_Testimonial extends Widget_Base {

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
        return 'testimonial';
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
        return __('SS Testimonial', 'ss-addons');
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
        return 'ss-icon  eicon-testimonial';
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
            'ss_content',
            [
                'label' => esc_html__('Content', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'ss_testi_content',
            [
                'label' => esc_html__('Testimonial Content', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => ss_kses('À quelques encablures de la Garonne, sur la commune de Floirac, entre site industriel et ancienne ligne
                ferroviaire, le quartier des Étangs et ses aménagements séduisent et offrent aux habitants un espace de
                verdure où maisons anciennes et nouvelles réalisations se fondent et se confondent avec le paysage.
                <br><br>
  
                Dans la continuité de cet espace de verdure, en remontant vers la passerelle Eiffel, le passé industriel
                de la ville se dévoile avec de grandes friches à réinvestir. Ce tissu urbain, marqué par le déclin de
                l’activité industrielle de la rive droite, fait l’objet d’un projet d’aménagement associant préservation
                de la continuité verte avec le cadre de vie agréable qui en découle et valorisation de son identité.
                <br><br>
  
                La réhabilitation de la halle Desse, imposant bâtiment, conçu à l’origine pour abriter la production de
                charpentes métalliques de la société Desse, l’un des témoins de cette tradition industrielle de Floirac,
                symbolise cette volonté. Remarquable par sa structure en béton et son toit en dalle de ciment et verre, la
                halle Desse sera mise en valeur par une réhabilitation adaptée, préservant sa structure tout en lui
                donnant un nouveau souffle. Logements, équipements, école, collège, ateliers d’artisans, commerces de
                proximité, etc. investiront les lieux, pour accueillir habitants et salariés qui bénéficieront du parc des
                Étangs, mais aussi du parc Eiffel au pied de la passerelle du même nom, dont personne à Bordeaux ne
                désespère de la voir un jour redevenir un lien entre les deux rives et, pourquoi pas, un pont habité.
                <br><br>
  
                Le quartier de la halle Desse s’inscrit comme une transition entre les coteaux de la rive droite, le
                fleuve et une nouvelle centralité bordelaise : le quartier Deschamps-Belvédère. @Texte Le Festin Septembre
                2020'),
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
        $ss_testi_content = $settings['ss_testi_content'];
?>

        <!-- Testimonial Section Start -->
        <section class="testimonial-section overflow-hidden" id="testimonial">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/bottom.png" class="top-border" alt="">
            <div class="container-fluid container-md gx-0 gx-md-4">
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
                    <div class="col-md-12">
                        <div class="testimonial-box text-center">
                            <?php if (!empty($ss_testi_content)) : ?>
                                <p>
                                    <?php echo ss_kses($ss_testi_content); ?>
                                </p>
                            <?php endif; ?>

                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/quote-1.png" class="quote-1" alt="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/quote-2.png" class="quote-2" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial Section End -->

<?php
    }
}

$widgets_manager->register(new SS_Testimonial());
