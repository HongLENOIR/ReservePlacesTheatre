<?php
//info de base de donnée
$host = 'mysql:host=localhost;dbname=theatre';
$login = 'root';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = new PDO($host, $login, $password, $options);

 // bdname  'theatre' avec un tableau 'reserve' par example:
   reserve= array('id','place','rang');

  $place= '';
  $rang='';
   // obtenir l'info via le formulaire de méthode 'POST'
  if(isset($_POST['place']) && isset($_POST['rang'])){
    $place=$_POST['place'];
    $rang=$_POST['rang'];
    
    // afficher un tableau des places
    $i=''; // 
    $j='';
    $msg='';

   // controler si les places sont réservée
    $verif_rang =$pdo->prepare("SELECT * FROM reserve WHERE rang=:rang");
    $verif_rang->bindParam(':rang', $rang, PDO::PARAM_STR);
    $verif_rang->execute();
    // $verif_place->bindParam(':place', $place, PDO::PARAM_STR);$verif_place->execute();
    
    if($verif_rang->rowCount()> 0 ){  
    // récupérer la totalité des places reservées d'une rangé dans la BDD
    $place_reserve = $pdo->query("SELECT SUM(place) FROM reserve WHERE rang = :rang");
    // echo 'Il y a ' . $place_reserve. ' places réservées.<hr>';      
        
      if($place < (9-$place_reserve) && $rang = $verif_rang){
      echo '<td>[ X ]</td>';    
      $enregistrement = $pdo ->prepare("INSERT INTO reserve(id, place, rang) VALUES(NULL, :place, :rang)");
      $enregistrement->bindParam('place', $place, PDO::PARAM_STR);
      $enregistrement->bindParam('rang', $rang, PDO::PARAM_STR);
      $enregistrement->execute();
      }else{
      echo '<td> [ _ ] </td>';
      $msg = "cette range sont réservée, veuillez choisir d'autre range, s'il vous plaît";
      }
     }
  } 
        
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Réserver des places</title>
  </head>
  <body>
    <form action=" " method="POST" class="form">
      <label for="place">Combien de places voulez vous acheter?</label><br>
      <input type="text" id="place"><br>
      <!-- <button type="button" onclick="getValue();">envoi</button> -->
     
      <label for="rang">A quelle rangée voulez vous aller ?</label><br>
      <input type="text" id="rang" placeholder="chiffre entre 0 et 7"><br>
      <button type="button" onclick="getValue();">envoi</button> <br>

      <?php 
        echo $msg;
        echo $place;
        echo $rang;
      ?>
     <hr><br><br>

       <?php
       echo '<table id="tableau>';
       echo '<tr>';
       for($j=0; $j<=7; $j++){
          echo '<th>'. $j .' | </th>';
          for($i=0;$i<=8; $i++){
           echo '<td>[ _ ]</td>' ; 
           }
        }
       for($tf=0; $tf<=8;$tf++){
        echo  '<th></th>';
        echo '<td>'.$tf. '</td>';
       }
       echo '</tr>';
       echo '</table>';
       ?>
 <!-- <table id="tableau">
       <tr>
        <th>0  |</th>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
       </tr>
       <tr>
        <th> 1 |</th>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
       </tr>
       <tr>
        <th> 2  |</th>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        <td>[ _ ]</td>
        </tr>
        <tr>
          <th> 3  |</th>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
        </tr>
        <tr>
        <th> 4  |</th>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
        </tr>
        <tr>
          <td> 5  |</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
        </tr>
        <tr>
        <th> 6 |</th>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
        <td>[ _ ]</td>
        </tr>
          <th> 7 | </th>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
          <td>[ _ ]</td>
        </tr>
          <th></th>
          <td> 0 </td>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
          <td>6</td>
          <td>7</td>
          <td>8</td>
          </tr>
        </table>-->
   
    </form> 
    <!-- <script src="js/jQuery-3-5-1.js"></script>
    <script src="js/script.js"></script> -->

  </body>
</html>
