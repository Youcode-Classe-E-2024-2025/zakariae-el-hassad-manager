<?php 
$servername = "localhost";
$password = "";
$database = "data_manager";
$username = "root";

$connection = new mysqli($servername, $username, $password, $database);

$nom = "";
$email = "";
$mode_de_passe = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mode_de_passe = $_POST["mode_de_passe"];

    do {
        if (empty($nom) || empty($email) || empty($mode_de_passe)) {
            $errorMessage = "All fields are required.";
            break;
        }

        $sql = "INSERT INTO utilisateurs (nom, email,mode_de_passe) VALUES ('$nom', '$email','$mode_de_passe')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $nom = "";
        $email = "";
        $mode_de_passe = "";

        $successMessage = "Student added successfully.";
        
        header("location: /zakariae-el-hassad-manager/login/login.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Login Form | CodingNepal</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="wrapper">

      <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $errorMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

      <form action="" method="post" id="signup-form">
      <h2>Sign UP</h2>      

      <div class="input-field">
        <input type="text" required  name="nom" id="nom" value="<?php echo htmlspecialchars($nom); ?>">
        <label for="nom" >Enter your name</label>
      </div>
      <div class="input-field">
        <input type="text" required name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
        <label for="email" >Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" required name="mode_de_passe" id="mode_de_passe" value="<?php echo htmlspecialchars($mode_de_passe); ?>">
        <label for="mode_de_passe" >Enter your password</label>
      </div>
      <div class="forget">

      <?php if (!empty($successMessage)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $successMessage; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Sign UP</button>
      <button><a href="/zakariae-el-hassad-manager/login/login.php">Log In</a></button>
      <div class="register">
        <p>Don't have an account? <a href="#">Register</a></p>
      </div>
    </form>
  </div>

  <script src="signup_validation.js"></script>
</body>
</html>





<!-- <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Fabricant</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div> -->