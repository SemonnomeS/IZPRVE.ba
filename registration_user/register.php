<?php include('server.php') ?>
<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>IZPRVE.ba</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <br>
  <a  style="text-decoration:none" class="btn btn-primary" href="../index.html">Nazad</a>
  <div class="header">
  	<h2>Registracija korisnika</h2>
  </div>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Korisničko ime</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email adresa</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Lozinka</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Potvrdite lozinku</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registruj se</button>
  	</div>
  	<p>
  		Već član? <a  style="text-decoration:none" href="login.php">Prijava</a>
  	</p>
  </form>
</body>
</html>
