<?php

/**
 * Framework_DB_ADODB 
 * 
 * Framework Driver for ADODB or ADODBLite
 * 
 * PHP Version 5.1
 * 
 * @package    Framework
 * @subpackage Framework_DB
 * @author     Bill Shupp <hostmaster@shupp.org> 
 * @copyright  2008 Bill Shupp
 * @uses       Framework_DB_Common
 * @license    BSD http://www.opensource.org/licenses/bsd-license.php
 * @link       http://adodb.sourceforge.net/
 * @link       http://adodblite.sourceforge.net/
 */

require_once 'Framework/DB/Common.php';

/**
 * Framework_DB_ADODB 
 * 
 * Framework Driver for ADODB or ADODBLite
 * 
 * @package    Framework
 * @subpackage Framework_DB
 * @author     Bill Shupp <hostmaster@shupp.org> 
 * @author     Joe Stump <joe@joestump.net>
 * @copyright  2008 Bill Shupp
 * @uses       Framework_DB_Common
 * @license    BSD http://www.opensource.org/licenses/bsd-license.php
 * @link       http://adodb.sourceforge.net/
 * @link       http://adodblite.sourceforge.net/
 */
class Framework_DB_ADODB extends Framework_DB_Common
{
    /**
     * Create a singleton of ADODB or ADODBLite;  This driver works for 
     * both.  Just specify the correct directory in 
     * config->db->options->adodbDir.
     *
     * @access public
     * @throws Framework_DB_Exception on failure
     * @return object                 Instance of ADODB[Lite] connected to the DB
     */
    public function singleton()
    {
        if (!is_null(parent::$db) && 
            parent::$db instanceof ADOConnection) {
            return parent::$db;
        }

        // Manually include files, ADODB does not follow naming conventions
        if (empty($this->options->adodbDir)) {
            throw new Framework_DB_Exception(
                'Error: you must set $options->adodbDir'
            );
        }
        $path = (string)$this->options->adodbDir;
        if (!include_once $path . PATH_SEPARATOR . 'adodb-exceptions.inc.php' ||
            !include_once $path . PATH_SEPARATOR . 'adodb.inc.php') {
            throw new Framework_DB_Exception(
                'Error: could not include ADODB files'
            );
        }

        try {
            parent::$db = ADONewConnection($this->dsn);
        } catch (Exception $error) {
            throw new Framework_DB_Exception(
                $error->getMessage(), $error->getCode()
            );
        } 

        // Fetch Modes
        $fetchModes = array(
            'ADODB_FETCH_DEFAULT' => ADODB_FETCH_DEFAULT,
            'ADODB_FETCH_NUM',    => ADODB_FETCH_NUM,
            'ADODB_FETCH_ASSOC',  => ADODB_FETCH_ASSOC,
            'ADODB_FETCH_BOTH',   => ADODB_FETCH_BOTH
        );

        $fetchMode = ADODB_FETCH_ASSOC;
        if (isset($this->options->fetchMode)&&
            isset($fetchModes[(string)$this->options->fetchMode])) {
            $fetchMode = $fetchModes[(string)$this->options->fetchMode];
        }

        parent::$db->SetFetchMode($fetchMode);
        return parent::$db;
    }
}

?>
