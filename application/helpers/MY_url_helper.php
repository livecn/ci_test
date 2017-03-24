<?php

/**
 * Helper class with shortcut functions to lookup URL
 */
// location of public asset folder
function asset_url($path) {
    return base_url('assets/' . $path);
}

/**
 * Helper class with shortcut functions to lookup URL
 */
// location of public asset folder
function asset_admin_url($path) {
    return base_url('assets/admin/' . $path);
}

function gen_url($uri = '', $params = array(), $protocol = null) {
    $url = base_url($uri, $protocol);
    if (count($params)) {
        $url .= '?' . http_build_query($params);
    }
    return $url;
}

// current URL includes query string
// Reference: http://stackoverflow.com/questions/4160377/codeigniter-current-url-doesnt-show-query-strings
function current_full_url() {
    $CI = & get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}

// refresh current page (interrupt other actions)
function refresh() {
    redirect(current_full_url(), 'refresh');
}

// redirect back to referrer page
function redirect_referrer() {
    $CI = & get_instance();
    $CI->load->library('user_agent');
    redirect($CI->agent->referrer());
}
