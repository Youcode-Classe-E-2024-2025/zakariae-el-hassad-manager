<?php 
$servername = "localhost";
$password = "";
$database = "data_manager";
$username = "root";

$connection = new mysqli($servername, $username, $password, $database);

$fabricant_id = "";
$médicament_id = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fabricant_id = $_POST["fabricant_id"];
    $médicament_id = $_POST["médicament_id"];

    do {
        if (empty($fabricant_id) || empty($médicament_id)) {
            $errorMessage = "All fields are required.";
            break;
        }

        $sql = "INSERT INTO fabricant_médicament (fabricant_id, médicament_id) VALUES ('$fabricant_id', '$médicament_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $fabricant_id = "";
        $médicament_id = "";

        $successMessage = "Student added successfully.";
        
        header("location: /zakariae-el-hassad-manager/médicaments/médicament.php");
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
                    <label for="fabricant_id" class="form-label">fabricant_id</label>
                    <input type="number" class="form-control" name="fabricant_id" id="fabricant_id" placeholder="Entrez le fabricant_id" value="<?php echo htmlspecialchars($fabricant_id); ?>">
                </div>
                <!-- Adresse -->
                <div class="mb-3">
                    <label for="médicament_id" class="form-label">médicament_id</label>
                    <input type="number" class="form-control" name="médicament_id" id="médicament_id" placeholder="Entrez l'médicament_id" value="<?php echo htmlspecialchars($médicament_id); ?>">
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
                    <a href="/zakariae-el-hassad-manager/médicaments/médicament.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

