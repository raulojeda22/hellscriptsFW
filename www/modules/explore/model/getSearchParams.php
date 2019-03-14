<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/www/modules/explore/controllers/Search.class.php';
try {
    echo json_encode(Search::getParams());
} catch (Exception $e){
    http_response_code(400);
}