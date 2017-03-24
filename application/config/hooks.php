<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	https://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook['pre_controller'][] = array(
    'class' => 'Extension',
    'function' => 'pre_controller',
    'filename' => 'Extension.php',
    'filepath' => 'hooks',
    'params' => array()
);

$hook['pre_system'] = array(
    'class' => 'Extension',
    'function' => 'pre_system',
    'filename' => 'Extension.php',
    'filepath' => 'hooks',
    'params' => array()
);

