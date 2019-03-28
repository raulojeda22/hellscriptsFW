<?
include_once _PROJECT_PATH_.'/backend/controllers/ControllerCore.class.php';
include_once _PROJECT_PATH_.'/backend/controllers/Authorization.class.php';
class ModelController extends ControllerCore{

    public $authorization;

    protected function __construct($token){
        $this->authorization = new Authorization($token,$this->tableName);
    }

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

    public function GET($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildGetQuery($data);
        return $this->runQuery($query);
    }

    public function GETImportant($data){
        $query=$this->buildGetQuery($data);
        return $this->runQuery($query);
    }

    public function POST($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildPostQuery($data);
        return $this->runQuery($query);
    }
    
    public function PUT($data){
        //if (!$this->checkPrivileges(__FUNCTION__,$data[0])) return false;
        $query=$this->buildPutQuery($data);
        return $this->runQuery($query);
    }
    
    public function DELETE($data){
        if (!$this->checkPrivileges(__FUNCTION__,$data)) return false;
        $query=$this->buildDeleteQuery($data);        
        return $this->runQuery($query);
    }

}