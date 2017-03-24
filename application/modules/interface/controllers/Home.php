<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Interface Module Controller Class
 *
 * @package	Interface
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Home extends MY_Controller {

    /**
     * Show index page
     * 
     * @param int page number default:1
     * @return null
     */
    public function index($page = 1) {

        $this->load->helper('form');

        $per_page = 10;
        $count = $this->db->count_all('history');
        $query = $this->db->select('*')->order_by('id DESC')->get('history', $per_page, ($page - 1) * $per_page);
        $history = $query->result_array();

        $data = array();
        if ($hid = $this->input->get('hid')) {
            $h_obj = $this->db->select('*')->where('id', $hid)->get('history');
            $h_array = $h_obj->row_array();
            $data = json_decode($h_array['content'], true);
        }

        $this->load->library('pagination');
        $this->load->config('pagination', TRUE);

        $config['base_url'] = base_url('home/index');
        $config['total_rows'] = $count;
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $pagination = $this->config->item('pagination')['pagination'];
        $config += $pagination;
        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();
        $this->render('interface/index', array(
            'data' => $data,
            'history' => $history,
            'count' => $count,
            'pagination' => $pagination_links
                )
        );
    }

    /**
     * Save input data to database
     * 
     * @param array post
     * @return json success/failure
     */
    public function save() {
        $post = $this->input->post();
        $this->history_model->insert($post);
        $status = 'succ';
        $msg = "<p><strong>Save success!</strong></p>";
        echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => array()));
    }

    /**
     * Do request
     * 
     * @param array post
     * @return json success/failure
     */
    public function request() {

        $this->load->library('form_validation');

        $post = $this->input->post();
        $data = array();
        $this->form_validation->set_rules('request-url', 'Request Url', 'trim|required|valid_url');
        $this->form_validation->set_rules('timeout', 'Timeout', 'numeric');
        $this->form_validation->set_rules('max_redirects', 'Max Redirects', 'numeric');
        $this->form_validation->set_rules('referer', 'Referer', array(array('referer_callable', function($value) {
                    if ($value != '') {
                        if (!$this->form_validation->valid_url($value) && !$this->form_validation->valid_ip($value)) {
                            return FALSE;
                        }
                    }
                    return TRUE;
                })), array('referer_callable' => 'Referer value is not a valid url or ip'));
        $this->form_validation->set_rules('body-json', 'Json', array(array('json_callable', function($value) use ($post) {
                    if ($post['body-type'] == 'json' && $value != '') {
                        json_decode($value);
                        return (json_last_error() == JSON_ERROR_NONE);
                    }
                    return TRUE;
                })), array('json_callable' => 'Json value is not valid'));
        $this->form_validation->set_rules('body-array', 'Array', array(array('array_callable', function($value) use ($post) {
                    if ($post['body-type'] == 'array' && $value != '') {
                        //array format array(...)
                        if (preg_match('/array\(.*\)/i', trim($value))) {
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    }
                    return TRUE;
                })), array('array_callable' => 'Array value is not valid'));
        $this->form_validation->set_rules('body-xml', 'Xml', array(array('xml_callable', function($value) use ($post) {
                    if ($post['body-type'] == 'xml' && $value != '') {
//                        Validate xml is vaild!                        
//                        if (@simplexml_load_string(trim($value))) {
//                            return TRUE;
//                        } else {
//                            return FALSE;
//                        }
                    }
                    return TRUE;
                })), array('xml_callable' => 'Xml value is not valid'));
        $this->form_validation->set_rules('headers[Accept]', 'Accept', 'trim|required');

        if (!$this->form_validation->run()) {
            $status = 'fail';
            $error_array = $this->form_validation->error_array();
            $data['error_field'] = key($error_array);
            $data['error_field_msg'] = $error_array[$data['error_field']];
            $msg = validation_errors();
            $post['status'] = '2';
        } else {
            list($content, $header) = $this->request->do_request($post);
            if ($header == '1001') {
                $post['status'] = '2';
                $msg = $content;
                $status = 'fail';
                $data['error_field'] = 'request-url';
                $data['error_field_msg'] = $content;
            } else {
                if (($code = substr($header[0], 9, 3)) != 200) {
                    $status = 'fail';
                    $msg = "<p><strong>Response code $code</strong></p>";
                } else {
                    $status = 'succ';
                    $msg = "<p><strong>Request success!</strong></p>";
                }
                $data = array('content' => htmlspecialchars($content, ENT_QUOTES), 'header' => implode('<br/>', $header));
                $post['status'] = ($status == 'succ') ? '1' : '3';
            }
        }

        //save post data to history table
        $this->history_model->insert($post);
        echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $data));
    }

}
