const express = require("express");
const mysql = require("mysql");

const app = express();
app.use(express.json()); // Bash y9ra JSON requests

// Configuration de la base de données
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "data_mangages"
});

db.connect((err) => {
    if (err) throw err;
    console.log("Database connected!");
});

// Route: Update active status
app.post("/update-active", (req, res) => {
    const { userId, status } = req.body;

    console.log("Received data:", { userId, status }); // Debugging backend input

    const query = "UPDATE utilisateurs SET active = ? WHERE id = ?";
    db.query(query, [status, userId], (err, result) => {
        if (err) {
            console.error("SQL Error:", err); // Debugging SQL errors
            return res.status(500).json({ success: false });
        }
        console.log("Database updated:", result); // Debugging database result
        res.json({ success: true });
    });
});


// Start the server
app.listen(3000, () => {
    console.log("Server running on http://localhost:3000");
});
