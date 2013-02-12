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
 * FwLite Core Class used by model,view and controller
 *
 * @package	FwLite
 * @subpackage	Libraries
 * @category	Libraries
 * @author	Uday Shiwakoti
 * @link	http://fwlite.usforweb.com/user_guide/libraries/core.html
 */
class Core{
      static $instance=NULL;
      static $headers=NULL;
      static $total_object=0;
      public $config;
   
 /**
 * Returns the core instance. If this class is extended it will return the instance 
 * the child class
  *  
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
 * Constructor of the class. 
 *  
 * @access      protected
 * @return	void
 */
protected function __construct() {
       if(!isset(self::$headers->item['ct']))
            self::$headers->item['ct']=array();
            
       $this->config=  Config::getInstance();
      
   }
   /**
    * Accorting to Singleton desing pattern cloning not allowed
    */
    private function  __clone() {
        trigger_error("Clonig not allowed");
    } 
    
 /**
 * Redirect the given url. 
 * 
 * @param $url
 *  
 * @access      public
 * @return	void
 */ 
    function redirect($url){
        header('Location: '.$url);
        exit;
    }
    
    
 /**
  * Set the output of buffer for view to html
  */         
      function setHtmlOutput(){           
           self::$headers->item['ct']=array('Content-Type: text/html; charset=utf-8');
       }

 /**
  * Set the output of buffer for view to css
  */    
       function setCssOutput(){
           self::$headers->item['ct']=array('Content-type: text/css');
           
       }
       
  /**
  * Set the output of buffer for view to javascript
  */     
       function setJavascriptOutput(){
           self::$headers->item['ct']=array('Content-type: text/javascript');
           
       }
       
  /**
  * Set the output of buffer for view to JSON
  */     
       function setJsonOutput(){
            self::$headers->item['ct']=array('Content-type: text/json',
                                'Content-type: application/json');
            
       }
       
 /**
  * Set the output of buffer for view to download with the given filename.
  * 
  * @param $filename string
  */     
       function setDownloadOutput($filename='download.zip'){           
            self::$headers->item['ct']=array('Content-type: application/zip',
                                 'Content-Disposition: attachment; filename="' . $filename . '"');            
       }
}