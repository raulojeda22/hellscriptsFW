<?
/**
 * Model that represents a table on the database
 */
class User extends ModelController{

    /**
     * The name of the table
     *
     * @var string
     */
    protected $tableName='users';

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

    /**
     * Returns the token of a user to the app given a correct email and password
     *
     * @param string $email
     * @param string $password
     * @return string token
     */
    public function login($email,$password){
        return ControllerCore::retrieveTokenByEmailAndPassword($email,$password);
    }

    /**
     * Creates a new user and adds it's credentials to the authentication table, returns the new token
     *
     * @param array $userParams data to insert on the user main table
     * @param array $authParams data to insert on the authentication table
     * @return void
     */
    public function register($userParams,$authParams){
        $authParams->token=md5(microtime(true).mt_Rand());
        $this->postNewUser($userParams,$authParams);   
        return $authParams->token;
    }

    /**
     * Verifies that the user has permission to use the email that he used to register
     *
     * @param string $token
     * @return object db user activated
     */
    public function activate($token){
        return $this->activateUser($token);
    }
}