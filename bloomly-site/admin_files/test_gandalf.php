<?php

try {
    // On crée l'instance de l'objet PDO
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=Workshop", "root", "Chloe123!");
 
    // On configure PDO pour qu'il nous prévienne en cas d'erreur SQL (très important pour le debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    echo "Connexion à la base de données réussie !";
 
} catch (PDOException $e) {
    // Si la connexion échoue, on attrape l'erreur ici
    die("Erreur de connexion : " . $e->getMessage());
}

$requete = "SELECT * FROM utilisateurs WHERE pseudo = 'Gandalf'";
$resultat = $pdo -> query($requete);

// Vérification erreur
if ($resultat === false) {
    echo "Erreur dans la requête";
    exit;
}

// Vérification résultat
if ($resultat -> rowCount() > 0) { //compte le nombre de fois ou gandalf apparaît dans les lignes
    echo "<br>Gandalf est présent";
} else {
    echo "<br>Gandalf n'est pas présent" ;
}
?>
