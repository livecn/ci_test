<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Admin (by CI Bootstrap 3)
  | -------------------------------------------------------------------------
  | This file lets you define default values to be passed into views when calling
  | MY_Controller's render() function.
  |
  | Each of them can be overrided from child controllers.
  |
 */
$config['admin'] = array(
    // Site name
    'name' => 'Codeigniter',
    // Site name
    'short_name' => 'CI',
    'open_auth_control' => TRUE,
    // Default page title
    // (set empty then MY_Controller will automatically generate one according to controller / action)
    'title' => 'Bootswatch: Lumen',
    // Menu items
    // (or directly update view file: applications/views/_partials/navbar.php)
    'menu' => array(
        'home' => array(
            'name' => 'Dashboard',
            'url' => 'admin',
            'style' => 'fa fa-dashboard'
        ),
        // Demo to add sections with subpages
        'auth' => array(
            'name' => 'Auth',
            'url' => 'auth/allot',
            'style' => 'fa fa-users',
            'children' => array(
                array(
                    'name' => 'Allot',
                    'url' => 'auth/allot',
                    'style' => 'fa fa-circle-o text-red'
                ),
                array(
                    'name' => 'User',
                    'url' => 'auth/user',
                    'style' => 'fa fa-circle-o text-yellow'
                ),
                array(
                    'name' => 'Group',
                    'url' => 'auth/group',
                    'style' => 'fa fa-circle-o text-aqua'
                ),
                array(
                    'name' => 'Permission',
                    'url' => 'auth/perm',
                    'style' => 'fa fa-circle-o text-blue'
                ),
            )
        ),
        // end of demo
        'logout' => array(
            'name' => 'Logout',
            'url' => 'auth/user/logout',
            'style' => 'fa fa-sign-out',
        ),
    ),
    // For debug purpose (available only when ENVIRONMENT = 'development')
    'debug' => array(
        'profiler' => FALSE, // whether to display CodeIgniter's profiler at page end
        'benchmark' => TRUE, // whether to display benchmark at page footer end
    ),
);
