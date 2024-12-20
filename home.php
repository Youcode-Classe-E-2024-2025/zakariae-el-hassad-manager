<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./h_style.css">
</head>
<body>

<div class="sidebar">
    <div id="image" class="navbar-brand d-flex align-items-center justify-content-center">
        <img src="./img/Leonardo_Phoenix_A_stylized_modern_and_sleek_logo_for_ZH_a_bol_0.jpg" alt="Logo">
    </div>
    <a href="/zakariae-el-hassad-manager/home.php">Home</a>
    <a href="/zakariae-el-hassad-manager/utilisateurs/utilisateur.php">Commande</a>
    <div class="mt-auto" style="margin-top: auto;">
        <a href="/zakariae-el-hassad-manager/login/login.php" class="btn btn-primary" style="margin-top: 20px;">Login</a>
    </div>
</div>

    <div class="content">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "data_manager";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $count_sql = "SELECT COUNT(*) AS total_fabricants FROM fabricants";
        $count_result = $connection->query($count_sql);
        $total_fabricants = 0;

        if ($count_result && $count_result->num_rows > 0) {
            $row = $count_result->fetch_assoc();
            $total_fabricants = $row['total_fabricants'];
        }
        ?>

        <form action="" method="GET" class="d-flex mb-4">
            <div class="input-group me-2">
                <input type="text" name="search" required value="<?php if (isset($_GET['search'])) { echo htmlspecialchars($_GET['search']); } ?>" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <a href="?reset=1" class="btn btn-secondary">Reset</a>
        </form>

        <div class="con">
            <h1 id="titre">Welcome to Packages</h1>
            <p id="list">---------- List of Packages ----------</p>
            <div id="c">
                <h2>Total Fabricants </h2>
                <p id="fabricant-counter"><?= htmlspecialchars($total_fabricants) ?></p>
            </div>
        </div>

        <div class="container my-5">
            <div id="main">
            <?php
            $sql = "
                SELECT 
                    médicaments.nom AS nomp, 
                    médicaments.description, 
                    médicaments.dosage, 
                    fabricants.nom AS fabricant_nom, 
                    stocks.quantite
                FROM 
                    médicaments
                INNER JOIN 
                    fabricant_médicament ON fabricant_médicament.médicament_id = médicaments.id
                INNER JOIN 
                    fabricants ON fabricant_médicament.fabricant_id = fabricants.id
                INNER JOIN 
                    stocks ON stocks.médicament_id = médicaments.id
            ";

            if (!empty($_GET['search'])) {
                $filtervalues = $connection->real_escape_string($_GET['search']);
                $sql .= " WHERE 
                    médicaments.nom LIKE '%$filtervalues%' 
                    OR fabricants.nom LIKE '%$filtervalues%' 
                    OR médicaments.dosage LIKE '%$filtervalues%'";
            }

            $result = $connection->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div id='carte'>
                        <h1>" . htmlspecialchars($row['nomp']) . "</h1>
                        <h2>Fabricant :</h2>
                        <p>" . htmlspecialchars($row['fabricant_nom']) . "</p>
                        <h2>Quantité :</h2>
                        <p>" . htmlspecialchars($row['quantite']) . "</p>
                        <h2>Description :</h2>
                        <p>" . htmlspecialchars($row['description']) . "</p>
                        <h2>Dosage :</h2>
                        <p>" . htmlspecialchars($row['dosage']) . "</p>
                    </div>
                    ";
                }
            } else {
                echo "<p>No results found.</p>";
            }
            ?>
            </div>
        </div>
    </div>

</body>
</html>
