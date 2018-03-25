<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 12:57
 */

/**
 * Class TextUtils
 * 文字工具
 */
class TextUtils
{

    static function checkParam($param){
        if(isset($_POST[$param])){
            $value=$_POST[$param];
            if(trim($value)=='') return false;
            else return true;
        }else{
            return false;
        }
    }

    static function checkParams($arr){
        if(count($arr)==0) return false;

        foreach ($arr as $value){
            if(!self::checkParam($value)) return false;
        }
        return true;
    }

    static function get($p){
        return $_POST[$p];
    }
}