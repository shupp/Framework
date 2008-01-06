<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_Web
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006, 2007 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Controller_Web
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */
class Framework_Controller_Web extends Framework_Controller_Common
{
    /**
     * $requester
     *
     * @access      public
     * @var         string      $requester      Framework_Request type to use
     */
    public $requester = 'Web';

    /**
     * module
     *
     * @access      public
     * @param       object      $request
     */
    public function &module()
    {
        return Framework_Module::factory(Framework::$request);
    }

    /**
     * start
     *
     * @access      public
     * @return      mixed
     */
    public function start()
    {
        return true;
    }

    /**
     * authenticate
     *
     * @access      public
     * @return      mixed
     */
    public function authenticate()
    {
        $result = Framework::$module->authenticate();
        if (PEAR::isError($result)) {
            return PEAR::raiseError($result->getMessage,
                                    FRAMEWORK_ERROR_AUTH);
        }

        if (!is_bool($result) || $result !== true) {
            return PEAR::raiseError('Authentication failed',
                                    FRAMEWORK_ERROR_AUTH);
        }
    }

    /**
     * run
     *
     * @access      protected
     * @return      mixed
     */
    protected function run()
    {
        $result = Framework_Module::start(Framework::$module,
                                          Framework::$request);

        if (PEAR::isError($result)) {
            return PEAR::raiseError($result->getMessage(),
                                    FRAMEWORK_ERROR_MODULE_EVENT);
        }
    }

    /**
     * display
     *
     * @access      public
     * @return      void
     */
    public function display()
    {
        $result = $this->run();
        if (PEAR::isError($result)) {
            return $result;
        }

        $presenter = Framework_Presenter::factory(Framework::$module->presenter,
                                                  Framework::$module);
        if (!PEAR::isError($presenter)) {
            $presenter->display();
        } else {
            return PEAR::raiseError($presenter->getMessage(),
                                    FRAMEWORK_ERROR_PRESENTER);
        }
    }

    /**
     * stop
     *
     * @access      public
     * @return      mixed
     */
    public function stop()
    {
        $result = Framework_Module::stop(Framework::$module);
        if (PEAR::isError($result)) {
            return $result;
        }
    }
}

?>
