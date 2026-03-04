<?php
$format = ['pdf'];
$uploadDir = 'upload/';
$max_file_size = 2 * 1024 * 1024; // 2 Mo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['cv'])) {
    $file = $_FILES['cv'];
    // (optionnel) récupérer la lettre
    $lettre = $_POST['Lettre']; // ton textarea s'appelle "Lettre"
    // Vérification upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Erreur de téléversement. Code : " . $file['error']);
    }
    // Vérification taille
    if ($file['size'] > $max_file_size) {
        die("Le fichier est trop volumineux");
    }
    // Vérification extension
    $format_fichier = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($format_fichier, $format, true)) {
        die("Votre fichier n'a pas la bonne extension");
    }
    // Vérification MIME
    $fileType = mime_content_type($file['tmp_name']);
    if ($fileType !== 'application/pdf') {
        die("Le fichier n'est pas un PDF valide");
    }
    // Nom du fichier
    $fileName = basename($file['name']);
    // Chemin destination
    $destination = $uploadDir . $fileName;
    // Déplacement fichier
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "Fichier téléversé avec succès ! <a href=\"" . $destination . "\">Voir le fichier</a>";
        echo "<br>";
        echo "Lettre : " . $lettre;
    } else {
        die("Échec du déplacement du fichier");
    }
}

bonjour
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Candidature envoyée</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Candidature envoyée avec succès</h1>

<p>Merci pour votre candidature. Votre CV a bien été transmis.</p>

<p><a href="index.html">Retour à l'accueil</a></p>

</body>
</html>

<?php

    } else {
        die("Échec du déplacement du fichier");
    }

}
?>
