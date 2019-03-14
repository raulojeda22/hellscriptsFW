<?
class Search{
    public static function setParams($params){
        $_SESSION['params']=$params;
    }
    public static function getParams(){
        return $_SESSION['params'];
    }
}