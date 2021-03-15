jQuery(function($) {
    var $modal = $('#ldCookieConsent');
    var switchToSettings = function() {
        $modal.removeClass('is-desc');
        $modal.addClass('is-settings');
    };
    var acceptAllCookies = function() {

        $(this).prop('disabled', true);

        wp.ajax.send('ld_cookie_consent', {
            dataType: 'json',
            data: {
                type: 'all'
            }
        }).done( function() {
            window.location.reload();
        });
    };
    var saveCookieSettings = function() {
        var $form = $(this).closest('.modal').find('form').first();

        $(this).prop('disabled', true);

        wp.ajax.send('ld_cookie_consent', {
            dataType: 'json',
            data: {
                type: 'settings',
                settings: $form.serialize()
            }
        }).done( function() {
            window.location.reload();
        });
    };

    $modal.on('click', '[data-ld-click="switch-to-settings"]', switchToSettings);
    $modal.on('click', '[data-ld-click="accept-all-cookies"]', acceptAllCookies);
    $modal.on('click', '[data-ld-click="save-cookie-settings"]', saveCookieSettings);

    $modal.modal('show');
});
