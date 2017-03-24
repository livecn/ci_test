<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom Controller Class
 *
 *
 * @package	CodeIgniter
 * @category	Core
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller {

    public $templates;
    public $get;
    public $post;
    public $view_data = array();

    /**
     *
     * Load file and set page data
     *
     * @return	null
     */
    public function __construct() {
        parent::__construct();

        $this->load->database();

        $this->get = $this->input->get();
        $this->post = $this->input->post();

        $this->class = $this->router->fetch_class();
        $this->action = $this->router->fetch_method();
        $this->method = $this->input->server('REQUEST_METHOD');

        $site_config = $this->config->item('site');

        $this->set_data('site_name', $site_config['name']);
        $this->set_data('title', $site_config['title']);

        $this->set_data('ci_object', $this);

        $this->set_data('get', $this->get);
        $this->set_data('post', $this->post);

        //use Plates template system
        $this->templates = new League\Plates\Engine(VIEWPATH);
        $this->templates->addFolder('layouts', VIEWPATH . '_layouts');
        $this->templates->addFolder('partials', VIEWPATH . '_partials');
        $this->templates->registerFunction('date', function ($string, $format) {
            return date($format, $string);
        });
    }

    // Render template (using Plates template)
    protected function render($view_file, $data = array(), $returnhtml = false) {
        if (!$this->get_data('title')) {
            if ($this->action == 'index')
                $this->set_data('title', humanize($this->class));
            else
                $this->set_data('title', humanize($this->action));
        }
        $this->templates->addData($this->get_data());
        if ($returnhtml) {
            return $this->templates->render($view_file, $data);
        } else {
            $this->output->set_output($this->templates->render($view_file, $data));
        }
    }

    protected function set_data($key, $value = null) {
        $this->load->vars($key, $value);
    }

    protected function get_data($key = null) {
        if ($key) {
            return $this->load->get_var($key);
        } else {
            return $this->load->get_vars();
        }
    }

}
