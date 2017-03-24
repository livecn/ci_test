<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom Admin Controller for Controllers to extends
 *
 * @package	Admin
 * @category	Core
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Admin_Controller extends MY_Controller {

    public $auth_methods = array(); //methods need to auth
    public $no_auth_uri = array(
        'auth/user/login',
        'auth/user/login_post',
        'auth/user/forgot',
        'auth/user/forgot_post',
    ); //uri dont' need auth


    // Load file and set data
    public function __construct() {

        parent::__construct();

        $admin_config = $this->config->item('admin');

        $this->config->load('auth/aauth');
        $this->load->library('auth/aauth');
        $this->lang->load('auth/aauth');

        $this->set_data('hide_content_header', false);

        if (!in_array(uri_string(), $this->no_auth_uri)) {
            if (!$this->aauth->is_loggedin()) {
                redirect('auth/user/login');
            } else {
                if ($this->aauth->current_user()) {
                    $this->set_data('user', $this->aauth->current_user());
                } else {
                    redirect('auth/user/login');
                }
            }
        }

        if (isset($admin_config['open_auth_control']) && $admin_config['open_auth_control']) {
            if (in_array($this->action, $this->auth_methods)) {
                $this->aauth->auth($this->class . '.' . $this->action);
            }
        }

        $this->set_data('site_name', $admin_config['name']);
        $this->set_data('short_site_name', $admin_config['short_name']);
        $this->set_data('title', $admin_config['title']);

        if ($error = $this->session->flashdata('errors')) {
            $this->set_data('error_msg', $error);
        } else {
            $this->set_data('error_msg', '');
        }
        if ($success = $this->session->flashdata('success')) {
            $this->set_data('success_msg', $success);
        } else {
            $this->set_data('success_msg', '');
        }

        if ($admin_config['debug']['profiler']) {
            $this->output->enable_profiler(TRUE);
        }

        $this->set_data('admin_config', $admin_config);
    }

    protected function get_data($key = null) {
        if ($key == 'title') {
            $value = parent::get_data('header_title') . ' | ' . parent::get_data($key);
            parent::set_data($key, $value);
            return $value;
        }
        return parent::get_data($key);
    }

}
