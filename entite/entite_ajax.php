




<?php
require __DIR__ . '/../db.php';

$res = 0;
$reponse2 = $bdd->query('SELECT * FROM Entité');
while ($donnes2 = $reponse2->fetch()) {


  $res .=  $donnes2['id'];
  $res .=   $donnes2['abr'];
  $res .=   $donnes2['libellé'];
  $res .=   $donnes2['ville'];


  if (empty($donnes2['entité_racine']))
    $res .= 'NULL';
  else
    $res .= $donnes2['entité_racine'];

  $res .= '<button  type="button" value=' . $donnes2['id'] . ' class="btn btn-info btn-xs button" ><img src="icons/edit_small.gif"></span>Éditer</button>';
  $res .= '<button  type="button" value=' . $donnes2['id'] . '  class="btn btn-danger btn-xs delete"><img src="icons/icon_minus.gif"></span>Supprimer</button>';
}
echo json_encode($res);
$reponse2->closeCursor();
?>