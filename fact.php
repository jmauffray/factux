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
 * File Name: fact.php
 * 	enregistrement de donn�es de la facture
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/headers.php");
include_once("include/finhead.php");?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_admin != y) { 
echo "<h1>$lang_admin_droit";
exit;
}
?>
</td>
</tr>
<?php
$acompte=isset($_POST['acompte'])?$_POST['acompte']:"";
$date_deb=isset($_POST['date_deb'])?$_POST['date_deb']:"";
list($jour_deb, $mois_deb,$annee_deb) = preg_split('/\//', $date_deb, 3);
$date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:"";
list($jour_f, $mois_f,$annee_f) = preg_split('/\//', $date_fin, 3);
$date_fact=isset($_POST['date_fact'])?$_POST['date_fact']:"";
list($jour_fact, $mois_fact,$annee_fact) = preg_split('/\//', $date_fact, 3);
$client=isset($_POST['listeville'])?$_POST['listeville']:"";
$annee_fac=isset($_POST['annee_fac'])?$_POST['annee_fac']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";
$debut = "$annee_deb-$mois_deb-$jour_deb" ;
$fin = "$annee_f-$mois_f-$jour_f" ;
$date_fact ="$annee_fact-$mois_fact-$jour_fact";
if($client=='null' || $date_deb==''|| $date_fin=='' || $date_fact=='' )
{
$message= "<h1>$lang_oubli_champ</h1>";
include('form_facture.php');
exit;
}
$sql = " SELECT nom, nom2 From " . $tblpref ."client WHERE num_client = $client ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());


while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		}

$sql = "SELECT * FROM " . $tblpref ."bon_comm 
	 WHERE client_num = '".$client."' 
	 AND " . $tblpref ."bon_comm.date >= '".$debut."' 
	 and " . $tblpref ."bon_comm.date <= '".$fin."' 
	 and fact = 'ok'";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$fact = $data['fact'];
		}
if($fact=='ok')
{
$message= "<h1>$lang_err_fact</h1>";
include('form_facture.php');
exit;
}
$sql = " SELECT SUM(tot_htva), SUM(tot_tva) 
		FROM " . $tblpref ."bon_comm 
		 WHERE " . $tblpref ."bon_comm.client_num = '".$client."' 
		 AND " . $tblpref ."bon_comm.date >= '".$debut."' 
		 and " . $tblpref ."bon_comm.date <= '".$fin."'";

  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$total_htva = $data['SUM(tot_htva)'];
		$total_tva = $data['SUM(tot_tva)'];
		$total_ttc = $total_htva + $total_tva ;
if($total_htva=='')
{
$message= "<h1>$lang_err_fact_2 </h1>";
include('form_facture.php');
exit;
}

//nouvelle methode
$sql = " SELECT num_bon 
		FROM " . $tblpref ."bon_comm 
		 WHERE " . $tblpref ."bon_comm.client_num = '".$client."' 
		 AND " . $tblpref ."bon_comm.date >= '".$debut."' 
		 and " . $tblpref ."bon_comm.date <= '".$fin."'";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$list_num[] = $data['num_bon'];
		}

$suite_sql="and " . $tblpref ."bon_comm.num_bon ='$list_num[0]'";
for($m=1; $m<count($list_num); $m++){
$suite_sql .= " or " . $tblpref ."bon_comm.num_bon ='$list_num[$m]'";

}

//on recherche le numero de la facture cr�e
$sql = "SELECT MAX(num) As Maxi FROM " . $tblpref ."facture";
$result = mysql_query($sql) or die('Erreur');
$num = mysql_result($result, 'Maxi');
$num = $num + 1 ;


