<?php

if (!function_exists('getGroupSelectHtml')) {

    function getGroupSelectHtml() {
        $CI = & get_instance();
        $html = '';
        if ($groups = $CI->aauth->list_groups()) {
            foreach ($groups as $k => $v) {
                $html .= "<option value='{$v['id']}'>{$v['definition']}</option>";
            }
        }
        return $html;
    }

}


if (!function_exists('getUserSelectHtml')) {

    function getUserSelectHtml() {
        $CI = & get_instance();
        $html = '';
        if ($users = $CI->aauth->list_users()) {
            foreach ($users as $k => $v) {
                $html .= "<option value='{$v['id']}'>{$v['username']}</option>";
            }
        }
        return $html;
    }

}

if (!function_exists('getAllUserSelectHtmlWithIds')) {

    function getAllUserSelectHtmlWithIds($ids = array()) {
        $CI = & get_instance();
        $html = '';
        if ($users = $CI->aauth->list_users()) {
            foreach ($users as $k => $v) {
                $checked = '';
                if (in_array($v['id'], $ids)) {
                    $checked = ' checked=checked ';
                }
                $html .= "<span><input name='user_ids[]' type='checkbox' {$checked} value='{$v['id']}'> {$v['username']}</span>";
            }
        }

        return $html;
    }

}

