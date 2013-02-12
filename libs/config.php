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
 * FwLite Config Class
 *
 * @package	FwLite
 * @subpackage	Libraries
 * @category	Libraries
 * @author	Uday Shiwakoti
 * @link	http://fwlite.usforweb.com/user_guide/libraries/config.html
 */
class Config{
   private $configs=array();
   static $instance=NULL;
   
/**
 * Returns the config instance. 
 * @access      public
 * @return	object
 */

    public static function getInstance($clsName=NULL){
       if (!isset(self::$instance)) {
            if(isset($clsName))
                $c=$clsName;
            else
                $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
   }

   
 /**
 * Loads the config from file.
 *  
 * @param $key string
 * 
 * @access      public
 * @return	void
 */
 
   function load($name=NULL){
      
      $config_file=BootStrap::getConfigDir('config').$name.'.php';
        
        if(!isset($this->configs[$name])){
            
            if(file_exists($config_file)){
              
                include $config_file;           
                $this->configs[$name]=$config;
            }else{
                die('Unable to load '.$config_file);
            }
       }
   }
   
   
/**
 * Returns the value of the key. 
 *  
 * @param $key string
 * 
 * @access      public
 * @return	array
 */
 
   function get($name=NULL){
       if(isset($name)){
           if(isset($this->configs[$name]))
               return $this->configs[$name];
           else 
               return false;
       }else{
           return $this->configs;
       }
       
   }
   
}
