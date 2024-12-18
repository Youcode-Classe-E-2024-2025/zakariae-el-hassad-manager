// const express = require("express");
// const mysql = require("mysql");

// const app = express();
// app.use(express.json());

// const db = mysql.createConnection({
//     host: "localhost",
//     user: "root",
//     password: "",
//     database: "data_mangages"
// });

// db.connect((err) => {
//     if (err) throw err;
//     console.log("Database connected!");
// });

// app.post("/update-active", (req, res) => {
//     const { userId, status } = req.body;

//     const query = "UPDATE utilisateurs SET active = ? WHERE id = ?";
//     db.query(query, [status, userId], (err, result) => {
//         if (err) {
//             return res.status(500).json({ success: false });
//         }
//         res.json({ success: true });
//     });
// });

// app.listen(3000, () => {
//     console.log("Server running on http://localhost:3000");
// });
