
function champsVide(form) {
  if (form.nom.value == "") {
    alert("Erreur: Veuillez remplir le champs nom avant de soumettre votre formulaire !");
    return false;
  }
  else if (form.prenom.value == "") {
    alert("Erreur: Veuillez remplir le champs prenom avant de soumettre votre formulaire !");
    return false;
  }
  else if (form.email.value == "") {
    alert("Erreur: Veuillez remplir le champs email avant de soumettre votre formulaire !");
    return false;
  }
}



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
  document.getElementById('note-affichee').textContent = "Note : " + note + " / 4";
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

document.addEventListener('DOMContentLoaded', function () {
  initialiserEtoiles();
});