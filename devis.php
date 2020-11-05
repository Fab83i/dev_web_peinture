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
   // Vérifier que les champs sont remplis
  $ok="oui";
  if ($_POST['nom']=="") 
   {
    if ($_POST['prenom']=="")
     {    
      $message="Oups ... Vous avez oublié de nous donner votre nom. Donnez au moins votre prénom pour pouvoir vous identifier";
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
  if (strlen($_POST['cp'])<5)
   {
    $message="Merci de renseigner correctement le code postal pour situer les travaux à effectuer.";
    $ok="non";  
   }
  if (strlen($_POST['cp'])>5)
   {
    $message="Merci de renseigner correctement le code postal pour situer les travaux à effectuer.";
    $ok="non";  
   } 
    
  preg_match("[0-9]",$_POST['cp'],$result); 
  if (!empty($result))
   {
    $message="Merci de renseigner correctement le code postal pour situer les travaux à effectuer.";
    $ok="non";  
   }
  if ($_POST['besoin']=="")
   {
    $message="Veuillez décrire, en quelques lignes,  les travaux à faire.";
    $ok="non";  
   }
     
  if ($ok=="oui")
   {
       $besoin=addslashes($_POST['besoin']);
       $besoin=utf8_decode($besoin);
       $nom=utf8_decode($_POST['nom']);
       $prenom=utf8_decode($_POST['prenom']);
	   $insertSQL = sprintf("INSERT INTO devis (ID, Nom, Prenom, Email, Tel, cp, Message) VALUES (%s, %s, %s, %s, %s, %s, %s)",                                       GetSQLValueString($_POST['ID'], "int"),
						   GetSQLValueString($nom, "text"),
						   GetSQLValueString($prenom, "text"),
						   GetSQLValueString($_POST['email'], "text"),
						   GetSQLValueString($_POST['tel'], "text"),
                           GetSQLValueString($_POST['cp'], "text"), 
						   GetSQLValueString($besoin, "text"));
	   $Result1 = mysqli_query($DevWebPeinture_db,$insertSQL);
	   $dest="ec83fr@yahoo.fr,titiplongeur83@yahoo.fr,laurentdeco83@yahoo.fr";
       $from=$_POST['email'];
       $objet="Demande de devis de ".$_POST['prenom']. " ".$_POST['nom'];
       $texte="Vous avez reçu une nouvelle demande de devis.\n";
       $texte=$texte."DE : \n";    
       $texte=$texte."NOM: ".$nom."\n";
       $texte=$texte."Prénom: ".$prenom."\n";
       $texte=$texte."Email: ".$_POST['email']."\n";
       $texte=$texte."Téléphone: ".$_POST['tel']."\n";
       $texte=$texte."Code postal: ".$_POST['cp']."\n";
       $texte=utf8_decode($texte);
       $texte=$texte."Son besoin:\n".utf8_decode($_POST['besoin']);
       $entete="From: ".$from;
       if (mail($dest,$objet,$texte,$entete)) 
	    {
		  $message="Votre devis nous a bien été transmis. Vous aurez de nos nouvelles trés bientôt !"; 
		  $afficheformulaire="non";
		}
		  else {$message="Erreur ! Le message n'a peut être pas été transmis";};
	   
   }
 }
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
    <section>
        <div id="formulaire">
            <?php if ($afficheformulaire=="oui") { ?>
            <?php if ($message<>"") { ?>
            <p class="messErreur"><?php echo $message; ?></p>
            <?php } ?>

            <form action="" method="post" enctype="" name="demande_devis">
                <p class="titre">Veuillez remplir le formulaire ci dessous :</p>
                <p id="avisId">
                    <input name="civilite" type="radio" id="civilite" value="Monsieur" checked="checked" />&nbsp;Monsieur&nbsp;
                    <input name="civilite" type="radio" id="civilite" value="Madame" />&nbsp;Madame&nbsp;
                </p>
                <p id="avisId">
                    <input name="nom" placeholder="Nom" type="text" size="25" value="<?php if (isset($_POST['nom'])){echo $_POST['nom'];} ?>" />
                </p>
                <p id="avisId">
                    <input name="prenom" placeholder="Prénom" type="text" size="25" value="<?php if (isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" /> </p>
                <p id="avisId">
                    <input name="email" type="text" placeholder="Email" size="25" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" />
                </p>
                <p id="avisId">
                    <input name="tel" type="text" placeholder="Téléphone" size="25" value="<?php if (isset($_POST['tel'])){echo $_POST['tel'];} ?>" />
                </p>
                <p id="avisId">
                    <input name="cp" placeholder="Code Postal" type="text" size="25" value="<?php if (isset($_POST['cp'])){echo $_POST['cp'];} ?>" /></p>
                <p id="avisId"><textarea name="besoin" placeholder="Détails de votre besoin" cols="30" rows="5"><?php if (isset($_POST['besoin'])){echo $_POST['besoin'];} ?></textarea></p>
                <p id="avisId">
                    <input class="btn btn-primary btn-lg" name="Envoyer" type="submit" id="Envoyer" value="Envoyer" /></p>
                <p class="information"><input name="ID" type="hidden" id="ID" />&nbsp;</p>
                <p class="information">Les informations demandées dans ce formulaire servent à traiter votre demande et à vous recontacter. Elles ne sont et ne seront en aucun cas cédées à des tiers pour quelque raison que ce soit.
                </p>
            </form>
            <?php } else { ?>
            <p class="messErreur"><?php echo $message; ?></p>
            <?php } ?>
        </div>
    </section>
    <section id="footer">
        <div id="pied"></div>
    </section>
    <p style="text-align: center;">2020 JMP/CouleurArcEnCiel - Tous droits réservés</p>
</body>

</html>
