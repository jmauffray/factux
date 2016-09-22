
<!DOCTYPE html> 
<html>
<head>
<meta charset="ISO-8859-1"><?php #html5 ?>
<title>Mise a niveau de Factux : verifier les droits des fichiers de configuration</title>


<link rel='stylesheet' type='text/css' href='../../include/themes/default/style.css'>
<link rel="shortcut icon" type="image/x-icon" href="../../image/favicon.ico" >
</head><body>
<?php
echo '<center><img src="../../image/factux.gif" alt="">';
echo '<h2>Mise � niveau de Factux 1.1.5 -->  FactuX5.10.5</h2><hr>';
echo 'Vous voici dans le module de mise � niveau de Factux. Avant de commencer la mise � niveau <b>
<font color=red>faite une sauvegarde de votre base de donn�e </font></b><br> ';
echo 'Si vous avez bien suivit les informations du fichier readme.txt vous avez:';
echo '<ul><li>D�compress� l\'archive sur votre disque dur, sauvgard� les fichiers /include/common.php et /include/var.php,</li>';
echo '<li>T�l�vers� les fichiers de l\'archive sur votre serveur en ayant au pr�alble fait place nette des fichiers de la version pr�cedente de Factux</li>';
echo '<li>T�l�vers� le fichier var.php dans le dossier /include/config/<br>
(si des problemes se d�clares avec le sigle � veulliez remplacer la ligne <code>$devise="&amp;euro;";</code> par <code>$devise="�";</code> avant de remplacer le fichier du serveur)</li>';
echo '<li>T�l�vers� le fichier common.php dans le dossier /include/config/ </li>';

echo '<li>Si vous avez modifi� les fichier fact_pdf.php ou bon_pdf.php 
vous devrez malheureusement refaire ces modifications</li></ul>';

$erreur = "Erreur veuiller v�rifier les droits en �criture sur ce fichier !!";
$verif = "V�rification des droits d'�criture pour le r�pertoire";
$verif2 = "V�rification des droits d'�criture pour le fichier";
$doss1 = "../../include";
$doss2 = "../../dump";
$doss4 = "../../image";
$doss3 = "../..";
$doss5 = "../../include/session";
$doss6 = "../../fpdf";
$fich3 = "../../include/configav.php";

$error='0';

echo "<br><hr><br><center><table>";
echo"<caption>V�rification des droits.</caption>";
echo "<tr><td>$verif $doss1 :<td>";
if (is_writable("$doss1")) {
 echo "<font color=green> OK</font></td></tr>";  
} else {
 echo "<font color=red> $erreur</td></tr>";
 $error='1';
}

echo "<tr><td>$verif $doss2 :<td>";
if (is_writable("$doss2")) {
 echo "<font color=green> OK</font></td></tr>";  
} else {
 echo "<font color=red> $erreur</td></tr>";  
 $error='1';
}

echo "<tr><td>$verif $doss3 :<td>";
if (is_writable("$doss3")) {
 echo "<font color=green> OK</font></td></tr>";  
} else {
 echo "<font color=red> $erreur</td></tr>";  
 $error='1';
}

echo "<tr><td>$verif $doss4 :<td>";
if (is_writable("$doss4")) {
 echo "<font color=green> OK</font></td></tr>";  
} else {
 echo "<font color=red> $erreur</td></tr>";  
 $error='1';
}

echo "<tr><td>$verif $doss5 :<td>";
if (is_writable("$doss5")) {
 echo "<font color=green> OK</font></td></tr>";  
} else {
 echo "<font color=red> $erreur</td></tr>";  
 $error='1';
}

echo "<tr><td>$verif $doss6 :<td>";
if (is_writable("$doss6")) {
 echo "<font color=green> OK</font></td></tr>";
} else {
 echo "<font color=red> $erreur</td></tr>";
 $error='1';
}

echo "<tr><td>$verif2 $fich3 :<td>";
if (is_writable("$fich3")) {
echo "<font color=green> OK</font></td></tr>";
} else {
 echo "<font color=red> $erreur</font></td></tr>";
 $error='1';
}

echo "</table></center>";	
if($error !='1'){
?>
<br><hr><br><center>Si tout est correct si dessus et que vous avez bien suivit le readme.txt vous pouver continuer</br>
je le r�pete <font color="red"> faite une sauvegarde de votre base de donn�e avant de poursuivre</font><br>
En cliquant sur un des boutons suivants, vos bases de donn�es seront modifi�es et Factux 1.1.5 pret � fonctionner.<br><br>
<b>ATTENTION</b><br>
Les tables de votre base de donn�es vont �tre profond�ment modifi�es et vos anciennes sauvegardes seront des lors inutilisables.<br>
Des la fin de la mise � jour verifier que vos anciennes factures sont correctes et faite une sauvegarde sur base de la nouvelle installation de Factux<br>
<script type="text/javascript">
function addquery(){
 var j = document.getElementById('j').value;
 var a = document.getElementsByTagName('a');//document.anchors;
 var i;
 for (i = 0; i < a.length; ++i){
  a[i].href = a[i].href + j;
 }
}
</script>
<br>Vos factures sont en g�n�ral r�gl�es <input type="text" id="j" value="30" size="2" /> jours apr�s leurs dates de facturation (date de payement)<br>
<a onclick="addquery()" href='upgrade.php?daytopay='><button>continuer</button></a><br>
<a onclick="addquery()" href='upgrade.php?devnet&amp;daytopay='><button>continuer et nettoyer les devis gagn�s</button></a>
</center>
<?php
}else{
echo "<font color='red'>Veuillez corriger les erreurs si dessus avant de poursuivre</font>";
}
?>
</body>
</html>
