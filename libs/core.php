<?php
class Core{
      static $instance=NULL;
      static $headers=NULL;
      static $total_object=0;
      public $config;
   
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

   function __construct() {
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
    
    
    function redirect($url){
        header('Location: '.$url);
        exit;
    }
    
    
      
       
       function setHtmlOutput(){           
           self::$headers->item['ct']=array('Content-Type: text/html; charset=utf-8');
       }
       
       function setCssOutput(){
           self::$headers->item['ct']=array('Content-type: text/css');
           
       }
       
       function setJavascriptOutput(){
           self::$headers->item['ct']=array('Content-type: text/javascript');
           
       }
       
       function setJsonOutput(){
            self::$headers->item['ct']=array('Content-type: text/json',
                                'Content-type: application/json');
            
       }
       
       function setDownloadOutput($filename='download.zip'){           
            self::$headers->item['ct']=array('Content-type: application/zip',
                                 'Content-Disposition: attachment; filename="' . $filename . '"');            
       }
}
?>