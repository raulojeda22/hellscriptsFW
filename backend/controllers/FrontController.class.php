<?
class FrontController {

    public function FrontController(){
        $this->uri=$_SERVER['REQUEST_URI'];
        if ($_SERVER['HTTP_HOST']=='localhost'||$_SERVER['HTTP_HOST']=='127.0.0.1'||$_SERVER['HTTP_HOST']=='192.168.22.129'){
            $this->uri=str_replace('/hellscriptsFW/',"",$this->uri);
        } else {
            $this->uri=ltrim($this->uri, '/');
        }
    }

    private function getAllowedPages(){
        $allowedPages=array(
            'home',
            'projects',
            'jqWidgets',
            'developers',
            'groups',
            'profile',
            'contact',
            'explore',
            'users',
            'cart'
        );
        return $allowedPages;
    }

    public function run(){
        $this->uri=rtrim($this->uri, '/');
        $cutUrl=explode('/',$this->uri);
        $allowedPages=$this->getAllowedPages();
        if ($cutUrl[0]=='api') {
            if (in_array($cutUrl[1],$allowedPages)){
                $getParams=array_slice($cutUrl,2);
                foreach ($getParams as $getParam){
                    $params = explode('-',$getParam);
                    $_GET[$params[0]]=$params[1];
                }
                include_once _PROJECT_PATH_.'/www/modules/'.$cutUrl[1].'/model/'.$cutUrl[1].'.php';
            } else {
                header('HTTP/1.0 404 Not found');
            }
        } else {
            include_once dirname(__FILE__).'/../includes/templates/start.php';
            include_once dirname(__FILE__).'/../includes/templates/head.php';
            include_once dirname(__FILE__).'/../includes/templates/corejs.php';
            include_once dirname(__FILE__).'/../includes/templates/header.php';
            error_log($this->uri);
            if (in_array($this->uri,$allowedPages)){
                include_once 'modules/'.$this->uri.'/view/'.$this->uri.".php";
            } else if ($this->uri==""||$this->uri=="/"){
                include_once "modules/home/view/home.php";
            } else {
                include_once "404.php";
            }
            include_once dirname(__FILE__).'/../includes/templates/footer.php';
            include_once dirname(__FILE__).'/../includes/templates/end.php';
        }
    }
}
?>