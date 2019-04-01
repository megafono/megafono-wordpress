<?php
/**
 * Plugin Name: Megafono
 * Plugin URI: https://www.megafono.host
 * Description: This plugin adds integration between Megafono platform and your wordpress blog.
 * Author: Megafono
 * Author URI: https://www.megafono.host
 * Text Domain: Text-domain
 * Version: 0.2.0
 *
 * @package         Megafono
 */

require_once( 'megafono-wordpress-updater.php' );
require_once( 'megafono-wordpress-admin-page.php' );
require_once( 'megafono-wordpress-data-management.php' );

class MegafonoWordpress {
    public function __construct() {
        add_filter( 'embed_defaults', array( $this, 'embed_defaults'), 10, 2 );
        add_action( 'admin_menu', array( $this, 'admin_menu') );

        add_filter( 'feed_link', array( $this, 'redirect_feed_link' ) );

        new MegafonoWordpressDataManagement();

        if( is_admin() ) {
            new MegafonoWordpressUpdater( __FILE__, 'megafono', 'megafono-wordpress' );
        }
    }

    public function embed_defaults( $embed_size, $url ) {
        if ( $this->is_megafono_url($url) ) {
            $embed_size['height'] = 190;
        }

        return $embed_size;
    }

    public function redirect_feed_link($url) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'megafono_settings';
        $uid = $wpdb->get_row( "SELECT value FROM $table_name WHERE name='uid' LIMIT 1");

        if ( strpos( $url, 'comments' ) )
            return $url;

        if ( strpos( $url, 'podcast' ) && isset($uid) && isset($uid->value) && strlen($uid->value) > 0 ) {
            return esc_url( "https://feed.megafono.host/$uid->value" );
        } else {
            return $url;
        }
    }

    public function admin_menu() {
        new MegafonoWordpressAdminPage();
    }


    private function is_megafono_url($url) {
        return preg_match('/megafono\.host/', $url) || preg_match('/^(.*)\/e\/([\w-]+)$/', $url) ;
    }


}

new MegafonoWordpress();
