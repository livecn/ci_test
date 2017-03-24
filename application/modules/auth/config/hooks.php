<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class' => 'Authperm',
    'function' => 'worker',
    'filename' => 'Authperm.php',
    'filepath' => 'hooks',
    'module' => 'auth',
    'params' => array()
);
