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
class SS_Brand extends Widget_Base {

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
		return 'brand';
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
		return __('Brand', 'ss-addons');
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
		return 'ss-icon';
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
		$this->start_controls_section(
			'ss_brand_section',
			[
				'label' => __('Brand Item', 'ss-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ss_brand_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __('Image', 'ss-addons'),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'ss_brand_url',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label' => __('URL', 'ss-addons'),
				'default' => __('#', 'ss-addons'),
				'placeholder' => __('Type url here', 'ss-addons'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'ss_brand_slides',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => esc_html__('Brand Item', 'ss-addons'),
				'default' => [
					[
						'ss_brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'ss_brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
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

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'ss-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'ss-addons'),
					'uppercase' => __('UPPERCASE', 'ss-addons'),
					'lowercase' => __('lowercase', 'ss-addons'),
					'capitalize' => __('Capitalize', 'ss-addons'),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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

?>

		<div class="brand__item-wrapper">
			<div class="row align-items-center">
				<?php foreach ($settings['ss_brand_slides'] as $item) :
					if (!empty($item['ss_brand_image']['url'])) {
						$ss_brand_image_url = !empty($item['ss_brand_image']['id']) ? wp_get_attachment_image_url($item['ss_brand_image']['id'], $settings['thumbnail_size']) : $item['ss_brand_image']['url'];
						$ss_brand_image_alt = get_post_meta($item["ss_brand_image"]["id"], "_wp_attachment_image_alt", true);
					}
				?>
					<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
						<div class="brand__item text-center m-img mb-40">
							<?php if (!empty($item['ss_brand_url'])) : ?>
								<a href="<?php echo esc_url($item['ss_brand_url']); ?>"><img src="<?php echo esc_url($ss_brand_image_url); ?>" alt="<?php echo esc_url($ss_brand_image_alt); ?>"></a>
							<?php else : ?>
								<img src="<?php echo esc_url($ss_brand_image_url); ?>" alt="<?php echo esc_url($ss_brand_image_alt); ?>">
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

<?php
	}
}

$widgets_manager->register(new SS_Brand());
