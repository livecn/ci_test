<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../../admin/core/Admin_Controller.php';

/**
 * User Manage
 *
 * @package	Auth
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class User extends Admin_Controller {

    public $aauth_config;

    public function __construct() {
        parent::__construct();
        $this->aauth_config = $this->config->item('aauth');
    }

    // show login page
    public function login() {
        $this->set_data('header_title', 'Login');
        $this->render('auth/user/login');
    }

    // login handler
    public function login_post() {
        $post = $this->input->post();
        if ($post['user_name'] && $post['password']) {
            if (!$this->aauth->login($post['user_name'], $post['password'], isset($post['remember']) ? $post['remember'] : FALSE)) {
                $msg = $this->aauth->get_errors_html();
                $status = 'fail';
            } else {
                $msg = 'Logined successfully';
                $status = 'success';
            }
        } else {
            $msg = 'Params error';
            $status = 'fail';
        }
        echo json_encode(array('status' => $status, 'data' => array(), 'msg' => $msg));
    }

    // logout action
    public function logout() {
        $this->aauth->logout();
        redirect('auth/user/login');
    }

    // show forgot password page
    public function forgot() {
        $this->set_data('header_title', 'Forgot Password');
        $this->render('auth/user/forgot');
    }

    // forgot password send mail
    public function forgot_post() {
        $post = $this->input->post();
        if ($post['email'] && filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            if (!$this->aauth->remind_password($post['email'])) {
                $msg = $this->aauth->get_errors_html();
                $status = 'fail';
            } else {
                $msg = 'Email has already been sent';
                $status = 'success';
            }
        } else {
            $msg = 'Email error';
            $status = 'fail';
        }
        echo json_encode(array('status' => $status, 'data' => array(), 'msg' => $msg));
    }

    public function reset_password($ver_code) {
        echo "Working...";
    }

    public function index() {
        $this->set_data('header_title', 'User Manage');
        $users = $this->aauth->list_users();
        $this->render('auth/user', array('users' => $users));
    }

    public function edit() {
        $user = array();
        if (isset($this->get['id'])) {
            $user_query = $this->db->select('id,email,username,active,last_login,date_created')->where('id', $this->get['id'])->get('aauth_users');
            $user = $user_query->row_array();
            if (is_array($user)) {
                $user['group_ids'] = $this->aauth->get_user_group_ids($this->get['id']);
            }
        }
        $this->render('auth/user/edit', array('user' => $user));
    }

    public function save() {
        $post = $this->input->post();

        $data = array();
        $this->form_validation->set_rules(
                'username', 'User Name', "required|alpha_numeric|min_length[{$this->aauth_config['validation']['username']['min']}]|max_length[{$this->aauth_config['validation']['username']['max']}]|edit_unique[aauth_users.username.id.{$post['id']}]", array(
            'required' => 'You have not provided %s.',
            'is_unique' => 'This %s already exists.'
                )
        );
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $is_required = '';
        if (!$post['id']) {
            $is_required = 'required|';
        }
        $this->form_validation->set_rules('password', 'Password', $is_required . "trim|min_length[{$this->aauth_config['validation']['password']['min']}]|max_length[{$this->aauth_config['validation']['password']['max']}]");
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', $is_required . 'trim|matches[password]');

        if (!$this->form_validation->run()) {
            $status = 'fail';
            $error_array = $this->form_validation->error_array();
            $data['error_field'] = key($error_array);
            $data['error_field_msg'] = $error_array[$data['error_field']];
            $msg = validation_errors();
        } else {
            $status = 'success';
            if (!$post['id']) {
                if (!($id = $this->aauth->create_user($post['email'], $post['password'], $post['username'], $post['active']))) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    if (isset($post['group_ids']) && !$this->aauth->user_to_groups($id, $post['group_ids'])) {
                        $msg = $this->db->error();
                        $status = 'fail';
                    } else {
                        $msg = 'Saved successfully';
                        $status = 'success';
                    }
                }
            } else {
                if (!$this->aauth->update_user($post['id'], $post['email'], $post['password'], $post['username'], $post['active'])) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    if (isset($post['group_ids']) && !$this->aauth->user_to_groups($post['id'], $post['group_ids'])) {
                        $msg = $this->db->error();
                        $status = 'fail';
                    } else {
                        $msg = 'Saved successfully';
                        $status = 'success';
                    }
                }
            }
        }

        echo json_encode(array('status' => $status, 'data' => $data, 'msg' => $msg));
    }

    public function delete() {
        $post = $this->input->post();
        if (!$post['id']) {
            $status = 'error';
            $msg = 'Params error';
        } else {
            if ($this->aauth->delete_user($post['id'])) {
                $status = 'success';
                $msg = 'Deleted successfully';
            } else {
                $status = 'error';
                $msg = $this->db->error();
            }
        }
        echo json_encode(array('status' => $status, 'data' => array(), 'msg' => $msg));
    }

}
