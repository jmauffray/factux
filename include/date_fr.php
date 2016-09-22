<?php
// TEMPS
$temps = time();

// JOURS
$jours = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
$jours_numero = date('w', $temps);
$jours_complet = $jours[$jours_numero];
// Numero du jour
$NumeroDuJour = date('d', $temps);


// MOIS
$mois = array('', 'Janvier', 'F�vrier', 'Mars', 'Avril', 'Mai',
'Juin', 'Juillet', 'Ao�t', 'Septembre', 'Octobre', 'Novembre', 'D�cembre');
$mois_numero = date("m", $temps);
//$mois_complet = $mois[$mois_numero];
$mois_complet = $mois[($mois_numero - 0)];//new (devient integer)

// ANNEE
$annee = date("Y", $temps);

// Affichage DATE
//echo "<p>Date : Nous sommes le <strong>$jours_complet $NumeroDuJour $mois_complet $annee</strong></p>";
echo "<strong>$jours_complet $NumeroDuJour $mois_complet $annee</strong>";
?>
