<?
if ($method=='GET'||$method=='DELETE'){
    $data=$_GET;
    $results = [];
    $response = $object->$method($data);
    if ($response){
        foreach ($response as $row){
            foreach ($row as &$element){
                $element=utf8_encode($element);
            }
            $results[]=$row;
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
        die();
    }
} else if ($method=='POST'||$method=='PUT'){
    $data=json_decode($_POST['data']);
    $response = $object->$method($data);
    if ($response){
        $results=$response;
    } else {
        header('HTTP/1.0 403 Forbidden');
        die();
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    die();
}