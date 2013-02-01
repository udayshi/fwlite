<?php

class Db{
    
        static $instance=NULL;       
  
        
        public static function getInstance()
        {
            if (!isset(self::$instance)) {
                
                
                $config=Config::getInstance();
                $config->load('db');
                $db_info=$config->get('db');
                $c=trim($db_info['dbdriver']);
                $driver_file=Bootstrap::getSystemDir().'db/driver/'.$c.'.php';
                $host=$db_info['hostname'];
                $db=$db_info['database'];
                $user=$db_info['username'];
                $pass=$db_info['password'];
                
                
                if(file_exists($driver_file)){
                    require_once $driver_file;
                    self::$instance = new $c($host,$db,$user,$pass);
                }else{
                    die('Unable to load driver '.$driver_file);
                }
            }

            return self::$instance;
        }
        
        
}
