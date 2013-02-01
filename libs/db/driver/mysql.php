<?php

class Mysql{
    
        
        private $connection;
        private $db;
        private $sql;
        private $result;
        
      
        
     
        private function makeConnecton($host='127.0.0.1',$db='test',$user='root',$pass='root') {
            $this->connection=  mysql_connect($host,$user,$pass) or die("Could not connect: " . mysql_error());
            $this->db=mysql_select_db($db,$this->connection);
        }
 
        
        /**
        * Allowing for multiple connection also
        *
        */
        function __construct($host='127.0.0.1',$db='test',$user='root',$pass='root') {
                $this->makeConnecton($host,$db,$user,$pass);
        }
        
      
        
        
        
        function query($sql){
            $this->sql=$sql;
       
            $this->result= mysql_query($sql,$this->connection) or die('Error on Query:'.  mysql_error($this->connection));
         
        }
        
        
        function fetch($sql=NULL,$type=1){
            $output=array();
                if(isset($sql)){
                    $this->query($sql);
                }
                
                if($type==1)
                    $type=MYSQL_ASSOC;
                elseif($type==2)
                    $type=MYSQL_NUM;
                
             if($type==0){
                   while ($row = mysql_fetch_object($this->result)) {
                   $output[]=$row;
                }  
             }else{
                while ($row = mysql_fetch_array($this->result, $type)) {
                   $output[]=$row;
                }  
             }
             mysql_free_result($this->result);
             
            return $output;
        }
        
        function fetchRow($sql=NULL,$type=0){
                if(isset($sql)){
                    $this->query($sql);
                }
                
               if($type==1)
                    $type=MYSQL_ASSOC;
                elseif($type==2)
                    $type=MYSQL_NUM;  
                
            if($type==0){
                $output=mysql_fetch_object($this->result);
            }else{
                $output=mysql_fetch_array($this->result, $type);
            }
            mysql_free_result($this->result);
            return $output;
        }
        
        function getLastSql(){
          return $this->sql;
        }
        
        function getInsertedId(){
            return mysql_insert_id();            
        }
        
        function close(){
            mysql_close($this->connection);
        }
}





