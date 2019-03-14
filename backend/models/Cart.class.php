<?
include_once _PROJECT_PATH_.'/backend/models/ModelController.class.php';
class Cart extends ModelController{
    protected $tableName='cart';
    public function __construct($user){
        parent::__construct($user);
    }
}