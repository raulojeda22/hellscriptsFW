<?
include_once _PROJECT_PATH_.'/backend/models/Connection.class.php';
class ControllerCore{

    private function addWhereStatement($array){
        $conditions=count($array);
        $query='';
        if ($conditions>=1){
            $query = " WHERE ";
        }
        foreach ($array as $row => $value){
            $query .= $row." LIKE '".str_replace('!','%',$value)."'";
            $conditions--;
            if ($conditions>0){
                $query .= ' AND ';
            }
        }
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
        if ($data!="" && is_array($data)){
            $query = 'UPDATE '.$this->tableName.' SET ';
            foreach ($data[1] as $row => $value){
                $query .= $row.'='.$value;
                if ($value === end($data[1])) $query .= ' ';
                else $query .= ', ';
            }
            $query .= $this->addWhereStatement($data[0]);
        }
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
}