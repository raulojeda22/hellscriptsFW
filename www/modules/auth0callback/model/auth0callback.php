<?php
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/includes/autoload.php';
include_once dirname(__FILE__).'/../../../../vendor/autoload.php';

use Auth0\SDK\Auth0;

$auth0 = new Auth0([
  'domain' => 'raulojeda.eu.auth0.com',
  'responseMode' => 'form_post',
  'client_id' => '0qDeBksiQ6DMDWfISnE5cyvuTp4Ftynz',
  'client_secret' => file_get_contents(dirname(__FILE__).'/../../../../auth0ApiSecretKey.txt'),
  'redirect_uri' => 'http://localhost/hellscriptsFW/www/modules/auth0callback/model/auth0callback.php',
  'scope' => 'openid profile email offline_access',
  'audience' => 'https://raulojeda.eu.auth0.com/userinfo',
  'persist_id_token' => true,
  'persist_access_token' => true,
  'persist_refresh_token' => true,
]);

$userInfo=$auth0->getUser();
$authData = new stdClass;
$authData->name=$userInfo['name'];
$authData->username=$userInfo['nickname'];
$authData->avatar=$userInfo['picture'];
$email=explode('-',$userInfo['email']);
$authData->email=$email[0];
$authData->password=$auth0->getIdToken();

$object = User::getInstance('');
$results = $object->login($authData->email,$authData->password);
if (!$results){
    $object = User::getInstance($auth0->getRefreshToken());
    $authParams = new stdClass;
    $authParams->password = $authData->password;
    $authParams->token = $auth0->getRefreshToken();
    unset($authData->password);
    $results = $object->register($authData,$authParams);
}
$getParams=array();
$getParams['email']=$authData->email;
$object = User::getInstance($results);
$user=$object->GETImportant($getParams);
foreach ($user as $row){
    foreach ($row as &$element){
        $element=utf8_encode($element);
    }
    $userTable[]=(object)$row;
}
$user=$userTable[0];
$user->token=$results;

setcookie("token", $user->token, time() + 3600, '/');
setcookie("email", $user->email, time() + 3600, '/');
setcookie("idUser", $user->id, time() + 3600, '/');

header('Location: http://localhost/hellscriptsFW/#/');