<?php
require('config.php');
$db = $conn;
?>
<script src="./js/rico/src/prototype.js" type="text/javascript"></script>

<div id="calendrier" class="conteneur calendrier" style="width:260px;background-color:#c6c3de;">
    <table class="tab_calendrier" align="center" style="margin:auto;background:#ffffff;">
       <tr>
           <td class="titre_calendrier" colspan="7" width="100%">
           <a id="link_precedent" href="#">Precedent</a>
           <span id="titre"></span>
           <a id="link_suivant" href="#">Suivant</a>
        </td>
      </tr>
      <tr>
        <td  class="cell_calendrier" >
        Lun
        </td>
        <td  class="cell_calendrier" >
        Mar.
        </td>
           <td  class="cell_calendrier">
        Mer.
        </td>
        <td  class="cell_calendrier">
        Jeu.
        </td>
        <td  class="cell_calendrier" >
         Ven.
        </td>
        <td  class="cell_calendrier">
        Sam.
        </td>
        <td  class="cell_calendrier">
        Dim.
        </td>
      </tr>
      <?php
             $compteur_lignes=0;
             $total=1;
             while($compteur_lignes<6){
                echo '<tr>';
                $compteur_colonnes=0;
                while($compteur_colonnes<7){
                   echo '<td id="'.$total.'" class="cell_calendrier" >';
                   echo '</td>';
                   $compteur_colonnes++;
                   $total++;
                }
                echo '</tr>';
                $compteur_lignes++;
             }
      ?>
    </table>
</div>