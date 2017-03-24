<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../core/Admin_Controller.php';

/**
 * Admin Module Controller Home Class
 *
 * @package	Admin
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Home extends Admin_Controller {

    // Show Dashboard page
    public function index() {
        $this->set_data('header_title', 'Dashboard');
        $this->render('admin/index');
    }

    // Custom 403 page
    public function no_perm() {
        $this->set_data('header_title', 'No permission');
        $this->set_data('hide_content_header', true);
        $this->render('admin/no_perm');
    }

}
