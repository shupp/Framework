<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Presenter
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Presenter
 *
 * Presenter factory class. This is used by the controller file, in
 * conjunction with the Framework_Module::$presenter variable to produced the
 * desired presenter class.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @see Framework_Module::$presenter, Framework_Presenter_common
 */
abstract class Framework_Presenter
{
    /**
     * factory
     *
     * @author Joe Stump <joe@joestump.net>
     * @access public
     * @param string $type Presentation type (our view)
     * @param mixed $module Our module, which the presenter will display
     * @return mixed PEAR_Error on failure or a valid presenter
     * @static
     */
    static public function factory($type,Framework_Module $module)
    {
        $file = 'Framework/Presenter/'.$type.'.php';
        if (include($file)) {
            $class = 'Framework_Presenter_'.$type;
            if (class_exists($class)) {
                try {
                    $presenter = new $class($module);
                    if ($presenter instanceof Framework_Presenter_common) {
                        return $presenter;
                    }
                } catch (Framework_Exception $error) {
                    return PEAR::raiseError($error->getMessage());
                }

                return PEAR::raiseError('Invalid presentation class: '.$type);
            }

            return PEAR::raiseError('Presentation class not found: '.$type);
        }

        return PEAR::raiseError('Presenter file not found: '.$type);
    }
}

?>
