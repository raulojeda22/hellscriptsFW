<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/www/modules/explore/controllers/Search.class.php';
try {
    Search::setParams($_POST['params']);
} catch (Exception $e){
    http_response_code(400);
}