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

$message=""; 
$afficheformulaire="oui";

if ((isset($_POST["Envoyer"])) && ($_POST["Envoyer"] == "Envoyer")) 
 { // Clic sur bouton envoyer
   // V?rifier que les champs sont remplis
  $ok="oui";
  if ($_POST['nom']=="") 
   {
    if ($_POST['pseudo']=="")
	 {
      $message="Vous avez oublié de nous donner votre nom.Si vous voulez rester anonyme, donnez au moins un pseudo pour pouvoir vous identifier";
      $ok="non";
	 } 
   }
  if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
   {
   }
     else  
   {
    $message="Il y a une erreur dans votre adresse email ";
    $ok="non";
   }
  if ($_POST['commentaire']=="")
   {
    $message="Merci de laisser un commentaire sur notre collaboration.";
    $ok="non";  
   }
    
  if ($ok=="oui")
   {
       $commentaire=addslashes($_POST['commentaire']);
       $commentaire=utf8_decode($commentaire);
       $nom=utf8_decode($_POST['nom']);
       $prenom=utf8_decode($_POST['prenom']);
       $pseudo=utf8_decode($_POST['pseudo']);
 	   $insertSQL = sprintf("INSERT INTO avis (ID, nom, prenom, pseudo, email, vitesse, preparation, qualite, recommandation, contact, commentaire, valide) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['ID'], "int"),
						   GetSQLValueString($nom, "text"),
						   GetSQLValueString($prenom, "text"),
						   GetSQLValueString($pseudo, "text"),
						   GetSQLValueString($_POST['email'], "text"),
						   GetSQLValueString($_POST['Vrating'], "int"),
						   GetSQLValueString($_POST['Prating'], "int"),
						   GetSQLValueString($_POST['Qrating'], "int"),
						   GetSQLValueString($_POST['Rrating'], "int"),
						   GetSQLValueString($_POST['Crating'], "int"),
						   GetSQLValueString($commentaire, "text"),"'non'");
	   $Result1 = mysqli_query($DevWebPeinture_db,$insertSQL);
       $dest="ec83fr@yahoo.fr";
       $from=$_POST['email'];
       $objet=utf8_decode("NOM: ".$nom. " Prénom: ".$prenom." Pseudo:".$pseudo." a donné son avis.");
       $texte="NOTES OBTENUES:\n";
       $texte=$texte."Vitesse éxécution:".$_POST['Vrating']."\n";
       $texte=$texte."Préparation:".$_POST['Prating']."\n";
       $texte=$texte."qualité des travaux:".$_POST['Qrating']."\n";
       $texte=$texte."recommandation:".$_POST['Rrating']."\n";
       $texte=$texte."Contact humain:".$_POST['Crating']."\n";
       $texte=utf8_decode($texte);
       $texte=$texte."Son commentaire:\n".utf8_decode($_POST['commentaire']);
       $entete="From: ".$from;
       if (mail($dest,$objet,$texte,$entete)) 
	    {
		  $message="Votre avis a bien été enregistré. Merci pour votre participation."; 
		  $afficheformulaire="non";
		}
		  else {$message="Une erreur s'est produite. Le message n'a peut être pas été enregistré";};
    }
 }
 
 
 // chargement de l'avis 
 $query_avis = "SELECT * FROM avis";
 $query_avis = $query_avis." WHERE valide = 'oui'";
 $avisdb = mysqli_query($DevWebPeinture_db,$query_avis);
 $row_avis = mysqli_fetch_assoc($avisdb);
 

?>

<!DOCTYPE html>
<html>

