<?php
include('../modele/index.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H5AI</title>
    <link rel="stylesheet" href="style.css">
    <script href="index.js"></script>
    <link rel="shortcut icon" href="../svg/html.svg" type="image/x-icon">
</head>
<body>
    <div class="container">

    <!-- Affiche le breadcrumb-->
    <div class="breadcrumb"> 
        <?php
        foreach($pathParts as $index => $part) {
            $path = implode('/', array_slice($pathParts, 0, $index + 1));
            echo '<a href="?dir=' . urldecode($path) .'">'. $part . '</a>';
           
            //Ajout d'un separateur 
            if ($index < count($pathParts) - 1) {
                echo' / ';
            }
        }
        ?>
    </div>

    <!-- Barre de recherche -->
    <div class="bar-search">
        <!-- Formulaire de recherche -->
        <form action="search.php" method="GET">
            <input type="text" placeholder="Rechercher..." name="recherche">
            <button type="submit"> Rechercher </button>
        </form>
    </div>

    <!-- Flèche de navigation retour -->
    <div class="button">
            <?php if($requestPath !== "/"): ?>
        <a href="../view/home.php">Retour</a>
        <?php endif; ?>
    </div>

        <!-- Tableau pour mettre les données -->
        <table>
            <thead>
                <tr>
                    <th>Dossiers</th>
                    <th>Fichiers</th>
                    <th>Dernière modification</th>
                    <th>Taille</th>
                </tr>
            </thead>

            <tbody>
                <!-- Affichage dossiers -->
                <?php foreach($filesDirectories['directories'] as $directory): ?>
                    <tr>
                        <td><img src="../svg/folder.svg" alt="folder" width="24" height="24">
                            <a href="?dir=<?php echo urlencode($requestPath . '/' . $directory); ?>"><?php echo htmlspecialchars($directory); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>

                    <!-- Affichage fichiers -->
                    <?php foreach($filesDirectories['files'] as $file): ?>
                        <tr>
                            <td></td>
                            <td><img src="../svg/<?php echo $file['icon']; ?>" alt="<?php echo $file['icon']; ?>" width="24" height="24">
                                <a href="file_content.php?file=<?php echo urlencode($requestPath . '/' . $file['name']); ?>"><?php echo htmlspecialchars($file['name']); ?></td>
                            <td><?php echo date("Y-m-d", $file['last_modified']); ?></td>
                            <td><?php echo $file['size']; ?> octets</td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
        </table>
    </div>
</body>
</html>