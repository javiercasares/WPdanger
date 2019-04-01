<?php
/*
Plugin Name: WPdanger Verification
Plugin URL:  https://www.javiercasares.com/wpdanger-verification/
Description: Allows you to add your WPdanger Verification code to your WordPress site.
Tags: wpdanger, security, pentesting
Version: 1.1.0
Requires at least: 4.9.0
Requires PHP: 7.0
Tested up to: 5.2.0
Stable tag: trunk
Author: Javier Casares
Author URI: https://www.javiercasares.com/
License: EUPL 1.2
License URI: https://eupl.eu/1.2/en/
Text Domain: wpdanger-verification
*/
defined('ABSPATH') or die('Bye bye!');
if ( !class_exists('wpdanger_verification') )
{
	function wpdanger_verification()
	{
		// nothing to do here!
	}
	function wpdanger_verification_show()
	{
		global $post;
		if( !is_404() )
		{
			$ok = false;
			$verification_code = null;
			if( is_home() || is_front_page() )
			{
				$verification_code = get_option( 'wpdanger_verification_code' );
				if($verification_code)
				{
					$ok = true;
				}
			}
			if ( $ok )
			{
				echo '<meta name="wpdanger" content="' . wp_kses($verification_code, array(), array()) .'">' . "\n";
			}
			unset($ok, $verification_code);
		}
	}	
	$wpdanger_verification_meta = wpdanger_verification();
	if (isset($wpdanger_verification_meta))
  {
		add_action( 'wp_head', array(&$wpdanger_verification_meta, 'wpdanger_verification_show' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpdanger_verification_settings_link' );
		add_action( 'admin_init', 'wpdanger_verification_register_meta' );
		add_action( 'admin_menu', 'wpdanger_verification_register_menu');
		function wpdanger_verification_register_menu()
    {
      add_options_page(__('WPdanger Verification code', 'wpdanger-verification'), __('WPdanger Verification', 'wpdanger-verification'), 'manage_options', 'wpdanger_verification', 'wpdanger_verification_screenprint');	
		}
		add_action( 'plugins_loaded', 'wpdanger_verification_textdomain' );	
		function wpdanger_verification_textdomain() {
			load_plugin_textdomain( 'wpdanger-verification', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}
	function wpdanger_verification_settings_link( $links )
	{
		$links[] = '<a href="' . get_admin_url( null, 'options-general.php?page=wpdanger_verification' ) . '">' . _('Settings') . '</a>';
		return $links;
	}
	function wpdanger_verification_register_meta()
	{
    register_setting( 'wpdangerverification', 'wpdanger_verification_code', array('type' => 'string', 'default' => null) );
	}
	function wpdanger_verification_screenprint()
	{
?>
		<div class="wrap">
      <h2><?php _e('WPdanger Verification', 'wpdanger-verification'); ?></h2>
      <p><?php _e('Copy the WPdanger Verification Code and paste in below.', 'wpdanger-verification'); ?></p>
      <form method="post" action="options.php">
<?php
  settings_fields( 'wpdangerverification' );
?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row"><?php _e('WPdanger Verification Code', 'wpdanger-verification'); ?></th>
            <td scope="row"><input type="text" name="wpdanger_verification_code" value="<?php echo wp_kses(get_option('wpdanger_verification_code'), array(), array()); ?>"></td>
          </tr>
        </table>
        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
      </form>
		</div>
<?php
  }
}
