<?php 
session_start();

require __DIR__ . './../db.php';


if(isset($_GET['numero']))
{

if($_GET['numero']==1)
{
if( isset($_POST['ref']) AND isset($_POST['marque']) AND isset($_POST['qte_min'])  AND isset($_POST['qte_stock']) )
{

  $_POST['marque']=htmlspecialchars(strtoupper($_POST['marque']));
  $_POST['ref']=htmlspecialchars(strtoupper($_POST['ref']));
  $_POST['qte_min']=htmlspecialchars($_POST['qte_min']);
  $_POST['qte_stock']=htmlspecialchars($_POST['qte_stock']);

$reponse=$bdd->prepare('SELECT réf FROM Consommable WHERE réf=?');
$reponse->execute(array($_POST['ref']));
if($reponse->rowCount()==0)
{

$reponse2=$bdd->prepare('INSERT INTO Consommable (réf,marque,qte_min,qte_stock) VALUES (?,?,?,?)');
$reponse2->execute(array($_POST['ref'], $_POST['marque'],$_POST['qte_min'],$_POST['qte_stock']));
$reponse2->closeCursor();
}
$reponse->closeCursor();


}



}
 else if($_GET['numero']==2)
{
	
  
if( isset($_POST['ref']) AND isset($_POST['marque']) AND isset($_POST['qte_min'])  AND isset($_POST['qte_stock']) )
{
  echo 'ok';
  $_POST['marque']=htmlspecialchars(strtoupper($_POST['marque']));
  $_POST['ref']=htmlspecialchars(strtoupper($_POST['ref']));
  $_POST['qte_min']=htmlspecialchars($_POST['qte_min']);
  $_POST['qte_stock']=htmlspecialchars($_POST['qte_stock']);



$reponse2=$bdd->prepare('UPDATE Consommable SET  marque=?,qte_min=?,qte_stock=? WHERE réf=?');
$reponse2->execute(array($_POST['marque'],$_POST['qte_min'],$_POST['qte_stock'],$_POST['ref']));
$reponse2->closeCursor();



}
}

else if($_GET['numero']==3)
{
  if(isset($_POST['id']))
  {
    
    $_POST['id']=htmlspecialchars($_POST['id']);
    $reponse=$bdd->prepare('DELETE FROM Consommable WHERE id=?');
    $reponse->execute(array($_POST['id']));
    $reponse->closeCursor();

  }
}

}
