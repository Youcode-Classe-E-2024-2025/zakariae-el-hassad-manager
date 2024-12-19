
const email_Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const password_Regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/;

function validateForm() {
  const email = document.getElementById('email').value;
  const mode_de_passe = document.getElementById('mode_de_passe').value;

  if (!email_Regex.test(email)) {
    alert("Veuillez entrer un email valide.");
    return false;
  }

  if (!password_Regex.test(mode_de_passe)) {
    alert("Le mot de passe doit comporter au moins une lettre, un chiffre, et un caractère spécial, et avoir une longueur minimale de 8 caractères.");
    return false; 
  }

  return true; 
}
