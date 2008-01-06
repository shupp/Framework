<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Exception
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @filesource
 */

require_once 'PEAR/Exception.php';

/**
 * Framework_Exception
 *
 * A small layer above PEAR_Exception that allows you to pass PEAR_Error
 * as the message to your exceptions.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 */
class Framework_Exception extends PEAR_Exception
{
    /**
     * __construct
     *
     * @access      public
     * @param       mixed       $message        PEAR_Error or your message
     * @param       int         $code           An error code
     * @return      void
     */
    public function __construct($message, $code = 0)
    {
        if (PEAR::isError($message)) {
            $msg = $message->getMessage();
            $code = $message->getCode();
        } else {
            $msg = $message;
        }

        $this->message  = $msg;
        $this->code     = $code;
    }
}

?>
