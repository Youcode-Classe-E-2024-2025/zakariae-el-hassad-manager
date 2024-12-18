
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
/* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Sidebar */
.sidebar {
    width: 250px;
    background-color: #343a40;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 40px;
    color: #fff;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.sidebar a {
    display: block;
    color: #ccc;
    padding: 15px;
    text-decoration: none;
    font-size: 16px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.sidebar a:hover {
    background-color: #495057;
    color: #fff;
}

.sidebar #image {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

/* Content */
.content {
    margin-left: 250px;
    padding: 30px;
    min-height: 100vh;
    background-color: #f9f9f9;
}

/* Section Titles */
#titre {
    font-size: 2rem;
    color: #2c3e50;
    margin-bottom: 15px;
}

#list {
    font-size: 1.1rem;
    color: #7f8c8d;
    margin-bottom: 30px;
}

#main {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Cards */
#carte {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

#carte:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

#carte h1 {
    font-size: 1.6rem;
    color: #34495e;
    margin-bottom: 10px;
}

#carte h2 {
    font-size: 1.1rem;
    color: #7f8c8d;
    margin-bottom: 5px;
}

#carte p {
    font-size: 1rem;
    color: #95a5a6;
}

/* Buttons */
.btn-primary {
    background-color: #1abc9c;
    border-color: #1abc9c;
    padding: 10px 20px;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #16a085;
    border-color: #16a085;
}

.btn-secondary {
    background-color: #bdc3c7;
    border-color: #bdc3c7;
    padding: 10px 20px;
    border-radius: 5px;
}

.btn-secondary:hover {
    background-color: #95a5a6;
    border-color: #95a5a6;
}

    </style>
</head>
<body>

    <div class="sidebar">
        <div id="image" class="navbar-brand d-flex align-items-center justify-content-center">
            <img src="./img/Leonardo_Phoenix_A_stylized_modern_and_sleek_logo_for_ZH_a_bol_0.jpg" alt="Logo">
        </div>
        <a href="/zakariae-el-hassad-manager/home.php">Home</a>
        <a href="/zakariae-el-hassad-manager/utilisateurs/utilisateur.php">commende</a>
    </div>

    <div class="content">
        <form action="" method="GET" class="d-flex mb-4">
            <div class="input-group me-2">
                <input type="text" name="search" required value="<?php if (isset($_GET['search'])) { echo htmlspecialchars($_GET['search']); } ?>" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <a href="?reset=1" class="btn btn-secondary">Reset</a>
        </form>
        <div class="container my-5">
            <h1 id="titre">Welcome to Packages</h1>
            <p id="list">---------- List of Packages ----------</p>
            <br>
            <div id="main">
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_manager";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

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
