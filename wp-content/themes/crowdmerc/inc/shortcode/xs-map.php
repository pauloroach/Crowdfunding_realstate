<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Google Maps Widget
 */
class Xs_Maps_Widget extends Widget_Base {

	public $geo_api_url = 'https://maps.googleapis.com/maps/api/geocode/json';

	public function get_name() {
        return 'xs-maps';
    }

    public function get_title() {
        return esc_html__( 'crowdmerc Map', 'crowdmerc' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return [ 'crowdmerc-elements' ];
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'section_map_settings',
			array(
				'label' => esc_html__( 'Map Settings', 'crowdmerc' ),
			)
		);

		$default_address = esc_html__( 'London Eye, London, United Kingdom', 'crowdmerc' );

		$this->add_control(
			'map_center',
			array(
				'label'       => esc_html__( 'Map Center', 'crowdmerc' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default'     => $default_address,
				'label_block' => true,
			)
		);

		$this->add_control(
			'zoom',
			array(
				'label'      => esc_html__( 'Initial Zoom', 'crowdmerc' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'default'    => array(
					'unit' => 'zoom',
					'size' => 11,
				),
				'range'      => array(
					'zoom' => array(
						'min' => 1,
						'max' => 18,
					),
				),
			)
		);

		$this->add_control(
			'scrollwheel',
			array(
				'label'   => esc_html__( 'Scrollwheel Zoom', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => array(
					'true'  => esc_html__( 'Enabled', 'crowdmerc' ),
					'false' => esc_html__( 'Disabled', 'crowdmerc' ),
				),
			)
		);

		$this->add_control(
			'zoom_controls',
			array(
				'label'   => esc_html__( 'Zoom Controls', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => esc_html__( 'Show', 'crowdmerc' ),
					'false' => esc_html__( 'Hide', 'crowdmerc' ),
				),
			)
		);

		$this->add_control(
			'street_view',
			array(
				'label'   => esc_html__( 'Street View Controls', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => esc_html__( 'Show', 'crowdmerc' ),
					'false' => esc_html__( 'Hide', 'crowdmerc' ),
				),
			)
		);

		$this->add_control(
			'map_type',
			array(
				'label'   => esc_html__( 'Map Type Controls (Map/Satellite)', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => esc_html__( 'Show', 'crowdmerc' ),
					'false' => esc_html__( 'Hide', 'crowdmerc' ),
				),
			)
		);

		$this->add_control(
			'drggable',
			array(
				'label'   => esc_html__( 'Is Map Draggable?', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => esc_html__( 'Yes', 'crowdmerc' ),
					'false' => esc_html__( 'No', 'crowdmerc' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_style',
			array(
				'label' => esc_html__( 'Map Style', 'crowdmerc' ),
			)
		);

		$this->add_control(
			'map_height',
			array(
				'label'       => esc_html__( 'Map Height', 'crowdmerc' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 50,
				'placeholder' => 570,
				'default'     => 570,
				'render_type' => 'template',
				'selectors' => array(
					'{{WRAPPER}} .fundpress-maps' => 'height: {{VALUE}}px',
				),
			)
		);

		$this->add_control(
			'map_style',
			array(
				'label'       => esc_html__( 'Map Style', 'crowdmerc' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'default',
				'options'     => $this->xs_get_map_style(),
				'label_block' => true,
				'description' => esc_html__( 'You can add own map styles within your theme. Add file with styles array in .json format into fundpress/google-map-styles/ folder in your theme. File must be minified', 'crowdmerc' )
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_pins',
			array(
				'label' => esc_html__( 'Pins', 'crowdmerc' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'pin_address',
			array(
				'label'       => esc_html__( 'Pin Address', 'crowdmerc' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => $default_address,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'pin_desc',
			array(
				'label'   => esc_html__( 'Pin Description', 'crowdmerc' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => $default_address,
			)
		);

		$repeater->add_control(
			'pin_image',
			array(
				'label'   => esc_html__( 'Pin Icon', 'crowdmerc' ),
				'type'    => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'pin_state',
			array(
				'label'   => esc_html__( 'Initial State', 'crowdmerc' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => array(
					'visible' => esc_html__( 'Vsible', 'crowdmerc' ),
					'hidden'  => esc_html__( 'Hidden', 'crowdmerc' ),
				),
			)
		);

		$this->add_control(
			'pins',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => array(
					array(
						'pin_address' => $default_address,
						'pin_desc'    => $default_address,
						'pin_image'   => '',
						'pin_state'   => 'visible',
					),
				),
				'title_field' => '{{{ pin_address }}}',
			)
		);

		$this->end_controls_section();
	}

	public function xs_get_map_style() {

		$style = array(

			'default' => esc_html__( 'Default', 'crowdmerc' ),
			'[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]'	=> 'Apple Maps Esque',
			'[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]' => 'Shades of Grey',
			'[{"featureType":"all","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"},{"saturation":"-100"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40},{"visibility":"off"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"landscape","elementType":"geometry.stroke","stylers":[{"color":"#4d6059"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"lightness":21}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"color":"#4d6059"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#7f8d89"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#2b3638"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2b3638"},{"lightness":17}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#24282b"}]},{"featureType":"water","elementType":"geometry.stroke","stylers":[{"color":"#24282b"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.icon","stylers":[{"visibility":"off"}]}]' => 'Shades of Green',
		);
		return $style;
	}
	/**
	 * Get lcation coordinates by entered address and store into metadata.
	 *
	 * @return void
	 */
	public function get_location_coord( $location ) {

		$key = md5( $location );

		$coord = get_transient( $key );

		if ( ! empty( $coord ) ) {
			return $coord;
		}

        $api_key  = crowdmerc_option('map_api', crowdmerc_defaults('map_api'));

		// Do nothing if api key not provided
		if ( ! $api_key ) {
			return;
		}

		// Prepare request data
		$location = esc_attr( $location );
		$api_key  = esc_attr( $api_key );

		$reques_url = esc_url( add_query_arg(
			array(
				'address' => urlencode( $location ),
				'key'     => urlencode( $api_key )
			),
			$this->geo_api_url
		) );

		$response = wp_remote_get( $reques_url );
		$json     = wp_remote_retrieve_body( $response );
		$data     = json_decode( $json, true );

		$coord = isset( $data['results'][0]['geometry']['location'] )
			? $data['results'][0]['geometry']['location']
			: false;

		if ( ! $coord ) {
			return;
		}

		set_transient( $key, $coord, WEEK_IN_SECONDS );

		return $coord;
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['map_center'] ) ) {
			return;
		}

		$coordinates = $this->get_location_coord( $settings['map_center'] );

		if ( ! $coordinates ) {
			return;
		}

		$init = array(
			'center'            => $coordinates,
			'zoom'              => isset( $settings['zoom']['size'] ) ? intval( $settings['zoom']['size'] ) : 11,
			'scrollwheel'       => filter_var( $settings['scrollwheel'], FILTER_VALIDATE_BOOLEAN ),
			'zoomControl'       => filter_var( $settings['zoom_controls'], FILTER_VALIDATE_BOOLEAN ),
			'streetViewControl' => filter_var( $settings['street_view'], FILTER_VALIDATE_BOOLEAN ),
			'mapTypeControl'    => filter_var( $settings['map_type'], FILTER_VALIDATE_BOOLEAN ),
		);

		if ( 'false' === $settings['drggable'] ) {
			$init['gestureHandling'] = 'none';
		}

		if ( 'default' !== $settings['map_style'] ) {
			$init['styles'] = json_decode( $settings['map_style']);
		}

		$this->add_render_attribute( 'map-data', 'data-init', json_encode( $init ) );

		$pins = array();

		if ( ! empty( $settings['pins'] ) ) {

			foreach ( $settings['pins'] as $pin ) {

				if ( empty( $pin['pin_address'] ) ) {
					continue;
				}

				$current = array(
					'position' => $this->get_location_coord( $pin['pin_address'] ),
					'desc'     => $pin['pin_desc'],
					'state'    => $pin['pin_state'],
				);

				if ( ! empty( $pin['pin_image']['url'] ) ) {
					$current['image'] = esc_url( $pin['pin_image']['url'] );
				}

				$pins[] = $current;
			}

		}

		$this->add_render_attribute( 'map-pins', 'data-pins', wp_json_encode( $pins ) );

		printf(
			'<div class="fundpress-maps" %1$s %2$s></div>',
			$this->get_render_attribute_string( 'map-data' ),
			$this->get_render_attribute_string( 'map-pins' )
		);
	}

	protected function _content_template() {}
}
