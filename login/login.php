<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "data_manager";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mode_de_passe = $_POST['mode_de_passe'];

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND mode_de_passe = '$mode_de_passe'";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row['active'] == 1) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['id_role'] = $row['id_role'];

            if ($row['id_role'] == 1) {
                header("Location: /zakariae-el-hassad-manager/utilisateurs/utilisateur.php");
            } else {
                header("Location: /zakariae-el-hassad-manager/home.php");
            }
            exit();
        } else {
            echo "Votre compte n'est pas activé. Veuillez contacter l'assistance.";
        }
    } else {
        echo "Les données de connexion sont incorrectes.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Login Form | CodingNepal</title>
  <link rel="stylesheet" href="login.css">
  <script src="login-validation.js" defer></script>
</head>
<body>
  <div class="wrapper">
    <form action="" method="POST">
      <h2>Login</h2>
        <div class="input-field">
        <input type="email" name="email" id="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
      <input type="password" name="mode_de_passe" id="mode_de_passe" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Log In</button>
      <button><a href="/zakariae-el-hassad-manager/login/signup.php">Sign UP</a></button>
      <div class="register">
        <p>Don't have an account? <a href="#">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
