<?php
namespace catetree;
class Catetree{

        public function catetree($catetree){
            return $this->sort($catetree);
        }

        public function sort($cateRes,$pid=0,$level=0){

            static $arr = array();

            foreach ($cateRes as $k=>$v){
                if ($v['pid'] == $pid){
                    $v['level'] = $level;
                    $arr[] = $v;
                    $this->sort($cateRes,$v['id'],$level+1);
                }
            }
            return $arr;
        }

        public function childrenids($cateid,$obj){

            $date  = $obj->field('id,pid')->select();
            return $this->_childrenids($date,$cateid);
        }

        private function _childrenids($date,$cateid){

            static $arr = array();

            foreach ($date as $k=>$v){
                if ($v['pid'] == $cateid){
                    $v['level'] = $cateid;
                    $arr[] = $v['id'];
                    $this->_childrenids($date,$v['id']);
                }
            }
            return $arr;
        }

        //处理子栏目排序

        public function cateSort($data,$obj){

            foreach ($data['sort'] as $k=>$v){
                $obj->update(['id'=>$k,'sort'=>$v]);

            }

        }
}