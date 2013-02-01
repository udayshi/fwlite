<?php

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
  

  function error(){
      echo 'Error occoured';
      exit;
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