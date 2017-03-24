<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../../admin/core/Admin_Controller.php';


/**
 * Group Manage
 *
 *
 * @package	Auth
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Group extends Admin_Controller {

    public $aauth_config;

    public function __construct() {
        parent::__construct();
        $this->aauth_config = $this->config->item('aauth');
    }

    public function index() {
        $this->set_data('header_title', 'Group Manage');
        $groups = $this->aauth->list_groups();
        $this->render('auth/group', array('groups' => $groups));
    }

    public function edit() {
        $group = array();
        if (isset($this->get['id'])) {
            $group_query = $this->db->select('id,name,definition')->where('id', $this->get['id'])->get('aauth_groups');
            $group = $group_query->row_array();
            if (is_array($group)) {
                $group['user_ids'] = $this->aauth->get_group_user_ids($this->get['id']);
            }
        }
        $this->render('auth/group/edit', array('group' => $group));
    }

    public function user() {
        $users = array();
        $selectAll = false;
        if (isset($this->get['id'])) {
            $group_query = $this->db->select('id,name,definition')->where('id', $this->get['id'])->get('aauth_groups');
            $group = $group_query->row_array();
            if (is_array($group)) {
                $users = $this->aauth->get_group_user_ids($this->get['id']);
            }
            if (count($users) === count($this->aauth->list_users())) {
                $selectAll = true;
            }
        }
        $this->render('auth/group/user', array('users' => $users, 'group_id' => $this->get['id'], 'selectAll' => $selectAll));
    }

    public function user_save() {
        $post = $this->input->post();
        if (!$this->aauth->group_to_users($post['id'], $post['user_ids'])) {
            $msg = $this->db->error();
            $status = 'fail';
        } else {
            $msg = 'Saved successfully';
            $status = 'success';
        }
        echo json_encode(array('status' => $status, 'data' => array(), 'msg' => $msg));
    }

    public function save() {
        $post = $this->input->post();
        $data = array();
        $this->form_validation->set_rules(
                'name', 'Group Name', "required|alpha_numeric|edit_unique[aauth_groups.name.id.{$post['id']}]", array(
            'required' => 'You have not provided %s.',
            'is_unique' => 'This %s already exists.'
                )
        );
        if (!$this->form_validation->run()) {
            $status = 'fail';
            $error_array = $this->form_validation->error_array();
            $data['error_field'] = key($error_array);
            $data['error_field_msg'] = $error_array[$data['error_field']];
            $msg = validation_errors();
        } else {
            $status = 'success';
            if (!$post['id']) {
                if (!($id = $this->aauth->create_group($post['name'], $post['definition']))) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    if (!$this->aauth->group_to_users($id, $post['user_ids'])) {
                        $msg = $this->db->error();
                        $status = 'fail';
                    } else {
                        $msg = 'Saved successfully';
                        $status = 'success';
                    }
                }
            } else {
                if (!$this->aauth->update_group($post['id'], $post['name'], $post['definition'])) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    if (!$this->aauth->group_to_users($post['id'], $post['user_ids'])) {
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
            if ($this->aauth->delete_group($post['id'])) {
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
