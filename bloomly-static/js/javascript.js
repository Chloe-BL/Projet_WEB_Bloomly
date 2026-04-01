// Javascript pour les note entreprises ==================================================================================================
let noteActuelle = 0; // Variable pour stocker la note sélectionnée

function selectionnerNote(note) { // Fonction pour sélectionner une note et mettre à jour l'affichage des étoiles
  const stars = document.querySelectorAll('.star'); // Sélectionne tous les éléments avec la classe "star"

  noteActuelle = note; // Met à jour la note actuelle avec la note sélectionnée

  stars.forEach((star, index) => { // Parcourt chaque étoile et met à jour son image en fonction de la note sélectionnée
    if (index < note) { // Si l'index de l'étoile est inférieur à la note sélectionnée, affiche une étoile rose
      star.src = 'http://bloomly-static.local/assets/etoile_rose.png'; // Remplacez par le chemin correct de votre image d'étoile rose
    } else {
      star.src = 'http://bloomly-static.local/assets/etoile_grise.png'; // Remplacez par le chemin correct de votre image d'étoile grise
    }
  });

  document.getElementById('note').value = note; // Met à jour la valeur de l'input caché avec la note sélectionnée
}

function initialiserEtoiles() { // Fonction pour initialiser les étoiles et ajouter les écouteurs d'événements
  const stars = document.querySelectorAll('.star'); // Sélectionne tous les éléments avec la classe "star"

  stars.forEach((star) => { // Parcourt chaque étoile et ajoute un écouteur d'événement pour le clic
    star.addEventListener('click', function () { // Lorsque l'étoile est cliquée, récupère la note associée à l'étoile et appelle la fonction de sélection de note
      const note = parseInt(this.dataset.value); // Récupère la note associée à l'étoile à partir de l'attribut data-value
      selectionnerNote(note); // Appelle la fonction pour sélectionner la note et mettre à jour l'affichage des étoiles
    });
  });
}

function gererFormulaire(event) { // Fonction pour gérer la soumission du formulaire et vérifier que la note a été sélectionnée
  if (noteActuelle === 0) { // Si aucune note n'a été sélectionnée, affiche une alerte et empêche la soumission du formulaire
    alert("Veuillez sélectionner une note "); // Affiche une alerte demandant à l'utilisateur de sélectionner une note
    event.preventDefault(); // Empêche la soumission du formulaire
    return false; // Retourne false pour indiquer que la validation a échoué
  }

  return true; // Retourne true pour indiquer que la validation a réussi et permettre la soumission du formulaire
}

document.addEventListener("DOMContentLoaded", () => { // Lorsque le contenu de la page est chargé, initialise les étoiles et ajoute un écouteur d'événement pour la soumission du formulaire

  initialiserEtoiles(); // Appelle la fonction pour initialiser les étoiles et ajouter les écouteurs d'événements

  const btnTop = document.getElementById("btnTop"); // Sélectionne le bouton de retour en haut de la page

  window.addEventListener("scroll", () => { // Ajoute un écouteur d'événement pour le défilement de la page afin d'afficher ou masquer le bouton de retour en haut en fonction de la position de défilement
    if (window.scrollY > 200) { // Si la position de défilement est supérieure à 200 pixels, affiche le bouton de retour en haut
      btnTop.style.display = "block"; // Affiche le bouton de retour en haut en définissant son style display sur "block"
    } else { // Sinon, masque le bouton de retour en haut
      btnTop.style.display = "none"; // Masque le bouton de retour en haut en définissant son style display sur "none"
    }
  });

  btnTop.addEventListener("click", () => { // Ajoute un écouteur d'événement pour le clic sur le bouton de retour en haut afin de faire défiler la page vers le haut de manière fluide
    window.scrollTo({ // Fait défiler la page vers le haut de manière fluide en utilisant la méthode scrollTo avec les options top et behavior
      top: 0, // Définit la position de défilement à 0 pour faire défiler vers le haut de la page
      behavior: "smooth" // Définit le comportement de défilement sur "smooth" pour une transition fluide

    });
  });
});

//Javascript pour valider le formulaire de candidature =================================================================================================

function SaisieComplete(form) { // Fonction pour vérifier que toutes les entrées du formulaire sont complètes
  // ici je vérifie que les entrées ne sont pas vides
  if (form.Lettre.value == "" || form.nom.value == "" || form.prenom.value == "" || form.email.value == "") { // Si l'une des entrées est vide, affiche une alerte et retourne false pour empêcher la soumission du formulaire
    alert("Vous devez complétez l'ensemble des champs !") // Affiche une alerte demandant à l'utilisateur de compléter tous les champs du formulaire
    return false; // Retourne false pour indiquer que la validation a échoué et empêcher la soumission du formulaire
  }
  return true;
}

