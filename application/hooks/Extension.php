<?php

class Extension {

    public function pre_controller($params = array()) {
//        $config = load_class('Config', 'core');
//        $config->load('site');
    }

    public function pre_system($params = array()) {
//        require_once(BASEPATH . 'database/DB.php');
//        $db = DB(); // getting hold of a DAO instance
        // routing information is always useful to have for pageview logs
//        load_class('Utf8', 'core');
//        $RTR = load_class('Router', 'core');
        // Router also load Uri and Config classes inside so the following two instances could be interesting too:
        // $RTR->uri 
        // $RTR->config
        //$db->insert('page_view_log', array('class' => $RTR->fetch_class(), 'method' => $RTR->fetch_method()));
    }

}
