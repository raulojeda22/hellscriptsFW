<?
include_once _PROJECT_PATH_.'/backend/controllers/ModelController.class.php';
class Project extends ModelController{
    protected $tableName='projects';
    private static $instance;
    protected function __construct($token){
        parent::__construct($token);
    }
    public static function getInstance($token){
        if (!(self::$instance instanceof self))
            self::$instance = new self($token);
        return self::$instance;
    }
}