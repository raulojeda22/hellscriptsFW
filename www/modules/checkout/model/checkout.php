<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
$cart = Cart::getInstance($headers['Authorization']);
if ($method=='POST'){
    if ($cart->authorization->permissions->idAuthorization!=3){
        $data = [
            'idUser' => $cart->authorization->user->id
        ];
        $response = $cart->GET((object)$data);
        foreach ($response as $row){
            foreach ($row as $key => &$element){
                if ($key=='id'){
                    $row['idCart'] = $element;
                    unset($row[$key]);
                }
                $element=utf8_encode($element);
            }
            $results[]=$row;
        }
        $checkout = Checkout::getInstance($headers['Authorization']);
        foreach ($results as $cartProject){
            $response = $checkout->POST((object)$cartProject);
        }
        if ($response){
            $delete = $cart->DELETE((object)$data);
        }
        
    }
    echo json_encode($response);
} else {
    $object = Checkout::getInstance($headers['Authorization']);
    include_once _PROJECT_PATH_.'/backend/controllers/ApiController.php';
    echo json_encode($results);
}