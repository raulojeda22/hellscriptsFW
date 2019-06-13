<?
/**
 * Manages the operations between the models and the database,
 * also checking the permissions of the user that made the request
 */
class ModelController extends ControllerCore{

    /**
     * The authorization object of the current request given the type of user and it's table
     *
     * @var object
     */
    public $authorization;

    /**
     * Sets the authorization object
     *
     * @param string $token
     */
    protected function __construct($token){
        $this->authorization = new Authorization($token,$this->tableName);
    }

    /**
     * Checks if the user has the right permission to complete this request
     *
     * @param string $function name of the operation (GET,POST,PUT,DELETE)
     * @param array $data
     * @return boolean whether the user can make the operation or not
     */
    private function checkPrivileges($function,$data){
        if (empty($data)){ 
            $target = 'All';
        } else {
            $target = 'Mine';
        }
        if ($this->tableName=='users'){
            if (array_key_exists('id',$data)){
                $authentication = ControllerCore::getAuthenticationByUserId($data['id']);
                if (is_object($authentication) && property_exists($authentication,'token') 
                && $authentication->token == $this->authorization->token){
                    $target = 'Mine';
                }else{
                    $target = 'All';
                }
            } else if(array_key_exists('email',$data)){
                $authentication = ControllerCore::getAuthenticationByEmail($data['email']);
                if (is_object($authentication) && property_exists($authentication,'token') 
                && $authentication->token == $this->authorization->token){
                    $target = 'Mine';
                }else{
                    $target = 'All';
                }
            } else {
                $target = 'All';
            }
        } else {
            if (array_key_exists('idUser',$data)){
                $authentication = ControllerCore::getAuthenticationByUserId($data->idUser);
                if (is_object($authentication) && property_exists($authentication,'token') 
                && $authentication->token == $this->authorization->token){
                    $target = 'Mine';
                }else{
                    $target = 'All';
                }
            } else {
                $elements=$this->GETImportant($data);
                foreach ($elements as $element){
                    if ($element['idUser']){
                        $authentication = ControllerCore::getAuthenticationByUserId($element['idUser']);
                        if (is_object($authentication) && property_exists($authentication,'token') 
                        && $authentication->token == $this->authorization->token){
                            $target = 'Mine';
                        }else{
                            $target = 'All';
                            break;
                        }
                    } else {
                        $target = 'All';
                        break;
                    }
                }
            }
        }
        $validate='validate'.$function.''.$target;
        return $this->authorization->$validate();
    }

    /**
     * Builds the select statement and runs it, checking if the user has the right permissions to do it
     *
     * @param array $data
     * @return array the resultant data
     */
    public function GET($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildGetQuery($data);
        return $this->runQuery($query);
    }

    /**
     * Builds the select statement and runs it, without checking the permissions
     *
     * @param array $data
     * @return array the resultant data
     */
    public function GETImportant($data){
        $query=$this->buildGetQuery($data);
        return $this->runQuery($query);
    }

    /**
     * Builds the insert statement and runs it, checking if the user has the right permissions to do it
     *
     * @param array $data
     * @return boolean whether the query was run successfully or not
     */
    public function POST($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildPostQuery($data);
        return $this->runQuery($query);
    }
    
    /**
     * Builds the update statement and runs it, checking if the user has the right permissions to do it
     *
     * @param array $data
     * @return boolean whether the query was run successfully or not
     */
    public function PUT($data){
        //if (!$this->checkPrivileges(__FUNCTION__,$data[0])) return false;
        $query=$this->buildPutQuery($data);
        return $this->runQuery($query);
    }
    
    /**
     * Builds the delete statement and runs it, checking if the user has the right permissions to do it
     *
     * @param array $data
     * @return boolean whether the query was run successfully or not
     */
    public function DELETE($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildDeleteQuery($data);        
        return $this->runQuery($query);
    }

}