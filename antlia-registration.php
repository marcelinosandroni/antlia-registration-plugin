<?php
/*
Plugin Name: Antlia Registration
Plugin URI: https://www.github.com/marcelinosandroni
Description: Process users registration in Antlia WebSite
Version: 1.0
Author: Marcelino Sandroni
Author URI: https://www.github.com/marcelinosandroni
*/

// namespace MarcelinoSandroni\AntliaRegistration;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/mail.php';
require_once __DIR__ . '/includes/register-clt.php';
require_once __DIR__ . '/includes/register-pj.php';
require_once __DIR__ . '/includes/register-coop.php';
require_once __DIR__ . '/includes/config.php';



use Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function antlia_registration_register_routes()
{
    register_rest_route($_ENV['API_ROOT_ROUTE'], 'healthcheck', array(
        'methods' => 'GET',
        'callback' => 'antlia_registration_health_check',
        'permission_callback' => '__return_true',
        true
    )
    );
    register_rest_route($_ENV['API_ROOT_ROUTE'], $_ENV['API_CLT_ROUTE'], array(
        'methods' => 'POST',
        'callback' => 'antlia_registration_clt',
        'permission_callback' => '__return_true'
    )
    );
    register_rest_route($_ENV['API_ROOT_ROUTE'], $_ENV['API_PJ_ROUTE'], array(
        'methods' => 'POST',
        'callback' => 'antlia_registration_pj'
    )
    );
    register_rest_route($_ENV['API_ROOT_ROUTE'], $_ENV['API_COOP_ROUTE'], array(
        'methods' => 'POST',
        'callback' => 'antlia_registration_coop'
    )
    );
}

function antlia_registration_health_check(WP_REST_Request $request)
{
    return array(
        'status' => 'ok',
        'message' => 'Antlia Registration API is up and running',
        'version' => '1.0.0',
        'author' => 'Marcelino Sandroni',
        'api_root_route' => $_ENV['API_ROOT_ROUTE'],
        'api_clt_route' => $_ENV['API_CLT_ROUTE'],
        'api_pj_route' => $_ENV['API_PJ_ROUTE'],
        'api_coop_route' => $_ENV['API_COOP_ROUTE']
        );
}

function antlia_registration_clt(WP_REST_Request $request)
{
    $form_data = $request->get_body_params();
    $updatedFilePath = register_clt($form_data);
    $response = send_mail_with_file($form_data, RegistrationType::CLT, $updatedFilePath);
    @unlink($updatedFilePath);
    return $response;
}

function antlia_registration_pj(WP_REST_Request $request)
{
    $form_data = $request->get_body_params();
    $updatedFilePath = register_pj($form_data);
    $response = send_mail_with_file($form_data['nome'], 'pj', $updatedFilePath);
    @unlink($updatedFilePath);
    return $response;
}

function antlia_registration_coop(WP_REST_Request $request)
{
    $form_data = $request->get_body_params();
    $updatedFilePath = register_coop($form_data);
    $response = send_mail_with_file($form_data['nome'], 'coop', $updatedFilePath);
    @unlink($updatedFilePath);
    return $response;
}

add_action('rest_api_init', 'antlia_registration_register_routes');

/*
 * ADMIN PAGE
 * 
 * todo
 * 
 * - Add a menu item under the "Settings" menu
 * - Add a settings section
 * - Add a field for email recipients
 */


## SETTING PAGE

// function antlia_registration_register_settings() {
//     // Register a settings section for the plugin
//     add_settings_section(
//         'antlia_registration_settings',
//         'Antlia Registration Settings',
//         'antlia_registration_render_settings_section',
//         'antlia-registration-settings'
//     );

//     // Add field for email recipients
//     add_settings_field(
//         'antlia_registration_email_recipients',
//         'Email Recipients',
//         'antlia_registration_render_email_recipients_field',
//         'antlia-registration-settings',
//         'antlia_registration_settings'
//     );
//     register_setting('antlia_registration_settings', 'antlia_registration_email_recipients');


//     // // Add a field for the frequency
//     // add_settings_field(
//     //     'myplugin_frequency',
//     //     'Frequency',
//     //     'myplugin_render_frequency_field',
//     //     'myplugin',
//     //     'myplugin_settings'
//     // );
//     // register_setting('myplugin_settings', 'myplugin_frequency');
// }
// add_action('admin_init', 'antlia_registration_register_settings');


// function antlia_registration_register_settings_page() {
//     add_options_page(
//         'Antlia Registration Settings',
//         'Antlia Registration',
//         'manage_options',
//         'antlia-registration',
//         'antlia_registration_render_settings_page'
//     );
// }

// add_action('admin_menu', 'antlia_registration_register_settings_page');