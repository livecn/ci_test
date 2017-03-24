<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../../admin/core/Admin_Controller.php';

/**
 * Permission Manage
 *
 *
 * @package	Auth
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Perm extends Admin_Controller {

    public $aauth_config;
    public $auth_methods = array(
        'save',
        'delete',
    );

    public function __construct() {
        parent::__construct();
        $this->aauth_config = $this->config->item('aauth');
    }

    public function index() {
        $this->set_data('header_title', 'Permission Manage');
        $perms = $this->aauth->list_perms();
        $this->render('auth/perm', array('perms' => $perms));
    }

    public function edit() {
        $perm = array();
        if (isset($this->get['id'])) {
            $perm_query = $this->db->select('id,name,definition,type')->where('id', $this->get['id'])->get('aauth_perms');
            $perm = $perm_query->row_array();
        }
        $this->render('auth/perm/edit', array('perm' => $perm));
    }

    public function save() {
        $post = $this->input->post();
        $data = array();
        $this->form_validation->set_rules(
                'name', 'Permission Name', "required|edit_unique[aauth_perms.name.id.{$post['id']}]", array(
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
                if (!($id = $this->aauth->create_perm($post['name'], $post['definition'], $post['type']))) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    $msg = 'Saved successfully';
                    $status = 'success';
                }
            } else {
                if (!$this->aauth->update_perm($post['id'], $post['name'], $post['definition'], $post['type'])) {
                    $msg = $this->aauth->get_errors_html();
                    $status = 'fail';
                } else {
                    $msg = 'Saved successfully';
                    $status = 'success';
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
            if ($this->aauth->delete_perm($post['id'])) {
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
