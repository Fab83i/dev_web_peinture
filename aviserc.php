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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Vos avis</title>
</head>

<body>
<link href="style1.css" rel="stylesheet" type="text/css" />
<div id="formulaire">
<?php if ($afficheformulaire=="oui") { ?>
	<form action="" method="post" enctype="application/x-www-form-urlencoded" name="demande_devis">
		<table width="200" border="0" align="center" class="formulaire">
		  <tr>
			<td colspan="2" align="left" valign="middle"><?php echo $message; ?></td>
		  </tr>
		  <tr>
			<td align="right" valign="middle">Vitesse d'ex&eacute;cution </td>
			<td align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="rating5" type="radio" name="rating" value="5">
				<label for="rating5">5</label>
				<input id="rating4" type="radio" name="rating" value="4">
				<label for="rating4">4</label>
				<input id="rating3" type="radio" name="rating" value="3">
				<label for="rating3">3</label>
				<input id="rating2" type="radio" name="rating" value="2">
				<label for="rating2">2</label>
				<input id="rating1" type="radio" name="rating" value="1">
				<label for="rating1">1</label>
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
</body>
</html>
