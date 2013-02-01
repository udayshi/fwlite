<?php

class test extends Controller{
    
    
   function preDispatch(){
       
    }
    
     function postDispatch(){
        
    }
    
    function index(){
      
    
        #$a=new testmodel();
       # $a->test();
        
      #$this->setCssOutput();
      #$config=$this->config->get('config');
      # print_r($config);
        
      #$this->forward('t3');
      #$this->view->enable();
       $this->view->assign('hello','world');
       
       # $result=$this->db->fetch('select * from admin_menu');
        #print_r($result);
      #$this->redirect('/fwtest/test/t3');  
        
    }
    
    function t3(){
        echo 't3 called';
    }
    
}
?>
