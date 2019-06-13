<?
/**
 * Model that represents a table on the database
 */
class Cart extends ModelController{

    /**
     * The name of the table
     *
     * @var string
     */
    protected $tableName='cart';

    /**
     * The stored object, using the singleton paradigm
     *
     * @var object
     */
    private static $instance;

    /**
     * Runs the parent construct function to set up the permissions on the object
     *
     * @param string $token
     */
    protected function __construct($token){
        parent::__construct($token);
    }

    /**
     * Returns an instance of this class, creates the instance if it doesn't exists yet
     *
     * @param string $token
     * @return void
     */
    public static function getInstance($token){
        if (!(self::$instance instanceof self))
            self::$instance = new self($token);
        return self::$instance;
    }
}