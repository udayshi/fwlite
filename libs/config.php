<?php
class Config{
   private $configs=array();
   static $instance=NULL;
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
?>
