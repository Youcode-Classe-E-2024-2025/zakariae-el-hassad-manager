<?php 
// Connect to the database
$servername = "localhost";
$password = "";
$database = "data_manager";
$username = "root";

$connection = new mysqli($servername, $username, $password, $database);

$nom = "";
$adresse = "";
$site_web = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $site_web = $_POST["site_web"];

    do {
        if (empty($nom) || empty($adresse) || empty($site_web)) {
            $errorMessage = "All fields are required.";
            break;
        }

        $sql = "INSERT INTO fabricants (nom, adresse,site_web) VALUES ('$nom', '$adresse','$site_web')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $nom = "";
        $adresse = "";
        $dasite_webte = "";

        $successMessage = "Student added successfully.";
        
        header("location: /zakariae-el-hassad-manager/fabricants/fabricant.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Fabricant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-4 text-center">Ajouter un Nouveau Fabricant</h2>
            
            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $errorMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <!-- Nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Fabricant</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div>
                <!-- Adresse -->
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Entrez l'adresse" value="<?php echo htmlspecialchars($adresse); ?>">
                </div>
                <!-- Site Web -->
                <div class="mb-3">
                    <label for="site_web" class="form-label">Site Web</label>
                    <input type="url" class="form-control" name="site_web" id="site_web" placeholder="https://exemple.com" value="<?php echo htmlspecialchars($site_web); ?>">
                </div>

                <!-- Success Message -->
                <?php if (!empty($successMessage)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $successMessage; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="/zakariae-el-hassad-manager/fabricants/fabricant.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

