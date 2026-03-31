// Javascript pour les note entreprises ==================================================================================================
let noteActuelle = 0;

function selectionnerNote(note) {
  const stars = document.querySelectorAll('.star');

  noteActuelle = note;

  stars.forEach((star, index) => {
    if (index < note) {
      star.src = 'http://bloomly-static.local/assets/etoile_rose.png';
    } else {
      star.src = 'http://bloomly-static.local/assets/etoile_grise.png';
    }
  });

  document.getElementById('note').value = note;
}

function initialiserEtoiles() {
  const stars = document.querySelectorAll('.star');

  stars.forEach((star) => {
    star.addEventListener('click', function () {
      const note = parseInt(this.dataset.value);
      selectionnerNote(note);
    });
  });
}

function gererFormulaire(event) {
  if (noteActuelle === 0) {
    alert("Veuillez sélectionner une note ");
    event.preventDefault();
    return false;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", () => {

  initialiserEtoiles();

  const btnTop = document.getElementById("btnTop");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      btnTop.style.display = "block";
    } else {
      btnTop.style.display = "none";
    }
  });

  btnTop.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
});

//Javascript pour valider le formulaire de candidature =================================================================================================

function SaisieComplete(form) {
  // ici je vérifie que les entrées ne sont pas vides
  if (form.Lettre.value == "" || form.nom.value == "" || form.prenom.value == "" || form.email.value == "") {
    alert("Vous devez complétez l'ensemble des champs !")
    return false;
  }
  return true;
}

function Majuscule() {
  // mise du nom en majuscule
  let nom = document.getElementById('nom');

  nom.value = nom.value.toUpperCase();
}

function validerMail() {
  // validation de la syntaxe du mail
  const email = document.getElementById('email').value;
  const syntaxe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (syntaxe.test(email)) {
    return true;
  }
  else {
    alert("Adresse mail invalide");
    return false;
  }
}

function ValiderCV() {
  const fichier = document.getElementById("cv");

  // vérification qu'un fichier a bien été saisi
  if (fichier.files.length == 0) {
    alert("Vous devez ajouter votre CV !");
    return false;
  }

  const file = fichier.files[0];

  if (!verifierExtension(file)) {
    alert("Format de fichier non autorisé.");
    return false;
  }
  if (!verifierTaille(file)) {
    alert("Le fichier dépasse 2 Mo");
    return false;
  }
  return true;
}

function verifierExtension(file) {
  const nomFichier = file.name.toLowerCase();
  const extensionsAutorisees = [".pdf", ".doc", ".docx", ".odt", ".rtf", ".jpg", ".png"];

  for (let i = 0; i < extensionsAutorisees.length; i++) {
    if (nomFichier.endsWith(extensionsAutorisees[i])) {
      return true;
    }
  }
  return false;
}

function verifierTaille(file) {
  const tailleMaxFichier = 2 * 1024 * 1024;

  if (file.size > tailleMaxFichier) {
    return false;
  }
  return true;
}

function validerFormulaire(form) {

  Majuscule();

  if (!SaisieComplete(form)) {
    return false;
  }

  if (!validerMail()) {
    return false;
  }

  if (!ValiderCV()) {
    return false;
  }

  alert("Candidature envoyée avec succès !")
  return true;
}

//Javascript pour valider le formulaire d'inscription =================================================================================================

function SaisieCompleteInscription(form) {
  // ici je vérifie que les entrées ne sont pas vides
  if (form.nom.value == "" ||
    form.prenom.value == "" ||
    form.email.value == "" ||
    form.mdp.value == "" ||
    form.num.value == "" ||
    form.civilite.value == "") {
    alert("Vous devez complétez l'ensemble des champs !")
    return false;
  }
  return true;
}

function validerFormulaireInscription(form) {
  Majuscule();

  if (!SaisieCompleteInscription(form)) {
    return false;
  }

  if (!validerMail()) {
    return false;
  }

  alert("L'utilisateur a bien été crée !")
  return true;
}
