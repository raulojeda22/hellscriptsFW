<?
spl_autoload_register(null,false);
spl_autoload_extensions('.php,.class.php');
spl_autoload_register('loadClasses');
function loadClasses($className){
    error_log($className);
    if (file_exists(_PROJECT_PATH_.'/backend/controllers/'.$className.'.class.php')){
        include_once _PROJECT_PATH_.'/backend/controllers/'.$className.'.class.php';
    }
    if (file_exists(_PROJECT_PATH_.'/backend/models/'.$className.'.class.php')){
        include_once _PROJECT_PATH_.'/backend/models/'.$className.'.class.php';
    }
}