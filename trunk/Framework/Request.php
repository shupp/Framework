<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Request
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Request
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @see         Framework::$request
 */
abstract class Framework_Request
{
    /**
     * factory
     *
     * @access      public
     * @param       string      $type
     * @return      mixed       PEAR_Error on failure, request on success
     */
    static public function &factory($type)
    {
        $file = 'Framework/Request/' . $type . '.php';
        $object = 'Framework_Request_' . $type;
        if (!include_once($file)) {
            return PEAR::raiseError('Invalid request file: ' . $file);
        }

        if (!class_exists($object)) {
            return PEAR::raiseError('Invalid request class: ' . $object);
        }

        $instance = new $object();
        if (!$instance instanceof Framework_Request_Common) {
            throw new Framework_Exception('Framework_Request_' . $type . ' does not extend from Framework_Request_Common');
        }

        return $instance;
    }
}

?>
