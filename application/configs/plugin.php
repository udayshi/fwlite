<?php
$config=array();
//make sure all plugin are static
$config['pre_dispatch'][]=array(
                                'class'=>'Myplugin',
                                     'methods'=>array(
                                         'doHello'=>array('name'=>'uday'/*Provide argument of method if exists*/),
                                     ),
                             );


$config['post_dispatch'][]=array(
                                'class'=>'Myplugin',
                                     'methods'=>array(
                                         'doBye'=>array('name'=>'uday'/*Provide argument of method if exists*/),
                                     ),
                             );


