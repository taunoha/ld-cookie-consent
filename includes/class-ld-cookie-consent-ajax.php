<?php

defined('ABSPATH') or die();


class LD_Cookie_Consent_Ajax
{
    static private $class = null;

    public static function init()
    {
        if( null === self::$class ) {
            self::$class = new self;
        }

        return self::$class;
    }

    public function __construct()
    {
        add_action('wp_ajax_ld_cookie_consent', array($this, 'request') );
        add_action('wp_ajax_nopriv_ld_cookie_consent', array($this, 'request') );
    }

    public function request()
    {
        $type = $_REQUEST['type'] ?? 'all';
        $type = strtolower($type);

        switch( $type )
        {
            case 'all':
                $this->setAllCookies();
                break;

            case 'settings':
                $this->setCookies();
                break;
        }
    }

    public function setAllCookies()
    {
        $settings = array(
            'necessary' => 1,
            'statistics' => 1,
            'marketing' => 1
        );

        ld_cookie_conset_set_cookie($settings);
        wp_send_json_success();
    }

    public function setCookies()
    {
        $_settings = array();
        $data = $_REQUEST['settings'] ?? '';

        wp_parse_str($data, $_settings);

        $settings = array(
            'necessary' => 1,
            'statistics' => isset($_settings['statistics']) ? 1 : 0,
            'marketing' => isset($_settings['marketing']) ? 1 : 0
        );

        ld_cookie_conset_set_cookie($settings);

        wp_send_json_success();
    }

}

add_action('after_setup_theme', array('LD_Cookie_Consent_Ajax', 'init'), 0);
