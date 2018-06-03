<?php
require_once '../vendor/autoload.php';
require_once 'PersistanceManager.class.php';
require_once 'Config.class.php';

Flight::register('pm', 'PersistanceManager', [Config::DB]);

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /users', function(){
  $users = Flight::pm()->get_all_users();
  Flight::json($users);
});

Flight::route('DELETE /users/@id', function($id){
  Flight::pm()->delete_user($id);
});

Flight::route('POST /register/user', function(){
  $request = Flight::request();
  $user = [
    'username' => $request->data->username,
    'email' => $request->data->email,
    'password' => $request->data->password,
    'name'=> $request->data->name
  ];
  $addeduser = Flight::pm()->add_user($user);
  Flight::json($addeduser);
});

Flight::start();

?>
