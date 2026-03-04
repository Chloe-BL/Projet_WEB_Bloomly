<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$format = ['pdf'];
$uploadDir = 'upload/';
$max_file_size = 2 * 1024 * 1024; // 2 Mo

// ✅ Si on arrive ici sans formulaire (GET), on affiche juste un message
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Ouvre la page candidature.html et envoie le formulaire (ne lance pas candidature.php directement).";
    exit;
}

// ✅ Vérifs de base pour éviter les notices/fatal
if (!isset($_FILES['cv'])) {
    die("Aucun fichier reçu (name=\"cv\").");
}
if (!isset($_POST['Lettre'])) {
    die("Aucune lettre reçue (name=\"Lettre\").");
}

$file = $_FILES['cv'];
$lettre = $_POST['Lettre'];

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

// Vérification MIME (si finfo dispo)
if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($fileType !== 'application/pdf') {
        die("Le fichier n'est pas un PDF valide");
    }
}

// S'assurer que le dossier upload existe (sinon move_uploaded_file échoue)
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$fileName = basename($file['name']);
$destination = $uploadDir . $fileName;

// Déplacement fichier
if (move_uploaded_file($file['tmp_name'], $destination)) {
    echo "<h2>Candidature envoyée ✅</h2>";
    echo '<p><a href="' . htmlspecialchars($destination) . '" target="_blank">Voir le fichier</a></p>';
    echo "<p><strong>Lettre :</strong><br>" . nl2br(htmlspecialchars($lettre)) . "</p>";
} else {
    die("Échec du déplacement du fichier (dossier upload ? permissions ?)");
}
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
