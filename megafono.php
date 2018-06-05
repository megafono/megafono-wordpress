<?php
/**
 * Plugin Name: Megafono
 * Plugin URI: http://megafono.host
 * Description: This plugin adds integration between Megafono platform and your wordpress blog.
 * Version: 1.0.0
 * Author: Megafono Host
 * Author URI: http://megafono.host
 * License: GPL2
 */

class Megafono {
  public function __construct() {
    if ( is_admin() ) {
      # add_action( 'admin_init', 'setup_settings' );
      add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
      add_action( 'add_meta_boxes', array( $this, 'setup_post_metabox' ) );
      add_action( 'save_post', array( $this, 'save_post_metabox' ) );
    }
  }

  public function setup_settings() {

  }

  public function create_plugin_settings_page() {
    $page_title = 'Megafono Settings Page';
    $menu_title = 'Megafono';
    $capability = 'manage_options';
    $slug = 'megafono';
    $callback = array( $this, 'plugin_settings_page_content' );
    $icon = 'dashicons-admin-plugins';
    $position = 100;

    add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
  }

  public function setup_post_metabox($e) {
    $post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'object' );

    if ( ! $post_types )
            return;

    foreach ( $post_types as $post_type ) {
      if ( $post_type ) {
          $id = $post_type->name;
          add_meta_box( "megafono_post_metabox_{$id}", "Megafono", array( $this, 'post_metabox'), $post_type->name, 'side', 'high');
      }
    }
  }

  public function save_post_metabox($post) {
    if ( ! isset( $_POST['nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['nonce'], 'nonce_value' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

  }


  public function plugin_settings_page_content() {
    echo 'Hello World!';
  }

  public function post_metabox() {
    $nonce = wp_create_nonce( 'mp-metabox' );
    $value = get_post_meta($post->ID, '_megafono_id', true);
    ?>
    <label for="megafono_id">Description for this field</label>
    <select name="megafono_id" id="megafono_id" class="postbox">
        <option value="">Select something...</option>
        <option value="something" <?php selected($value, 'something'); ?>>Something</option>
        <option value="else" <?php selected($value, 'else'); ?>>Else</option>
    </select>
    <?php
  }
}

new Megafono();
?>
