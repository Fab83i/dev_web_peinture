<!DOCTYPE html>
<?php
require_once('DevWebPeinture_db.php'); 
$DevWebPeinture_db = mysqli_connect($hostname_DevWebPeinture_db, $username_DevWebPeinture_db, $password_DevWebPeinture_db, $database_DevWebPeinture_db);
$erreur=mysqli_connect_errno();
if ($erreur<>0) {echo "echec lors de la connexion: ".$erreur;} 
echo mysqli_connect_error();

if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  switch ($theType) 
	   {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? floatval($theValue)  : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	   } // fin du switch
	  return $theValue;
	} // fin de la fonction
} // fin du if

 // chargement de l'avis 
 $query_avis = "SELECT * FROM avis";
 $query_avis = $query_avis." WHERE valide = 'oui'";
 $avisdb = mysqli_query($DevWebPeinture_db,$query_avis);
 $row_avis = mysqli_fetch_assoc($avisdb);

 // chargement de la note moyenne

$query_avg = "SELECT AVG(`vitesse`), AVG(`preparation`), AVG(`qualite`), AVG(`recommandation`), AVG(`contact`) FROM avis";
$avg_db = mysqli_query($DevWebPeinture_db,$query_avg);
$row_avg = mysqli_fetch_assoc($avg_db);

$somme = 0;
foreach($row_avg as $key => $value){
    $somme+= $value;
}
$moyenne = round($somme/5,1);

?>

<html>

