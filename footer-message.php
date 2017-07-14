<?php
/**
 * Block AdBlock 1.3.0 front end message template
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $kill_adblock_name;
?>
<div class="<?php echo $kill_adblock_name?>-container <?php echo $kill_adblock_name?>-<?php echo get_option('kill_adBlock_message_type');?> <?php echo $kill_adblock_name?>-hide">
    <div class="<?php echo $kill_adblock_name?>-body">
        <?php if(get_option('kill_adBlock_close_btn')){?>
        <span class="close-btn">×</span>
        <?php }?>
        <?php if(get_option('kill_adBlock_message_type')!=1){?>
        <img src="<?php echo plugin_dir_url( __FILE__ ) . '/images/logo.png'?>">
        <?}?>
        <div class="<?php echo $kill_adblock_name?>"></div>
    </div>
</div>