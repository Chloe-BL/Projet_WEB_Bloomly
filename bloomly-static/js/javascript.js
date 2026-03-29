 
 function champsVide(form)
  {
    if(form.nom.value == "") {
      alert("Erreur: Veuillez remplir tous les champs avant de soumettre votre formulaire !");
      form.nom.focus();
      return false;
    } 
    else if(form.prenom.value == "") {
      alert("Erreur: Veuillez remplir tous les champs avant de soumettre votre formulaire !");
      form.prenom.focus();
      return false;
    } 
    else if(form.email.value == "") {
      alert("Erreur: Veuillez remplir tous les champs avant de soumettre votre formulaire !");
      form.email.focus();
      return false;
    }
}