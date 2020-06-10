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
      $message="Oups ... Vous avez oubli&eacute; de nous donner votre nom. Si vous voulez rester anonyme, donnez au moins un pseudo pour pouvoir vous identifier";
      $ok="non";
	 } 
   }
  if ($ok=="oui")
   { 
	   $insertSQL = sprintf("INSERT INTO avis (ID, nom, prenom, pseudo, email, vitesse, preparation, qualite, recommandation, contact, commentaire, valide) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['ID'], "int"),
						   GetSQLValueString($_POST['nom'], "text"),
						   GetSQLValueString($_POST['prenom'], "text"),
						   GetSQLValueString($_POST['pseudo'], "text"),
						   GetSQLValueString($_POST['email'], "text"),
						   GetSQLValueString($_POST['Vrating'], "int"),
						   GetSQLValueString($_POST['Prating'], "int"),
						   GetSQLValueString($_POST['Qrating'], "int"),
						   GetSQLValueString($_POST['Rrating'], "int"),
						   GetSQLValueString($_POST['Crating'], "int"),
						   GetSQLValueString($_POST['commentaire'], "text"),"'oui'");
	   echo $insertSQL;
	   $Result1 = mysqli_query($DevWebPeinture_db,$insertSQL);
	   echo " Result1=".$Result1;
    }
 }
 
 
 // chargement de l'avis 
 $query_avis = "SELECT * FROM avis";
 $query_avis = $query_avis." WHERE valide = 'oui'";
 $avisdb = mysqli_query($DevWebPeinture_db,$query_avis);
 $row_avis = mysqli_fetch_assoc($avisdb);
 

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
	<link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/style.css">
	<link rel="stylesheet" href="/style1.css">
    <script src="/script.js"></script>
    <link rel="stylesheet" href="/css/style-rea.css"> <!-- Resource style -->


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
	<div id="avis-cat">
        <p class="titre">Ce qu'ils disent de nous</p>
      <div id="monCarousel" class="carousel slide" data-ride="carousel" style="width: 800px text-align:center">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
			 <p id="avisId"><?php if ($row_avis['pseudo']<>"") {echo '"'.$row_avis['pseudo'].'" a dit:';} else {echo $row_avis['nom']." a dit:";}?></p>
			 <p id="avisId"><?php echo '"'.$row_avis['commentaire'].'"';?></p>
			 <p id="levelId">
			 Vitesse d'éxécution &nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['vitesse']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
			 <p id="levelId">
			 Préparation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['preparation']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Qualité des travaux &nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['qualite']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Recommandation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['recommandation']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Contact humain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['contact']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
           </div>
	       <?php 
		     $row_avis = mysqli_fetch_assoc($avisdb);
             do
              { 
			?>
            <div class="item">
			 <p id="avisId"><?php if ($row_avis['pseudo']<>"") {echo '"'.$row_avis['pseudo'].'" a dit:';} else {echo $row_avis['nom']." a dit:";}?></p>
			 <p id="avisId"><?php echo '"'.$row_avis['commentaire'].'"';?></p>
			 <p id="levelId">
			 Vitesse d'éxécution &nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['vitesse']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['vitesse']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
			 <p id="levelId">
			 Préparation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['preparation']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['preparation']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Qualité des travaux &nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['qualite']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['qualite']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Recommandation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['recommandation']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['recommandation']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
			  </p>
   			  <p id="levelId">
			  Contact humain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/star-on.svg" width="20" height="20" alt=""/>
				   <?php if ($row_avis['contact']>=2) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=3) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=4) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
				   <?php if ($row_avis['contact']>=5) { ?><img src="/star-on.svg" width="20" height="20" alt=""/> <?php }?>
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
   <form action="" method="post" enctype="" name="demande_avis">
   <p class="titre">Que pensez vous de nous ?</p>
   <p class="soustitre">Votre identité</p>

   <p id="avisId">
     NOM:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="nom" type="text" size="20" />
   </p>
    <p id="avisId">
     Prénom:&nbsp;&nbsp;<input name="prenom" type="text" size="20" />
   </p>
    <p id="avisId">
     Pseudo:&nbsp;&nbsp;<input name="pseudo" type="text" size="20" />
   </p>
   <p id="avisId">
     Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="email" type="text" size="20" />
   </p>
   <p class="soustitre">Votre avis</p>
   <p id="avisId">Vitesse d'éxécution <span style="font-style: italic; font-size: 14px">(Ponctualité, temps de travail)</span>:</p>
   <p class="starRating" align="left">
		<input id="Vrating5" type="radio" name="Vrating" value="5">
		<label for="Vrating5">5</label>
		<input id="Vrating4" type="radio" name="Vrating" value="4">
		<label for="Vrating4">4</label>
		<input id="Vrating3" type="radio" name="Vrating" value="3">
		<label for="Vrating3">3</label>
		<input id="Vrating2" type="radio" name="Vrating" value="2">
		<label for="Vrating2">2</label>
		<input id="Vrating1" type="radio" name="Vrating" value="1" checked="checked">
		<label for="Vrating1">1</label>		
   </p>
   <p id="avisId">Préparation <span style="font-style: italic; font-size: 14px">(Protection des éléments, nettoyage)</span>:</p>
   <p class="starRating" align="left">
	<input id="Prating5" type="radio" name="Prating" value="5">
	<label for="Prating5">5</label>
	<input id="Prating4" type="radio" name="Prating" value="4">
	<label for="Prating4">4</label>
	<input id="Prating3" type="radio" name="Prating" value="3">
	<label for="Prating3">3</label>
	<input id="Prating2" type="radio" name="Prating" value="2">
	<label for="Prating2">2</label>
	<input id="Prating1" type="radio" name="Prating" value="1" checked="checked">
	<label for="Prating1">1</label>			
   </p>
   <p id="avisId">Qualité des travaux <span style="font-style: italic; font-size: 14px">(Professionnalisme, serieux, qualité d'éxécution)</span>:</p>
   <p class="starRating" align="left">
	<input id="Qrating5" type="radio" name="Qrating" value="5">
	<label for="Qrating5">5</label>
	<input id="Qrating4" type="radio" name="Qrating" value="4">
	<label for="Qrating4">4</label>
	<input id="Qrating3" type="radio" name="Qrating" value="3">
	<label for="Qrating3">3</label>
	<input id="Qrating2" type="radio" name="Qrating" value="2">
	<label for="Qrating2">2</label>
	<input id="Qrating1" type="radio" name="Qrating" value="1" checked="checked">
	<label for="Qrating1">1</label>			
   </p>
   <p id="avisId">Recommandation <span style="font-style: italic; font-size: 14px">(Nous recommanderiez-vous ?)</span>:</p>
   <p class="starRating" align="left">
	<input id="Rrating5" type="radio" name="Rrating" value="5">
	<label for="Rrating5">5</label>
	<input id="Rrating4" type="radio" name="Rrating" value="4">
	<label for="Rrating4">4</label>
	<input id="Rrating3" type="radio" name="Rrating" value="3">
	<label for="Rrating3">3</label>
	<input id="Rrating2" type="radio" name="Rrating" value="2">
	<label for="Rrating2">2</label>
	<input id="Rrating1" type="radio" name="Rrating" value="1" checked="checked">
	<label for="Rrating1">1</label>			
   </p>
   <p id="avisId">Contact humain <span style="font-style: italic; font-size: 14px">(Dialogue, échange d'idées, communication)</span>:</p>
   <p class="starRating" align="left">
	<input id="Crating5" type="radio" name="Crating" value="5">
	<label for="Crating5">5</label>
	<input id="Crating4" type="radio" name="Crating" value="4">
	<label for="Crating4">4</label>
	<input id="Crating3" type="radio" name="Crating" value="3">
	<label for="Crating3">3</label>
	<input id="Crating2" type="radio" name="Crating" value="2">
	<label for="Crating2">2</label>
	<input id="Crating1" type="radio" name="Crating" value="1" checked="checked">
	<label for="Crating1">1</label>			
   </p>
   <p class="soustitre">Votre commentaire:</p>
   <p id="avisId"><textarea name="commentaire" cols="30" rows="10" ></textarea></p>
   
   </form>
  </div>
 <!--	<div id="formulaire">
<?php /*?><?php if ($afficheformulaire=="oui") { ?>
<?php */?>	<form action="" method="post" enctype="" name="demande_avis">
    	<table border="0" class="tableId">
		  <tr>
			<td colspan="2" align="middle" height="80" valign="middle" class="titre">Que pensez vous de nous ? </td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" height="40" valign="middle" class="soustitre">Votre identit&eacute; </td>
		  </tr>
		  
		  <tr>
			<td colspan="2" align="left" valign="middle"><?php /*?><?php echo $message; ?><?php */?></td>
		  </tr>
		  <tr>
			<td align="left" width="40%" valign="middle" class="champs">NOM:</td>
			<td align="left" width="60%" valign="middle" nowrap="nowrap" class="champs"><input name="nom" type="text" size="30" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left" width="40%" valign="middle" class="champs">Pr&eacute;nom:</td>
			<td align="left" width="60%" valign="middle" nowrap="nowrap" class="champs"><input name="prenom" type="text" size="30" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left" width="40%" valign="middle" class="champs">Pseudo:</td>
			<td align="left" width="60%" valign="middle" nowrap="nowrap" class="champs"><input name="pseudo" type="text" size="30" />&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left" width="40%" valign="middle" class="champs">Email:</td>
			<td align="left" width="60%" valign="middle" nowrap="nowrap" class="champs"><input name="email" type="text" size="30" />&nbsp;</td>
		  </tr>
		</table>
		<table border="0" class="tableId">
		  <tr>
			<td colspan="2" height="40" class="soustitre"></td>
		  </tr>
		  <tr>
			<td colspan="2" align="left" height="40" valign="middle" class="soustitre">Votre avis</td>
		  </tr>
		  <tr>
			<td colspan="2" height="20" class="soustitre"></td>
		  </tr>
		  <tr>
    	    <td  align="left" valign="middle" class="champsavis" >Vitesse d'ex&eacute;cution</td>
			<td rowspan="2" align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="Vrating5" type="radio" name="Vrating" value="5">
				<label for="Vrating5">5</label>
				<input id="Vrating4" type="radio" name="Vrating" value="4">
				<label for="Vrating4">4</label>
				<input id="Vrating3" type="radio" name="Vrating" value="3">
				<label for="Vrating3">3</label>
				<input id="Vrating2" type="radio" name="Vrating" value="2">
				<label for="Vrating2">2</label>
				<input id="Vrating1" type="radio" name="Vrating" value="1" checked="checked">
				<label for="Vrating1">1</label>			</td>
		  </tr>
     	    <td width="60%" align="left" valign="middle" class="champsaviscomment" >Ponctualit&eacute;, temps de travail </td>
		   <tr>
			<td colspan="2" align="middle" height="40"></td>
		  </tr>
		  <tr>
    	    <td  width="60%" align="left" valign="middle" class="champsavis" >Pr&eacute;paration</td>
			<td  width="40%" rowspan="2" align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="Prating5" type="radio" name="Prating" value="5">
				<label for="Prating5">5</label>
				<input id="Prating4" type="radio" name="Prating" value="4">
				<label for="Prating4">4</label>
				<input id="Prating3" type="radio" name="Prating" value="3">
				<label for="Prating3">3</label>
				<input id="Prating2" type="radio" name="Prating" value="2">
				<label for="Prating2">2</label>
				<input id="Prating1" type="radio" name="Prating" value="1" checked="checked">
				<label for="Prating1">1</label>			</td>
		  </tr>
     	    <td width="60%" align="left" valign="middle" class="champsaviscomment" >Protection des &eacute;l&eacute;ments, nettoyage </td>
		   <tr>
			<td colspan="2" align="middle" height="40"></td>
		  </tr>
		  <tr>
    	    <td  width="60%" align="left" valign="middle" class="champsavis" >Qualit&eacute; des travaux </td>
			<td  width="40%" rowspan="2" align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="Qrating5" type="radio" name="Qrating" value="5">
				<label for="Qrating5">5</label>
				<input id="Qrating4" type="radio" name="Qrating" value="4">
				<label for="Qrating4">4</label>
				<input id="Qrating3" type="radio" name="Qrating" value="3">
				<label for="Qrating3">3</label>
				<input id="Qrating2" type="radio" name="Qrating" value="2">
				<label for="Qrating2">2</label>
				<input id="Qrating1" type="radio" name="Qrating" value="1" checked="checked">
				<label for="Qrating1">1</label>			</td>
		  </tr>
     	    <td width="60%" align="left" valign="middle" class="champsaviscomment" >Professionnalisme, serieux, qualit&eacute; d'ex&eacute;cution </td>
		   <tr>
			<td colspan="2" align="middle" height="40"></td>
		  </tr>
		  <tr>
    	    <td  width="60%" align="left" valign="middle" class="champsavis" >Recommandation </td>
			<td  width="40%" rowspan="2" align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="Rrating5" type="radio" name="Rrating" value="5">
				<label for="Rrating5">5</label>
				<input id="Rrating4" type="radio" name="Rrating" value="4">
				<label for="Rrating4">4</label>
				<input id="Rrating3" type="radio" name="Rrating" value="3">
				<label for="Rrating3">3</label>
				<input id="Rrating2" type="radio" name="Rrating" value="2">
				<label for="Rrating2">2</label>
				<input id="Rrating1" type="radio" name="Rrating" value="1" checked="checked">
				<label for="Rrating1">1</label>			</td>
		  </tr>
     	    <td width="60%" align="left" valign="middle" class="champsaviscomment" >Nous recommanderiez-vous ?  </td>
		   <tr>
			<td colspan="2" align="middle" height="40"></td>
		  </tr>
		  <tr>
    	    <td  width="60%" align="left" valign="middle" class="champsavis" >Contact humain </td>
			<td  width="40%" rowspan="2" align="left" valign="middle" nowrap="nowrap" class="starRating">
				<input id="Crating5" type="radio" name="Crating" value="5">
				<label for="Crating5">5</label>
				<input id="Crating4" type="radio" name="Crating" value="4">
				<label for="Crating4">4</label>
				<input id="Crating3" type="radio" name="Crating" value="3">
				<label for="Crating3">3</label>
				<input id="Crating2" type="radio" name="Crating" value="2">
				<label for="Crating2">2</label>
				<input id="Crating1" type="radio" name="Crating" value="1" checked="checked">
				<label for="Crating1">1</label>			</td>
		  </tr>
     	       <td width="60%" align="left" valign="middle" class="champsaviscomment" >Dialogue, &eacute;change d'id&eacute;es, communication </td>
		   <tr>
			<td colspan="2" align="middle" height="40"></td>
  		   </tr>
		   <tr>
			<td colspan="2" align="left" class="champs">Votre commmentaire:</td>
		   </tr>
		   <tr>
			<td colspan="2" align="left" valign="middle" class="champs"><textarea name="commentaire" cols="50" rows="10" ></textarea>&nbsp;</td>
		   </tr>
  		   <tr>
			<td colspan="2" align="middle" valign="middle" class="champs"><input name="Envoyer" type="submit" id="Envoyer" value="Envoyer" /></td>
		   </tr>
  		   <tr>
			<td colspan="2" align="right" valign="middle" class="champs"><input name="ID" type="hidden" id="ID" /></td>
		   </tr>
 	  </table>
  </form>
  
<?php /*?>  <?php
    } // fin du if
	else {echo $message;}
  ?>	
<?php */?>   </div>
-->    <!-- InstanceEndEditable -->
	    <section id="footer">
        <div id="pied">
        </div>
    </section>
    
    <p style="text-align: center;">� 2020 JMP & CouleurArcEnCiel - Tous droits r�serv�s</p>

    </body>
<!-- InstanceEnd --></html>