<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/models/Cart.class.php';
include_once _PROJECT_PATH_.'/backend/models/Checkout.class.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
$cart = new Cart($headers['Authorization']);
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
    $checkout = new Checkout($headers['Authorization']);
    foreach ($results as $cartProject){
        $response = $checkout->POST((object)$cartProject);
    }
    if ($response){
        $delete = $cart->DELETE((object)$data);
    }
    
}
echo json_encode($response);