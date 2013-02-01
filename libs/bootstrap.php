<?php

class BootStrap{
    static $config;
 
    ###############################################
    static function autoload($clsname=NULL){
       
        foreach(self::$config->dir as $dir){
             $file=$dir.'/'.strtolower($clsname).'.php';
             if(file_exists($file)){
                    require_once($file);
             }
        }
        
    }

    ###############################################
    private static function setupCore(){
        
        
        $required_core_files=array('config','core','controller','view','model');
        
               $config=Config::getInstance();
               $config->load('config');
               $data= $config->get('config');
              
               if(isset($data['use_db']) && $data['use_db'] ){
                    $required_core_files[]='db/db';
               }
             
                
                
        foreach($required_core_files as $required_core_file){
                
                $file=self::$config->dir['system'].'/'.$required_core_file.'.php';
                if(file_exists($file)){
                    require_once($file);
                }else{
                    die($file.' is require file to run this framework.');
                }
        }
        
    }
    ###############################################
    
     private static function setupEnv(){
        if(!isset(self::$config->dir['document_root']))
            self::$config->dir['document_root']=$_SERVER['DOCUMENT_ROOT'].'/';
        
         if(!isset(self::$config->dir['system']))
            self::$config->dir['system']=self::$config->dir['document_root'].'libs/';
         
          if(!isset(self::$config->dir['application']))
            self::$config->dir['application']=self::$config->dir['document_root'].'application/';
        
          if(!isset(self::$config->dir['config']))
            self::$config->dir['config']=self::$config->dir['application'].'configs/';
          
          if(!isset(self::$config->dir['controller']))
            self::$config->dir['controller']=self::$config->dir['application'].'controllers/';
        
          if(!isset(self::$config->dir['model']))
            self::$config->dir['model']=self::$config->dir['application'].'models/';
          
          if(!isset(self::$config->dir['view']))
            self::$config->dir['view']=self::$config->dir['application'].'views/';
        
          if(!isset(self::$config->dir['template']))
            self::$config->dir['template']=self::$config->dir['application'].'templates/';
          
          if(!isset(self::$config->dir['plugin']))
            self::$config->dir['plugin']=self::$config->dir['application'].'plugins/';
    }
    
    ###############################################    
    static function getConfigDir($key=NULL){
        if(isset($key)){
            if(isset(self::$config->dir[$key]))
                return self::$config->dir[$key];
            else 
                return NULL;
        }else{
            return self::$config;
        }
        
    }
    
    static function getViewDir(){
        return self::$config->dir['view'];
    }
    
    ###############################################    
    
    static function setDocumentRoot($dir=NULL){
        self::$config->dir['document_root']=$dir;
    }
    
    static function setSystemDir($dir=NULL){
        self::$config->dir['system']=$dir;
    }
    
    static function getSystemDir(){
        return  self::$config->dir['system'];
    }
    
     static function setLibDir($dir=NULL){
        self::setSystemDir($dir);
    }
    
    static function setApplicationDir($dir=NULL){
        self::$config->dir['application']=$dir;
    }
    ###############################################
     static function setConfigDir($dir=NULL){
        self::$config->dir['config']=$dir;
    }
    
    static function setControllerDir($dir=NULL){
        self::$config->dir['controller']=$dir;
    }
    
    static function setModelDir($dir=NULL){
        self::$config->dir['model']=$dir;
    }
    
    static function setViewDir($dir=NULL){
        self::$config->dir['view']=$dir;
    }
    
 
    static function setTemplateDir($dir=NULL){
        self::$config->dir['template']=$dir;
    }
     static function getTemplateDir(){
        return self::$config->dir['template'];
    }
    
    static function setPluginDir($dir=NULL){
        self::$config->dir['plugin']=$dir;
    }
    
    static function getPluginDir($dir=NULL){
        return self::$config->dir['plugin'];
    }
    ###############################################
    
    static function setMVCInfo($info=array()){
        self::$config->info['mvc']=$info;
    }
    
    static function getMVCInfo(){
        return self::$config->info['mvc'];
    }
    
    static function dispatch($info=array()){
            self::setupEnv();
            self::setupCore();
            
             $config=Config::getInstance();
             $config->load('config');
             $data= $config->get('config');
             unset($config);
             
          
     

            if(isset($_SERVER['QUERY_STRING'])){
                $query_str=trim($_SERVER['QUERY_STRING']);
                $query_str=$query_str;
                $requests=explode('/',str_replace('^/', '/', $query_str));
                $i=0;
                if(isset($_GET))
                    unset($_GET);
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $mvc_info=$_POST;
                    unset($_POST);
                }
                
                $mvc_info['controller']=$data['default_controller'];
                $mvc_info['action']=$data['default_action'];
                  
                  
                foreach($requests as $request){
                        if($request=='')
                            continue;


                            if($i==0)
                                $mvc_info['controller']=$request;
                            elseif($i==1)
                                $mvc_info['action']=$request;
                            else{
                                $arg_index=$i-2;
                                $mvc_info['arg_'.$arg_index]=$request;
                            }

                 $i++;   
                }
            }
            
            self::setMVCInfo($mvc_info);
            
            $class=$mvc_info['controller'];
            $method=$mvc_info['action'];

            $obj_controller=new $class;
            #$obj_controller->enableHook();
            $obj_controller->setView(strtolower($method));
            call_user_func(array($obj_controller, $method));
    }
}



?>