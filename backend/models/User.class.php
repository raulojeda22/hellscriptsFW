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
        return $this->postNewUser($userParams,$authParams);
    }
}