//On afiche le resultat
$sql9 = "SELECT date, quanti, article, remise, tot_art_htva, to_tva_art, taux_tva, uni, num_bon 
FROM " . $tblpref ."client 
RIGHT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num 
LEFT join " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num  
LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num 
WHERE " . $tblpref ."client.num_client = '".$client."'"; 
//AND " . $tblpref ."bon_comm.date >= '".$debut."' 
//and " . $tblpref ."bon_comm.date <= '".$fin."'";
$sql9="$sql9 $suite_sql";

$req = mysql_query($sql9) or die('Erreur SQL9 !<br>'.$sql9.'<br>'.mysql_error());
echo "<tr><td class='page'><table class='boiteaction'>
  <caption>
  Facture $num cr��e pour $nom $nom2
  </caption>
"; 

echo "<tr><th>Quanti <th>$lang_unite<th>$lang_article<th>$lang_prix_h_tva<th>$lang_remise<th>$lang_taux_tva<th>$lang_tot_tva<th>$lang_num_bon<th>$lang_date_bon</tr>";
while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$article = $data['article'];
		$tot_htva = $data['tot_art_htva'];
		$tot_tva = $data['to_tva_art'];
		$taux = $data['taux_tva'];
		$uni = $data['uni'];
		$num_bon = $data['num_bon'];
		$date = $data['date'];
		$remise = $data['remise'];
		echo "<tr><td>$quanti<td>$uni<td>$article<td>$tot_htva<td>$remise<td>$taux<td>$tot_tva<td>$num_bon<td>$date</tr>";
		}
		
		echo "<tr><td>";
		?>
		<form action="fpdf/fact_pdf.php" method="post" target="_blank" >
		<input type="hidden" name="client" value="<?php echo $client ?>" />
		<input type="hidden" name="debut" value="<?php echo $debut ?>" />
		<input type="hidden" name="fin" value="<?php echo $fin ?>" />
		<input type="hidden" name="num" value="<?php echo $num ?>" />
		<input type="hidden" name="user" value="adm" />
		<input type="image" src="image/printer.gif" alt="imprimer" />

</form>
		
		<?php  
$rest = $total_htva + $total_tva - $acompte ;
		echo"<td>&nbsp;<td>&nbsp;<td><b>$lang_total</b><td><b>$total_htva $devise htva </b><td><b>$lang_tot_tva</b><td><b> $total_tva  $devise de tva </b><td><b><font color='red'>$lang_tot_ttc </font></b><td><b><font color='red'>$total_ttc $devise</font></b></tr>";    
		echo " <tr><td colspan='7'>&nbsp;<td>$lang_acompte<td>$acompte $devise</tr>";
		echo "<tr><td colspan='7'>&nbsp;<td>Reste a payer<td>$rest $devise</tr>
		</table><br><hr>";
//on enregistre le contenu de la facture
$list_num = serialize($list_num);
$sql1 = "INSERT INTO " . $tblpref ."facture(acompte, coment, client, date_fact, total_fact_h, total_fact_ttc, list_num)
	 VALUES ('$acompte', '$coment', '$client', '$date_fact', '$total_htva', '$total_ttc', '$list_num')";
mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
$message="<h2> Facture crenregistr�e<br>";		
$sql2 = "UPDATE " . $tblpref ."bon_comm SET fact='ok' WHERE " . $tblpref ."bon_comm.client_num = '".$client."' AND " . $tblpref ."bon_comm.date >= '".$debut."' and " . $tblpref ."bon_comm.date <= '".$fin."'";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());

//date_fact rajout by ciit (permet l'impression du total des remise
$sql2 = "UPDATE " . $tblpref ."bon_comm SET date_fact='$date_fact' WHERE " . $tblpref ."bon_comm.client_num = '".$client."' AND " . $tblpref ."bon_comm.date >= '".$debut."' and " . $tblpref ."bon_comm.date <= '".$fin."'";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
//FIN   date_fact rajout by ciit (permet l'impression du total des remise fpdf_fact.php) 

//include('form_facture.php');
?>
<tr><td>
<?php
include_once("include/bas.php");
?> 
</td></tr></table>