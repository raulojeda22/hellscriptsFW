<?
class Authorization {

    public $token;
    public $user;
    public $permissions;

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

    public function validateGETMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'getMine')){
                return $this->permissions->getMine;
            }
        } 
        return false;
        
    }
    public function validateGETAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'getAll')){
                return $this->permissions->getAll;
            }
        } 
        return false;
    }
    public function validatePOSTMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'postMine')){
                return $this->permissions->postMine; 
            }
        } 
        return false;
    }
    public function validatePOSTAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'postAll')){
                return $this->permissions->postAll;
            }
        } 
        return false;
    }
    public function validatePUTMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'putMine')){
                return $this->permissions->putMine;
            }
        } 
        return false;
    }
    public function validatePUTAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'putAll')){
                return $this->permissions->putAll;
            }
        } 
        return false;
    }
    public function validateDELETEMine(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'deleteMine')){
                return $this->permissions->deleteMine;
            }
        } 
        return false;
    }
    public function validateDELETEAll(){
        if (is_object($this->permissions)){
            if (property_exists($this->permissions,'deleteAll')){
                return $this->permissions->deleteAll;
            }
        } 
        return false;
    }
}