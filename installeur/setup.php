<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$etape = "�tape N�3 : Donn�es figurantes sur vos bons de commande et factures";
include('headers.php');
$un=isset($_POST['un'])?$_POST['un']:"";
$deux=isset($_POST['deux'])?$_POST['deux']:"";
$trois=isset($_POST['trois'])?$_POST['trois']:"";
$quatre=isset($_POST['quatre'])?$_POST['quatre']:"";
$cinq=isset($_POST['cinq'])?$_POST['cinq']:"";
$six=isset($_POST['six'])?$_POST['six']:"";
mysql_connect($quatre,$un,$deux) or die ("<font color='red' size='4'> Les informations que vous avez entr�es semblent incorrectes, veuillez les verifier et recommencer l'installeur.");

$type = '<?php' . "\n";
/*$type_fin = '?>';*/
$com = '//common.php cr�� grace � l\'installeur de Factux, soyez prudent si vous l\'�ditez'. "\n";
$com .= 'error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les �l�ments depr�ci�'. "\n";
//$connect = 'mysql_connect($host,$user,$pwd) or die ("serveur de base de donn�es injoignable, verifiez dans /factux/include/common.php si $host est correct.");' . "\n";
//$connect2 = 'mysql_select_db($db) or die ("La base de donn�es est injoignable, verifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");' . "\n";
//$un = "valeur1";
$un = '"'.$un.'";//l\'utilisateur de la base de donn�es mysql' . "\n";
//$deux = "valeur2";
$deux = '"'.$deux.'";//le mot de passe � la base de donn�es mysql' . "\n";
//$trois = "valeur3";
$trois = '"'.$trois.'";//le nom de la base de donn�es mysql' . "\n";
//$quatre = "valeur4";
$quatre = '"'.$quatre.'";//l\'adresse de la base de donn�es mysql ' . "\n";
//$cinq = "valeur5";
$cinq = '"'.$cinq.'";//la langue de l\'interface et des factures cr��es par Factux : voir la doc pour les abbr�viations' . "\n";
$six = '"'.$six.'";//prefixe des tables ' . "\n";
$sept = 'require_once(@$now."include/0.php");#uptophp7'."\n";
//a modifier avant realease common et pas common2
$monfichier = fopen("../include/config/common.php", "w+"); 

fwrite($monfichier, ''.$type.''.$com.'$user= '.$un.'$pwd= '.$deux.'$db= '.$trois.'$host= '.$quatre.'$default_lang= '.$cinq.'$tblpref= '.$six.$sept);
fclose($monfichier);
?>
<center>
 <h2>Les informations de connexion a la base de donn�es ont �t� enregistr�es avec succ�s dans le fichier<font color="red">/factux/include/config/common.php</font></h2>
 <h2>En cas d'erreur, vous avez 2 choix : recommencer l'installeur de Factux ou �diter ce fichier.<br>
 Ce fichier est largement comment� (en francais) pour vous y aider.</h2>
</center><hr>
<?php
include("setup_suite.php");
