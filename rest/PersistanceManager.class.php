<?php


class PersistanceManager{
  private $pdo;

  public function __construct($params){
    $this->pdo = new PDO('mysql:host='.$params['host'].';dbname='.$params['scheme'], $params['username'], $params['password']);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function add_user($user){
    $companyQuery =
    "INSERT INTO companies (name)
           VALUES (:name)";
    $statement = $this->pdo->prepare($companyQuery);
    $statement->execute(['name'=>$user["name"]]);
    $user["companyID"]=$this->pdo->lastInsertId();

    $query = "INSERT INTO users
            (username,
             email,
             password,
            companyID)
            VALUES (:username,
                    :email,
                    :password,
                    :companyID)";

    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':username', $user['username']);
    $statement->bindParam(':email', $user['email']);
    $statement->bindParam(':password', $user['password']);
    $statement->bindParam(':companyID', $user['companyID']);
    $statement->execute();
    //execute(['username'=>$user["username"], 'email'=>$user["email"], 'password'=>$user["password"], 'companyID'=>$user["companyID"]]);
  }
  public function find_user($user)
    {
        $usernameCheck = $this->pdo->prepare("SELECT * FROM users WHERE username  = :name AND password = :password");
        $usernameCheck->bindParam(':name', $user['username']);
        $usernameCheck->bindParam(':password', $user['password']);
        $usernameCheck->execute();
        if ($usernameCheck->rowCount() === 0) {
            $x["valid"] = false;
            $x["error"] = "invalid username or password";
            return $x;
        }
        $x = $usernameCheck->fetch();
        $x["valid"] = true;
        return $x;
    }

  public function get_all_users(){
    $query = "SELECT * FROM users";
    return $this->pdo->query($query)->fetchAll();
  }

  public function get_user_by_id($id){

  }

  public function update_user($id, $user){

  }

  public function delete_user($id){
    $query = "DELETE FROM users WHERE id = ?";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$id]);
  }

}

?>
