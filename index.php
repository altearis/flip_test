<?php
require_once("configs/Constant.php");
require_once("controllers/MainController.php");

$controller = new MainController();
if(isset($_GET['action']))
{
    
    switch($_GET['action']){
        case 'update':
            if (isset($_GET['id'])) 
            {
                $controller->update_status($_GET['id']);
            }
        break;

        case 'add':    
            if(($controller->requestCounter)<5)
            {
                $controller->sendRequest();
            }
        break;
        
        default:
        break;
    }
    header("Location:".MAIN_URL);
}  else
{
    $controller->index();
}

?>