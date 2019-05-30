<?php
include_once dirname(__FILE__).'/../../../models/sendEmail.php';
$data=json_decode($_POST['data']);
if (filter_var($data->email,FILTER_VALIDATE_EMAIL)) {
    $subject="Hellscripts contact email from ".$data->email;
    $html= "<h1>Message from ".$data->name." ".$data->surname."</h1><br/><p>".$data->message."</p>";
    return sendEmail($data->email,$subject,$html);
} else {
    header('HTTP/1.0 403 Forbidden');
    return false;
}
