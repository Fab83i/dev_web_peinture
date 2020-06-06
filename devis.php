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
		  else {$message="Erreur ! Le message n'a peut ?tre pas &eacute;t&eacute; transmis";};
	   
   }
 }
?>

<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/modele.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <title> JMP / Couleur arc-en-ciel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale-1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/style.css">
	<link rel="stylesheet" href="/style1.css">
	<link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/script.js"></script>

</head>

    <body>
    <section id="entete">

        <div class=" logo-bandeau">
            <a href="/index.html"><img src="/images/logo%20groupe.png" width="500"></a>
        </div>

        <nav class="navbar">
            <span class="navbar-toggle" id="js-navbar-toggle">
                <i class="fas fa-bars"></i>
            </span>
            <ul class="main-nav" id="js-menu">
                <li>
                    <a id="btn1" href="/savoir-etre.html">
                        <div id="btn1-in"><img id="mouseleave" src="/images/btn/savoir-faire.png" width="171px" height="64"> </div>
                        <div id="btn1-out"><img id="mouseenter" src="/images/btn/sf-survol.png"  width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn2" href="/index.html">
                        <div id="btn2-in"><img id="mouseleave" src="/images/btn/accueil-btn.png"  width="171px" height="64"> </div>
                        <div id="btn2-out"><img id="mouseenter" src="/images/btn/accueil-survol.png"  width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn3" href="/rea.html">
                        <div id="btn3-in"><img id="mouseleave" src="/images/btn/rea.png"  width="171px" height="64"> </div>
                        <div id="btn3-out"><img id="mouseenter" src="/images/btn/rea-survol.png"  width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn4" href="/avis.php">
                        <div id="btn4-in"><img id="mouseleave" src="/images/btn/avis.png" width="171px" height="64"> </div>
                        <div id="btn4-out"><img id="mouseenter" src="/images/btn/avis-survol.png"  width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn5" href="/contact.html">
                        <div id="btn5-in"><img id="mouseleave" src="/images/btn/contact.png"  width="171px" height="64"> </div>
                        <div id="btn5-out"><img id="mouseenter" src="/images/btn/contact-survol.png"  width="171px" height="64"></div>
                    </a>
                </li>
                <li>
                    <a id="btn6" href="/devis.php">
                        <div id="btn6-in"><img id="mouseleave" src="/images/btn/devis.png"  width="171px" height="64"> </div>
                        <div id="btn6-out"><img id="mouseenter" src="/images/btn/devis-survol.png" width="171px" height="64"></div>
                    </a>

                </li>
            </ul>
        </nav>

    </section>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <section>
	<div id="formulaire">
<?php if ($afficheformulaire=="oui") { ?>
	<form action="" method="post" enctype="" name="demande_devis">
		<table width="90%" border="0" align="center">
		  <tr>
			<td colspan="2" align="left" height="30" valign="middle"><?php echo $message; ?></td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" height="50" valign="middle" class="titre">Pour une demande de devis, veuillez remplir le formulaire ci dessous : </td>
		  </tr>
		  
		  <tr>
			<td width="19%" height="30" align="right" valign="middle" class="champs" >Civilit&eacute;<span style="color: #FF0000">*</span>:&nbsp;</td>
			<td width="81%" align="left" valign="middle" nowrap="nowrap">
			<table width="50%">
			 <tr>
		       <td align="center" valign="middle" class="champs"><input name="civilite" type="radio" id="civilite" value="Monsieur" checked="checked" /> Monsieur</td>
		       <td align="center" valign="middle" class="champs"> <input name="civilite" type="radio" id="civilite" value="Madame" /> Madame</td>
			 </tr>
			 </table>
			</td>
		  </tr>
		
		  <tr>
			<td align="right" valign="middle" class="champs">NOM<span style="color: #FF0000">*</span>:</td>
			<td align="left" valign="middle" nowrap="nowrap" class="champs"><input name="nom" type="text" size="50" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle" class="champs">Pr&eacute;nom<span style="color: #FF0000">*</span>:</td>
			<td align="left" valign="middle" nowrap="nowrap" class="champs"><input name="prenom" type="text" size="50" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle" class="champs">Email<span style="color: #FF0000">*</span>:</td>
			<td align="left" valign="middle" nowrap="nowrap" class="champs"><input name="email" type="text"size="50" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right" valign="middle" class="champs">T&eacute;l&eacute;phone<span style="color: #FF0000">*</span>:</td>
			<td align="left" valign="middle" nowrap="nowrap" class="champs"><input name="tel" type="text" size="50"/>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" height="30" valign="middle"></td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" valign="middle" class="champs">Descriptif des travaux:</td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" valign="middle" class="champs"><textarea name="descriptif" cols="70" rows="10" ></textarea>
			&nbsp;</td>
		  </tr>
  		  <tr>
			<td colspan="2" align="middle" valign="middle" class="champs"><input name="Envoyer" type="submit" id="Envoyer" value="Envoyer" /></td>
		  </tr>
  		  <tr>
			<td colspan="2" align="right" valign="middle" class="champs"><input name="ID" type="hidden" id="ID" /></td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" height="30" valign="middle" class="information"><p>Vous recevrez par email une confirmation de r&eacute;ception de votre demande. </p>
			  Les informations demand&eacute;es dans ce formulaire servent &agrave; traiter votre demande et &agrave; vous recontacter. Elles ne sont et ne seront en aucun cas c&eacute;d&eacute;es &agrave; des tiers pour quelque raison que ce soit.</td>
		  </tr>
		  
	  </table>
  </form>
  <?php
    } // fin du if
	else {echo $message;}
  ?>	
</div>
</section>
    <!-- InstanceEndEditable -->
	    <section id="footer">
        <div id="pied">
        </div>
    </section>
    
    <p style="text-align: center;">© 2020 JMP & CouleurArcEnCiel - Tous droits réservés</p>

    </body>
<!-- InstanceEnd --></html>
