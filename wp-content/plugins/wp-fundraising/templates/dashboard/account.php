<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$data = get_user_meta(get_current_user_id());


$current_user = wp_get_current_user();

$first_name = $last_name = $description = '';
$user_login = $current_user->user_login;
if( isset($_POST['userEmail']) ){
    $user_email = sanitize_text_field($_POST['userEmail']);
}else{
    $user_email = $current_user->user_email;
}
if( isset($_POST['userWebSite']) ){
    $user_url = sanitize_text_field($_POST['userWebSite']);
}else{
    $user_url = $current_user->user_url;
}

if(isset($data['first_name'][0])){
    $first_name = $data['first_name'][0];
}
if(isset($data['last_name'][0])){
    $last_name = $data['last_name'][0];
}
if(isset($data['description'][0])){
    $description = sanitize_textarea_field($data['description'][0]);
}
?>
<div class="tab-pane slideUp xs-dashboard" id="myAccount" role="tabpanel">
    <form action="#" method="POST" class="xs-campaign xs-dashboard-info">
        <h4 class="dashboard-content-title"><?php esc_html_e('My Information','wp-fundraising');?></h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Username','wp-fundraising');?></h3>
                    <input type="text" readonly="readonly" disabled value="<?php echo $user_login; ?>" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Email','wp-fundraising');?></h3>
                    <input type="email" disabled value="<?php echo $user_email; ?>" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                    <input type="text" disabled value="<?php echo $first_name; ?>" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                    <input type="text" disabled value="<?php echo $last_name; ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="h3"><?php esc_html_e('Website','wp-fundraising');?></h3>
            <input type="url" disabled value="<?php echo $user_url; ?>" class="form-control">
        </div>
        <div class="form-group">
            <h3 class="h3"><?php esc_html_e('Bio','wp-fundraising');?></h3>
            <textarea class="form-control form-control-sm" disabled rows="3"><?php echo $description; ?></textarea>
        </div>
        <div class="xs-btn-wraper">
            <a href="#" class="btn btn-outline-success formEdit"><?php esc_html_e('Edit','wp-fundraising');?></a>
        </div>
    </form>
    <form action="#" method="POST" id="myDashAccount" class="xs-campaign xs-dashboard-form">
        <h4 class="dashboard-content-title"><?php esc_html_e('My Information','wp-fundraising');?></h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Username','wp-fundraising');?></h3>
                    <input type="text" class="form-control" disabled name="userName" id="userName" value="<?php echo $user_login; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Email','wp-fundraising');?></h3>
                    <input type="email" class="form-control" name="userEmail" id="email" value="<?php echo $user_email; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                    <input type="text" class="form-control" name="userFName" id="fName" value="<?php echo $first_name; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                    <input type="text" class="form-control" name="userLName" id="lName" value="<?php echo $last_name; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="h3"><?php esc_html_e('Website','wp-fundraising');?></h3>
            <input type="url" class="form-control" name="userWebSite" id="webSite" value="<?php echo $user_url; ?>">
        </div>
        <div class="form-group">
            <h3 class="h3"><?php esc_html_e('Bio','wp-fundraising');?></h3>
            <textarea class="form-control form-control-sm" name="userBio" id="bio" rows="3"> <?php echo $description; ?></textarea>
        </div>
        <div class="xs-btn-wraper">
            <a href="#" class="btn btn-outline-danger formCancel"><?php esc_html_e('Cancel','wp-fundraising');?></a>
            <input class="btn btn-success" type="submit" name="userUpdate" value="<?php esc_html_e('Save','wp-fundraising');?>" />
        </div>
    </form><!-- #myDashAccount END -->
</div><!-- #myAccount END -->