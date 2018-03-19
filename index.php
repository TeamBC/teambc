<?php
/*
 * Fonction d'autochargement de l'ensemble des classes du projet
 * 
 * La fonction charge toutes les classes nécessaire au projet
 * si les classses sont placées dans le dossier classes
 */
function chargerMesClasses($classes) {
    require 'classes/' . $classes . '.php';
}
spl_autoload_register('chargerMesClasses');
session_start(); // Démarrage de la session
// Desctruction de la session grâce au lien Déconnexion
// Pour permettre l'utilisation d'un autre personnage sur le même ordinateur
// Ou alors la création d'un nouveau personnage
if (isset($_GET['deconnexion'])) {
    session_destroy();
    header('Location: .');
    exit();
}
// Si la session perso existe, on restaure l'objet
if (isset($_SESSION['perso'])) {
    $perso = $_SESSION['perso'];
}
$db = new PDO('mysql:host=localhost;dbname=MiniJeuCombat', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
//$db = new ConfigurationPDO(); // Utilisation d'une instance de la class PDO pour la connexion à la BDD
//$bdd = $db->bdd();
$manager = new PersonnagesManager($db);

    
if (isset($_POST['utiliser']) && isset($_POST['personnageNom'])) // Si souhait utilisation d'un personnage existant
{
    if ($manager->ifPersonnageExist($_POST['personnageNom'])) // SI le personnage existe
    {
        $perso = $manager->getPersonnage($_POST['personnageNom']);
    }
    else
    {
        $message = 'Ce personnage n\'existe pas'; // Message si le personnage n'existe pas
    }
}
// Si on clique sur la 1ère attack !! 
elseif (isset($_GET['frapperUnPersonnage']))
{   

        if (!$manager->ifPersonnageExist((int) $_GET['frapperUnPersonnage']))
        {
            $message = 'Le personnage que vous voulez attaquer n\'existe pas';
        }
        
        else
        {
            $persoAFrapper = $manager->getPersonnage((int) $_GET['frapperUnPersonnage']);
            
            // Gestion d'affichage des erreurs renvoyés par la méthode frapperUnPersonnage
            $retour = $perso->frapperUnPersonnage($persoAFrapper);
            
            switch ($retour)
            {
                case Personnage::DETECT_ME :
                    $message = 'Mais...c\'est moi...Stupid idiot !!!';
                    
                    break;
                
                case Personnage::PERSO_COUP :
                    $message = 'Le personnage a bien été atteint';
                    
                    $manager->updatePersonnage($perso);
                    $manager->updatePersonnage($persoAFrapper);
                    
                    break;
                
                case Personnage::PERSO_DEAD :
                    $message = 'Vous avez tué ce personnage !';
                    $manager->reUpPersonnage($perso);
                    $manager->reUpPersonnage($persoAFrapper);
                    
                    break;
            }
        }
}elseif (isset($_GET['frapperUnPersonnage2']))
{   

        if (!$manager->ifPersonnageExist((int) $_GET['frapperUnPersonnage2']))
        {
            $message = 'Le personnage que vous voulez attaquer n\'existe pas';
        }
        
        else
        {
            $persoAFrapper = $manager->getPersonnage((int) $_GET['frapperUnPersonnage2']);
            
            // Gestion d'affichage des erreurs renvoyés par la méthode frapperUnPersonnage
            $retour = $perso->frapperUnPersonnage2($persoAFrapper);
            
            switch ($retour)
            {
                case Personnage::DETECT_ME :
                    $message = 'Mais...c\'est moi...Stupid idiot !!!';
                    
                    break;
                
                case Personnage::PERSO_COUP :
                    $message = 'Le personnage a bien été atteint';
                    
                    $manager->updatePersonnage($perso);
                    $manager->updatePersonnage($persoAFrapper);
                    
                    break;
                
                case Personnage::PERSO_DEAD :
                    $message = 'Vous avez tué ce personnage !';
                    $manager->reUpPersonnage($perso);
                    $manager->reUpPersonnage($persoAFrapper);
                    
                    break;
            }
        }
}elseif (isset($_GET['frapperUnPersonnage3']))
{   

        if (!$manager->ifPersonnageExist((int) $_GET['frapperUnPersonnage3']))
        {
            $message = 'Le personnage que vous voulez attaquer n\'existe pas';
        }
        
        else
        {
            $persoAFrapper = $manager->getPersonnage((int) $_GET['frapperUnPersonnage3']);
            
            // Gestion d'affichage des erreurs renvoyés par la méthode frapperUnPersonnage
            $retour = $perso->frapperUnPersonnage3($persoAFrapper);
            
            switch ($retour)
            {
                case Personnage::DETECT_ME :
                    $message = 'Mais...c\'est moi...Stupid idiot !!!';
                    
                    break;
                
                case Personnage::PERSO_COUP :
                    $message = 'Le personnage a bien été atteint';
                    
                    $manager->updatePersonnage($perso);
                    $manager->updatePersonnage($persoAFrapper);
                    
                    break;
                
                case Personnage::PERSO_DEAD :
                    $message = 'Vous avez tué ce personnage !';
                    $manager->reUpPersonnage($perso);
                    $manager->reUpPersonnage($persoAFrapper);
                    
                    break;
            }
        }
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - basé sur le MOOC POO - PHP OpenClassrooms">
        <meta name="keywords" content="POO, PHP, Bootstrap">
        <meta name="author" content="Christophe Malo">
            
        <title>Mini jeu de combat - POO - PHP</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css"  href="css/style.css" media="all"> 
    </head>
    <body>
        <div class="container">
        <!-- Header
        ================================================== -->
            <header class="row col-sm-12">
                <h1>Mini jeu de combat - POO - PHP</h1>
            </header>
        
        <!-- Section Contenu
        ================================================== -->
            <section id="infos" class="row col-sm-12">
                <p>
                    <?php
                        if (isset($message)) {  // Si message à afficher
                            echo $message;      // on affiche le message
                        }
                    ?>
                </p>
            </section>
        
        <!-- Section Personnage
        ================================================== -->
            <?php
            // Si utilisation d'un personnage
            if (isset($perso)) {
            ?>
                <div class="row col-sm-12"><a class="btn btn-default btn-lg pull-right" href="?deconnexion=1" role="button">Déconnexion</a></div>
                <section class="row col-sm-12">
                    <fieldset>
                        <legend>Mes informations</legend>
                        <p>
                            Nom : <?= htmlspecialchars($perso->getNom()) ?><br>
                            Dégâts : <?= $perso->getDegats() ?><br>
                            Type : <?= ucfirst($perso->getType()) ?><br>
                        </p>
                        <p>
                          <?php $persos = $manager->getListPersonnages($perso->getNom());
 
                            foreach ($persos as $onePerson) { ?>
                                Nom : <?= htmlspecialchars($onePerson->getNom()) ?><br>
                                Dégâts : <?= $onePerson->getDegats() ?><br>
                                Type : <?= ucfirst($onePerson->getType()) ?><br>
                                <?php
                                // Affichage Atout du personnage selon son type
                                switch ($onePerson->getType()) {
                                    case 'guerrier' :
                                        echo 'Protection : ';
                                        break;
                                    case 'magicien' :
                                        echo 'Magie : ';
                                        break;
                                }
                            }                            
                            ?>
                        </p>
                    </fieldset>
                    <fieldset>
                        <legend>Qui frapper ?</legend>
                        <p>
                        <?php
                        // R2cupérer la liste de tous les personnages par ordre alphabétique dont le nom est différent du personnage choisi
                            $persos = $manager->getListPersonnages($perso->getNom());
                            
                            if (empty($persos)) {
                                echo 'Il n\'y aucun adversaire';
                            }
                                
                                else {
                                    foreach ($persos as $onePerson) {
                                        echo '<a href="?frapperUnPersonnage=' . $onePerson->getId() . '">' . 'Attack1 ';
                                        echo '<a href="?frapperUnPersonnage2=' . $onePerson->getId() . '">' . 'Attack2 ';
                                        echo '<a href="?frapperUnPersonnage3=' . $onePerson->getId() . '">' . 'Attack3 ' . '</a> (Dégats : ' . $onePerson->getDegats() . ' - type : ' . $onePerson->getType() . ')'; 
 
                                        echo '<br>';
                                    }
                                }
                            
                        ?>
                        </p>
                    </fieldset>
                </section>
            
            <?php
            } else { // Si utilisation d'un personnage, formulaire n'est pas affiché
            ?>
        <!-- Section Formulaire saisie - choix
        ================================================== -->
                <section class="row col-sm-12">
                    <form class="form-horizontal" method="post">
                        <!-- Champ de saisie texte une ligne -->
                        <div class="form-group form-group-lg">
                            <label for="personnageNom" class="col-xs-12 col-sm-4 col-md-3 control-label">Nom du personnage : </label>
                            <div class="col-xs-12 col-sm-8 col-md-9 focus"> 
                                <input class="form-control input-lg" type="text" name="personnageNom" id="prenom" placeholder="Nom du personnage" autofocus required />
                            </div>
                            
                        </div>
                        <div class="form-group form-group-lg">
                            <label for="personnageType" class="col-xs-12 col-sm-4 col-md-3 control-label">Type du personnage : </label>
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <select class="form-control input-lg" name="personnageType">
                                    <option value="magicien">Magicien</option>
                                    <option value="guerrier">Guerrier</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default btn-lg pull-right" value="Créer le personnage" name="creer">Créer le personnage</button>
                        <button type="submit" class="btn btn-default btn-lg pull-right" value="Utiliser le personnage" name="utiliser">Utiliser le personnage</button>
                    </form>
                </section>
        <?php
            }
        ?>
        <!-- Footer
        ================================================== -->
            <footer class="row col-sm-12">
                <p>Copyright 2015 Openclassrooms - Adaptation Christophe Malo</p> 
            </footer>
        </div>
    </body>
</html>
<?php
// Si création d'un personnage alors stockage dans une variable SESSION pour économie requête SQL
if (isset($perso)) {
    $_SESSION['perso'] = $perso;
    
     //Débug variable $_SESSION
    echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';
}
?>