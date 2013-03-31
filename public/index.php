<?php
$doc_root=$_SERVER['DOCUMENT_ROOT'].'/fwlite/';
$app_base=$doc_root.'application/';
$libs_base=$doc_root.'libs/';



ini_set("display_errors", 1);
error_reporting(E_ALL);



require_once $libs_base.'/bootstrap.php';

BootStrap::setDocumentRoot($doc_root);

















function __autoload($clsname=NULL){
    /*$libs=array('controllers','model','libs','interfaces','third_party');
    foreach($libs as $lib){
        $file=$lib.'/'.strtolower($clsname).'.php';
        if(file_exists($file)){
            require_once($file);
        }
    }*/
    
    BootStrap::autoload($clsname);
    
}


BootStrap::dispatch();
/*$obj_controller=new $mvc_info['controller'];
#$obj_controller->enableHook();
$obj_controller->setView(strtolower($mvc_info['action']));
call_user_func(array($obj_controller, $mvc_info['action']));
 
 */
 
