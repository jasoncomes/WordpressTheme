<?php

/**
 * 410 Error Code Reponse Header
 * Note: This allows you to specify 410 RewriteRules in the .htaccess to use a custom 410.php WordPress template.
 * Source: http://otroblogmas.com/retornar-410-wordpress/
 *
 * @param string $template
 * @return string
 */

add_filter('template_include', function ($template) {

    if (is_404() && $_SERVER['REDIRECT_STATUS'] == '410') {
        status_header(410);

        if (file_exists(STYLESHEETPATH . '/410.php')) {
            return STYLESHEETPATH . '/410.php';
        }
    }

    // Return
    return $template;
});
