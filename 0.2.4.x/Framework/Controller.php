<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Controller
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 */
abstract class Framework_Controller
{
    /**
     * factory
     *
     * @access      public
     * @param       string      $type
     * @return      mixed       PEAR_Error on failure, controller on success
     */
    static public function &factory($type)
    {
        $file = 'Framework/Controller/' . $type . '.php';
        $object = 'Framework_Controller_' . $type;
        if (!include_once($file)) {
            return PEAR::raiseError('Controller file not found: ' . $file);
        }

        if (!class_exists($object)) {
            return PEAR::raiseError('Controller class not found: ' . $object);
        }

        $instance = new $object();
        if (!$instance instanceof Framework_Controller_Common) {
            return PEAR::raiseError('Framework_Controller_' . $type . ' does not extend from Framework_Controller_Common');
        }

        return $instance;
    }
}

?>
