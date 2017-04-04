<?php
/**
 * Created by PhpStorm.
 * User: jackdeng
 * Date: 3/24 0024
 * Time: 16:44
 */

namespace common\libs;

class Tree{

    public $arr = [];
    public $icon = ['│', '├', '└'];
    public $nbsp = '&nbsp;';

    public $treeArr = [];

    public function __construct(array $arr){
        $this->arr = $arr;
    }

    public function getMenuTree($pk = 'id',$pidFieldName = 'pid',$child = '_child',$root = 0){
        $refer = [];
        foreach($this->arr as $key=>$value){
            $refer[$value[$pk]] = &$this->arr[$key];
        }

        foreach($this->arr as $key=>$value){
            $parentId = $value[$pidFieldName];
            if($root == $parentId){
                $this->treeArr[] = &$this->arr[$key];
            }else{
                if(isset($refer[$parentId])){
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$this->arr[$key];
                }
            }
        }

        return $this->treeArr;
    }

}