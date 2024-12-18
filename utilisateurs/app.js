// function updateActiveStatus(status) {
//     const userId = document.getElementById("userId").value;

//     console.log("Sending data:", { userId, status });

//     fetch("/update-active", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify({ userId, status })
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log("Response from server:", data); 
//         const statusDiv = document.getElementById("status");
//         if (data.success) {
//             statusDiv.textContent = "Statut mis à jour avec succès.";
//         } else {
//             statusDiv.textContent = "Erreur lors de la mise à jour.";
//         }
//     })
//     .catch(err => console.error("Erreur:", err));
// }
