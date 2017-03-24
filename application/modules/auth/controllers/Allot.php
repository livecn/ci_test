<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../../admin/core/Admin_Controller.php';

/**
 * Allot permission to user and group
 *
 *
 * @package	Auth
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Allot extends Admin_Controller {

    public $aauth_config;

    public function __construct() {
        parent::__construct();
        $this->aauth_config = $this->config->item('aauth');
    }

    public function index() {
        $this->set_data('header_title', 'Allot');
        $groups = $this->aauth->list_groups();
        $perms = $this->aauth->list_perms();
        $users = $this->aauth->list_users();
        $selected_perms = array();
        if (!isset($this->get['gid']) && !isset($this->get['uid'])) {
            $group_id = $this->aauth->get_group_id($this->aauth_config['group']['default_group']);
        }
        if (isset($this->get['gid'])) {
            $group_id = $this->get['gid'];
        }
        if (isset($this->get['uid'])) {
            $user_id = $this->get['uid'];
        }
        if (isset($group_id) && $group_id) {
            $query = $this->db->where('group_id', $group_id)->select('perm_id')->get($this->aauth_config['table']['perm_to_group']);
            if ($query->num_rows()) {
                foreach ($query->result_array() as $v) {
                    $selected_perms[] = $v['perm_id'];
                }
            }
        }
        if (isset($user_id) && $user_id) {
            $query = $this->db->where('user_id', $user_id)->select('perm_id')->get($this->aauth_config['table']['perm_to_user']);
            if ($query->num_rows()) {
                foreach ($query->result_array() as $v) {
                    $selected_perms[] = $v['perm_id'];
                }
            }
        }
        $this->render('auth/allot', array('groups' => $groups, 'perms' => $perms, 'users' => $users, 'selected_perms' => $selected_perms));
    }

    public function save() {
        if (!($gid = $this->post['gid']) && !($uid = $this->post['uid'])) {
            $gid = $this->aauth->get_group_id($this->aauth_config['group']['default_group']);
        }
        $pids = array();
        if (isset($this->post['pid']) && count($this->post['pid'])) {
            foreach ($this->post['pid'] as $pid => $status) {
                $pids[] = $pid;
            }
        }
        if ($gid) {
            $status = $this->aauth->group_to_perms($gid, $pids);
        } elseif ($uid) {
            $status = $this->aauth->user_to_perms($uid, $pids);
        } else {
            $status = FALSE;
        }
        if (!$status) {
            $this->session->set_flashdata('errors', 'Save Failed');
        } else {
            $this->session->set_flashdata('success', 'Save Successfully');
        }
        redirect_referrer(); // go back
    }

}
