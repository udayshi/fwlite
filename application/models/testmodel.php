<?php

class testmodel extends Model{
    
    
    function test(){
        echo 'Running from model';
      /* $result=$this->db->fetch('select * from admin_menu');
        print_r($result);*/
    }
}
?>
