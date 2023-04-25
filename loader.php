<?php
# Load plugin files on activation
define( 'ANTLIA_REGISTRATION_DIR', dirname( __FILE__ ) );
add_action( 'plugins_loaded', 'antlia_registration_load_files' );

function antlia_registration_load_files() {
    require_once ANTLIA_REGISTRATION_DIR . '/src/antlia-registration.php';
}

