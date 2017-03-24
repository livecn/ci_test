<?php

if (!function_exists('getMenuHtml')) {

    function getMenuHtml() {
        $CI = & get_instance();
        $html = '';
        if ($admin = $CI->config->item('admin')) {
            if (count($admin['menu'])) {
                foreach ($admin['menu'] as $m) {
                    $child_active = false;
                    $child_html = $url = '';
                    if (isset($m['children']) && count($m['children'])) {
                        $child_html .= "<ul class='treeview-menu'>";
                        foreach ($m['children'] as $c) {
                            $active = '';
                            if ($c['url'] == uri_string() || $c['url'] . '/index' == uri_string()) {
                                $active = 'active';
                                $child_active = TRUE;
                            }
                            $url = gen_url($c['url']);
                            $child_html .= "<li class='{$active}'><a href='{$url}'><i class='{$c['style']}'></i> {$c['name']}</a></li>";
                        }
                        $child_html .= "</ul>";
                    }
                    $active = '';
                    $url = gen_url($m['url']);
                    if ($m['url'] == uri_string() || $m['url'] == uri_string() . '/index' || $child_active == TRUE) {
                        $active = 'active';
                    }
                    $html .= "<li class='treeview {$active}'>
                                <a href='{$url}'>
                                    <i class='{$m['style']}'></i>
                                    <span>{$m['name']}</span>";
                    if (isset($m['children']) && count($m['children'])) {
                        $html .= "<span class='pull-right-container'>
                                        <i class='fa fa-angle-left pull-right'></i>
                                    </span>";
                    }
                    $html .= $child_html;
                    $html .= "</a>";
                    $html .= "</li>";
                }
            }
        }
        return $html;
    }

}

