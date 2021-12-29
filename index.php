<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="imgs/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Like & Dislike</title>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>
  
<?php
include('config.php');
  
$sqlPeliculas   = ("SELECT * FROM  peliculas ORDER BY id DESC");
$dataPeliculas  = mysqli_query($con, $sqlPeliculas);
?>

<h1 class="text-center bold mt-5 mb-5">Vota por tu Pelicula Favorita del 2021</h1>
<ul class="flex-container">
<?php
 while ($rowPelicula = mysqli_fetch_array($dataPeliculas)) {
   $idPelicula = "userLike".$rowPelicula["id"];
  ?>
  <li class="flex-item"><img class="fotoPelicula" src="imgs/peliculas/<?php echo $rowPelicula["url_foto"]; ?>" alt="">
  <p style="display: flex; justify-content: space-around;">

  <!--aplicando el operador ternario para agregar la clase checkenlike -->
  <span>
  <i class="far fa-thumbs-up iconVotoLike <?php echo isset($_COOKIE[$idPelicula]) ? 'checkenlike' : '' ?>" id="like<?php echo $rowPelicula["id"]; ?>" data-id="<?php echo $rowPelicula["id"]; ?>"></i> 
    <span id="respuestaVotoLike<?php echo $rowPelicula["id"]; ?>"> <?php echo $rowPelicula["megusta"]; ?></span>
  </span>

  <span>
  <i class="far fa-thumbs-down iconVotoDislike" id="dislike" data-id="<?php echo $rowPelicula["id"]; ?>"></i>
    <span id="respuestaVoto<?php echo $rowPelicula["id"]; ?>"> <?php echo $rowPelicula["megusta"]; ?></span>
  </span>
  </p>
  </li>
<?php } ?>
</ul>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="js/scriptVotos.js"></script>
</body>
</html>