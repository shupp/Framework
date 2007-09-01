<?php

/**
 * Framework_Presenter_None
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Presenter_None
 *
 * None is just that. It's not a presenter. Use this if you want to use simple
 * echo/print statements to output your module.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Presenter
 * @link http://smarty.php.net
 */
class Framework_Presenter_None extends Framework_Presenter_Common
{
    /**
     * __construct
     *
     * @access public
     * @param object $module
     * @return void
     */
    public function __construct(Framework_Module $module)
    {
        parent::__construct($module);
    }

    /**
     * display
     *
     * @access public
     * @return void
     */
    public function display()
    {

    }
}

?>
