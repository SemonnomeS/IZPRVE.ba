<?php
session_start();

// inicijaliziranje vrijednosti
$username = "";
$email    = "";
$errors = array();

// spajanje sa bazom
$db = mysqli_connect('localhost', 'phpmyadmin', '9823', 'admin');

// registracija
if (isset($_POST['reg_user'])) {
  // dobijanje svih unesenih podataka
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);



  if (empty($username)) { array_push($errors, "Korisničko ime je obavezno"); }
  if (empty($email)) { array_push($errors, "Email adresa je obavezna"); }
  if (empty($password_1)) { array_push($errors, "Lozinka je obavezna"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Lozinke se ne podudaraju");
  }


  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // ako korisnik postoji
    if ($user['username'] === $username) {
      array_push($errors, "Korisničko ime već postoji");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email adresa već postoji");
    }
  }

  // registracija ako nema erora
  if (count($errors) == 0) {


  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = header("Location:login.php");
  }
}
// prijava
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Korisničko ime je obavezno");
  }
  if (empty($password)) {
  	array_push($errors, "Lozinka je bavezna");
  }

  if (count($errors) == 0) {

  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = header("Location:../dashboard_admin/index.html");
  	}else {
  		array_push($errors, "Netačno korisničko ime ili lozinka");
  	}
  }
}

?>
