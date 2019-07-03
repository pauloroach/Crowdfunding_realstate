<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Creates widget with recent post thumbnail
 */

class Crowdmerc_social extends WP_Widget{
    function __construct() {
        $widget_opt = array(
            'classname'     => 'crowdmerc_widget',
            'description'   => 'fundpress Social'
        );
        
        parent::__construct('xs-social', esc_html__('Crowdmerc Social', 'crowdmerc'), $widget_opt);
    }
    
    function widget( $args, $instance ){

        echo crowdmerc_return($args['before_widget']);
        if ( !empty( $instance[ 'title' ] ) ) {

            echo crowdmerc_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . crowdmerc_return($args[ 'after_title' ]);
        }

        $facebook = '';
        $twitter = '';
        $google = '';
        $pinterest = '';
        $youtube = '';
        $linkedin = '';
        $social_style = 'style1';

        if(isset($instance['facebook'])){
            $facebook = $instance['facebook'];
        }
        if(isset($instance['twitter'])){
            $twitter = $instance['twitter'];
        }
        if(isset($instance['google'])){
            $google = $instance['google'];
        }
        if(isset($instance['pinterest'])){
            $pinterest = $instance['pinterest'];
        }
        if(isset($instance['youtube'])){
            $youtube = $instance['youtube'];
        }
        if(isset($instance['linkedin'])){
            $linkedin = $instance['linkedin'];
        }
        if(isset($instance['social_style'])){
            $social_style = $instance['social_style'];
        }

        if($social_style == 'style1'):
        ?>
        <ul class="xs-social-list xs-social-list-v6 fundpress-social-list">

            <?php if($facebook != ''): ?>
                <li><a href="<?php echo esc_url($facebook); ?>" class="color-facebook"><i class="fa fa-facebook"></i><?php echo esc_html__( 'Facebook', 'crowdmerc' ) ?></a></li>
            <?php endif; ?>

            <?php if($twitter != ''): ?>
                <li><a href="<?php echo esc_url($twitter); ?>" class="color-twitter"><i class="fa fa-twitter"></i><?php echo esc_html__( 'Twitter', 'crowdmerc' ) ?></a></li>
            <?php endif; ?>

             <?php if($google != ''): ?>
                <li><a href="<?php echo esc_url($google); ?>" class="color-pinterest"><i class="fa fa-google-plus"></i><?php echo esc_html__( 'google', 'crowdmerc') ?></a></li>
            <?php endif; ?>

            <?php if($pinterest != ''): ?>
                <li><a href="<?php echo esc_url($pinterest); ?>" class="color-pinterest"><i class="fa fa-pinterest-p"></i><?php echo esc_html__( 'Pinterest', 'crowdmerc' ) ?></a></li>
            <?php endif; ?>

            <?php if($youtube != ''): ?>
            <li><a href="<?php echo esc_url($youtube); ?>" class="color-instagram"><i class="fa fa-instagram"></i><?php echo esc_html__( 'Instagram', 'crowdmerc' ) ?></a></li>
            <?php endif; ?>

            <?php if($linkedin != ''): ?>
            <li><a href="<?php echo esc_url($linkedin); ?>" class="color-dribbble"><i class="fa fa-dribbble"></i><?php echo esc_html__( 'Dribbble', 'crowdmerc' ) ?></a></li>
            <?php endif; ?>
        </ul>
        <?php else: ?>
            <ul class="xs-social-list fundpress-social-list">

                <?php if($facebook != ''): ?>
                    <li><a href="<?php echo esc_url($facebook); ?>" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>

                <?php if($twitter != ''): ?>
                    <li><a href="<?php echo esc_url($twitter); ?>" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>

                <?php if($google != ''): ?>
                    <li><a href="<?php echo esc_url($google); ?>" class="color-pinterest full-round"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>

                <?php if($pinterest != ''): ?>
                    <li><a href="<?php echo esc_url($pinterest); ?>" class="color-pinterest full-round"><i class="fa fa-pinterest-p"></i></a></li>
                <?php endif; ?>

                <?php if($youtube != ''): ?>
                    <li><a href="<?php echo esc_url($youtube); ?>" class="color-instagram full-round"><i class="fa fa-instagram"></i></a></li>
                <?php endif; ?>

                <?php if($linkedin != ''): ?>
                    <li><a href="<?php echo esc_url($linkedin); ?>" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        <?php
        echo crowdmerc_return($args['after_widget']);
    }
    
    
    function update ( $old_instance , $new_instance) {
        $new_instance['title'] = strip_tags( $old_instance['title'] );
        $new_instance['facebook'] = $old_instance['facebook'];
        $new_instance['twitter'] = $old_instance['twitter'];
        $new_instance['google'] = $old_instance['google'];
        $new_instance['pinterest'] = $old_instance['pinterest'];
        $new_instance['youtube'] = $old_instance['youtube'];
        $new_instance['linkedin'] = $old_instance['linkedin'];
        $new_instance['social_style'] = $old_instance['social_style'];

        return $new_instance;
    	
    }
    
    function form($instance){
    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        else{
            $title = esc_html__( 'Social', 'crowdmerc' );
        }

        $facebook = '';
        $twitter = '';
        $google = '';
        $pinterest = '';
        $youtube = '';
        $linkedin = '';
        $social_style = 'style1';

        if(isset($instance['facebook'])){
            $facebook = $instance['facebook'];
        }
        if(isset($instance['twitter'])){
            $twitter = $instance['twitter'];
        }
        if(isset($instance['google'])){
            $google = $instance['google'];
        }
        if(isset($instance['pinterest'])){
            $pinterest = $instance['pinterest'];
        }
        if(isset($instance['youtube'])){
            $youtube = $instance['youtube'];
        }
        if(isset($instance['linkedin'])){
            $linkedin = $instance['linkedin'];
        }
        if(isset($instance['social_style'])){
            $social_style = $instance['social_style'];
        }
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'social_style' )); ?>"><?php esc_html_e( 'Style:' , 'crowdmerc' ); ?></label>
            <?php $alignment_args = array('style1','style2') ?>
            <select id="<?php echo esc_attr($this->get_field_id('social_style')); ?>" name="<?php echo esc_attr($this->get_field_name('social_style')); ?>" class="widefat" style="width:100%;">
                <?php foreach($alignment_args as $alignment) { ?>
                    <option <?php selected( $social_style, $alignment ); ?> value="<?php echo esc_attr($alignment); ?>"><?php echo esc_html($alignment); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e( 'Facebook:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" 
                       value="<?php echo esc_attr( $facebook ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e( 'Twitter:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" 
                       value="<?php echo esc_attr( $twitter ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'google' )); ?>"><?php esc_html_e( 'Google Plus:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" type="text" 
                       value="<?php echo esc_attr( $google ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php esc_html_e( 'Pinterest:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" type="text" 
                       value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e( 'Instagram:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" type="text" 
                       value="<?php echo esc_attr( $youtube ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php esc_html_e( 'Dribbble:' , 'crowdmerc' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" type="text" 
                       value="<?php echo esc_attr( $linkedin ); ?>" />
        </p>
    <?php
    }
}
