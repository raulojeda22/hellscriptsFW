<?
include_once dirname(__FILE__).'/../../../models/sendEmail.php';
/**
 * self explanatory
 *
 * @param string $email receiver
 * @param string $token token of the receiver to be able to activate the account
 * @return boolean whether the petition works or not
 */
function sendActivationEmail($email,$token){
    $subject = "Hellscripts activation email";
    $html="<p>Please, use this activation url to activate your account. <a href=\"http://localhost/hellscriptsFW/api/activate/token-$token\">http://localhost/hellscriptsFW/api/activate/token-$token</a></p>
    <p>If you received this email and you didn't registered on Hellscripts, please just ignore this email.</p>";
    //return sendEmail($email,$subject,$html); El bò és este però per a proves millor el de baix
    return sendEmail('raulojeda10g@gmail.com',$subject,$html);
}