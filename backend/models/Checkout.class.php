<?
class Checkout extends ModelController{
    protected $tableName='checkout';
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