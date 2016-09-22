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
 ?> 
   <h2>Installation de Factux suite</h2>
   <p>Nous allons maintenant enregistrer les donn�es qui figureront sur vos bons de commande et factures</p>
   <hr><br>
   <center>
    <form action="setup_3.php" method="post" name="artice" id="artice">
     <table style="color:green">
      <tr>
       <td>Nom de l'entreprise</td>
       <td><input name="zero" type="text" maxlength="140"></td>
      </tr>        
      <tr>
       <td>Si�ge social de l'entreprise</td>
       <td><input name="un" type="text" maxlength="140"></td>
      </tr>
      <tr>
       <td>Num�ro de t�l�phone de l'entreprise</td>
       <td><input name="deux" type="text"  ></td>
      </tr>
      <tr>
       <td>Num�ro de T.V.A. de l'entreprise</td>
       <td><input name="trois" type="text" ></td>
      </tr>
      <tr>
       <td>Num�ro de compte en banque de l'entreprise</td>
       <td><input name="quatre" type="text" ></td>
      </tr>
      <tr>
       <td>Slogan de l'entreprise (Faites assez court)</td>
       <td><input name="cinq" type="text" ></td>
      </tr>
      <tr>
       <td>Num�ro de registre de commerce de l'entreprise</td>
       <td><input name="six" type="text" ></td>
      </tr>
      <tr>
       <td>Adresse email de l'entreprise</td>
       <td><input name="sept" type="text" ></td>
      </tr>
      <tr>
       <td>Devise utilis�e par Factux (�, $...)</td>
       <td><input name="huit" type="text" ></td>
      </tr>
      <tr>
       <td><input type="submit" name="Submit" value="Envoyer"></td>
       <td><input name="reset" type="reset" id="reset" value="effacer"></td>
      </tr>
     </table>
    </form>
   </center>
   <br><hr>
<?php include_once("../include/bas_cli.php"); ?> 
  </td>
 </tr>
</table>
</body>
</html>
