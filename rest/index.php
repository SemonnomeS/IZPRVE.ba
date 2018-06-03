<?php
require_once '../vendor/autoload.php';
require_once 'PersistanceManager.class.php';
require_once 'Config.class.php';
use \Firebase\JWT\JWT;

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

Flight::route('POST /user/login', function () {
    $request = Flight::request();
    $user = [
        'username' => $request->data->username,
        'password' => $request->data->password,
    ];
    $res = Flight::pm()->find_user($user);
    if ($res["valid"]) {
        $key = "";
        $token = [
            "exp" => time() + 36000,
            "data" => $res,
        ];
        $jwt = JWT::encode($token, $key, "HS256");
        $x["token"] = $jwt;
        $x["companyID"] = $res["companyID"];
        Flight::json($x);} else {
        Flight::json($res);
    }
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
