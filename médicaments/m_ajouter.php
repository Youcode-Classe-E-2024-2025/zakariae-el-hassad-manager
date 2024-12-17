<?php 
// Connect to the database
$servername = "localhost";
$password = "";
$database = "data_manager";
$username = "root";

$connection = new mysqli($servername, $username, $password, $database);

$nom = "";
$description = "";
$dosage = "";
$form = "";
$indication = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $dosage = $_POST["dosage"];
    $form = $_POST["form"];
    $indication = $_POST["indication"];

    do {
        if (empty($nom) || empty($description) || empty($form) || empty($indication)) {
            $errorMessage = "All fields are required.";
            break;
        }

        $sql = "INSERT INTO médicaments (nom, description,dosage,form,indication) VALUES ('$nom', '$description','$dosage','$form','$indication')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $nom = "";
        $description = "";
        $dosage = "";
        $form = "";
        $indication = "";

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
                    <label for="nom" class="form-label">Nom du Fabricant</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div>
                <!-- Adresse -->
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Entrez l'description" value="<?php echo htmlspecialchars($description); ?>">
                </div>
                <!-- Site Web -->
                <div class="mb-3">
                    <label for="dosage" class="form-label">Site Web</label>
                    <input type="text" class="form-control" name="dosage" id="dosage" placeholder="entre le dosage" value="<?php echo htmlspecialchars($dosage); ?>">
                </div>
                <div class="mb-3">
                    <label for="form" class="form-label">form</label>
                    <input type="text" class="form-control" name="form" id="form" placeholder="entre le form" value="<?php echo htmlspecialchars($form); ?>">
                </div>
                <div class="mb-3">
                    <label for="indication" class="form-label"> indication</label>
                    <input type="text" class="form-control" name="indication" id="indication" placeholder="entre le indication" value="<?php echo htmlspecialchars($indication); ?>">
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

