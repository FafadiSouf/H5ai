<?php

class H5AI{

    //Declaration d'une proprieter
    private $_path; 

    public function __construct($_path){
        $this->_path = $_path;
    }

    // Recuperer tout les noms des fichiers 
    public function getFiles($path = null) { 
        if($path === null){
        $path = $this->_path;
        }
        $files =[];
        $directories = [];
    
        // Ouvre le gestionnaire de fichier
        if($handle= opendir($path)){
            while(false !== ($entry = readdir($handle))) {
                $fullPath = $path . "/" . $entry;
                if(is_dir($fullPath)) {
                    $directories[] = $entry;
                }else {
                    $extension = pathinfo($entry, PATHINFO_EXTENSION);
                    $files[] = [
                        'name' => $entry,
                        'size' => filesize($fullPath), //Recupere la taille des fichiers
                        'last_modified' =>filemtime($fullPath), //Recupere derniere modification des fichiers
                        'icon' =>$this->getIcon($extension) // Recupere l'icone correspondante
                    ];
                    // $files[] =$file;    
                }
            
            }
            //Ferme le gestionnaire de fichier
            closedir($handle);
        }
        return [
        'files' => $files,
        'directories' => $directories
        ];

    }

    //Ouvre le contenu d'un fichier
    public function getFileContent($filePath) {
        if(is_file($filePath) && is_readable($filePath)) {
            return file_get_contents($filePath);
        } else {
            return false;
        }
    }

   //  Fonction pour chaque type de fichier
   private function getIcon($extension) {
    $fileIcons = [
        'txt' => 'txt.svg',
        'pdf' => 'pdf.svg',
        'jpg' => 'img.svg',
        'css' => 'css.svg',
        'html' => 'html.svg',
        'js' => 'js.svg',
        'php' => 'php.svg',
        'sql' => 'sql.svg',
        'folder' => 'folder.svg'
    ]; 

    // On associe l'icone à l'extension
    if(array_key_exists($extension, $fileIcons)) {
        return $fileIcons[$extension];
    } else {
        return 'default_icon.png';
    }
    }

    // Fonction pour rechercher des fichiers et dossiers
    public function search($keyword) {
        $result = [];

        // Ouvre le gestionnaire de fichier
        if($handle = opendir($this->_path)) {
            // Parcours tout les éléments
            while(false !== ($entry = readdir($handle))) {
            // Verife si l'element correspond a la recherche
            if(strpos($entry, $keyword) !== false) {
                $results[] = $entry;
            }
            }
            // Ferme le gestionnaire de fichier 
            closedir($handle);
        }
        // Retourne les resultats de la recherche
        return $results;
    }

    // Fonction pour le favicon 
    // public function favicon($filename) {
    //     $extension = pathinfo($filename, PATHINFO_EXTENSION);
    //     if($extension == 'html') {
    //     return '<link rel="shortcut icon" href="../svg/html.svg" type="image/x-icon">';
    // }
    // return '';
    // }
 
}
    //On recupere le chemin complet Breadcrumb
    $currentPath = isset($_GET['dir']) ? $_GET['dir'] : "/home/epitech7/W-PHP-501-LYN-1-1-mymeetic-rafadhia.houmadi";
    // On divise le chemin en parties
    $pathParts = explode('/', $currentPath); 

//Ouvre un dossier 
if(isset($_GET['dir'])){
    $requestPath = $_GET['dir'];
} else {
    $requestPath = "/home/epitech7/W-PHP-501-LYN-1-1-mymeetic-rafadhia.houmadi"; 
}

$newH5AI = new H5AI($requestPath);
$filesDirectories = $newH5AI->getFiles();
