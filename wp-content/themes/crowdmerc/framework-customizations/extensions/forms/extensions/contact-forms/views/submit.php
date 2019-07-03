<?php
if (!defined('FW'))
    die('Forbidden');
/**
 * @var string $submit_button_text
 */
?>
<div class="form-group text-right">
    <button type="submit" class="margin-top-20 btn btn-primary solid blank"><i class="fa fa-send"></i> <?php echo esc_attr($submit_button_text) ?></button>
</div>