<head>
    <title> Peinture deco 83</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale-1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Bienvenue chez JMP&Couleur-arc-en-ciel. Décoration, rénovation, peinture intérieure ou extérieure, nous ferons de notre mieux pour satisfaire toutes vos envies et faire de votre chez vous quelque chose qui vous tient à coeur.">
    <meta name="revised" content="05/11/2020" `>
    <meta name="keywords" content="peinture, décoration, rénovation, peinture var, décoration var, peinture 83, peinturedeco83, savoir-faire, société de peinture, site internet peinture, intérieure, extérieure, 83, var, picard, Laurent, Jean Marie, jean, Marie">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Signika&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo%20groupe.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/style-rea.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42232039-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-42232039-4');
    </script>

</head>

<body>

    <section id="entete">

        <div class=" logo-bandeau">
            <a href="index.php"><img src="images/logo%20groupe.png" width="500"></a>
        </div>

        <nav class="navbar">
            <span class="navbar-toggle" id="js-navbar-toggle">
                <i class="fas fa-bars"></i>
            </span>
            <ul class="main-nav" id="js-menu">
                <li>
                    <a id="btn1" href="savoir-etre.html">
                        <div id="btn1-in"><img id="mouseleave" src="images/btn/savoir-faire.png" width="171px" height="64"> </div>
                        <div id="btn1-out"><img id="mouseenter" src="images/btn/sf-survol.png" width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn2" href="index.php">
                        <div id="btn2-in"><img id="mouseleave" src="images/btn/accueil-btn.png" width="171px" height="64"> </div>
                        <div id="btn2-out"><img id="mouseenter" src="images/btn/accueil-survol.png" width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn3" href="rea.html">
                        <div id="btn3-in"><img id="mouseleave" src="images/btn/rea.png" width="171px" height="64"> </div>
                        <div id="btn3-out"><img id="mouseenter" src="images/btn/rea-survol.png" width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn4" href="avis.php">
                        <div id="btn4-in"><img id="mouseleave" src="images/btn/avis.png" width="171px" height="64"> </div>
                        <div id="btn4-out"><img id="mouseenter" src="images/btn/avis-survol.png" width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn5" href="contact.html">
                        <div id="btn5-in"><img id="mouseleave" src="images/btn/contact.png" width="171px" height="64"> </div>
                        <div id="btn5-out"><img id="mouseenter" src="images/btn/contact-survol.png" width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn6" href="devis.php">
                        <div id="btn6-in"><img id="mouseleave" src="images/btn/devis.png" width="171px" height="64"> </div>
                        <div id="btn6-out"><img id="mouseenter" src="images/btn/devis-survol.png" width="171px" height="64"></div>
                    </a>

                </li>
            </ul>
        </nav>

    </section>


    <!--ANIMATION ACCUEIL-->
    <section id="main">
        <div id="adapt-accueil">
            <div id="accueil">
                <div id="overlay">
                    <div>
                        <h2 id="bienvenue" style="font-weight: bold"> Nos prestations</h2>
                        <h3 id="accueil-part1"> Peinture intérieure</h3>
                        <h3 id="accueil-part2"> décoration</h3>
                        <h3 id="accueil-part3"> peinture extérieure</h3>
                        <h3 id="accueil-part4"> rénovation</h3>
                    </div>
                </div>
            </div>
            <div id="accueil-smart">
                <div id="overlay-smart">
                    <div>
                        <h2 id="bienvenue-smart" style="font-weight: bold"> Nos prestations</h2>
                        <h3 id="accueil-part1-smart"> Peinture intérieure</h3>
                        <h3 id="accueil-part2-smart"> décoration</h3>
                        <h3 id="accueil-part3-smart"> peinture extérieure</h3>
                        <h3 id="accueil-part4-smart"> rénovation</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--FIN ANIMATION ACCUEIL-->

    <!--AVIS CLIENTS-->
    <div id="avis-cat">
        <h2 id="avis-texte">Ce qu'ils disent de nous</h2>
        <div id="monCarousel" class="carousel slide" data-ride="carousel" style="width: 800px text-align:center">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <p><?php
                        if ($row_avis['pseudo']<>"") {
                            echo '"'.$row_avis['pseudo'].'" a dit:';
                        }
                        else {
                            echo $row_avis['nom'].' a dit:';
                        }
                        ?>
                    </p>
                    <p><?php echo '"'.utf8_encode($row_avis['commentaire']).'"';?></p>
                </div>
                <?php 
		     $row_avis = mysqli_fetch_assoc($avisdb);
             do
              { 
			?>
                <div class="item">
                    <p><?php
                        if ($row_avis['pseudo']<>"") {
                            echo '"'.$row_avis['pseudo'].'" a dit:';
                        }
                        else {
                            echo $row_avis['nom']." a dit:";
                        }?>
                    </p>
                    <p><?php echo '"'.utf8_encode($row_avis['commentaire']).'"';?></p>
                </div>
                <?php } while ($row_avis = mysqli_fetch_assoc($avisdb));?>
            </div>
            <a href="#monCarousel" class="left carousel-control" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" style="color: black"></span></a>
            <a href="#monCarousel" class="right carousel-control" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" style="color: black"></span></a>
        </div>



    </div>

    <style>
        /* DYSFONCTIONNEMENT DE CE STYLE DANS style.css */

        /* MISE EN STYLE DU BADGE NOTE MOYENNE */

        #emplacement_badge {
            margin: 0px auto 30px auto;
            width: 250px;
            height: 239px;
            background-image: url(images/badge.png);
            background-size: cover;
            text-align: center;
        }

        #emplacement_badge p {
            padding-top: 33%;
            color: white;
            font-size: 50px;
        }

    </style>


    <div id="emplacement_badge">
        <p><?php echo $moyenne; ?>/5</p>
    </div>

    <!--FIN AVIS CLIENTS-->

    <!--LISTING DES FOURNISSEURS-->
    <section id="secteurs">
        <div id="list-sectors">
            <h2 id="fournisseurs-titre">des fournisseurs de qualité</h2>
            <ul id="activite">
                <li id="act-1"><img src="images/fournisseurs/ZOLPAN.png" width="200px"></li>
                <li id="act-2"><img src="images/fournisseurs/cdo_logo.png" width="120px"></li>
                <li id="act-3"><img src="images/fournisseurs/logo_seigneurie1.png" width="200px"></li>
            </ul>
        </div>
    </section>
    <!--FIN LISTING DES FOURNISSEURS-->



    <!--PIED DE PAGE-->
    <section id="footer">
        <div id="pied">
        </div>
    </section>


    <p style="text-align: center;">
        2020 JMP/CouleurArcEnCiel - Tous droits réservés
    </p>

</body>

</html>
