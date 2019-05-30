<?php
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/includes/autoload.php';
include_once dirname(__FILE__).'/../../../models/sendEmail.php';
$data=json_decode($_POST['data']);

$userParams = new stdClass;
$userParams->email=$data->email;

$user=User::getInstance('');
$userData=$user->getAuthenticationByEmail($data->email);

$subject="Change password";
$html="<p>Please, use this activation url to change your password. <a href=\"http://localhost/hellscriptsFW/#/recover/$data->email/$userData->token\">http://localhost/hellscriptsFW/#/recover/$data->email/$userData->token</a></p>
<p>If you received this email and you didn't registered on Hellscripts, please just ignore this email.</p>";

return sendEmail($data->email,$subject,$html);