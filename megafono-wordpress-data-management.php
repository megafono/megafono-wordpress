<?php

    global $megafono_db_version;
    $megafono_db_version = '1.0';

    function uninstall() {
        delete_option('megafono_db_version');
    }

    register_uninstall_hook( __FILE__, 'uninstall' );
    register_deactivation_hook( __FILE__, 'uninstall' );


    class MegafonoWordpressDataManagement {
        public function __construct() {
            register_activation_hook( __FILE__, array($this, 'install') );
            register_activation_hook( __FILE__, array($this, 'install_data') );

            add_action( 'plugins_loaded', array($this, 'update') );
            add_action( 'admin_init', array($this, 'update') );
        }


        public function install() {
            global $wpdb;
            global $megafono_db_version;

            $table_name = $wpdb->prefix . 'megafono_settings';
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(55) NOT NULL,
                value varchar(55)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'megafono_db_version', $megafono_db_version );

            $this->install_data();
        }

        public function install_data() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'megafono_settings';

            // $wpdb->insert(
            //     $table_name,
            //     array(
            //         'name' => 'uid',
            //         'value' => '',
            //     )
            // );
        }

        public function update() {
            global $megafono_db_version;

            if ( get_site_option( 'megafono_db_version' ) != $megafono_db_version ) {
                $this->install();
            }
        }
    }
?>