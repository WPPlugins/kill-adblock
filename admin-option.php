<?php
/**
 * Block AdBlock 1.2.0 admin panel.
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * add Kill AdBlock Plugin Settings to admin menu.
 */
function kill_adblock_create_menu() {
	//create new top-level menu
	add_menu_page(__( 'Kill AdBlock Plugin Settings', 'kill-adblock' ), __( 'Kill AdBlock Settings', 'kill-adblock' ), 'administrator', __FILE__, 'kill_adblock_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_kill_adblock_settings' );
}
add_action('admin_menu', 'kill_adblock_create_menu');
/**
 * register our settings.
 */
function register_kill_adblock_settings() {
	//register our settings
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_status' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_random_class_name' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_message' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_message_delay' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_close_btn' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_close_automatically' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_close_automatically_delay' );
	register_setting( 'kill-adblock-settings-group', 'kill_adBlock_message_type' );
}
/**
 * settings page.
 */
function kill_adblock_settings_page() {
?>
<div class="wrap">
<h2><?php _e( 'Kill AdBlock', 'kill-adblock' )?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'kill-adblock-settings-group' ); ?>
    <?php do_settings_sections( 'kill-adblock-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Kill AdBlock Status', 'kill-adblock' )?></th>
            <td>
                <fieldset><legend class="screen-reader-text"><span><?php _e( 'Kill AdBlock Status', 'kill-adblock' )?></span></legend>
                <label title="<?php _e( 'Enable', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_status" value="1" <?php if(esc_attr( get_option('kill_adBlock_status') ) == 1 ){ ?> checked="checked"<?php }?>> <?php _e( 'Enable', 'kill-adblock' )?></label><br>
                <label title="<?php _e( 'Disable', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_status" value="0" <?php if(esc_attr( get_option('kill_adBlock_status') ) == 0 ){ ?> checked="checked"<?php }?>> <?php _e( 'Disable', 'kill-adblock' )?></label><br>
                </fieldset>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Use Random Class name', 'kill-adblock' )?></th>
            <td>
                <fieldset><legend class="screen-reader-text"><span><?php _e( 'Use Random Class name', 'kill-adblock' )?></span></legend>
                <label title="<?php _e( 'Enable', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_random_class_name" value="1" <?php if(esc_attr( get_option('kill_adBlock_random_class_name') ) == 1 ){ ?> checked="checked"<?php }?>> <?php _e( 'Enable', 'kill-adblock' )?></label><br>
                <label title="<?php _e( 'Disable', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_random_class_name" value="0" <?php if(esc_attr( get_option('kill_adBlock_random_class_name') ) == 0 ){ ?> checked="checked"<?php }?>> <?php _e( 'Disable', 'kill-adblock' )?></label><br>
                </fieldset>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Message', 'kill-adblock' )?></th>
            <td>
                <textarea name="kill_adBlock_message" id="kill_adBlock_message" class="large-text code" rows="3"><?php echo esc_attr( get_option('kill_adBlock_message') ); ?></textarea>
                <br><span><?php _e( 'Message When AdBlock is enabled', 'kill-adblock' )?></span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Message Delay', 'kill-adblock' )?></th>
            <td><input type="number" class="small-text" name="kill_adBlock_message_delay" value="<?php echo esc_attr( get_option('kill_adBlock_message_delay') ); ?>" /> <span><?php _e( 'Time In Seconds To Show Kill Message', 'kill-adblock' )?></span></td>
        </tr>
            <tr valign="top">
            <th scope="row"><?php _e( 'Display Close Button', 'kill-adblock' )?></th>
            <td>
                <fieldset><legend class="screen-reader-text"><span>Show Close Button</span></legend>
                <label title="<?php _e( 'Yes', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_close_btn" value="1" <?php if(esc_attr( get_option('kill_adBlock_close_btn') ) == 1 ){ ?> checked="checked"<?php }?>> <?php _e( 'Yes', 'kill-adblock' )?></label><br>
                <label title="<?php _e( 'No', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_close_btn" value="0" <?php if(esc_attr( get_option('kill_adBlock_close_btn') ) == 0 ){ ?> checked="checked"<?php }?>> <?php _e( 'No', 'kill-adblock' )?></label><br>
                </fieldset>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Close Message Automatically', 'kill-adblock' )?></th>
            <td>
                <fieldset><legend class="screen-reader-text"><span><?php _e( 'Close Message Automatically', 'kill-adblock' )?></span></legend>
                <label title="<?php _e( 'Yes', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_close_automatically" value="1" <?php if(esc_attr( get_option('kill_adBlock_close_automatically') ) == 1 ){ ?> checked="checked"<?php }?>> <?php _e( 'Yes', 'kill-adblock' )?></label><br>
                <label title="<?php _e( 'No', 'kill-adblock' )?>"><input type="radio" name="kill_adBlock_close_automatically" value="0" <?php if(esc_attr( get_option('kill_adBlock_close_automatically') ) == 0 ){ ?> checked="checked"<?php }?>> <?php _e( 'No', 'kill-adblock' )?></label><br>
                </fieldset>
            </td>
        </tr>
         
        <tr valign="top">
            <th scope="row"><?php _e( 'Close Message Automatically Delay', 'kill-adblock' )?></th>
            <td><input type="number" class="small-text" name="kill_adBlock_close_automatically_delay" value="<?php echo esc_attr( get_option('kill_adBlock_close_automatically_delay') ); ?>" /> <span><?php _e( 'Time In Seconds and You Should Active Previous  Option', 'kill-adblock' )?></span></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Message Type', 'kill-adblock' )?></th>
            <td>
                <fieldset><legend class="screen-reader-text"><span><?php _e( 'Message Type', 'kill-adblock' )?></span></legend>
                <label title="Sticky Bar"><input type="radio" name="kill_adBlock_message_type" value="1" <?php if(esc_attr( get_option('kill_adBlock_message_type') ) == 1 ){ ?> checked="checked"<?php }?>> <?php _e( 'Sticky Bar', 'kill-adblock' )?></label><br>
                <label title="Full Screen"><input type="radio" name="kill_adBlock_message_type" value="2" <?php if(esc_attr( get_option('kill_adBlock_message_type') ) == 2 ){ ?> checked="checked"<?php }?>> <?php _e( 'Full Screen', 'kill-adblock' )?></label><br>
                <label title="Flying Box"><input type="radio" name="kill_adBlock_message_type" value="3" <?php if(esc_attr( get_option('kill_adBlock_message_type') ) == 3 ){ ?> checked="checked"<?php }?>> <?php _e( 'Flying Box', 'kill-adblock' )?></label><br>
                </fieldset>
            </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }