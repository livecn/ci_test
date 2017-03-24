<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Interface Module Request Class
 *
 * @package	Interface
 * @category	Libraries
 * @author	Yun
 * @link	https://codeigniter.com/user_guide/general/controllers.html
 */
class Request {

    /**
     * Use stream to request
     * 
     * @param array post
     * @return array ($response, $http_response_header)
     */
    public function do_request(&$post) {

        $data = array();
        if ($post['body-type'] == 'form') {
            foreach ($post['body-form-key'] as $m => $n) {
                if (trim($n)) {
                    $data[trim($n)] = $post['body-form-value'][$m];
                }
            }
        } elseif ($post['body-type'] == 'array') {
            if ($post['body-array']) {
                eval('$data=' . $post['body-array'] . ';');
            }
        } elseif ($post['body-type'] == 'json') {
            $data = $post['body-json'];
        } elseif ($post['body-type'] == 'xml') {
            $data = $post['body-xml'];
        }

        $url = $post['request-url'];

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        // Parse a URL and return its components
        $uri = @parse_url($url);

        if ($uri == FALSE) {
            //throw new Exception("unable to parse URL");exit;
            return array("unable to parse URL", '1001');
        }

        if (!in_array($uri['scheme'], array('https', 'http', 'ftp'))) {
            //    throw new Exception("invalid schema {$uri['scheme']}"); exit;
            return array("invalid schema {$uri['scheme']}", '1001');
        }

        $options = array(
            'header' => '',
            'method' => $post['request-method'],
            'max_redirects' => $post['max_redirects'],
            'timeout' => $post['timeout'],
            'ignore_errors' => $post['ignore_errors'],
            'referer' => $post['referer'],
        );

        $headers = $post['headers'];

        if ($post['other-header']) {
            $other_headers = explode(';', $post['other-header']);
            if (count($other_headers)) {
                foreach ($other_headers as $header) {
                    list($k, $v) = explode(':', $header);
                    if (trim($k)) {
                        $headers[trim($k)] = trim($v);
                    }
                }
            }
        }

        if ($post['base-username'] && $post['base-password']) {
            $auth = base64_encode("{$post['base-username']}:{$post['base-password']}");
            $headers["Authorization"] = "Basic $auth";
        }

        if (is_array($data)) {
            // Convert the data array into URL Parameters like a=b&foo=bar etc.
            $options['content'] = http_build_query($data);
        } else {
            $options['content'] = $data;
        }

        $params = array(
            $uri['scheme'] => $options,
        );

        $headers['Content-length'] = strlen($options['content']);

        foreach ($headers as $key => $header) {
            if (trim($header)) {
                $params[$uri['scheme']]['header'] .= "$key: $header\r\n";
            }
        }

        if ($uri['scheme'] == 'https') {
//          see more at http://php.net/manual/en/migration56.openssl.php
            $params['ssl'] = [
                'verify_peer' => false,
                'verify_peer_name' => false,
//                'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT |
//                STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
            ];
        }

        // Creates a stream context
        $context = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $context);
        if (!$fp) {
            //throw new Exception("Problem with $url"); exit;
            return array("Problem with this url", '1001');
        }
        $post['content'] = $options['content'];
        $response = @stream_get_contents($fp);
        return array($response, $http_response_header);
    }

}
