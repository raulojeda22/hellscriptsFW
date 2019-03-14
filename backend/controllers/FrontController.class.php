<?
class FrontController {

    public function FrontController(){
        $this->uri=$_SERVER['REQUEST_URI'];
        if ($_SERVER['HTTP_HOST']=='localhost'){
            $this->uri=str_replace('/hellscripts/',"",$this->uri);
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
        $allowedPages=$this->getAllowedPages();
        include_once dirname(__FILE__).'/../includes/templates/start.php';
        include_once dirname(__FILE__).'/../includes/templates/head.php';
        include_once dirname(__FILE__).'/../includes/templates/corejs.php';
        include_once dirname(__FILE__).'/../includes/templates/header.php';
        if (in_array($this->uri,$allowedPages)){
            include_once 'modules/'.$this->uri.'/view/'.$this->uri.".php";
        }else if($this->uri==""||$this->uri=="/"){
            include_once "modules/home/view/home.php";
        }else {
            include_once "404.php";
        }
        include_once dirname(__FILE__).'/../includes/templates/footer.php';
        include_once dirname(__FILE__).'/../includes/templates/end.php';
    }
}
?>