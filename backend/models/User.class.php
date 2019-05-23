<?
class User extends ModelController{
    protected $tableName='users';
    private static $instance;
    protected function __construct($token){
        parent::__construct($token);
    }
    public static function getInstance($token){
        if (!(self::$instance instanceof self))
            self::$instance = new self($token);
        return self::$instance;
    }
    public function login($email,$password){
        return ControllerCore::retrieveTokenByEmailAndPassword($email,$password);
    }
    public function register($userParams,$authParams){
        $authParams->token=md5(microtime(true).mt_Rand());
        $this->postNewUser($userParams,$authParams);   
        return $authParams->token;
    }
    public function activate($token){
        return $this->activateUser($token);
    }
}