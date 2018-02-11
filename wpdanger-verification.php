<?php
/*
Plugin Name: WPdanger Verification
Plugin URI: https://www.wpdanger.com/
Description: Allows you to add your WPdanger Verification code to your WordPress site.
Version: 1.0.0
Author: Javier Casares
Author URI: https://www.javiercasares.com/
License: GPLv2 or later
*/
defined('ABSPATH') or die('Bye bye!');
if ( !class_exists('wpdanger_verification') )
{
  class wpdanger_verification
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
          echo '<meta name="wpdanger" content="' . htmlentities(stripslashes($verification_code), ENT_COMPAT, 'UTF-8') .'">' . "\n";
				}
			}
		}	
	}
	$wpdanger_verification_meta = new wpdanger_verification();
	if (isset($wpdanger_verification_meta))
  {
		add_action( 'wp_head', array(&$wpdanger_verification_meta, 'wpdanger_verification_show' ) );
		add_action( 'admin_init', 'wpdanger_register_meta' );
		add_action( 'admin_menu', 'wpdanger_register_menu');
		function wpdanger_register_menu()
    {
      add_options_page('WPdanger Verification code', 'WPdanger Verification', 'manage_options', 'wpdanger_verification', 'wpdanger_verification_show');	
		}
	}
	function wpdanger_register_meta()
	{
    register_setting( 'wpdanger-verification-settings', 'wpdanger_verification_code' );
	}
	function wpdanger_verification_show()
	{
?>
		<div class="wrap">
      <h2>WPdanger Verification</h2>
      <p>Copy the WPdanger Verification Code and paste in below.</p>
      <form method="post" action="options.php">
<?php
  settings_fields( 'wpdanger-verification-settings' );
?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">WPdanger Verification Code</th>
            <td scope="row"><input type="text" name="wpdanger_verification_code" value="<?php echo get_option('wpdanger_verification_code'); ?>"></td>
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
?>