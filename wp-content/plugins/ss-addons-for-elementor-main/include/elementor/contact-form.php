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
class SS_Contact_Form extends Widget_Base {

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
		return 'contactform';
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
		return __('SS Contact Form', 'ss-addons');
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
		return 'ss-icon eicon-form-horizontal';
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
				'label' => esc_html__('Content', 'ss-addons'),
			]
		);
		$this->add_control(
			'ss_section_title',
			[
				'label' => esc_html__('Section Text', 'ss-addons'),
				'description' => ss_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXT,
				'default' => ss_kses('Vous avez une idée d’évènement à proposer, un spectacle à monter ? Contactez nous !</b>'),
				'label_block' => true,
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'sscore_contact',
			[
				'label' => esc_html__('Contact Form', 'ss-addons'),
			]
		);

		$this->add_control(
			'sscore_select_contact_form',
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
		$ss_section_text = $settings['ss_section_title'];
		$ss_select_form = $settings['sscore_select_contact_form'];
?>
		<!-- Contact Section Start -->
		<section class="contact-section" id="contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if (!empty($ss_section_text)) : ?>
							<p class="text-center"><?php echo ss_kses($ss_section_text); ?></p>
						<?php endif; ?>

						<?php if (!empty($ss_select_form)) : ?>
							<?php echo do_shortcode('[contact-form-7  id="' . $ss_select_form . '"]'); ?>
							<!-- <div class="contact-form-box halle-form">
	<div class="row">
		<div class="col">
			<select class="form-select" aria-label="Default select example">
				<option selected>Vous êtes un partenaire ?</option>
				<option value="1">One</option>
				<option value="2">Two</option>
				<option value="3">Three</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Nom*">
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Prénom*">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type="email" class="form-control" placeholder="Email*">
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Téléphone*">
		</div>
	</div>

	<div class="row">
		<div class="col">
			<textarea class="form-control" placeholder="Message*"></textarea>
		</div>
	</div>

	<div class="captcha-box d-flex">
		<div class="code">XvYZzoi</div>
		<input type="text" class="form-control" placeholder="Retapez ce code">
	</div>

	<div class="form-check">
		<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			J’accepte d’être contacté(e) par FAYAT Immobilier*
		</label>
	</div>

	<p class="bottom-text">*Champs obligatoires. Les informations collectées sont destinées à l’usage exclusif
		de Fayat Immobilier. Pour connaître et exercer vos droits, notamment de retrait de votre consentement à
		l’utilisation des données par ce formulaire, veuillez consulter nos mentions légales.</p>

	<button type="button" class="btn button-primary">Envoyer</button>

</div> -->
						<?php endif; ?>
					</div>
				</div>
			</div>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact/bottom.png" class="bottom-border" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
		</section>
		<!-- Contact Section End -->


<?php
	}
}

$widgets_manager->register(new SS_Contact_Form());
