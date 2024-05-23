<?php
include('../modele/index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu du fichier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
        <!-- Flèche de navigation retour -->
        <div class="button">
            <?php if($requestPath !== "/"): ?>
        <a href="../view/home.php">Retour</a>
        <?php endif; ?>
    </div>
<?php
// Ouvrir un fichier
if(isset($_GET['file'])) {
    $filePath = $_GET['file'];
    $h5ai = new H5AI('');
    $fileContent = $h5ai->getFileContent($filePath);
    if($fileContent !== false) {
        echo '<pre>' . htmlspecialchars($fileContent) . '</pre>';
    } else {
        echo 'Impossible de lire le fichier';
    }
}else {
    $content = '';
} 
?>

</div>
   
</body>
</html>