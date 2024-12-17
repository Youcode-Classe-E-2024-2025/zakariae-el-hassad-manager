<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médicament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-4 text-center">Ajouter un Nouveau Médicament</h2>

            <div id="errorAlert" class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
                <strong id="errorMessage"></strong>
                <button type="button" class="btn-close" onclick="closeAlert('errorAlert')"></button>
            </div>

            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong id="successMessage"></strong>
                <button type="button" class="btn-close" onclick="closeAlert('successAlert')"></button>
            </div>

            <form id="medicamentForm">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Médicament</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="mb-3">
                    <label for="dosage" class="form-label">dosage</label>
                    <input type="text" class="form-control" id="dosage" name="dosage" required>
                </div>
                <div class="mb-3">
                    <label for="form" class="form-label">form</label>
                    <input type="text" class="form-control" id="form" name="form" required>
                </div>
                <div class="mb-3">
                    <label for="indication" class="form-label">indication</label>
                    <input type="text" class="form-control" id="indication" name="indication" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="/zakariae-el-hassad-manager/médicaments/médicament.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('medicamentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const nom = document.getElementById('nom').value;
            const description = document.getElementById('description').value;
            const categorie = document.getElementById('dosage').value;
            const categorie = document.getElementById('form').value;
            const categorie = document.getElementById('indication').value;

            if (!nom || !description || !dosage || !form || !indication) {
                showAlert('errorAlert', 'Tous les champs sont obligatoires.');
                return;
            }

            const newMedicament = {
                id: Date.now(),
                nom,
                description,
                dosage,
                form,
                indication
            };

            let médicaments = JSON.parse(localStorage.getItem('médicaments')) || [];
            médicaments.push(newMedicament);
            localStorage.setItem('médicaments', JSON.stringify(médicaments));

            showAlert('successAlert', 'Médicament ajouté avec succès.');
            this.reset();

            setTimeout(() => {
                window.location.href = '/zakariae-el-hassad-manager/médicaments/médicament.php';
            }, 1500);
        });

        function showAlert(alertId, message) {
            const alert = document.getElementById(alertId);
            const messageEl = document.getElementById(
                alertId === 'errorAlert' ? 'errorMessage' : 'successMessage'
            );
            messageEl.textContent = message;
            alert.style.display = 'block';
        }

        function closeAlert(alertId) {
            document.getElementById(alertId).style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
