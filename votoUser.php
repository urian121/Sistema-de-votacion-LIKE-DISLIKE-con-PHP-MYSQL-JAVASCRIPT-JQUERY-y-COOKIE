<?php
include('config.php');
$idvotoPelicula = $_REQUEST['idvotoPelicula'];

//sql para primero buscar el total de votos
$ConsultandoTotal = ("SELECT megusta FROM peliculas WHERE id='$idvotoPelicula' LIMIT 1 ");
$jqueryTotal      = mysqli_query($con, $ConsultandoTotal);
$dataTotal        = mysqli_fetch_array($jqueryTotal);
$totalLike        = (int) $dataTotal['megusta'];

//Sumando voto
if($_REQUEST['accion'] == "1"){
  $likeVoto         = $_REQUEST['likeVoto'];
  $nuevototalLike   = ($totalLike + $likeVoto);

  $updateVoto = ("UPDATE peliculas SET megusta='$nuevototalLike' WHERE id='".$idvotoPelicula."' ");
  $resultVoto = mysqli_query($con, $updateVoto);

if ($resultVoto > 0) {
  $resultTotal = mysqli_query($con, "SELECT SUM(megusta) as Liketotal FROM peliculas WHERE id='".$idvotoPelicula."'");
  $rowData     = mysqli_fetch_array($resultTotal, MYSQLI_ASSOC);
  echo $rowData["Liketotal"];

  //Creando la COOKIE de votos like
  $miCookies = "userLike".$idvotoPelicula;
  setcookie("$miCookies", $likeVoto, time() + (86400)); //86400 = 1 dia , 2 dias = 172800 y 604.800 = 1 semana
  }

}else{ //Restando voto
  $dislikeVoto         =  $_REQUEST['dislikeVoto'];
  $nuevototalDisLike   = ($totalLike - 1);

  //elimino la cookie la cual almacena el voto
  $miCookiesdis = "userLike".$idvotoPelicula;
  if(isset($miCookiesdis)){
    setcookie ($miCookiesdis); //borrando la cookies

    //setcookie($miCookiesdis, '', time() - 86400);
    //setcookie($miCookiesdis, '', time() - 86400, '/');
    //setcookie("user",false);
  }

  $updateVotoDis = ("UPDATE peliculas SET megusta='$nuevototalDisLike' WHERE id='".$idvotoPelicula."' ");
  $resultVotoDis = mysqli_query($con, $updateVotoDis);

if ($resultVotoDis > 0) {
  $resultTotalDis = mysqli_query($con, "SELECT SUM(megusta) as Distotal FROM peliculas WHERE id='".$idvotoPelicula."'");
  $rowDataDis     = mysqli_fetch_array($resultTotalDis, MYSQLI_ASSOC);
  echo $rowDataDis["Distotal"];
  }
}

?>