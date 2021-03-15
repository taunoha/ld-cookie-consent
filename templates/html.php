<?php
    defined('ABSPATH') or die();

    $settings = ld_cookie_consent_get_cookie();

    if( !empty($settings) ) {
        return;
    }
?>

<dialog class="modal fade modal-ld-cookie-consent is-desc" data-backdrop="static" tabindex="-1" role="dialog" id="ldCookieConsent">
    <div class="modal-dialog" role="document">
        <div class="modal-content pb-0">
            <div class="modal-body">
                <h2 class="mt-3"><?php _ex('We use cookies on our website', 'ldCookieConsent', 'ld-cookie-consent'); ?></h2>
                <p class="lead ld-cookie-consent-is-desc"><?php _ex('We will ask your consent to use these cookies which are not strictly necessary to enable core functionality of our website and to provide the service you request when visiting our website.', 'ldCookieConsent', 'ld-cookie-consent'); ?></p>
                <p class="lead ld-cookie-consent-is-settings"><?php _ex('You can choose which cookies you enable by ticking boxes here.', 'ldCookieConsent', 'ld-cookie-consent'); ?></p>
                <form action="javascript:void(0)" method="post" class="ld-cookie-consent-is-settings py-3">
                    <div class="form-group">
                        <label class="input-checkbox"><input type="checkbox" checked disabled><span><b class="d-block"><?php _ex('Necessary cookies', 'ldCookieConsent', 'ld-cookie-consent'); ?></b><span class="d-block text-muted"><?php _ex('These cookies are needed for our website to work in a secure and correct way. Necessary cookies enable you to browse in our website and to provide the service you request. Necessary cookies make basic functions of the website possible.', 'ldCookieConsent', 'ld-cookie-consent'); ?></span></span></label>
                        <input type="hidden" name="necessary" value="1">
                    </div>
                    <div class="form-group">
                        <label class="input-checkbox"><input type="checkbox" name="statistics" value="1"><span><b class="d-block"><?php _ex('Statistics & analytics cookies', 'ldCookieConsent', 'ld-cookie-consent'); ?></b><span class="d-block text-muted"><?php _ex('These cookies give us information about how you use our website and allow us to improve the user experience.', 'ldCookieConsent', 'ld-cookie-consent'); ?></span></span></label>
                    </div>
                    <div class="form-group">
                        <label class="input-checkbox"><input type="checkbox" name="marketing" value="1"><span><b class="d-block"><?php _ex('Marketing cookies', 'ldCookieConsent', 'ld-cookie-consent'); ?></b><span class="d-block text-muted"><?php _ex('These cookies help us and our partners to show personalized and relevant ads based on your browsing behavior with us, even when you later visit other websites. Cookies in this category are used for targeted marketing and profiling, regardless of which device(s) you have used.', 'ldCookieConsent', 'ld-cookie-consent'); ?></span></span></label>
                    </div>
                </form>
                <p><?php _ex('Please view detailed information about our cookies and cookie policy <a href="#ldCookieConsentDescription" data-toggle="collapse">here</a>.', 'ldCookieConsent', 'ld-cookie-consent'); ?></p>
                <div class="collapse" id="ldCookieConsentDescription">
                    <div class="collapse-body bg-light overflow-hidden px-3 py-4 rounded">
                        <?php
                            $page = get_post( (int) get_option('wp_page_for_privacy_policy') );
                            echo apply_filters('the_content', $page->post_content );
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-3">
                <div class="row align-items-center justify-content-center justify-content-lg-between mx-n2">
                    <div class="col-auto py-2 px-2">
                        <button type="button" class="btn btn-link px-0 ld-cookie-consent-is-desc" data-ld-click="switch-to-settings"><?php _ex('Change cookie settings', 'ldCookieConsent', 'ld-cookie-consent'); ?></button>
                    </div>
                    <div class="col-auto py-2 px-2">
                        <button type="button" class="btn btn-primary ld-cookie-consent-is-desc" data-ld-click="accept-all-cookies"><?php _ex('Accept all cookies', 'ldCookieConsent', 'ld-cookie-consent'); ?></button>
                        <button type="button" class="btn btn-primary ld-cookie-consent-is-settings" data-ld-click="save-cookie-settings"><?php _ex('Save changes', 'ldCookieConsent', 'ld-cookie-consent'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dialog>
