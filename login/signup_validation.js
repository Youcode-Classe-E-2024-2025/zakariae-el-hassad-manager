
const name_Regex = /^[A-Za-z]{2,50}(?:\s[A-Za-z]{2,50})*$/;
const email_Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const password_Regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/;

document.getElementById("signup-form").addEventListener("submit", function(event) {
    const signUp_name = document.getElementById("nom").value;
    const signUp_email = document.getElementById("email").value;
    const signUp_password = document.getElementById("mode_de_passe").value;

    if (!name_Regex.test(signUp_name)) {
        alert("Nom invalide. Il doit être composé de lettres et peut inclure un espace.");
        event.preventDefault(); 
        return;
    }

    if (!email_Regex.test(signUp_email)) {
        alert("Email invalide. Veuillez entrer un email valide.");
        event.preventDefault(); 
        return;
    }

    if (!password_Regex.test(signUp_password)) {
        alert("Mot de passe invalide. Il doit contenir au moins une lettre, un chiffre et un caractère spécial.");
        event.preventDefault(); 
        return;
    }
});
