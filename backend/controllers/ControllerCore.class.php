<?
include_once _PROJECT_PATH_.'/backend/models/Connection.class.php';
class ControllerCore{

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

    private function addLimitStatement($limit){
        $query='';
        $values=explode(',',$limit);
        $query .= ' LIMIT '.$values[0];
        if (array_key_exists(1,$values)){
            $query .= ', '.$values[1];
        }
        return $query;
    }

    private function addCountStatement($query){
        // change * to count(*)
        return $query;
    }

    protected function runQuery($query){
        $connection = Connection::connect();
        $response = mysqli_query($connection, $query);
        Connection::close($connection);
        return $response;
    }

    protected function buildGetQuery($data){
        $query = 'SELECT * FROM '.$this->tableName;
        if ($data!="" && is_array($data)){
            $query .= $this->addWhereStatement($data);
        }
        error_log($query);
        return $query;
    }
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
    protected function buildDeleteQuery($data){
        $query = 'DELETE FROM '.$this->tableName;
        $query .= $this->addWhereStatement($data);
        return $query;
    }

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

    public static function getAuthenticationByUserId($id){
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $id));
        $authentication = self::runQuery($authentication)->fetch_object();
        return $authentication;
    }

    public static function getAuthenticationByEmail($email){
        $user = 'SELECT * FROM users';
        $user .= self::addWhereStatement(array("email" => $email));
        $user = self::runQuery($user)->fetch_object();     
        $authentication = 'SELECT * FROM authentication';
        $authentication .= self::addWhereStatement(array("secret" => $user->id));
        $authentication = self::runQuery($authentication)->fetch_object();
        return $authentication;
    }

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