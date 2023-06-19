<?php session_start() ?>



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
    <div class="container-fluid">
        <div class="row">


            <nav class="col-md-3 mt-3">



                <a href="?page=index.php"><button type="button" class="btn btn-secondary">Home</button></a>



                <!-- Si add n'est pas défini alours on ajoute le bouton ajouter des données -->
                <?php if (!isset($_GET['add'])) {
                    echo '<a href="index.php?add"> <button type="button" class="btn btn-primary btn">Ajouter des données</button></a>';
                } ?>

                <!-- Si $_SESSION['table'] est défini alors affiche la liste -->
                <?php
                if (isset($_SESSION['table']))
                    include_once './includes/ul.inc.php';

                ?>

            </nav>



            <section class="col-md-9 mt-3">

            <!-- Si add est défini alors on ajoute le formulaire -->
                <?php
                if (isset($_GET['add'])) {
                    include_once './includes/form.inc.html';

                    // Si les données sont valider alors on initialise un tableau $table
                } elseif (isset($_POST['form'])) {
                    $table = [
                        'first_name' => $_POST['first_name'],
                        'name' => $_POST['name'],
                        'age' => $_POST['age'],
                        'size' => $_POST['size'],
                        'gender' => $_POST['gender'],

                    ];
                    if (!is_numeric($_POST['age'])) {
                        echo "<h2>L'age doit être un nombre</h2>";
                        session_destroy();
                    } elseif (!is_numeric($_POST['size'])) {
                        echo "<h2>la taille doit être un nombre</h2>";
                        session_destroy();

                        // Si les vérifications sont bonnes on stock les données dans la session ['table] et on affiche un message
                    } else {
                        $_SESSION['table'] = $table;
                        echo '<div class="alert alert-dismissible alert-success">
                        <strong class="d-flex justify-content-center">Données sauvegardées</strong>
                        </div>';
                    }
                } 

                    if (isset($_GET['debugging'])) {
                        echo '<h2> Débogage </h2>';
                        echo '<pre>';
                        print_r($_SESSION['table']);
                        echo '<pre>';
                    } elseif (isset($_GET['concatenation'])) {

                        $first_name = $_SESSION['table']['first_name'];
                        $name = $_SESSION['table']['name'];
                        $age = $_SESSION['table']['age'];
                        $size = $_SESSION['table']['size'];

                        $tab = $_SESSION['table'];
                        function genre($tab)
                        {
                            if ($tab['gender'] === "Homme") {
                                echo "Mr";
                            } else {
                                echo "Mme";
                            }
                        }
                        echo "<h1 class='d-flex justify-content-center' >Concaténation</h1> <br>
                            <h3> ===> Construction d'une phrase avec le contenu du tableau</h3>";

                        echo genre($tab) .  " " . $first_name . " " .  $name;
                        echo " <br> j'ai " . $age . " ans et je mesure "  . $size . " m. <br> <br>";

                        echo "<h3> ===> Construction d'une phrase après MAJ du tableau</h3>";
                        $name_maj = strtoupper($name);
                        echo genre($tab) .  " " . $first_name . " " . $name_maj . "<br>";
                        echo "j'ai " . $age . " ans et je mesure "  . $size . " m. <br> <br>";

                        echo "<h3> ===> Affichage d'une virgule à la place du point pour la taille</h3>";

                        $size_maj = str_replace(".", ",", $size);
                        echo genre($tab) . " " . $first_name . " " . $name_maj . "<br>
                        j'ai " . $age . " ans et je mesure " . $size_maj . "m.";
                    } elseif (isset($_GET['loop'])) {
                        echo "<h2> ===> Lecture du tableau à l'aide d'une boucle foreach</h2>
                    <br> <br>";
                        $n = 0;
                        foreach ($_SESSION['table'] as $key => $value) {
                            echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient " . $value . "<br>";
                        }
                    } elseif (isset($_GET['function'])) {
                        echo "<h2> ===> J'utilise ma function Readtable()</h2>
                    <br> <br>";
                        function readTable()
                        {
                            $n = 0;
                            foreach ($_SESSION['table'] as $key => $value) {
                                echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient " . $value . "<br>";
                            }
                        }
                        readTable();
                    } elseif (isset($_GET['del'])) {
                        session_destroy();
                        echo '
                    <div class="alert alert-dismissible alert-info">
                        <strong class="d-flex justify-content-center">Données supprimées</strong>
                    </div>
                    ';
                ?>
                    <!-- Refresh la page au bout de 1.3 secondes et retourne à la racine -->
                    <meta http-equiv="refresh" content="1.3; URL=/index.php">

                <?php
                    }
                ?>

            </section>
        </div>
    </div>
    <?php
    include './includes/footer.inc.html'
    ?>
</body>