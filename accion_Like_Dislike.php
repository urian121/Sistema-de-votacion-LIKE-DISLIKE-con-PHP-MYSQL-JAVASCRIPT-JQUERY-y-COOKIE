<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (strlen($_REQUEST["token"])==100)){
  include('config.php');
  $jsonData = array();
  $idvotoPelicula = $_REQUEST['idvotoPelicula'];

//Sumando voto
if($_REQUEST['accion'] == "1"){
    $miCookiesvotoLike = "userLike".$idvotoPelicula;
    if(isset($_COOKIE[$miCookiesvotoLike])){
      //Ya votaste
      $jsonData['success'] = 0; 
    }else{
    //sql para primero buscar el total de votos Megusta Like
    $ConsultandoTotal = ("SELECT megusta FROM peliculas WHERE id='$idvotoPelicula' LIMIT 1 ");
    $jqueryTotal      = mysqli_query($con, $ConsultandoTotal);
    $dataTotal        = mysqli_fetch_array($jqueryTotal);
    $totalLike        = (int) $dataTotal['megusta'];
    $nuevototalLike   = ($totalLike + 1);

    $updateVoto = ("UPDATE peliculas SET megusta='$nuevototalLike' WHERE id='$idvotoPelicula' LIMIT 1 ");
    $resultVoto = mysqli_query($con, $updateVoto);

    if ($resultVoto > 0) {
      $resultTotal = mysqli_query($con, "SELECT SUM(megusta) as Liketotal FROM peliculas WHERE id='".$idvotoPelicula."'");
      $rowData     = mysqli_fetch_array($resultTotal, MYSQLI_ASSOC);

      //IMPORTANTE: Creando la COOKIE de votos like, esto servira para identificar si el usuario ya ha votado
      $miCookies = "userLike".$idvotoPelicula;
      setcookie("$miCookies", $idvotoPelicula, time() + (86400)); //86400 = 1 dia , 2 dias = 172800 y 604.800 = 1 semana
      //Votando por primera vez
      $jsonData['success'] = 1;
      $jsonData['mensaje'] = (int) filter_var($rowData["Liketotal"], FILTER_SANITIZE_NUMBER_INT);
      }

  }
}else{ 
 //IMPORTANTE: caso Dislike
//sql para primero buscar el total de votos
$ConsultandoTotal = ("SELECT nomegusta FROM peliculas WHERE id='$idvotoPelicula' LIMIT 1 ");
$jqueryTotal      = mysqli_query($con, $ConsultandoTotal);
$dataTotal        = mysqli_fetch_array($jqueryTotal);
$totalDisLike     = (int) $dataTotal['nomegusta'];
$nuevototalLike   = ($totalDisLike - 1);
if($totalDisLike ==0){
  $jsonData['success'] = 2;
}else{

$updateVotoDis = ("UPDATE peliculas SET nomegusta='$nuevototalLike' WHERE id='$idvotoPelicula' LIMIT 1 ");
$resultVotoDis = mysqli_query($con, $updateVotoDis);

if ($resultVotoDis !=0) {
$resultTotalDislike = mysqli_query($con, "SELECT SUM(nomegusta) as DisLiketotal FROM peliculas WHERE id='".$idvotoPelicula."'");
$rowDataDislike     = mysqli_fetch_array($resultTotalDislike, MYSQLI_ASSOC);

  $jsonData['success'] = 3;
  $jsonData['mensaje'] = (int) filter_var($rowDataDislike["DisLiketotal"], FILTER_SANITIZE_NUMBER_INT);

  //IMPORTANTE: Creando la COOKIE de votos dislike
  $miCookiesDislike = "userDisLike".$idvotoPelicula;
  setcookie("$miCookiesDislike", $idvotoPelicula, time() + (86400)); //86400 = 1 dia 
  }
 }
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsonData);
exit();
        
}
?>