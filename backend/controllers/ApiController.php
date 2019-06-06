<?
if ($method=='GET'||$method=='DELETE'){
    $data=$_GET;
    $results = [];
    $response = $object->$method($data);
    if ($method=='DELETE'){
        if ($response){
            $results=$response;
        } else {
            header('HTTP/1.0 403 Forbidden');
            die();
        }
    } else {
        if ($response){
            foreach ($response as $row){
                foreach ($row as &$element){
                    $element=utf8_encode($element);
                }
                $results[]=(object)$row;
            }
        } else {
            header('HTTP/1.0 403 Forbidden');
            die();
        }
    }
} else if ($method=='POST'){
    $data=json_decode($_POST['data']);
    $response = $object->$method($data);
    if ($response){
        $results=$response;
    } else {
        header('HTTP/1.0 403 Forbidden');
        die();
    }
} else if ($method=='PUT'){
    $update=(array)json_decode($_POST['data']);
    $data=array();
    $data[0]=$_GET;
    $data[1]=$update;
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