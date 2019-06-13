<?
include_once _PROJECT_PATH_.'/backend/models/Connection.class.php';
/**
 * Builds the queries and executes them
 */
class ControllerCore{

    /**
     * Used to build the where part of the query, using the keys and values of the array
     *
     * @param array $array each key is the name of the column and it's value is the param that will do the search
     * @return string the where part of the query
     */
    private function addWhereStatement($array){
        $conditions=count($array);
        $query='';
        $limit='';
        if ($conditions>=1){
            $query = " WHERE ";
        }
        foreach ($array as $row => $value){
            if ($row=='limit'){
                $limit = $this->addLimitStatement($value);
            } else if ($row=='count'){
                $query = $this->addCountStatement($query);
            } else {
                $query .= $row." LIKE '".str_replace('!','%',$value)."'"; 
                $conditions--;
                if ($conditions>0){
                    $query .= ' AND ';
                }
            }
        }
        if ($query == " WHERE "){
            return $limit;
        }
        return $query.$limit;
    }

    /**
     * Used to build the limit part of the query, using the keys and values of the array
     *
     * @param int $limit specifies the limit on the query
     * @return string the limit part of the query
     */
    private function addLimitStatement($limit){
        $query='';
        $values=explode(',',$limit);
        $query .= ' LIMIT '.$values[0];
        if (array_key_exists(1,$values)){
            $query .= ', '.$values[1];
        }
        return $query;
    }

    /**
     * Adds a count statement to the query
     *
     * @todo this functions isn't finished
     * @param string $query
     * @return string the resultant query after adding the count
     */
    private function addCountStatement($query){
        // change * to count(*)
        return $query;
    }

    /**
     * Runs the query 
     *
     * @param string $query
     * @return boolean|array returns an array when the query is a select and a boolean in any other request
     */
    protected function runQuery($query){
        $connection = Connection::connect();
        $response = mysqli_query($connection, $query);
        Connection::close($connection);
        return $response;
    }

    /**
     * Builds a select statement from a GET request
     *
     * @param array $data keys and values to build the where query
     * @return string the final query
     */
    protected function buildGetQuery($data){
        $query = 'SELECT * FROM '.$this->tableName;
        if ($data!="" && is_array($data)){
            $query .= $this->addWhereStatement($data);
        }
        error_log($query);
        return $query;
    }

    /**
     * Builds an insert statement from a POST request
     *
     * @param array $data the columns and data that is going to be inserted
     * @return string the final query
     */
    protected function buildPostQuery($data){
        if ($data!="" && is_object($data)){
            $query = 'INSERT INTO '.$this->tableName;
            $rows = ' (';
            $values = ' VALUES (';
            $endData=end($data);
            $endKey = key($data);
            unset($data->$endKey);
            foreach ($data as $row => $value){
                $rows .= $row.', ';
                $values .= '"'.$value.'", ';
            }
            $values .= '"'.$endData.'")';
            $rows .= $endKey.')';
            $query .= $rows.$values;
        }
        return $query;
    }

    /**
     * Builds an update query from a PUT request 
     *
     * @param array $data an array with 2 keys, the first one is used to build the where statement
     * and the second to build the set statement
     * @return string the final query
     */
    protected function buildPutQuery($data){
        $count=0;
        error_log(print_r($data,1));
        if ($data!="" && is_array($data)){
            $query = 'UPDATE '.$this->tableName.' SET ';
            foreach ($data[1] as $row => $value){
                $count++;
                $query .= $row."='".utf8_decode($value)."'";
                if (count($data[1]) == $count) $query .= ' ';
                else $query .= ', ';
            }
            $query .= $this->addWhereStatement($data[0]);
        }
        error_log($query);
        return $query;
    }

    /**
     * Builds a delete query from a DELETE request
     *
     * @param array $data keys and values to build the where query
     * @return string 
     */
    protected function buildDeleteQuery($data){
        $query = 'DELETE FROM '.$this->tableName;
        $query .= $this->addWhereStatement($data);
        return $query;
    }

    /**
     * Returns a user db object by it's token
     *
     * @param string $token the desired user token
     * @return object user db object
     */
    public static function retrieveUserByToken($token){
        $authentication = 'SELECT secret FROM authentication';
        $authentication .= self::addWhereStatement(array("token" => $token));
        $authentication = self::runQuery($authentication)->fetch_object();
        if (is_object($authentication)){
            $user = 'SELECT * FROM users';
            $user .= self::addWhereStatement(array("id" => $authentication->secret));
            $user = self::runQuery($user)->fetch_object();
            return $user;
        }
        return false;
    }

