<?php
class Model extends Core{

        function __construct() {
            parent::__construct();
            
            //setting up database
            $data= $this->config->get('config');
            if(isset($data['use_db']) && $data['use_db'] ){
                 $this->db=Db::getInstance();
            }
        }
  
        
    
}