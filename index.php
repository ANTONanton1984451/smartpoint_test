<?php
use classes\Template;
use classes\DB;
use classes\Verify;
session_start();
define('HOME',__DIR__);
spl_autoload_register(function ($className){
    $fileName = HOME .'/'  .str_replace('\\','/',$className) . '.php';

    if(file_exists($fileName)) {
        require_once $fileName;
    }

});
require_once HOME.'/vendor/autoload.php';
if(!empty($_POST['login']) && !empty($_POST['password']) && isAjax()){

   $ver=new Verify(new DB(),$_POST['password'],$_POST['login']);
  echo json_encode($ver->auth()) ;

}elseif(isAjax()===false){

    Template::init('index');

}
function isAjax():bool{
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        return true;
    }
    return false;
}