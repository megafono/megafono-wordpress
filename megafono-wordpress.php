<?php
/**
 * Plugin Name: Megafono
 * Plugin URI: https://www.megafono.host
 * Description: This plugin adds integration between Megafono platform and your wordpress blog.
 * Author: Megafono
 * Author URI: https://www.megafono.host
 * Text Domain: Text-domain
 * Domain Path: /path-domain
 * Version: 1.0.0
 *
 * @package         Megafono
 */

class Megafono {
    public function __construct() {
        add_filter( 'embed_defaults', array( $this, 'embed_defaults'), 10, 2 );
    }

    public function embed_defaults($embed_size, $url) {
        if ( $this->is_megafono_url($url) ) {
            $embed_size['height'] = 190;
        }

        return $embed_size;
    }

    public function is_megafono_url($url) {
        return preg_match('/^(.*)\/e\/([\w-]+)$/', $url);
    }
}

new Megafono();
