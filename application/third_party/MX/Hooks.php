<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hooks Class
 *
 * Provides a mechanism to extend the base system without hacking.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/hooks.html
 */
class MX_Hooks extends CI_Hooks {

    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct() {

        $CFG = & load_class('Config', 'core');
        log_message('info', 'Hooks Class Initialized');

        // If hooks are not enabled in the config file
        // there is nothing else to do
        if ($CFG->item('enable_hooks') === FALSE) {
            return;
        }


        /* get module locations from config settings or use the default module location and offset */
        is_array($locations = $CFG->item('modules_locations')) OR $locations = array(
            APPPATH . 'modules/' => '../modules/',
        );

        /* check modules */
        foreach ($locations as $location => $offset) {
            if (is_dir($location)) {
                if ($dh = opendir($location)) {
                    while (($module = readdir($dh)) !== false) {
                        if ($module != "." && $module != ".." && is_dir($location . $module)) {
                            if (file_exists($location . $module . '/config/hooks.php')) {
                                include($location . $module . '/config/hooks.php');
                            }
                        }
                    }
                    closedir($dh);
                }
            }
        }

        // Grab the "hooks" definition file.
        if (file_exists(APPPATH . 'config/hooks.php')) {
            include(APPPATH . 'config/hooks.php');
        }

        if (file_exists(APPPATH . 'config/' . ENVIRONMENT . '/hooks.php')) {
            include(APPPATH . 'config/' . ENVIRONMENT . '/hooks.php');
        }

        // If there are no hooks, we're done.
        if (!isset($hook) OR ! is_array($hook)) {
            return;
        }

        $this->hooks = & $hook;
        $this->enabled = TRUE;
    }

    /**
     * Run Hook
     *
     * Runs a particular hook
     *
     * @param	array	$data	Hook details
     * @return	bool	TRUE on success or FALSE on failure
     */
    protected function _run_hook($data) {
        // Closures/lambda functions and array($object, 'method') callables
        if (is_callable($data)) {
            is_array($data) ? $data[0]->{$data[1]}() : $data();

            return TRUE;
        } elseif (!is_array($data)) {
            return FALSE;
        }

        // -----------------------------------
        // Safety - Prevents run-away loops
        // -----------------------------------
        // If the script being called happens to have the same
        // hook call within it a loop can happen
        if ($this->_in_progress === TRUE) {
            return;
        }

        // -----------------------------------
        // Set file path
        // -----------------------------------

        if (!isset($data['filepath'], $data['filename'])) {
            return FALSE;
        }



        if (isset($data['module'])) {
            $CFG = & load_class('Config', 'core');
            /* get module locations from config settings or use the default module location and offset */
            is_array($locations = $CFG->item('modules_locations')) OR $locations = array(
                APPPATH . 'modules/' => '../modules/',
            );
            /* check modules */
            foreach ($locations as $location => $offset) {
                if (file_exists($location . '/' . $data['module'] . '/' . $data['filepath'] . '/' . $data['filename'])) {
                    $filepath = $location . '/' . $data['module'] . '/' . $data['filepath'] . '/' . $data['filename'];
                }
            }
        } else {
            $filepath = APPPATH . $data['filepath'] . '/' . $data['filename'];
        }

        if (!file_exists($filepath)) {
            return FALSE;
        }

        // Determine and class and/or function names
        $class = empty($data['class']) ? FALSE : $data['class'];
        $function = empty($data['function']) ? FALSE : $data['function'];
        $params = isset($data['params']) ? $data['params'] : '';

        if (empty($function)) {
            return FALSE;
        }

        // Set the _in_progress flag
        $this->_in_progress = TRUE;

        // Call the requested class and/or function
        if ($class !== FALSE) {
            // The object is stored?
            if (isset($this->_objects[$class])) {
                if (method_exists($this->_objects[$class], $function)) {
                    $this->_objects[$class]->$function($params);
                } else {
                    return $this->_in_progress = FALSE;
                }
            } else {
                class_exists($class, FALSE) OR require_once($filepath);

                if (!class_exists($class, FALSE) OR ! method_exists($class, $function)) {
                    return $this->_in_progress = FALSE;
                }

                // Store the object and execute the method
                $this->_objects[$class] = new $class();
                $this->_objects[$class]->$function($params);
            }
        } else {
            function_exists($function) OR require_once($filepath);

            if (!function_exists($function)) {
                return $this->_in_progress = FALSE;
            }

            $function($params);
        }

        $this->_in_progress = FALSE;
        return TRUE;
    }

}
