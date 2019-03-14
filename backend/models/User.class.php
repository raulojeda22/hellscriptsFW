<?
include_once _PROJECT_PATH_.'/backend/models/ModelController.class.php';
class User extends ModelController{
    protected $tableName='users';
    public function __construct($user){
        parent::__construct($user);
    }
    public function login($email,$password){
        return ControllerCore::retrieveTokenByEmailAndPassword($email,$password);
    }
    public function register($userParams,$authParams){
        return $this->postNewUser($userParams,$authParams);
    }
}