<?php
/**
 * Plugin Name: LD Cookie Consent
 * Description: Introduces the consent banner to the website
 * Author: Klipper
 * Version: 1.0
 * Author URI: https://klipper.ee
 */

defined('ABSPATH') or die();

define('LD_COOKIE_CONSENT_DIR', dirname(__FILE__));
define('LD_COOKIE_CONSENT_URL', plugin_dir_url(__FILE__));
define('LD_COOKIE_CONSENT_COOKIE', 'ldCookieConsent');

require_once('includes/class-ld-cookie-consent-ajax.php');

function ld_cookie_conset_set_cookie($data)
{
    $expires = time() + YEAR_IN_SECONDS;
    setcookie( LD_COOKIE_CONSENT_COOKIE, wp_json_encode($data), $expires, '/', $_SERVER['SERVER_NAME'], is_ssl(), true );
}

function ld_cookie_consent_get_cookie()
{
    $cookie = $_COOKIE[LD_COOKIE_CONSENT_COOKIE] ?? false;

    if( $cookie ) {
        return json_decode( stripslashes($cookie), true );
    }

    return array();
}

function ld_cookie_consent_oembed_html($html, $url, $attr)
{
    $cookie_consent = ld_cookie_consent_get_cookie();
    $apply_to_vendors = array('youtube.com', 'youtu.be', 'vimeo.com');

    if( !isset($cookie_consent['statistics']) && !isset($cookie_consent['marketing']) )
    {
        foreach( $apply_to_vendors as $vendor )
        {
            if( strpos($url, $vendor) !== false )
            {

                switch( $vendor )
                {
                    case 'youtube.com':
                        $html = str_replace('youtube.com', 'youtube-nocookie.com', $html);
                        break;

                    case 'vimeo.com':
                        // Already has dnt=1 parameter?
                        $html = $html;
                        break;

                }
            }
        }
    }


    return $html;
}
add_filter('embed_oembed_html', 'ld_cookie_consent_oembed_html', 10, 3);

function ld_add_cookie_consent_scripts()
{
    wp_enqueue_script('ld-cookie-consent', LD_COOKIE_CONSENT_URL . '/js/ld-cookie-consent.js', false);
}
add_action('wp_enqueue_scripts', 'ld_add_cookie_consent_scripts');

function ld_add_cookie_consent_block()
{
    ob_start();
    include(LD_COOKIE_CONSENT_DIR . '/templates/html.php');
    echo ob_get_clean();
}
add_action('wp_footer', 'ld_add_cookie_consent_block');
