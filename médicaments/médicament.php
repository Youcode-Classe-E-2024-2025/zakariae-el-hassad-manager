<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Sidebar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <aside class="sidebar">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/zakariae-el-hassad-manager/home.php">Home</a></li>
                <li><a href="/zakariae-el-hassad-manager/utilisateurs/utilisateur.php">utilisateurs</a></li>
                <li><a href="/zakariae-el-hassad-manager/fabricants/fabricant.php">fabricant</a></li>
                <li><a href="/zakariae-el-hassad-manager/médicaments/médicament.php">médicaments</a></li>
                <li><a href="/zakariae-el-hassad-manager/stocks/stock.php">stocks</a></li>
                <div class="mt-auto" style="margin-top: auto;">
                    <a href="/zakariae-el-hassad-manager/login/login.php" class="btn btn-primary" style="margin-top: 20px;">Login</a>
                </div>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <header>
            <h1>Les Packages</h1>
            <p class="subtitle">---------- Liste des fabricants ----------</p>
        </header>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "data_manager";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $count_sql = "SELECT COUNT(*) AS total_médicaments FROM médicaments";
        $count_result = $connection->query($count_sql);
        $total_médicaments = 0;

        if ($count_result && $count_result->num_rows > 0) {
            $row = $count_result->fetch_assoc();
            $total_médicaments = $row['total_médicaments'];
        }
        ?>

        <div class="actions">
            <a href="/zakariae-el-hassad-manager/médicaments/m_ajouter.php" class="btn">Nouveau fabricants</a>
            <a href="/zakariae-el-hassad-manager/médicaments/f_m_ajouter.php" class="btn">Relation fabricants et Auteur</a>
        </div>

        <div class="counter">
            <h2>Total Médicaments : <span><?= htmlspecialchars($total_médicaments) ?></span></h2>
        </div>

        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Dosage</th>
                        <th>Form</th>
                        <th>Indication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM médicaments";
                    $result = $connection->query($sql);
                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nom']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['dosage']}</td>
                            <td>{$row['form']}</td>
                            <td>{$row['indication']}</td>
                            <td>
                                <a href='/zakariae-el-hassad-manager/médicaments/m_edit.php?id={$row['id']}' class='btn'>Edit</a>
                                <a href='/zakariae-el-hassad-manager/médicaments/m_delete.php?id={$row['id']}' class='btn danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
