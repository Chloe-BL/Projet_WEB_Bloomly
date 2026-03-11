<?php
$entreprises = [
    "NexoraTech",
    "SynaptIQ Solutions",
    "TechVortex",
    "SecureFlow Systems",
    "DataNova",
    "CloudBridge",
    "InnovaDev",
    "CyberSphere",
    "SoftWave",
    "FutureLabs",
    "AlphaCode",
    "BlueMatrix",
    "Quantum IT",
    "NetFusion",
    "DevSpark",
    "InfoPulse",
    "SkyWare",
    "HexaDigital",
    "CodeFactory",
    "BrightSystems",
    "NovaLink",
    "SmartCore",
    "ByteWorks",
    "GreenSoft",
    "InfraTech",
    "OptimaWeb",
    "DataCraft",
    "PixelForge",
    "Visionary Tech",
    "Proxima Dev",
    "Sigma Networks",
    "AeroCode",
    "Delta Systems",
    "Fusion Labs",
    "OmniTech",
    "Prime Solutions",
    "LogicBloom",
    "CyberNest",
    "CloudHive",
    "HyperNova",
    "IntelliSoft",
    "NextGen Digital",
    "Orbit Systems",
    "SecureMind",
    "TechRoots",
    "VisionCode",
    "WaveLogic",
    "ZenIT",
    "MetaSoft",
    "Digital Horizon"
];

$parPage = 9;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$totalEntreprises = count($entreprises);
$totalPages = (int) ceil($totalEntreprises / $parPage);

if ($page > $totalPages) {
    $page = $totalPages;
}

$debut = ($page - 1) * $parPage;
$entreprisesPage = array_slice($entreprises, $debut, $parPage);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../abdellah_style.css">

        <title>Annonces d'offres</title>
    </head>
    <body class="back">
        <header class="mon-header">

            <div class="header-left">
                <div class="search-bar">
                    <span class="icon">🔍</span>
                    <input type="text" placeholder="Rechercher ">
                </div>
            </div>

            <div class="header-center">
                <img src="../assets/logo_bloomly.png" alt="Logo Bloomly" >
            </div>
            
            <div class="header-right">
                <nav>
                    <a class="mon-espaced"href="..\index.html">Se déconnecter</a>
                    <a class="mon-espace" href="pilot_espace.html">Mon espace</a>
                </nav>
            </div>

        </header>
        
        <br><br>
        
        <nav class="navbar">
            <a class="active">Vos annonces</a>
            <a href="pilot_brouillons_off.html">Vos brouillons</a>
            <a href="pilot_archives_off.html">Vos archives</a>
        </nav>
         <div class="sous-nav"></div>

        <h1 class="police">Consulter vos annonces</h1>
        <p class="police">Retrouvez ici l'ensemble des offres de stage que vous avez publiées.</p>
        <p class="police">Vous pouvez modifier ou supprimer vos annonces à tout moment.</p>

        <div class="liste">
    <?php foreach ($entreprisesPage as $entreprise): ?>
        <div class="bloc-liste">
            <img src="../assets/annonce.png" alt="Image d'une annonce">
            <p><?= htmlspecialchars($entreprise) ?></p>
        </div>
    <?php endforeach; ?>
</div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">Précédent</a>
        <?php else: ?>
            <span class="disabled">Précédent</span>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i === $page): ?>
                <span class="active-page"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Suivant</a>
        <?php else: ?>
            <span class="disabled">Suivant</span>
        <?php endif; ?>
    </div>


    <footer class="mon-footer">

            <div class="mon-footer-left">
                <a href="https://instagram.com" target="_blank">
                    <img src="../assets/instagram.png" alt="Instagram"></a>

                <a href="https://twitter.com" target="_blank">
                    <img src="../assets/twitter.png" alt="Twitter"></a>

                <a href="https://linkedin.com" target="_blank">
                    <img src="../assets/linkedin.png" alt="LinkedIn"></a>
            </div>
            
            <div class="mon-footer-center">
                <p>© 2026 Bloomly - Tous droits réservés.</p>
                <nav>
                    <a href="..\a-propos.html">A propos de nous</a>
                    <a href="..\mentions-legales.html">Mentions légales</a>
                    <a href="..\cookies.html">Cookies</a>
                </nav>
            </div>

            <div class="mon-footer-right">
                    <img src="../assets/mini_logo_bloomly.png" alt="Logo Bloomly" class="logo">
            </div>         
        </footer>
</body>
</html>