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
 * FwLite Bootstrap Class
 *
 * @package	FwLite
 * @subpackage	Libraries
 * @category	Libraries
 * @author	Uday Shiwakoti
 * @link	http://fwlite.usforweb.com/user_guide/libraries/bootstrap.html
 */
class BootStrap{
    static $config;
 
    ###############################################

    /**
    * Auto load enviroment setup
    * @param $clsName 
    *  
    * @access      public
    * @return	void
    */
    static function autoload($clsname=NULL){
       
        foreach(self::$config->dir as $dir){
             $file=$dir.'/'.strtolower($clsname).'.php';
             if(file_exists($file)){
                    require_once($file);
             }
        }
        
    }

    ###############################################
    
    /**
    * Load the core files of FwLite 
    * @access      private
    * @return	void
    */

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
    /**
     * Setup the default environment directory if not setup
     * @access      private
     * @return	void
     */
    
     
    private static function setupEnv(){
        if(!isset(self::$config->plugin))
            self::$config->plugin=false;
        
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
    

    static function enablePlugin(){
        self::$config->plugin=true;
    }
    
    
    static function disablePlugin(){
        self::$config->plugin=false;
    }
    
    static function isPluginEnabled(){
        return self::$config->plugin;
    }
    ###############################################    
    /**
     * Returns the config directory name
     * 
     * @param $key string
     * 
     * @access      public
     * @return	string
     */

    
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
 
    /**
    * Returns the view directory name
    * @access      public
    * @return	string
    */

    static function getViewDir(){
        return self::$config->dir['view'];
    }
    
    ###############################################    
    /**
    * Sets the document root
     * 
     *@param $dir string
     * 
    * @access      public
    * @return	void
    */
    
    static function setDocumentRoot($dir=NULL){
        self::$config->dir['document_root']=$dir;
    }

     /**
 * Sets the system Dir
 * 
  *@param $dir string
  * 
 * @access      public
 * @return	void
 */
    static function setSystemDir($dir=NULL){
        self::$config->dir['system']=$dir;
    }
    

    
    /**
    * Returns the system directory name
    * @access      public
    * @return	string
    */   

    static function getSystemDir(){
        return  self::$config->dir['system'];
    }
    
     /**
    * Sets the lib Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */

    static function setLibDir($dir=NULL){
        self::setSystemDir($dir);
    }

        
   /**
 * Sets the Application Dir
 * 
 * @param $dir string
 * 
 * @access      public
 * @return	void
 */

    
    static function setApplicationDir($dir=NULL){
        self::$config->dir['application']=$dir;
    }
    ###############################################
    /**
    * Sets the config Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */

    static function setConfigDir($dir=NULL){
        self::$config->dir['config']=$dir;
    }
    
    /**
    * Sets the controller Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */
    static function setControllerDir($dir=NULL){
        self::$config->dir['controller']=$dir;
    }
    

        
    /**
     * Sets the controller Dir
     * 
     * @param $dir string
     * 
     * @access      public
     * @return	void
     */     

    static function setModelDir($dir=NULL){
        self::$config->dir['model']=$dir;
    }

    
    /**
    * Sets the view Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */   

    static function setViewDir($dir=NULL){
        self::$config->dir['view']=$dir;
    }
    
    /**
    * Sets the template Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */

    static function setTemplateDir($dir=NULL){
        self::$config->dir['template']=$dir;
    }

    /**
     * Returns the location of template.
     * 
     * @return string
     */
    static function getTemplateDir(){
        return self::$config->dir['template'];
    }
   
    /**
    * Sets the plugin Dir
    * 
    * @param $dir string
    * 
    * @access      public
    * @return	void
    */

    static function setPluginDir($dir=NULL){
        self::$config->dir['plugin']=$dir;
    }
    /**
     * Returns the location fo plugin dir
     * 
     * @return string
     */
    static function getPluginDir(){
        return self::$config->dir['plugin'];
    }
    ###############################################
    
    /**
     *  Set Mvc information 
     * 
     * @param info array
     * 
     * 
     */
    
    static function setMVCInfo($info=array()){
        self::$config->info['mvc']=$info;
    }
    
    /**
     * Returns the current mvc information.
     * @return array
     */
    
    static function getMVCInfo(){
        return self::$config->info['mvc'];
    }
    
    /**
     * Set up the bootstrap and dispatch.
     * @param type $info
     */
    static function dispatch($info=array()){
            self::setupEnv();
            self::setupCore();
            
             $config=Config::getInstance();
             $config->load('config');
             $data= $config->get('config');
          
          if(isset($data['display_error']) && $data['display_error']){
             error_reporting(E_ALL);
             ini_set('display_errors', 1);
          }else{
              error_reporting(0);
              ini_set('display_errors', 0);
          }
       
          if(isset($data['use_session']) && $data['use_session']){
              session_start();
          }    
            if(isset($data['use_plugin']) && $data['use_plugin'])
                    self::enablePlugin();
             
             unset($config);
             
         
             
         
     

            if(isset($_SERVER['QUERY_STRING'])){
                
                $mvc_info['controller']=$data['default_controller'];
                $mvc_info['action']=$data['default_action'];
                  
                if(isset($data['use_get']) && $data['use_get']){
                    $requests=$_GET;
                }else{
                    $query_str=trim($_SERVER['QUERY_STRING']);
                    $query_str=$query_str;
                    $requests=explode('/',str_replace('^/', '/', $query_str));
               
                    $i=0;
                
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
                    unset($_GET);
               }  
                
            }
            
            self::setMVCInfo($mvc_info);
            
            $class=$mvc_info['controller'];
            $method=$mvc_info['action'];
            $file=self::$config->dir['controller'].'/'.$class.'.php';
            #echo $file;
            if(file_exists($file)){
            $obj_controller=new $class;
            #$obj_controller->enableHook();
            $obj_controller->setView(strtolower($method));
            call_user_func(array($obj_controller, $method));
            }else{
                echo 'Invalid Request';
                exit;
            }
    }
}



