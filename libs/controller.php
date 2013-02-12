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
 * FwLite Core Class controller used by all controller
 *
 * @package	FwLite
 * @subpackage	Libraries
 * @category	Libraries
 * @author	Uday Shiwakoti
 * @link	http://fwlite.usforweb.com/user_guide/libraries/controller.html
 */

class Controller extends Core{
  
  private $status=200;
  private $controller=NULL;
  private $method=NULL;
  private $plugin=NULL;
  protected $view=NULL;
  private $hooks=array();
  private $is_hook_enabled=false;
  
  
 
 
    
   
  function __construct() {
    
      parent::__construct();
      if($this->is_hook_enabled){
        Myplugin::doHello();
      }
      $this->preDispatch();
      $this->view=new View();
      
  }
  
  function enableHook(){
      
      $this->is_hook_enabled=true;
  }
  function disableHook(){
      $this->is_hook_enabled=false;
  }
  
  function preDispatch(){
      
  }
  
  function postDispatch(){
      
  }
 
  function setTemplateDir($template_dir=NULL){
     $this->view->setTemplateDir($template_dir);
  }
  
  function forward($method=NULL,$view=NULL){
      if(!isset($view)){
          $this->setView(strtolower($method));
      }
      $this->$method();
      exit;
  }
  
  
  
 
  
  public function __call($method, $args) {
      $this->status=500;
      print "No page Found ".$method ;
 
  }
 
  function setView($view=NULL,$ext='html'){      
        $this->view->file=$view;      
  }
  
   function setController($controller=NULL){      
        $this->controller=$controller;      
  }
  
  
  function setMethod($method=NULL){      
        $this->method=$method;      
  }
  

  
  
  private function setHeader(){
      
      foreach(self::$headers->item['ct'] as $header){
          echo $header;
          header($header);
      }
  }

  
  function __destruct() {
      $this->setHeader();
      if($this->status==200){
         
          $this->view->loadView($this->view->file);
          
      }   
      $this->postDispatch();
      if($this->is_hook_enabled){          
        Myplugin::doHello();
      }
      #print_r(get_included_files());
  }
  
}