<?
/**
 * Main class to manage the incoming requests to the API
 */
class FrontController {

    /**
     * Sets the uri that will be used to get the params on the url depending if it's running on
     * a local machine or in a server
     *
     * @return void
     */
    public function FrontController(){
        $this->uri=$_SERVER['REQUEST_URI'];
        if ($_SERVER['HTTP_HOST']=='localhost'||$_SERVER['HTTP_HOST']=='127.0.0.1'||$_SERVER['HTTP_HOST']=='192.168.22.129'){
            $this->uri=str_replace('/hellscriptsFW/',"",$this->uri);
        } else {
            $this->uri=ltrim($this->uri, '/');
        }
    }

    /**
     * Checks the request and the resources to validate it and runs the query and response
     *
     * @return void
     */
    public function run(){
        $this->uri=rtrim($this->uri, '/');
        $cutUrl=explode('/',$this->uri);
        $allowedPages=json_decode(file_get_contents(dirname(__FILE__).'/../includes/resources/pages.json'));
        $allowedResources=json_decode(file_get_contents(dirname(__FILE__).'/../includes/resources/resources.json'));
        if ($cutUrl[0]=='api') {
            if (in_array($cutUrl[1],$allowedResources)){
                $getParams=array_slice($cutUrl,2);
                foreach ($getParams as $getParam){
                    $params = explode('-',$getParam);
                    $_GET[$params[0]]=$params[1];
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUT' && empty($_POST))
                    $_POST = json_decode(file_get_contents('php://input'), true);
                include_once _PROJECT_PATH_.'/www/modules/'.$cutUrl[1].'/model/'.$cutUrl[1].'.php';
            } else {
                header('HTTP/1.0 404 Not found');
            }
        } else {
            include_once "404.php";
        }
    }
}
?>