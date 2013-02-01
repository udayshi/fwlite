<?php

class ActiveRecord{
        private $info=array();
        
        
        function insert($table_name=NULL,$data=array()){
            $sql='INSERT INTO '.$table_name.' set ';
            foreach($data as $k=>$v){
                $sql.="`".$k."`='".mysql_real_escape_string($v)."'";

            }
            #echo $sql;
        }
    
    
       
    
        function update($table_name=NULL,$data=array()){
        $sql='UPDATE '.$table_name.' set ';
            foreach($data as $k=>$v){
                $sql.="`".$k."`='".mysql_real_escape_string($v)."'";
            }
        
        }
        
        function delete($table_name=NULL,$where=NULL){
       # echo $sql;
        
        }
        function get($table_name=NULL,$where=NULL){
            
        }
        function select($columns="*",$alias=NULL){
            $this->info['columns'][]=array('column'=>$columns,'alias'=>$alias);
            
        }
        
        function from($table_name=NULL){
            $this->info['table_name'][]=$table_name;
        }
        
        function join($table_name,$join_on=NULL,$join_type='FULL'){
            $this->info['join'][]=array('table_name'=>$table_name,'join_on'=>$join_on,'join_type'=>  strtoupper($join_type));
        }
        
        
         function where($k,$v,$where=NULL){
            $this->info['where'][$k]=$v;        
        }
        
        
        function like($k,$v){
            $this->info['like'][$k]=$v;        
        }
        
        function or_like($k,$v){
            $this->info['or_like'][$k]=$v;        
        }
        
        function or_not_like($k,$v){
            $this->info['or_not_like'][$k]=$v;        
        }
        
        function or_where($k,$v,$where=NULL){
            $this->info['or_where'][$k]=$v;        
        }
        
        function where_in($k,$v,$where=NULL){
            $this->info['where_in'][$k]=$v;        
        }
        
        function where_not_in($k,$v,$where=NULL){
            $this->info['where_not_in'][$k]=$v;        
        }
        
        
        function orderby($columns=NULL){
            $this->info['order_by']=$columns;
            
        }
        
        function having($where=NULL){
            $this->info['having']=$where;
        }
        
        function not_having($where=NULL){
            $this->info['not_having']=$where;
            
        }
        
        function group_by($columns=NULL){
            $this->info['group_by']=$columns;
            
        }
        
        
        function generateSql(){
            #############
            $sql='SELECT ';
            #############
            $prefex=NULL;
            foreach($this->info['columns'] as $column){
                $sql.=$prefex."\t".$column['column'];
                
                $pattern='/^(avg\(|count\(|min\(|max\(|sum\(|group_cat\()/i';
                $col=trim($column['column']);
                
                if(preg_match($pattern, $subject))
                    $this->info['has_groupby_cols']=true;
                
                if(isset($column['alias']) && $column['alias']!='')
                        $sql.=" AS ".$column['alias'];
                
                $prefex="\n,";
            }
            #############
            $sql.="\n ". $this->info['table_name'][0].' a';
            #############
            if(isset($this->info['join'])){
                foreach($this->info['join'] as $join_table){
                     $sql.="\n ";

                     if($join_table['join_type']!='FULL')
                         $sql.=' '.$join_table['join_type'];

                     $sql.=' JOIN '.$join_table['table_name'];

                     if(isset($join_table['join_on']))
                        $sql.=' ON '.$join_table['join_on'];

                }
            }
            #############
            $sql.=' WHERE 1 ';
            if(isset($this->info['where'])){
                foreach($this->info['where'] as $k=>$v){
                    
                }
            }
            
            
            
            
        }
        
        
}
?>
