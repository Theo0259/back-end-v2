<?php session_start(); // Démarre une session ou restaure la session existante
// Récupération des données
if (isset($_SESSION['table'])) $table = $_SESSION['table']; // Récupère les données de la variable de session 'table' et les stocke dans la variable $table
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include './includes/head.inc.html'
    ?>
</head>

<body>
    <?php
    include './includes/header.inc.html'
    ?>

    <div class="container">
        <div class="row">

            <nav class="col-md-3 mt-3">

                <a href="index.php"><button type="button" class="btn btn-light w-100">Home</button></a>

                <!-- Si $_SESSION['table'] est défini alors affiche la liste de ul.php -->
                <?php
                if (isset($_SESSION['table']))
                    include_once './includes/ul.inc.php';

                ?>

            </nav>

            <section class="col-md-9 mt-3">

                <!-- Si les paramètres GET 'add' et 'addmore' sont  définis alors on ajoute le formulaire form.html -->
                <?php

                // Si le paramètre 'add' existe dans l'URL
                if (isset($_GET['add'])) {
                    $pageTitle = 'Ajouter des données';
                    $formFile = './includes/form.inc.html';

                    // Sinon, si le paramètre 'addmore' existe dans l'URL
                } elseif (isset($_GET['addmore'])) {
                    $pageTitle = 'Ajouter plus de données';
                    $formFile = './includes/form2.inc.php';
                }

                if (isset($pageTitle) && isset($formFile)) {
                    // Si les variables $pageTitle et $formFile sont définies
                ?>
                    <h2><?php echo $pageTitle; ?></h2>
                    <form action="./index.php" method="post" enctype="multipart/form-data">
                        <?php include_once $formFile; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="form">Enregistrer les données</button>
                        </div>
                    </form>
                    <?php
                }

                // Si les données sont validées alors on initialise un tableau $table
                elseif (isset($_POST['form']) || (isset($_POST['form2']))) {

                    // Création d'un tableau avec les données à sauvegarder
                    $table = [
                        'first_name' => $_POST['first_name'],
                        'name' => $_POST['name'],
                        'age' => $_POST['age'],
                        'size' => $_POST['size'],
                        'gender' => $_POST['gender'],
                    ];
                    // Vérification et ajout des langages sélectionnés
                    if (isset($_POST['HTML'])) {
                        $table['HTML'] =  $_POST['HTML'];
                    }
                    if (isset($_POST['CSS'])) {
                        $table['CSS'] =  $_POST['CSS'];
                    }
                    if (isset($_POST['JS'])) {
                        $table['JS'] =  $_POST['JS'];
                    }
                    if (isset($_POST['PHP'])) {
                        $table['PHP'] =  $_POST['PHP'];
                    }
                    if (isset($_POST['MySQL'])) {
                        $table['MySQL'] =  $_POST['MySQL'];
                    }
                    if (isset($_POST['Bootstrap'])) {
                        $table['Bootstrap'] =  $_POST['Bootstrap'];
                    }
                    if (isset($_POST['Symphony'])) {
                        $table['Symphony'] =  $_POST['Symphony'];
                    }
                    if (isset($_POST['React'])) {
                        $table['React'] =  $_POST['React'];
                    }
                    // Vérification et ajout de la couleur sélectionnée
                    if (isset($_POST['color'])) {
                        $table['color'] = $_POST['color'];
                    }
                    // Vérification et ajout de la date sélectionnée
                    if (isset($_POST['date'])) {
                        $table['date'] = $_POST['date'];
                    }

                    // Traitement du fichier téléchargé (s'il existe)
                    if (isset($_FILES['file'])) {
                        // Récupération des informations sur le fichier téléchargé
                        $name = $_FILES['file']['name']; // Nom original du fichier
                        $type = $_FILES['file']['type']; // Type MIME du fichier
                        $tmpName = $_FILES['file']['tmp_name']; // Chemin temporaire du fichier  
                        $size = $_FILES['file']['size']; // Taille du fichier en octets
                        $error = $_FILES['file']['error']; // Code d'erreur associé au téléchargement    
                        $maxSize = '2000000'; // Taille maximale autorisée pour le fichier (en octets)
                        $allowedExtensions = ['jpg', 'png']; // Extensions de fichiers autorisées

                        // Vérifie si le tableau $_FILES est défini et s'il y a des erreurs lors du téléchargement du fichier
                        if (isset($_FILES) && $error != UPLOAD_ERR_OK) {
                            // Gestion des erreurs lors du téléchargement du fichier
                            if ($error == UPLOAD_ERR_NO_FILE) {
                                $message = 'Aucune image n\'a été inserée';
                            } elseif ($error == UPLOAD_ERR_INI_SIZE || $error == UPLOAD_ERR_FORM_SIZE) {
                                $message = 'La taille du fichier dépasse la limite autorisée';
                            } else {
                                $message = 'Erreur lors du téléchargement du fichier';
                            }
                            echo '<div class="alert alert-danger text-center" role="alert">' . $message . '</div>';
                        }
                        // Vérifie si le fichier a été téléchargé et s'il respecte les conditions requises (extension, taille)
                        elseif (isset($_FILES['file']) && $error == UPLOAD_ERR_OK) {
                            // Vérification de l'extension du fichier
                            
                            $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                            if (!in_array($fileExtension, $allowedExtensions)) {
                                $message = 'L\'extension du fichier est invalide. Les extensions autorisées sont : ' . implode(', ', $allowedExtensions);
                                echo '<div class="alert alert-danger text-center" role="alert">' . $message . '</div>';
                            }
                            // Vérification de la taille du fichier
                            elseif ($size > $maxSize) {
                                $message = 'La taille du fichier dépasse la limite autorisée';
                                echo '<div class="alert alert-danger text-center" role="alert">' . $message . '</div>';
                            }
                            // Si toutes les conditions sont remplies, le fichier est valide
                            else {
                                move_uploaded_file($tmpName, './uploaded/' . $name);
                                $table['img'] = array(
                                    'tmp_name' => $tmpName,
                                    'type' => $type,
                                    'name' => $name,
                                    'size' => $size,
                                    'error' => $error
                                );
                            }
                        }
                    }
                    // Les données du formulaire sont validées. Si 'age' ou 'size' ne sont pas des nombres, un message d'erreur est affiché et la session est détruite. Sinon, les données sont sauvegardées dans la variable de session 'table' et un message de succès est affiché.
                    // Vérifie si la valeur de 'age' n'est pas un nombre
                    if (!is_numeric($_POST['age'])) {
                        echo "<h2>L'age doit être un nombre</h2>";
                        session_destroy();
                        // Vérifie si la valeur de 'size' n'est pas un nombre
                    } elseif (!is_numeric($_POST['size'])) {
                        echo "<h2>la taille doit être un nombre</h2>";
                        session_destroy();
                        // Les données sont valides, elles sont sauvegardées dans la variable de session 'table' et un message de succès est affiché
                    } else {
                        $_SESSION['table'] = $table ;
                        echo '<div class="alert alert-dismissible alert-success">
                        <strong class="d-flex justify-content-center">Données sauvegardées</strong>
                        </div>';
                    }
                }
                // Vérifie si la variable $table est définie (données préalablement sauvegardées)
                elseif (isset($table)) {

                    // Vérifie si le paramètre 'debugging' est présent dans l'URL
                    if (isset($_GET['debugging'])) {
                        echo '<h2> Débogage </h2>'; // Affiche un titre "Débogage"
                        echo '<pre>'; // Balise HTML pour afficher du texte préformaté
                        print_r($_SESSION['table']); // Affiche le contenu de la variable de session 'table'
                        echo '<pre>'; // Fermeture de la balise HTML

                        // Vérifie si le paramètre 'concatenation' est présent dans l'URL
                    } elseif (isset($_GET['concatenation'])) {
                        // Récupère les valeurs individuelles de la variable de session 'table'
                        $first_name = $_SESSION['table']['first_name'];
                        $name = $_SESSION['table']['name'];
                        $age = $_SESSION['table']['age'];
                        $size = $_SESSION['table']['size'];

                        $tab = $_SESSION['table']; // Copie la variable de session 'table' dans une nouvelle variable $tab
                        function genre($tab)
                        {
                            // Vérifie si le genre dans le tableau est "Homme"
                            if ($tab['gender'] === "Homme") {
                                echo "Mr"; // Affiche "Mr" si le genre est "Homme"
                            } else {
                                echo "Mme"; // Affiche "Mme" si le genre n'est pas "Homme"
                            }
                        }
                        echo "<h1 class='d-flex justify-content-center' >Concaténation</h1> <br>
                            <h3> ===> Construction d'une phrase avec le contenu du tableau</h3>";

                        echo genre($tab) .  " " . $first_name . " " .  $name; // Affiche le genre suivi du prénom et du nom
                        echo " <br> j'ai " . $age . " ans et je mesure "  . $size . " m. <br> <br>"; // Affiche l'âge et la taille

                        echo "<h3> ===> Construction d'une phrase après MAJ du tableau</h3>";
                        $name_maj = strtoupper($name); // Convertit le nom en majuscules
                        echo genre($tab) .  " " . $first_name . " " . $name_maj . "<br>";  // Affiche le genre, le prénom et le nom en majuscules
                        echo "j'ai " . $age . " ans et je mesure "  . $size . " m. <br> <br>"; // Affiche l'âge et la taille

                        echo "<h3> ===> Affichage d'une virgule à la place du point pour la taille</h3>";

                        $size_maj = str_replace(".", ",", $size); // Remplace les points par des virgules dans la taille
                        echo genre($tab) . " " . $first_name . " " . $name_maj . "<br>
                        j'ai " . $age . " ans et je mesure " . $size_maj . "m."; // Affiche le genre, le prénom, le nom en majuscules et la taille avec des virgules
                    } elseif (isset($_GET['loop'])) {
                        echo "<h2> ===> Lecture du tableau à l'aide d'une boucle foreach</h2>
                    <br> <br>";
                        $n = 0; // Initialise une variable pour compter le numéro de ligne    
                        // Parcours du tableau '$_SESSION['table']' avec une boucle foreach
                        foreach ($_SESSION['table'] as $key => $value) {
                            // Si la clé n'est pas 'img', affiche le numéro de ligne, la clé et la valeur correspondante
                            if ($key != 'img') {
                                echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient : " . $value . "<br>";
                                // Si la clé est 'img', affiche le numéro de ligne, la clé et affiche une image en utilisant la valeur correspondante comme nom de fichier
                            } else {
                                echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient : <br>";
                                echo '<img class="mw-100" src="uploaded/' . $value['name'] . '">'; // Affiche une balise HTML pour l'image en utilisant le nom de fichier
                            };
                        }
                    } elseif (isset($_GET['function'])) {
                        echo "<h2> ===> J'utilise ma function Readtable()</h2>
                    <br> <br>";
                        // Définition de la fonction ReadTable()
                        function readTable()
                        {

                            $n = 0; // Initialise une variable pour compter le numéro de ligne
                            // Parcours du tableau '$_SESSION['table']' avec une boucle foreach
                            foreach ($_SESSION['table'] as $key => $value) {
                                // Si la clé n'est pas 'img', affiche le numéro de ligne, la clé et la valeur correspondante
                                if ($key != 'img') {
                                    echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient : " . $value . "<br>";
                                    // Si la clé est 'img', affiche le numéro de ligne, la clé et affiche une image en utilisant la valeur correspondante comme nom de fichier
                                } else {
                                    echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient : <br>";
                                    echo '<img class="mw-100" src="uploaded/' . $value['name'] . '">';
                                }
                            }
                        }
                        readTable(); // Appel de la fonction ReadTable() pour lire et afficher le contenu du tableau

                    } elseif (isset($_GET['del'])) {
                        session_destroy(); // Détruit toutes les données de la session actuelle
                        echo '
                    <div class="alert alert-dismissible alert-info">
                        <strong class="d-flex justify-content-center">Données supprimées</strong>
                    </div>
                    ';
                    ?>

                        <!-- Si la variable $table n'est pas définie ou vide, affiche les boutons pour ajouter des données -->
                <?php
                    }
                } else {
                    echo '<a href="index.php?add"> <button type="button" class="btn btn-primary">Ajouter des données</button></a>';
                    echo '<a href="index.php?addmore"> <button type="button" class="btn btn-secondary">Ajouter plus de données</button></a>';
                }
                ?>
            </section>
        </div>
    </div>
    <?php
    include './includes/footer.inc.html'
    ?>
</body>