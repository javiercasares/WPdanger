<?php
if ( defined( 'ABSPATH' ) && defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	delete_option( 'wpdanger_verification_code' );
}
