<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Creates widget with recent post thumbnail
 */

class Crowdmerc_contact extends WP_Widget
{
    function __construct() {
        $widget_opt = array(
            'classname'     => 'fundpress_widget',
            'description'   => 'Crowdmerc Contact'
        );
        
        parent::__construct('xs-contacts', esc_html__('Crowdmerc Contact', 'crowdmerc'), $widget_opt);
    }
    
    function widget( $args, $instance ){

        echo crowdmerc_return($args['before_widget']);
        if ( !empty( $instance[ 'title' ] ) ) {

            echo crowdmerc_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . crowdmerc_return($args[ 'after_title' ]);
        }

        $address = '';
        $address_one = '';
        $mobile = '';
        $email = '';

        if(isset($instance['address'])){
            $address = $instance['address'];
        }
        if(isset($instance['address_one'])){
            $address_one = $instance['address_one'];
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }
        if(isset($instance['email'])){
            $email = $instance['email'];
        }
        
        ?>
        <div class="contact-widget">
            <ul class="xs-list-item-icon-text-v2">
                <?php if($address != ''): ?>
                    <li>
                        <i class="icon icon-paper-plane"></i>
                        <div class="xs-contact-contet">
                            <?php echo esc_html($address); ?>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if($mobile != ''): ?>
                    <li>
                        <i class="icon icon-phone-call"></i>
                        <div class="xs-contact-contet">
                            <?php echo esc_html($mobile); ?>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if($email != ''): ?>
                    <li>
                        <i class="icon icon-email"></i>
                        <div class="xs-contact-contet">
                            <a href="mailto:<?php echo esc_html($email); ?>" class="d-block"><?php echo esc_html($email); ?></a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if($address_one != ''): ?>
                    <li>
                        <i class="icon icon-internet"></i>
                        <div class="xs-contact-contet">
                            <a href="<?php echo esc_url($address_one); ?>"><?php echo esc_html($address_one); ?></a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>    
        <?php
        echo crowdmerc_return($args['after_widget']);
    }
    
    
    function update ( $old_instance , $new_instance) {
        $new_instance['title'] = strip_tags( $old_instance['title'] );
        $new_instance['address'] = $old_instance['address'];
        $new_instance['address_one'] = $old_instance['address_one'];
        $new_instance['email'] = $old_instance['email'];
        $new_instance['mobile'] = $old_instance['mobile'];

        return $new_instance;
    	
    }
    
    function form($instance){
    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        else{
            $title = esc_html__( 'Contact', 'crowdmerc' );
        }

        $address = '';
        $address_one = '';
        $email = '';
        $mobile = '';

        if(isset($instance['address'])){
            $address = $instance['address'];
        }
        if(isset($instance['address_one'])){
            $address_one = $instance['address_one'];
        }
        if(isset($instance['email'])){
            $email = $instance['email'];
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'address_one' )); ?>"><?php esc_html_e( 'Address Two:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address_one' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'address_one' )); ?>" type="text" 
                       value="<?php echo esc_attr( $address_one ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>"><?php esc_html_e( 'Mobile:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'mobile' )); ?>" type="text" 
                       value="<?php echo esc_attr( $mobile ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e( 'Email:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="text" 
                       value="<?php echo esc_attr( $email ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e( 'Website:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" type="text"
                   value="<?php echo esc_attr( $address ); ?>" />
        </p>

    <?php
    }
}
