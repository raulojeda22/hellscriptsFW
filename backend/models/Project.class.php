<?
include_once _PROJECT_PATH_.'/backend/models/ModelController.class.php';
class Project extends ModelController{
    protected $tableName='projects';
    public function __construct($token){
        parent::__construct($token);
    }
}