<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * History model Class
 *
 * @package	Interface
 * @category	Controller
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class History extends CI_Model {

    /**
     * Convert status code to string
     * 
     * @param int status
     * @return string
     */
    public function getStatusLable($status) {
        switch ($status):
            case 3:
                return 'danger';
            case 2:
                return 'warning';
            case 1:
                return 'success';
            default :
                return '';
        endswitch;
    }

    /**
     * Insert data to history table
     * 
     * @param int status
     * @return string
     */
    public function insert($post) {
        $data = array(
            'method' => $post['request-method'],
            'url' => $post['request-url'],
            'content' => json_encode($post),
            'status' => isset($post['status']) ? $post['status'] : 0,
            'create_time' => time()
        );
        $this->db->insert('history', $data);
    }

    /**
     * Convert content
     * 
     * @param string content
     * @return string
     */
    public function getContentText($content) {
        $str = '';
        if (isset($content['content']) && $content['content']) {
            if ($content['body-type'] == 'form') {
                parse_str($content['content'], $array_content);
                if (count($array_content)) {
                    foreach ($array_content as $key => $value) {
                        $str .= "$key : $value <br/>";
                    }
                }
            } else {
                $str = htmlentities($content['content'], ENT_QUOTES);
            }
        } else {
            if ($content['body-type'] == 'form') {
                if (count($content['body-form-key'])) {
                    foreach ($content['body-form-key'] as $m => $n) {
                        if (trim($n)) {
                            $array_content[trim($n)] = $content['body-form-value'][$m];
                        }
                    }
                    foreach ($array_content as $key => $value) {
                        $str .= "$key : $value <br/>";
                    }
                }
            } elseif ($content['body-type'] == 'json') {
                $str = $content['body-json'];
            } elseif ($content['body-type'] == 'array') {
                $str = $content['body-array'];
            } elseif ($content['body-type'] == 'xml') {
                $str = htmlentities($content['body-xml'], ENT_QUOTES);
            }
        }
        return $str;
    }

}
