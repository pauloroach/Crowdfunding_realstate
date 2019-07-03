<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
        'event_date_cat'=>array(
            'type'  => 'datetime-picker',
            'value' => '',
            'label' =>esc_html__('Event Date', 'crowdmerc'),
            'desc'  =>esc_html__('Enter your event date', 'crowdmerc'),
            'datetime-picker' => array(
                'format'        => 'Y/m/d',
                'maxDate'       => false,
                'minDate'       => false,
                'timepicker'    => false,
                'datepicker'    => true,
                'defaultTime'   => '12:00'
            ),
        ),
);
