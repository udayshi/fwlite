<?php
/**
 * FwLite
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		FwLite
 * @author		Uday Shiwakoti
 * @copyright           Copyright (c) 2010 - 2013, Shiwakoti Consultancy
 * @license		http://fwlite.userfor.com/user_guide/license.html
 * @link		http://fwlite.usforweb.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------
// ------------------------------------------------------------------------

/**
 * FwLite Model Class
 *
 * @package	FwLite
 * @subpackage	Libraries
 * @category	Libraries
 * @author	Uday Shiwakoti
 * @link	http://fwlite.usforweb.com/user_guide/libraries/model.html
 */

class Model extends Core{

        /**
	 * Constructor
	 *
	 * @access public
	 */    
        function __construct() {
            parent::__construct();
            
            //setting up database
            $data= $this->config->get('config');
            if(isset($data['use_db']) && $data['use_db'] ){
                 $this->db=Db::getInstance();
            }
        }
  
        
    
}