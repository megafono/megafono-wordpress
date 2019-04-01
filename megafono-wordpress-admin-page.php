<?php

class MegafonoWordpressAdminPage {
    function __construct( ) {
        add_menu_page( 'Megafono', 'Megafono', 'manage_options', 'megafono', array( $this, 'render'), 'dashicons-megaphone', 61 );
    }

    public function render() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'megafono_settings';
        $uid = $wpdb->get_row( "SELECT value FROM $table_name WHERE name='uid' LIMIT 1");

        if ( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $this->handle_post($uid);

            $uid = $wpdb->get_row( "SELECT value FROM $table_name WHERE name='uid' LIMIT 1");
        }

        $uid_value = $uid ? $uid->value : '';

        include_once( 'views/admin.php' );
    }

    public function handle_post($uid) {
        if( check_admin_referer( 'megafono-settings-save', 'megafono-settings' ) && isset($_POST['megafono_uid']) ) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'megafono_settings';

            if ( $uid == null ) {
                $wpdb->insert(
                    $table_name,
                    array(
                        'name' => 'uid',
                        'value' => $_POST['megafono_uid'],
                    )
                );
            } else {
                $wpdb->update(
                    $table_name,
                    array(
                        'value' => $_POST['megafono_uid'],
                    ),
                    array(
                        'name' => 'uid'
                    )
                );
            }
        }
    }
}
?>