    /**
     * Returns the permissions that has a user on the specified table
     *
     * @param int $idAuthorization type of authorization that the user has on this resource
     * @param string $tableName
     * @return object the permissions on each type of request on the given table
     */
    public static function retrievePermissions($idAuthorization,$tableName){
        $table = 'SELECT * FROM tables';
        $table .= self::addWhereStatement(array("name" => $tableName));
        $table = self::runQuery($table)->fetch_object();
        if (is_object($table)){
            if (property_exists($table,'id')){
                $permission = 'SELECT * FROM permissions';
                $permission .= self::addWhereStatement(array("idAuthorization" => $idAuthorization,"idTable" => $table->id));
                $permission = self::runQuery($permission)->fetch_object();
                return $permission;
            }
        }
        return false;
    }

    /**
     * Gets the authentication data of the user by it's id
     *
     * @param int $id the id of the user
     * @return object db authentication
     */
    public static function getAuthenticationByUserId($id){
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $id));
        $authentication = self::runQuery($authentication)->fetch_object();
        return $authentication;
    }

    /**
     * Gets the authentication info of the user by it's email
     *
     * @param string $email the email of the user
     * @return object db authentication
     */
    public static function getAuthenticationByEmail($email){
        $user = 'SELECT * FROM users';
        $user .= self::addWhereStatement(array("email" => $email));
        $user = self::runQuery($user)->fetch_object();     
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $user->id));
        $authentication = self::runQuery($authentication)->fetch_object();
        return $authentication;
    }

    /**
     * Retrieves the token of a user by it's email and password
     *
     * @param string $email 
     * @param string $password
     * @return string the token of the user
     */
    public static function retrieveTokenByEmailAndPassword($email,$password){
        $user = 'SELECT * FROM users';
        $user .= self::addWhereStatement(array("email" => $email));
        $user = self::runQuery($user)->fetch_object();
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $user->id));
        $authentication = self::runQuery($authentication)->fetch_object();
        if (password_verify($password,$authentication->password)){
            $updateToken = 'UPDATE authentication set token=\''.md5(microtime(true).mt_Rand()).'\'';
            $updateToken .= self::addWhereStatement(array("secret" => $user->id));
            $updateToken = self::runQuery($updateToken);
            if ($updateToken){
                $authentication = 'SELECT * FROM authentication';
                $authentication .= self::addWhereStatement(array("secret" => $user->id));
                $authentication = self::runQuery($authentication)->fetch_object();
            }
            return $authentication->token;
        } else {
            return false;
        }
    }

    /**
     * Inserts a user on the database and adds it's credentials to the authentication table
     *
     * @param object $userParams the data that is going to be added to the user main table
     * @param object $authParams the data that is going to be added to the authentication table
     * @return string the token of the new user
     */
    public function postNewUser($userParams,$authParams){
        $user = 'SELECT * FROM users';
        $user .= $this->addWhereStatement(array("email" => $userParams->email));
        $user = $this->runQuery($user)->fetch_object();
        if (!$user){
            $userParams->idAuthorization=1;
            $query=$this->buildPostQuery($userParams);
            $user = $this->runQuery($query);
            $user = 'SELECT * FROM users';
            $user .= $this->addWhereStatement(array("email" => $userParams->email));
            $user = $this->runQuery($user)->fetch_object();
            if ($user){
                $authentication = 'INSERT INTO authentication (password, token, secret) VALUES ("'.password_hash($authParams->password,PASSWORD_DEFAULT).'", "'.$authParams->token.'", "'.$user->id.'")';
                $authentication = $this->runQuery($authentication);
                return $authentication->token;
            }
        }
        return false;   
    }

    /**
     * Activates a user on the page by it's token and returns it
     *
     * @param string $token
     * @return object db user
     */
    public static function activateUser($token){
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("token" => $token));
        $authentication = self::runQuery($authentication)->fetch_object();
        $user = 'UPDATE users set activated=1';
        $user .= self::addWhereStatement(array("id" => $authentication->secret));
        $user = self::runQuery($user);
        if ($user){
            $user = 'SELECT * FROM users';
            $user .= self::addWhereStatement(array("id" => $authentication->secret));
            return self::runQuery($user)->fetch_object();
        } else {
            return $user;
        }
    }

    /**
     * Changes the password of the user by it's email and token
     *
     * @param string $email
     * @param string $token
     * @param string $password the new password of the user
     * @return boolean whether the operation has been successfull or not
     */
    public static function changePassword($email,$token,$password){
        $user = 'SELECT * FROM users';
        $user .= self::addWhereStatement(array("email" => $email));
        $user = self::runQuery($user)->fetch_object();
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $user->id));
        $authentication = self::runQuery($authentication)->fetch_object();
        if ($token == $authentication->token){
            $updatePassword = 'UPDATE authentication set password=\''.password_hash($password,PASSWORD_DEFAULT).'\'';
            $updatePassword .= self::addWhereStatement(array("secret" => $user->id));
            $updatePassword = self::runQuery($updatePassword);
            return $updatePassword;
        } else {
            return false;
        }
    }
}