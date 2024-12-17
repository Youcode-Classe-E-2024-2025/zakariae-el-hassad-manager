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
            <li><a href="/zakariae-el-hassad-manager/utilisateurs/utilisateur.php">utilisateurs</a></li>
                <li><a href="/zakariae-el-hassad-manager/fabricants/fabricant.php">fabricant</a></li>
                <li><a href="/zakariae-el-hassad-manager/médicaments/médicament.php">médicaments</a></li>
                <li><a href="/zakariae-el-hassad-manager/stocks/stock.php">stocks</a></li>
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
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "data_manager";

                    $connection = new mysqli($servername, $username, $password, $database);

                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    $sql = "SELECT * FROM utilisateurs";
                    $result = $connection->query($sql);
                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nom']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='/brief1_php/package/p_edit.php?id={$row['id']}' class='btn'>Edit</a>
                                <a href='/brief1_php/package/p_delete.php?id={$row['id']}' class='btn danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>