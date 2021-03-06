<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_DB_None
 *
 * @author      Bill Shupp <hostmaster@shupp.org>
 * @copyright   Bill Shupp <hostmaster@shupp.org>
 * @package     Framework
 * @subpackage  DB
 * @filesource
 */

/**
 * Framework_DB_None
 *
 * Driver to use when there will be no DB connection.
 *
 * @author      Bill Shupp <hostmaster@shupp.org
 * @package     Framework
 * @subpackage  DB
 */
class Framework_DB_None implements Framework_DB_Interface
{
    /**
     * start 
     * 
     * @access public
     * @return void
     */
    public function start($dsn)
    {
        Framework::$db = null;
    }
    /**
     * stop 
     * 
     * @access public
     * @return void
     */
    public function stop($db)
    {
        Framework::$db = null;
    }
}

?>
