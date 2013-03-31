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
  private $is_plugin_enabled=false;
  protected $_get=NULL,$_post=NULL,$_files=NULL,$_session=NULL,$_request=NULL;










  function __construct() {
    
      parent::__construct();
      
                if(BootStrap::isPluginEnabled()){
                    $this->firePlugin('pre_dispatch');
                }
               
                //Myplugin::doHello();
      
      $this->setupRequestObjects();
      $this->preDispatch();
      $this->view=new View();
      
  }
  
  
private  function loadPlugin($clsName=NULL){
      $plugin_dir=  BootStrap::getPluginDir();
     $require_file=$plugin_dir.'/'.strtolower($clsName).'.php';
     if(file_exists($require_file)){
        require_once $require_file;
      
     }else{
         die('No '.$require_file.' Found');
     }
     
  }
  
  private function firePlugin($state='pre_dispatch'){
        
                $config=Config::getInstance();
             $config->load('plugin');
            $data= $config->get('plugin');
            # print_r($config);
            $plugin_dir=  BootStrap::getPluginDir();
            if(isset($data[$state])){
            foreach($data[$state] as $row){
                    $class=$row['class'];
                    $this->loadPlugin($class);
                    if(is_array($row['methods'])){
                        foreach($row['methods'] as $method=>$args){
                           if(is_array($args)){
                            $class::$method($args);
                           }
                        }
                    }
                        //$this->firePlugin($row['class']
            }
           }
  }

  
  private function setupRequestObjects(){
      if(isset($_FILES))
        $this->_files=&$_FILES;
      
      if(isset($_POST))
        $this->_post=&$_POST;
      
      
      if(isset($_SESSION))
        $this->_post=&$_SESSION;
      
      if(isset($_REQUEST))
        $this->_request=&$_REQUEST;
      
      if(isset($_GET))
        $this->_get=&$_GET;
      
  }
  
  function enablePlugin(){
      
      $this->is_plugin_enabled=true;
  }
  function disablePlugin(){
      $this->is_plugin_enabled=false;
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
      if(BootStrap::isPluginEnabled()){
                    $this->firePlugin('post_dispatch');
      }
      #print_r(get_included_files());
  }
  
}