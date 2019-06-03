<?php
session_start();
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}


if ($_SERVER['HTTP_HOST']=='localhost'||$_SERVER['HTTP_HOST']=='127.0.0.1'||$_SERVER['HTTP_HOST']=='192.168.22.129'){
    define('_PUBLIC_URL_',$protocol.$_SERVER['HTTP_HOST'].'/hellscriptsFW');
    define('_PROJECT_URL_',$protocol.$_SERVER['HTTP_HOST'].'/hellscriptsFW/www');   
    define('_PROJECT_PATH_',dirname(__FILE__).'/../..'); 
    define('_JS_VERSION_',substr(md5(rand()), 0, 7));
}else {
    define('_PUBLIC_URL_',$protocol.$_SERVER['HTTP_HOST']);
    define('_PROJECT_URL_',$protocol.$_SERVER['HTTP_HOST']);  
    define('_PROJECT_PATH_',dirname(__FILE__).'/../..'); 
}
define('_GOOGLE_API_KEY_',file_get_contents(_PROJECT_PATH_.'/google_api_key.txt'));
define('_MAIL_GUN_API_KEY_',file_get_contents(_PROJECT_PATH_.'/mail_gun_api_key.txt'));
define('_MAIL_GUN_API_URL_',file_get_contents(_PROJECT_PATH_.'/mail_gun_api_url.txt'));
define('MEDIA_PATH',_PROJECT_PATH_.'/www/view/avatars/');
exec('ls');

?>