<head>
    <title> JMP / Couleur arc-en-ciel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale-1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="peinture, décoration, rénovation, peinture var, décoration var, peinture 83, peinturedeco83, savoir-faire, société de peinture, site internet peinture, intérieure, extérieure, 83, var, picard, Laurent, Jean Marie, jean, Marie">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/style-rea.css">
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
                    <a id="btn3" href="rea-previous.html">
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
    <div id="avis-cat">
        <p class="titre">Ce qu'ils disent de nous</p>
        <div id="monCarousel" class="carousel slide" data-ride="carousel" style="width: 800px text-align:center">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <p id="avisId"><?php if ($row_avis['pseudo']<>"") {echo '"'.$row_avis['pseudo'].'" a dit:';} else {echo $row_avis['nom']." a dit:";}?></p>
                    <p id="avisId"><?php echo '"'.utf8_encode($row_avis['commentaire']).'"';?></p>
                    <p id="levelId">
                        Vitesse d'éxécution &nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['vitesse']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Préparation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['preparation']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Qualité des travaux &nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['qualite']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Recommandation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['recommandation']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Contact humain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['contact']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                </div>
                <?php 
		     $row_avis = mysqli_fetch_assoc($avisdb);
             do
              { 
			?>
                <div class="item">
                    <p id="avisId"><?php if ($row_avis['pseudo']<>"") {echo '"'.$row_avis['pseudo'].'" a dit:';} else {echo $row_avis['nom']." a dit:";}?></p>
                    <p id="avisId"><?php echo '"'.utf8_encode($row_avis['commentaire']).'"';?></p>
                    <p id="levelId">
                        Vitesse d'éxécution &nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['vitesse']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['vitesse']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Préparation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['preparation']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['preparation']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Qualité des travaux &nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['qualite']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['qualite']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Recommandation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['recommandation']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['recommandation']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                    <p id="levelId">
                        Contact humain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="star-on.svg" width="20" height="20" alt="" />
                        <?php if ($row_avis['contact']>=2) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=3) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=4) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                        <?php if ($row_avis['contact']>=5) { ?><img src="star-on.svg" width="20" height="20" alt="" /> <?php }?>
                    </p>
                </div>
                <?php } while ($row_avis = mysqli_fetch_assoc($avisdb));?>
            </div>
            <a href="#monCarousel" class="left carousel-control" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" style="color: black"></span></a>
            <a href="#monCarousel" class="right carousel-control" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" style="color: black"></span></a>
        </div>
    </div>
    <div id="formulaire">
        <?php if ($afficheformulaire=="oui") { ?>
        <?php if ($message<>"") { ?>
        <p class="messErreur"><?php echo $message; ?></p>
        <?php } ?>

        <form action="" method="post" enctype="" name="demande_avis">
            <p class="titre">Que pensez vous de nous ?</p>
            <p class="soustitre">Votre identité</p>

            <p id="avisId"><input name="nom" placeholder="Nom" type="text" size="25" value="<?php if (isset($_POST['nom'])){echo $_POST['nom'];} ?>" />
            </p>
            <p id="avisId"><input name="prenom" placeholder="Prénom" type="text" size="25" value="<?php if (isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" />
            </p>
            <p id="avisId"><input name="pseudo" placeholder="Pseudo" type="text" size="25" value="<?php if (isset($_POST['pseudo'])){echo $_POST['pseudo'];} ?>" />
            </p>
            <p id="avisId"><input name="email" placeholder="Email" type="text" size="25" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" />
            </p>
            <p class="soustitre">Votre avis</p>
            <p id="avisId">Vitesse d'éxécution <span style="font-style: italic; font-size: 14px">(Ponctualité, temps de travail)</span>:</p>
            <p class="starRating" align="left">
                <input id="Vrating5" type="radio" name="Vrating" value="5" <?php if ((isset($_POST['Vrating'])) and ($_POST['Vrating']=="5")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Vrating5">5</label>
                <input id="Vrating4" type="radio" name="Vrating" value="4" <?php if ((isset($_POST['Vrating'])) and ($_POST['Vrating']=="4")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Vrating4">4</label>
                <input id="Vrating3" type="radio" name="Vrating" value="3" <?php if ((isset($_POST['Vrating'])) and ($_POST['Vrating']=="3")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Vrating3">3</label>
                <input id="Vrating2" type="radio" name="Vrating" value="2" <?php if ((isset($_POST['Vrating'])) and ($_POST['Vrating']=="2")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Vrating2">2</label>
                <input id="Vrating1" type="radio" name="Vrating" value="1" <?php if ((!isset($_POST['Vrating'])) or ($_POST['Vrating']=="1")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Vrating1">1</label>
            </p>
            <p id="avisId">Préparation <span style="font-style: italic; font-size: 14px">(Protection des éléments, nettoyage)</span>:</p>
            <p class="starRating" align="left">
                <input id="Prating5" type="radio" name="Prating" value="5" <?php if ((isset($_POST['Prating'])) and ($_POST['Prating']=="5")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Prating5">5</label>
                <input id="Prating4" type="radio" name="Prating" value="4" <?php if ((isset($_POST['Prating'])) and ($_POST['Prating']=="4")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Prating4">4</label>
                <input id="Prating3" type="radio" name="Prating" value="3" <?php if ((isset($_POST['Prating'])) and ($_POST['Prating']=="3")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Prating3">3</label>
                <input id="Prating2" type="radio" name="Prating" value="2" <?php if ((isset($_POST['Prating'])) and ($_POST['Prating']=="2")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Prating2">2</label>
                <input id="Prating1" type="radio" name="Prating" value="1" <?php if ((!isset($_POST['Prating'])) or ($_POST['Prating']=="1")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Prating1">1</label>
            </p>
            <p id="avisId">Qualité des travaux <span style="font-style: italic; font-size: 14px">(Professionnalisme, serieux, qualité d'éxécution)</span>:</p>
            <p class="starRating" align="left">
                <input id="Qrating5" type="radio" name="Qrating" value="5" <?php if ((isset($_POST['Qrating'])) and ($_POST['Qrating']=="5")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Qrating5">5</label>
                <input id="Qrating4" type="radio" name="Qrating" value="4" <?php if ((isset($_POST['Qrating'])) and ($_POST['Qrating']=="4")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Qrating4">4</label>
                <input id="Qrating3" type="radio" name="Qrating" value="3" <?php if ((isset($_POST['Qrating'])) and ($_POST['Qrating']=="3")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Qrating3">3</label>
                <input id="Qrating2" type="radio" name="Qrating" value="2" <?php if ((isset($_POST['Qrating'])) and ($_POST['Qrating']=="2")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Qrating2">2</label>
                <input id="Qrating1" type="radio" name="Qrating" value="1" <?php if ((!isset($_POST['Qrating'])) or ($_POST['Qrating']=="1")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Qrating1">1</label>
            </p>
            <p id="avisId">Recommandation <span style="font-style: italic; font-size: 14px">(Nous recommanderiez-vous ?)</span>:</p>
            <p class="starRating" align="left">
                <input id="Rrating5" type="radio" name="Rrating" value="5" <?php if ((isset($_POST['Rrating'])) and ($_POST['Rrating']=="5")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Rrating5">5</label>
                <input id="Rrating4" type="radio" name="Rrating" value="4" <?php if ((isset($_POST['Rrating'])) and ($_POST['Rrating']=="4")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Rrating4">4</label>
                <input id="Rrating3" type="radio" name="Rrating" value="3" <?php if ((isset($_POST['Rrating'])) and ($_POST['Rrating']=="3")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Rrating3">3</label>
                <input id="Rrating2" type="radio" name="Rrating" value="2" <?php if ((isset($_POST['Rrating'])) and ($_POST['Rrating']=="2")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Rrating2">2</label>
                <input id="Rrating1" type="radio" name="Rrating" value="1" <?php if ((!isset($_POST['Rrating'])) or ($_POST['Rrating']=="1")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Rrating1">1</label>
            </p>
            <p id="avisId">Contact humain <span style="font-style: italic; font-size: 14px">(Dialogue, échange d'idées, communication)</span>:</p>
            <p class="starRating" align="left">
                <input id="Crating5" type="radio" name="Crating" value="5" <?php if ((isset($_POST['Crating'])) and ($_POST['Crating']=="5")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Crating5">5</label>
                <input id="Crating4" type="radio" name="Crating" value="4" <?php if ((isset($_POST['Crating'])) and ($_POST['Crating']=="4")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Crating4">4</label>
                <input id="Crating3" type="radio" name="Crating" value="3" <?php if ((isset($_POST['Crating'])) and ($_POST['Crating']=="3")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Crating3">3</label>
                <input id="Crating2" type="radio" name="Crating" value="2" <?php if ((isset($_POST['Crating'])) and ($_POST['Crating']=="2")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Crating2">2</label>
                <input id="Crating1" type="radio" name="Crating" value="1" <?php if ((!isset($_POST['Crating'])) or ($_POST['Crating']=="1")) {?> checked="checked">
                <?php } else {echo ">";};?>
                <label for="Crating1">1</label>
            </p>
<!--            <p class="soustitre">Votre commentaire:</p>-->
            <p id="avisId"><textarea name="commentaire" placeholder="Votre commentaire ..." cols="30" rows="8"><?php if (isset($_POST['commentaire'])){echo $_POST['commentaire'];} ?></textarea></p>
            <p id="avisId"><input class="btn btn-primary btn-lg" name="Envoyer" type="submit" id="Envoyer" value="Envoyer" /></p>
            <p class="information"><input name="ID" type="hidden" id="ID" />&nbsp;</p>
        </form>
        <?php } else { ?>
        <p class="messErreur"><?php echo $message; ?></p>
        <?php } ?>
    </div>
    <section id="footer">
        <div id="pied"></div>
    </section>
    <p style="text-align: center;">2020 JMP/CouleurArcEnCiel - Tous droits réservés</p>
</body>

</html>
