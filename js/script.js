// $(document).ready(function(){
  var tableau = document.getElementById("monTableau");//on prend le tableau
  var ligne = tableau.rows[0];// on prend la première ligne
  ligne.deleteCell(0);//on supprime la première cellule de la première ligne
  function supprimerLigne(num)
  {
    document.getElementById("tableau").deleteRow(num);
  }



// var $n = prompt("Combien de places voulez vous acheter?");
// var $r = prompt ("A quelle rangée voulez vous aller ?");

  const range = [0,1, 2, 3, 4, 5, 6,7];
  const colum = [0, 1, 2, 3, 4, 5, 6, 7, 8];
  $n = InputDeviceInfo;

  function reserve_place($n, $r)
  {
      for($i=0; $i<= range.length;$i++){
        for($j=0; $j<= colum.length; $j++){
          if($i ==0 && $j == 0){
            return 0;
          }else if($i==$r && $n>0 &&  $n<=9 ){
            return( [ X ]) ;
          }else{
            return([ _ ]) ;
          }
        }
  }
}
// })
