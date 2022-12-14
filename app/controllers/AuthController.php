<?php

require_once __DIR__.'/../core/Controller.php';
require_once __DIR__."/../core/Http.php";
require_once __DIR__."/../models/dao/mysql/MysqlUser.php";
require_once __DIR__."/../models/Encrytor.php";
class AuthController extends Controller{
  public function index(){}
  public function create($data) {
    if(!Http::isRequestMethod('POST'))
        return;
  }
  public function login(){
    if(!Http::isRequestMethod('POST'))
      return;
    extract($_POST);
    $instance = new MysqlUser();
    // $user = $instance->selectParams([],['username='=>$username,'password='=>md5($password)]);
    // $user = $instance->selectParams([],['username='=>$username,'password='=>Md5Encryptor::encrypt($password)]);
    $user = $instance->selectParams([],['username='=>$username]);
    $encryptedUserPassword = $user[0]['password'];
    if(empty($user)){
      return 3;
    }
    if(!password_verify($password,$encryptedUserPassword)) {
      return 3;
    }
    $hashed_password =  SHA512Encryptor::encrypt($password);
    $instance->updatePassword($hashed_password,$user[0]['id']);
    foreach ($user[0] as $key => $value) {
      if(!is_numeric($key)) $_SESSION['login_'.$key] = $value;
    }
    return 1;
  }

  public function logout(){
    if(!Http::isRequestMethod('GET'))
      return;
    session_start();
    session_destroy();
    foreach ($_SESSION as $key => $value) {
      unset($_SESSION[$key]);
    }
    header("location:login.php");
  }
}