function Majuscule() { 
  // mise du nom en majuscule
  let nom = document.getElementById('nom'); // Sélectionne l'élément du formulaire avec l'id "nom" et le stocke dans la variable nom

  nom.value = nom.value.toUpperCase(); // Convertit la valeur de l'élément nom en majuscules en utilisant la méthode toUpperCase() et met à jour la valeur de l'élément nom avec le résultat
}

function validerMail() {
  // validation de la syntaxe du mail
  const email = document.getElementById('email').value; // Sélectionne l'élément du formulaire avec l'id "email", récupère sa valeur et la stocke dans la variable email
  const syntaxe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Définit une expression régulière pour valider la syntaxe d'une adresse e-mail, qui vérifie que l'adresse e-mail contient un caractère "@" suivi d'un point "." et que les parties avant et après ces caractères ne contiennent pas d'espaces ou de caractères spéciaux

  if (syntaxe.test(email)) {
    return true;
  }
  else {
    alert("Adresse mail invalide");
    return false;
  }
}

function ValiderCV() {
  const fichier = document.getElementById("cv"); // Sélectionne l'élément du formulaire avec l'id "cv" et le stocke dans la variable fichier

  // vérification qu'un fichier a bien été saisi
  if (fichier.files.length == 0) { 
    alert("Vous devez ajouter votre CV !");
    return false;
  }

  const file = fichier.files[0]; // Récupère le premier fichier sélectionné dans l'élément fichier et le stocke dans la variable file

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

function verifierExtension(file) { // Fonction pour vérifier que le fichier a une extension autorisée
  const nomFichier = file.name.toLowerCase(); // Récupère le nom du fichier, le convertit en minuscules et le stocke dans la variable nomFichier pour faciliter la comparaison avec les extensions autorisées
  const extensionsAutorisees = [".pdf", ".doc", ".docx", ".odt", ".rtf", ".jpg", ".png"]; // Définit un tableau d'extensions de fichiers autorisées pour les CV, qui inclut les formats PDF, Word, OpenDocument, RTF, JPEG et PNG

  for (let i = 0; i < extensionsAutorisees.length; i++) { // Parcourt le tableau des extensions autorisées et vérifie si le nom du fichier se termine par l'une de ces extensions en utilisant la méthode endsWith()
    if (nomFichier.endsWith(extensionsAutorisees[i])) { // Si le nom du fichier se termine par une extension autorisée, retourne true pour indiquer que la validation a réussi
      return true;
    }
  }
  return false;
}

function verifierTaille(file) { // Fonction pour vérifier que le fichier ne dépasse pas la taille maximale autorisée
  const tailleMaxFichier = 2 * 1024 * 1024; // Définit la taille maximale autorisée pour les fichiers de CV en octets, ici 2 Mo (2 * 1024 * 1024 octets)

  if (file.size > tailleMaxFichier) { 
    return false;
  }
  return true;
}

function validerFormulaire(form) { // Fonction pour valider le formulaire de candidature en appelant les différentes fonctions de validation

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

function SaisieCompleteInscription(form) { // Fonction pour vérifier que toutes les entrées du formulaire d'inscription sont complètes
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

function validerFormulaireInscription(form) { // Fonction pour valider le formulaire d'inscription en appelant les différentes fonctions de validation
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

// Javascript pour récupérer LM et CV =================================================================================================================
function afficherLM(index) { // Fonction pour afficher ou masquer la lettre de motivation et le CV associés à une candidature en fonction de l'index de la candidature
  const element = document.getElementById('lm-' + index); // Sélectionne l'élément du DOM avec l'id "lm-" suivi de l'index de la candidature et le stocke dans la variable element

  if (!element) { // Si l'élément n'existe pas, affiche un message dans la console et retourne pour éviter une erreur
    console.log("Element non trouvé :", index); // Affiche un message dans la console indiquant que l'élément n'a pas été trouvé, avec l'index de la candidature pour faciliter le débogage
    return; // Retourne pour éviter une erreur si l'élément n'existe pas
  }

  if (element.style.display === "none" || element.style.display === "") { // Si l'élément est actuellement masqué (display: none) ou n'a pas de style display défini, affiche l'élément en définissant son style display sur "block"
    element.style.display = "block"; // Affiche l'élément en définissant son style display sur "block"
  } else {
    element.style.display = "none"; // Sinon, masque l'élément en définissant son style display sur "none"
  }
}