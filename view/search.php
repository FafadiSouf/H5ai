<?php
include('../modele/index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Barre de recherche</title>
</head>
<body>
    <!-- Flèche de navigation retour -->
    <div class="button">
            <?php if($requestPath !== "/"): ?>
        <a href="../view/home.php">Retour</a>
        <?php endif; ?>
    </div>
    
    <?php
    //Initialise la class H5AI avec le chemin
    $h5AI = new h5AI($requestPath);

        // Verife si la requete existe
        if(isset($_GET['recherche'])) {
            $search = $_GET['recherche'];

            // Effectue une recherche
            $results = $newH5AI->search($search); 
           
            // Affiche les resultats
           echo  "<h3> Résultats de la recherche pour :  $search</h3>";
            if(!empty($results)){
                echo "<ul>";
            }
            foreach($results as $result) {
                echo "<li> $result </li>";
            }
            echo "<ul>";
            } else{
            echo "<p> Aucun résultat trouvé </p>";
        }

    ?>

</body>
</html>

