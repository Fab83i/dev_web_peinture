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
    $message="Oups ... Vous avez oubli&eacute; de nous donner votre nom. Si vous voulez rester anonyme, donnez un pseudo pour pouvoir vous identifier";
    $ok="non";
   }
  if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
   {
   }
     else  
   {
    $message="Il y a une erreur dans votre email ";
    $ok="non";
   } 
  if ($_POST['civilite']=="??")
   {
    $message='Vous avez oubli&eacute; de d&eacute;finir la civilit&eacute;.';
    $ok="non";
   }
  if ($ok=="oui")
   { 
	   $insertSQL = sprintf("INSERT INTO devis (ID, Nom, Prenom, Email, Tel, Message) VALUES (%s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['ID'], "int"),
						   GetSQLValueString($_POST['nom'], "text"),
						   GetSQLValueString($_POST['prenom'], "text"),
						   GetSQLValueString($_POST['email'], "text"),
						   GetSQLValueString($_POST['tel'], "text"),
						   GetSQLValueString($_POST['descriptif'], "text"));
	   $Result1 = mysqli_query($DevWebPeinture_db,$insertSQL);
	   $dest="calvo.eric@orange.fr";
       $from=$_POST['email'];
       $objet="Demande de devis de ".$_POST['prenom']. " ".$_POST['nom'];
       $texte=stripslashes($_POST['descriptif']);
       $entete="From: ".$from;
       if (mail($dest,$objet,$texte,$entete)) 
	    {
		  $message="Votre devis nous a bien &eacute;t&eacute; transmis. Vous aurez de nos nouvelles tr&eacute;s bient&ocirc;t !"; 
		  $afficheformulaire="non";
		}
		  else {$message="Erreur ! Le message n'a peut être pas &eacute;t&eacute; transmis";};
	   
   }
 }
?>

<!DOCTYPE html>
<html>

<head>
    <title> JMP / Couleur arc-en-ciel</title>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale-1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

</head>

    <body>
            <section id="entete">

        <div class=" logo-bandeau">
            <a href="index.html"><img src="images/logo%20groupe.png" width="300"></a>
        </div>

        <nav class="navbar">
            <span class="navbar-toggle" id="js-navbar-toggle">
                <i class="fas fa-bars"></i>
            </span>
            <ul class="main-nav" id="js-menu">
                <li>
                    <a id="btn1" href="savoir-etre.html">
                                <div id="btn1-in"><img id="mouseleave" src="images/savoir-faire.png" width="133px" height="35"> </div>
                                <div id="btn1-out"><img id="mouseenter" src="images/sf-survol.png" width="150px" height="50"></div>
                            </a>
                </li>
                <li>
                    <a id="btn2" href="index.html">
                                <div id="btn2-in"><img id="mouseleave" src="images/accueil-btn.png" width="133px" height="35"> </div>
                                <div id="btn2-out"><img id="mouseenter" src="images/accueil-survol.png" width="150px" height="100%"></div>
                            </a>
                </li>
                <li>
                    <a id="btn3" href="rea.html">
                                <div id="btn3-in"><img id="mouseleave" src="images/rea.png" width="133px" height="35"> </div>
                                <div id="btn3-out"><img id="mouseenter" src="images/rea-survol.png" width="150px" height="100%"></div>
                            </a>
                </li>
                <li>
                    <a id="btn4" href="avis.html">
                                <div id="btn4-in"><img id="mouseleave" src="images/avis.png" width="133px" height="35"> </div>
                                <div id="btn4-out"><img id="mouseenter" src="images/avis-survol.png" width="150px" height="100%"></div>
                            </a>
                </li>
                <li>
                    <a id="btn5" href="contact.html">
                                <div id="btn5-in"><img id="mouseleave" src="images/contact.png" width="133px" height="35"> </div>
                                <div id="btn5-out"><img id="mouseenter" src="images/contact-survol.png" width="150px" height="100%"></div>
                            </a>
                </li>
                <li>
                    <a id="btn6" href="devis.html">
                                <div id="btn6-in"><img id="mouseleave" src="images/devis.png" width="133px" height="35"> </div>
                                <div id="btn6-out"><img id="mouseenter" src="images/devis-survol.png" width="150px" height="100%"></div>
                            </a>
                    
                </li>
            </ul>
        </nav>
    </section>
	<section id="content">
	 <div class="formulaire" id="formulaire">
<?php if ($afficheformulaire=="oui") { ?>
	<form action="" method="post" enctype="application/x-www-form-urlencoded" name="demande_devis">
		<table width="200" border="0" align="center" class="formulaire">
		  <tr>
			<td colspan="2" align="left" valign="middle"><?php echo $message; ?></td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">Civilit&eacute;:</td>
			<td align="left" valign="middle" nowrap="nowrap">
			  <select name="civilite" id="civilite">
			   <option value="??" <?php if ((!isset($_POST['civilite'])) or ($_POST['civilite']=="??")) {echo 'selected="selected"';}?>>??</option>
			   <option value="Madame" <?php if ((isset($_POST['civilite'])) and($_POST['civilite']=="Madame")) {echo 'selected="selected"';}?>>Madame</option>
			   <option value="Monsieur" <?php if ((isset($_POST['civilite'])) and($_POST['civilite']=="Monsieur")) {echo 'selected="selected"';}?>>Monsieur</option>
			  </select>
			</td>
		  </tr>
		
		  <tr>
			<td align="right" valign="middle">NOM:</td>
			<td align="left" valign="middle" nowrap="nowrap"><input name="nom" type="text" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">Pr&eacute;nom:</td>
			<td align="left" valign="middle" nowrap="nowrap"><input name="prenom" type="text" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">Email:</td>
			<td align="left" valign="middle" nowrap="nowrap"><input name="email" type="text" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">T&eacute;l&eacute;phone:</td>
			<td align="left" valign="middle" nowrap="nowrap"><input name="tel" type="text" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">Descriptif des travaux: </td>
			<td align="left" valign="middle"><textarea name="descriptif" cols="" rows=""></textarea>&nbsp;</td>
		  </tr>
  		  <tr>
			<td colspan="2" align="right" valign="middle"><input name="Envoyer" type="submit" value="Envoyer" id="Envoyer" /></td>
		  </tr>
  		  <tr>
			<td colspan="2" align="right" valign="middle"><input type="hidden" name="ID" id="ID" /></td>
		  </tr>
	  </table>
  </form>
  <?php
    } // fin du if
	else {echo $message;}
  ?>	
</div>

	</section>
    </body>
</html>