 
 function champsVide(form)
  {
    if(form.nom.value == "") {
      alert("Erreur: Veuillez remplir le champs nom avant de soumettre votre formulaire !");
      return false;
    } 
    else if(form.prenom.value == "") {
      alert("Erreur: Veuillez remplir le champs prenom avant de soumettre votre formulaire !");
      return false;
    } 
    else if(form.email.value == "") {
      alert("Erreur: Veuillez remplir le champs email avant de soumettre votre formulaire !");
      return false;
    }
}