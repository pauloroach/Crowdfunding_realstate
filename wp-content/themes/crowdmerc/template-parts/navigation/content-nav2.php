<?php
/*
 * This is for nav style
 *
 */

$site_logo = crowdmerc_option('site_logo');
$show_login = crowdmerc_option('show_login', crowdmerc_defaults('show_login'));
$show_header_cta = crowdmerc_option('show_header_cta', crowdmerc_defaults('show_header_cta'));
$cta_btn_label = crowdmerc_option('cta_btn_label', crowdmerc_defaults('cta_btn_label'));
$cta_btn_link = crowdmerc_option('cta_btn_link', crowdmerc_defaults('cta_btn_link'));
$show_border = crowdmerc_option('show_border', crowdmerc_defaults('show_border'));

if(!$show_login){
    $wrap_class = 'xs_no_login';
}else{
    $wrap_class = '';
}
$header_class = ($show_border) ? 'xs-menu-style-border' : '';
?>
<!-- header section -->
<header class="fundpress-header-main-version header-boxed">
    <div class="container">
        <nav class="xs-menus fundpress-menu fundpress-menu-v2">
            <div class="nav-header">
                <div class="nav-toggle"></div>
                <a class="nav-brand nav-logo" href="<?php echo esc_url(home_url('/'));?>">
                    <?php if(!empty($site_logo)): ?>
                        <img src="<?php echo esc_url($site_logo);  ?>" alt="<?php echo get_bloginfo(); ?>">
                    <?php else: ?>
                        <?php bloginfo('name'); ?>
                    <?php endif ?>
                </a>
            </div><!-- . END -->
            <div class="nav-menus-wrapper <?php echo esc_attr($wrap_class); ?>">
                <div class="xs-logo-wraper">
                    <a class="nav-brand xs-logo fundpress-logo-v3" href="<?php echo esc_url(home_url('/'));?>">
                        <?php if(!empty($site_logo)): ?>
                            <img src="<?php echo esc_url($site_logo);  ?>" alt="<?php echo get_bloginfo(); ?>">
                        <?php else: ?>
                            <?php bloginfo('name'); ?>
                        <?php endif ?>
                    </a>
                </div>

                <?php
                if(has_nav_menu('primary')) {
                    wp_nav_menu(array(
                            'menu'				 => 'primary',
                            'menu_class'		 => 'nav-menu',
                            'theme_location'	 => 'primary',
                            'container'			 => false,
                            'walker'			 => new crowdmerc_xs_navwalker(),
                        )
                    );
                }
                ?>
                <?php if(class_exists('Xs_Main')): ?>
                    <?php if($show_login): ?>
                        <div class="xs-navs-button">
                            <ul class="fundpress-icon-menu">
                                <?php if(!is_user_logged_in()): ?>
                                    <li><a href="#" class="badge badge-pill badge-primary" data-toggle="modal" data-target=".bd-login-modal"><i class="fa fa-user"></i><?php echo esc_html__('Log in','crowdmerc'); ?></a></li>
                                <?php else: ?>
                                    <?php
                                    $dashboard = crowdmerc_option('crowdmerc_dashbord', crowdmerc_defaults('crowdmerc_dashbord'));
                                    if(empty($dashbord)){
                                        if(is_page('wf-dashboard')){
                                            $dashboard = get_the_permalink(get_page_by_path('wf-dashboard'));
                                        }
                                    }
                                    ?>
                                    <li class="xs_sub_menu">
                                        <a href="<?php echo esc_url($dashboard); ?>" class="xs-logged badge badge-pill badge-primary"><?php echo esc_html__('Dashboard','crowdmerc'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- .nav-menus-wrapper END -->
        </nav><!-- .xs-menus .fundpress-menu END -->
    </div>
</header>







