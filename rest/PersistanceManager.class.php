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
           VALUES (name)";
    $statement = $this->pdo->prepare($query);
    $statement->execute(['name'=>$user["name"]]);
    $user["companyID"]=$this->pdo->lastInsertId();

    $query = "INSERT INTO users
            (
             username,
             email,
             password,
            companyID)
            VALUES (username,
                    :email,
                    :password
                    :companyID)";

    $statement = $this->pdo->prepare($query);
    $statement->execute($user);
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
