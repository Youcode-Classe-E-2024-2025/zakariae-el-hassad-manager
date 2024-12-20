<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_manager";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['action']) && $_GET['action'] == 'toggle_active' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "SELECT active FROM utilisateurs WHERE id = $userId";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $newStatus = ($row['active'] == 1) ? 0 : 1;
    
    $updateSql = "UPDATE utilisateurs SET active = $newStatus WHERE id = $userId";
    if ($connection->query($updateSql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $deleteSql = "DELETE FROM utilisateurs WHERE id = $userId";
    if ($connection->query($deleteSql) === TRUE) {
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

$sql = "SELECT * FROM utilisateurs";
$result = $connection->query($sql);
if (!$result) {
    die("Invalid query: " . $connection->error);
}
?>

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
        <div class="actions">
            <a href="/zakariae_el_hassad_package/package/p_create.php" class="btn">Nouveau fabricants</a>
        </div>
        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nom</th>
                        <th>email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nom']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='/zakariae-el-hassad-manager/utilisateurs/utilisateur.php?action=toggle_active&id={$row['id']}' class='btn'>" . 
                                ($row['active'] == 1 ? ' Désactiver' : 'activation') . "</a>
                                <a href='/zakariae-el-hassad-manager/utilisateurs/utilisateur.php?action=delete&id={$row['id']}' class='btn danger'>delete</a>
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
