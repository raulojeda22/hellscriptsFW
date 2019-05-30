<?
include_once dirname(__FILE__).'/../../../models/sendEmail.php';
function sendActivationEmail($email,$token){
    $subject = "Hellscripts activation email";
    $html="<p>Please, use this activation url to activate your account. <a href=\"http://localhost/hellscriptsFW/api/activate/token-$token\">http://localhost/hellscriptsFW/api/activate/token-$token</a></p>
    <p>If you received this email and you didn't registered on Hellscripts, please just ignore this email.</p>";
    return sendEmail($email,$subject,$html);
}