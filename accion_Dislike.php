<?php
include('config.php');
$idvotoPelicula = $_REQUEST['idvotoPelicula'];

//sql para primero buscar el total de votos
$ConsultandoTotal = ("SELECT nomegusta FROM peliculas WHERE id='$idvotoPelicula' LIMIT 1 ");
$jqueryTotal      = mysqli_query($con, $ConsultandoTotal);
$dataTotal        = mysqli_fetch_array($jqueryTotal);
$totalDisLike        = (int) $dataTotal['nomegusta'];

//Sumando voto
if($_REQUEST['accion'] == "0"){
if($totalDisLike !=0){
  $nuevototalLike   = ($totalDisLike - 1);

  $updateVoto = ("UPDATE peliculas SET nomegusta='$nuevototalLike' WHERE id='$idvotoPelicula' LIMIT 1 ");
  $resultVoto = mysqli_query($con, $updateVoto);

if ($resultVoto > 0) {
  $resultTotal = mysqli_query($con, "SELECT SUM(nomegusta) as DisLiketotal FROM peliculas WHERE id='".$idvotoPelicula."'");
  $rowData     = mysqli_fetch_array($resultTotal, MYSQLI_ASSOC);
  echo $rowData["DisLiketotal"];

  //Creando la COOKIE de votos like
  $miCookies = "userDisLike".$idvotoPelicula;
  setcookie("$miCookies", $idvotoPelicula, time() + (86400)); //86400 = 1 dia 
  }
  }
}else{ //Restando voto
  $nuevototalDisLike   = ($totalDisLike + 1);

  //elimino la cookie la cual almacena el voto
  $miCookiesdis = "userDisLike".$idvotoPelicula;
  if(isset($miCookiesdis)){
    setcookie ($miCookiesdis); //borrando la cookies
  }

  $updateVotoDis = ("UPDATE peliculas SET nomegusta='$nuevototalDisLike' WHERE id='$idvotoPelicula' LIMIT 1");
  $resultVotoDis = mysqli_query($con, $updateVotoDis);

if ($resultVotoDis > 0) {
  $resultTotalDis = mysqli_query($con, "SELECT SUM(nomegusta) as Distotal FROM peliculas WHERE id='".$idvotoPelicula."'");
  $rowDataDis     = mysqli_fetch_array($resultTotalDis, MYSQLI_ASSOC);
  echo $rowDataDis["Distotal"];
  }
}

?>