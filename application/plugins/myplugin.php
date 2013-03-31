<?php

class Myplugin{
    static function doHello($args=array()){
        echo 'xxHelloxx '.$args['name'];
    }
    static function doBye($args=array()){
        echo 'Bye '.$args['name'];
    }
}
?>
