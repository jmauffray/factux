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
 * File Name: db_create.php
 * 	creation de la base de donn�e
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$etape = "�tape N�4 : Initialiser la base de donn�es, cr�er la base, les tables et l'utilisateur primaire";
include('headers.php');
$now='../';
require_once("../include/config/common.php");
mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
$sql = "create database $db";
mysql_query($sql)or die('Erreur SQL !'.$sql.''.mysql_error());
echo "Votre base de donn�e $db � �t� cr�e avec succes<hr>";
include("table_create.php");
