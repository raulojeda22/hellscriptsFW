<?
/**
 * Used to validate whether the user that did the request has the right permissions to complete it
 */
class Authorization {

    /**
     * Saves the token used to make this request
     *
     * @var string
     */
    public $token;

    /**
     * Saves the user that did this request based on the token
     *
     * @var object
     */
    public $user;

    /**
     * Saves all the permissions that the user has on all the resources
     *
     * @var object
     */
    public $permissions;

    /**
     * Establishes the permission that the user has on the requested resource
     *
     * @param string $token authorization token
     * @param string $tableName requested table name
     */
    public function __construct($token,$tableName){
        $this->token = $token;
        if ($this->token != ''){
            $this->user = ControllerCore::retrieveUserByToken($this->token);
            if (is_object($this->user)){
                $this->permissions = ControllerCore::retrievePermissions($this->user->idAuthorization,$tableName);
            } else {
                $this->permissions = ControllerCore::retrievePermissions(3,$tableName);
            }
        } else {
            $this->permissions = ControllerCore::retrievePermissions(3,$tableName);
        }
    }

    /**
     * Validates if you can get data that you own of this resource
     *
     * @return boolean
     */
    public function validateGETMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'getMine')){
                return $this->permissions->getMine;
            }
        } 
        return false;
        
    }

    /**
     * Validates if you can get all the data of this resource
     *
     * @return boolean
     */
    public function validateGETAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'getAll')){
                return $this->permissions->getAll;
            }
        } 
        return false;
    }

    /**
     * Validates if you can post data on a resource that you own
     *
     * @return boolean
     */
    public function validatePOSTMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'postMine')){
                return $this->permissions->postMine; 
            }
        } 
        return false;
    }

    /**
     * Validates if you can post data of any kind on this resource
     *
     * @return boolean
     */
    public function validatePOSTAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'postAll')){
                return $this->permissions->postAll;
            }
        } 
        return false;
    }

    /**
     * Validates if you can update data on a resource that you own
     *
     * @return boolean
     */
    public function validatePUTMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'putMine')){
                return $this->permissions->putMine;
            }
        } 
        return false;
    }

    /**
     * Validates if you can update data of any kind on this resource
     *
     * @return boolean
     */
    public function validatePUTAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'putAll')){
                return $this->permissions->putAll;
            }
        } 
        return false;
    }

    /**
     * Validates if you can delete data on a resource that you own
     *
     * @return boolean
     */
    public function validateDELETEMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'deleteMine')){
                return $this->permissions->deleteMine;
            }
        } 
        return false;
    }

    /**
     * Validates if you can delete data on any resource
     *
     * @return boolean
     */
    public function validateDELETEAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'deleteAll')){
                return $this->permissions->deleteAll;
            }
        } 
        return false;
    }
}