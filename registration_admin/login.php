<?php include('server.php') ?>
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
  	<h2>Prijava poslodavca</h2>
  </div>

  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Korisničko ime</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Lozinka</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Prijava</button>
  	</div>
  	<p>
        Niste još član? <a style="text-decoration:none" href="register.php">Registruj se</a>
  	</p>
  </form>
</body>
</html>
