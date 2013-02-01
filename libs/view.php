<?php
class View extends Core{
    private $data;
    public  $file=NULL;
    private $enable_view=true;
    static  $extra=NULL;
    private  $template_dir=NULL;
    private $view_dir=NULL;
    
    
        function __construct() {
            
            if(!isset(self::$extra->data['js']))
                self::$extra->data['js']=array();
            
            if(!isset(self::$extra->data['css']))
                    self::$extra->data['css']=array();
            
            $this->view_dir=  BootStrap::getViewDir();
            parent::__construct();
        }
        
        function setViewDir($dir=NULL){
            $this->view_dir=$dir;
        }
        
        function addJs($js_file){
            array_push(self::$extra->data['js'],$js_file);
        }
    
        function addCss($css_file){
           array_push(self::$extra->data['css'],$css_file);
        }
        
        function prependJs($js_file){
            array_unshift(self::$extra->data['js'],$js_file);
        }
                
        function prependCss($css_file){
            array_unshift(self::$extra->data['css'],$css_file);
        }
        
        function removeJs($js_file=NULL){
            foreach(self::$extra->data['js'] as $k=>$v){
                if($v==$js_file)
                    unset(self::$extra->data['js'][$k]);
            }
        }
        
        
        function removeCss($css_file=NULL){
             foreach(self::$extra->data['css'] as $k=>$v){
                if($v==$css_file)
                    unset(self::$extra->data['css'][$k]);
            }            
        }
        
        
         public  function printJs(){
             
               foreach(self::$extra->data['js'] as $file){
                echo "<script src='".$file."' type='text/javascript'></script>\n";
                }
                self::$extra->data['js']=array();
             
         }
        
         public  function printCss(){              
              foreach(self::$extra->data['css'] as $css_file){
                    echo "<link type=\"text/css\"  media=\"all\"  rel=\"stylesheet\" href=\"".$css_file."\" />\n";
                }
                self::$extra->data['css']=array();
         }
        
       function disable(){
           $this->enable_view=FALSE;
       }
       
       
       function enable(){
           $this->enable_view=TRUE;
       }
      
       function setTemplateDir($template_dir=NULL){
           $this->template_dir=$template_dir;
       }
    
      function loadView($view,$ext='html'){
                if($this->enable_view){
                    $vw_file=$this->view_dir.$view.'.'.$ext;
                    if(file_exists($vw_file)){
                        extract($this->data);
                        require_once $vw_file;

                    }else{
                        echo 'No view found'.$vw_file;
                    }
                }
                
            
        }
    
        function assign($k,$v){
            $this->data[$k]=$v;
        }
        
        
        function dump(){
            print_r($this->data);
        }
}