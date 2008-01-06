<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_JSON
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 * @filesource
 */

/**
 * Framework_Controller_JSON
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 */
class Framework_Controller_JSON extends Framework_Controller_Web
{
    /**
     * module
     *
     * @access      public
     * @return      mixed
     */
    public function &module()
    {
        $result = @parent::module();
        if (PEAR::isError($result)) {
            $this->output($result);
            exit;
        } else {
            return $result;
        }
    }

    /**
     * authenticate
     *
     * @access      public
     * @return      mixed
     */
    public function authenticate()
    {
        $result = @parent::authenticate();
        if (PEAR::isError($result)) {
            $this->output($result);
            exit;
        }

        return $result;
    }

    /**
     * start
     *
     * @access      public
     * @return      mixed
     */
    public function start()
    {
        $result = @parent::start();
        if (PEAR::isError($result)) {
            $this->output($result);
            exit;
        }

        return $result;
    }

    /**
     * stop
     *
     * @access      public
     * @return      mixed
     */
    public function stop()
    {
        $result = @parent::stop();
        if (PEAR::isError($result)) {
            $this->output($result);
            exit;
        }

        return $result;
    }

    /**
     * display
     *
     * @access      public
     * @return      mixed
     */
    public function display()
    {
        try {
            $result = $this->run();
        } catch (Framework_Exception $result) {
            $result = PEAR::raiseError($result->getMessage());
        }

        if (!PEAR::isError($result)) {
            $result = Framework::$module->getData();
        }

        $this->output($result);
    }

    /**
     * output
     *
     * Outputs the given $data into XML using XML_Serializer
     *
     * @access      public
     * @param       mixed       $data       Datat to serialize into XML
     * @return      mixed
     */
    private function output($data)
    {
        header('Content-type: application/json; charset=utf-8');
        if (!function_exists('json_encode')) {
            echo <<< EOT
{
    "error"     : "json_encode() not found",
    "code"      : "404",
    "info"      : "It appears php-json is not installed"
}
EOT;
        } else {
            if (PEAR::isError($data)) {
                $data = array('error' => $data->getMessage(),
                              'code'  => $data->getCode(),
                              'info'  => $data->getUserInfo());
            }

            echo json_encode($data);
        }
    }
}

?>
