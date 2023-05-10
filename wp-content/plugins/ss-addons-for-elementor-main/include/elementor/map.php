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
class SS_Map extends Widget_Base {

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
        return 'map';
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
        return __('SS Map', 'ss-addons');
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
        return 'ss-icon eicon-google-maps';
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
        return ['googlemap'];
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
                'label' => esc_html__('Google Map', 'ss-addons'),
            ]
        );
        $this->add_control(
            'ss_map_latitude',
            [
                'label' => esc_html__('Map Latitude ', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '48.86118824309792',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_map_longitude',
            [
                'label' => esc_html__('Map Longitude ', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '2.3531323875196435',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_map_zoom',
            [
                'label' => esc_html__('Map Zoom ', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '16',
                'label_block' => true,
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
        $ss_map_latitude = $settings['ss_map_latitude'];
        $ss_map_longitude = $settings['ss_map_longitude'];
        $ss_map_zoom = $settings['ss_map_zoom'];

        // wp_localize_script("halle-main", "mapdata", array(
        //     "latitude" => $ss_map_latitude,
        //     "longitude" => $ss_map_longitude,
        // ));
?>

        <!-- Map Section Start -->
        <section class="map-section">
            <div id="mrsmap"></div>
        </section>
        <!-- Map Section End -->


        <script>
            (function ($) {
                "use strict";
                function mapActive() {
                    function initMap() {

                        var location = new google.maps.LatLng(<?php echo $ss_map_latitude ?>, <?php echo $ss_map_longitude ?>);

                        var mapCanvas = document.getElementById('mrsmap');
                        var mapOptions = {
                            center: location,
                            zoom: <?php echo $ss_map_zoom ?>,
                            panControl: false,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        var map = new google.maps.Map(mapCanvas, mapOptions);

                        var markerImage = 'https://preprod.halle47.fr/wp-content/uploads/2023/05/map-marker.png';

                        var marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            icon: markerImage
                        });

                        var contentString = '<div class="info-window">' +
                                '<div class="info-content">' +
                                '<a href="#contact"><img src="https://preprod.halle47.fr/wp-content/uploads/2023/05/tooltip.png"/></a>' +
                                '</div>' +
                                '</div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString,
                            maxWidth: 400
                        });

                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });

                    }

                    google.maps.event.addDomListener(window, 'load', initMap);
                }

                $(window).on("elementor/frontend/init", function () {
                    elementorFrontend.hooks.addAction(
                        "frontend/element_ready/map.default",mapActive
                    );
                });
            })(jQuery);
        </script>   

<?php
    }
}

$widgets_manager->register(new SS_Map());
