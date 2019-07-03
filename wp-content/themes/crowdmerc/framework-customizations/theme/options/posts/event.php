<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    'event' => array(
        'type'		 => 'box',
        'title'		 =>esc_html__( 'Event', 'crowdmerc' ),
        'options'	 => array(
            'general'	 => array(
                'title'		 =>esc_html__( 'General', 'crowdmerc' ),
                'type'		 => 'tab',
                'options'	 => array(
                    'general-box' => array(
                        'title'		 =>esc_html__( 'General Settings', 'crowdmerc' ),
                        'type'		 => 'box',
                        'options'	 => array(
                            'speaker'		 => array(
                                'label'	 =>esc_html__( 'Speaker Nme', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter Speaker name', 'crowdmerc' ),
                                'type'	 => 'text',
                            ),
                            'event_organization'		 => array(
                                'label'	 =>esc_html__( 'Organized by', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Organization name', 'crowdmerc' ),
                                'type'	 => 'text',
                            ),
                            'event_date'=>array(
                                'type'  => 'datetime-picker',
                                'value' => '',
                                'label' =>esc_html__('Event Date', 'crowdmerc'),
                                'desc'  =>esc_html__('Enter your event date and time', 'crowdmerc'),
                                'datetime-picker' => array(
                                    'format'        => 'Y/m/d', // Format datetime.
                                    'maxDate'       => false,  // By default there is not maximum date , set a date in the datetime format.
                                    'minDate'       => false,  // By default minimum date will be current day, set a date in the datetime format.
                                    'timepicker'    => false,   // Show timepicker.
                                    'datepicker'    => true,   // Show datepicker.
                                    'defaultTime'   => '12:00' // If the input value is empty, timepicker will set time use defaultTime.
                                ),
                            ),
                            'event_time' => array(
                                'label'	 =>esc_html__( 'Phone', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter event time', 'crowdmerc' ),
                                'type'	 => 'text',
                            ),
                            'event_venue'		 => array(
                                'label'	 =>esc_html__( 'Venue', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter your event venue name', 'crowdmerc' ),
                                'type'	 => 'textarea',
                            ),
                            'event_phone'		 => array(
                                'label'	 =>esc_html__( 'Phone', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter phone number', 'crowdmerc' ),
                                'type'	 => 'text',
                            ),
                            'event_email'		 => array(
                                'label'	 =>esc_html__( 'Email', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter email address', 'crowdmerc' ),
                                'type'	 => 'text',
                            ),
                        ),
                    ),
                )
            ),
            'facilities'	     => array(
                'title'		 =>esc_html__( 'Facilities', 'crowdmerc' ),
                'type'		 => 'tab',
                'options'	 => array(
                    'general-box2' => array(
                        'title'		 =>esc_html__( 'Facilities Settings', 'crowdmerc' ),
                        'type'		 => 'box',
                        'options'	 => array(
                            'event_desc'		 => array(
                                'label'	 =>esc_html__( 'Description', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Event Description', 'crowdmerc' ),
                                'type'	 => 'textarea',
                            ),
                            'event_facilities'	 => array(
                                'type'				 => 'addable-popup',
                                'limit'				 => '5',
                                'add-button-text'	 =>esc_html__( 'Add Facilities info', 'crowdmerc' ),
                                'label'				 => esc_html__( 'Facilities info', 'crowdmerc' ),
                                'desc'				 => esc_html__( 'Add Artists info', 'crowdmerc' ),
                                'template'			 => '{{=title}}',
                                'popup-options'		 => array(
                                    'title'	 => array(
                                        'label'	 => esc_html__( 'Facilities', 'crowdmerc' ),
                                        'value'	 => esc_html__( 'Assisting senior consultants in projects', 'crowdmerc' ),
                                        'type'	 => 'text',
                                    ),
                                ),
                                'value'				 => array(
                                    0	 => array(
                                        'title'	 => esc_html__('Assisting senior consultants in projects:','crowdmerc'),
                                    ),
                                    1	 => array(
                                        'title'	 => esc_html__('Share best practices and knowledge.','crowdmerc'),
                                    ),
                                )
                            ),
                        )
                    ),
                )
            ),
            'map'	 => array(
                'title'		 =>esc_html__( 'Map Locations', 'crowdmerc' ),
                'type'		 => 'tab',
                'options'	 => array(
                    'general-box3' => array(
                        'title'		 =>esc_html__( 'Map Settings', 'crowdmerc' ),
                        'type'		 => 'box',
                        'options'	 => array(
                            'latitude'		 => array(
                                'label'	 =>esc_html__( 'Latitude', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter latitude', 'crowdmerc' ),
                                'type'	 => 'text',
                                'value' => '37.4850753',
                            ),
                            'longitude'		 => array(
                                'label'	 =>esc_html__( 'Longitude', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter latitude', 'crowdmerc' ),
                                'type'	 => 'text',
                                'value' => '-122.1496129'
                            ),
                        )
                    ),
                )
            ),
            'contact'	 => array(
                'title'		 =>esc_html__( 'Contact Form', 'crowdmerc' ),
                'type'		 => 'tab',
                'options'	 => array(
                    'general-box4' => array(
                        'title'		 =>esc_html__( 'Contact Form Settings', 'crowdmerc' ),
                        'type'		 => 'box',
                        'options'	 => array(
                            'event_contact'		 => array(
                                'label'	 =>esc_html__( 'Contact Form', 'crowdmerc' ),
                                'desc'	 =>esc_html__( 'Enter contact form 7 shortcode', 'crowdmerc' ),
                                'type'	 => 'textarea',
                            ),
                        )
                    ),
                )
            ),
            'sponsor'	 => array(
                'title'		 =>esc_html__( 'Sponsor', 'crowdmerc' ),
                'type'		 => 'tab',
                'options'	 => array(
                    'general-box5' => array(
                        'title'		 =>esc_html__( 'Sponsor Settings', 'crowdmerc' ),
                        'type'		 => 'box',
                        'options'	 => array(
                            'event_sponsor'		 => array(
                                'type'  => 'multi-upload',
                                'value' => array(

                                ),
                                'label' =>esc_html__('Sponsor Logo', 'crowdmerc'),
                                'desc'  =>esc_html__('Upload your sponsor logo', 'crowdmerc'),
                                'images_only' => true,
                            ),
                        )
                    ),
                )
            ),
        ),
    ),
);
