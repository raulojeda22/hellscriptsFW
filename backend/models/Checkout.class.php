<?
include_once _PROJECT_PATH_.'/backend/models/ModelController.class.php';
class Checkout extends ModelController{
    protected $tableName='checkout';
    public function __construct($user){
        parent::__construct($user);
    }
}