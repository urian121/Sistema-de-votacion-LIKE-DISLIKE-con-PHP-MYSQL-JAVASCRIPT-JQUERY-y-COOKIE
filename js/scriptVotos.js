$(function(){
  var clic = 1;
  $(".iconVotoLike").click(function(){
     if(clic==1){
      clic = clic + 1;
      likeVoto =1;
      var idvotoPelicula   = $(this).attr("data-id"); //capturando el id de quien recibira el voto
      
      //enviando voto con Ajax
      var like =1;
      dataStringLike = 'accion='+ like +'&likeVoto=' + likeVoto +'&idvotoPelicula=' + idvotoPelicula;
      $.ajax({
          url: "votoUser.php",
          type: "POST",
          data: dataStringLike,
          success: function(data){
            $("#like" + idvotoPelicula).addClass("checkenlike"); //Agrego clase de checke like
            $("#respuestaVotoLike" + idvotoPelicula).html(data); // Mostrar la respuestas del script PHP.
            console.log(data);
          }
        });
     
     } else{
      clic = 1;
      var idvotodislike   = $(this).attr("data-id");
      //enviando voto con Ajax
      var dislike = 0;
      var dislikeVoto=0;
      dataStringDislike = 'accion='+ dislike +'&dislikeVoto=' + dislikeVoto + '&idvotoPelicula=' + idvotodislike;
       $.ajax({
          url: "votoUser.php",
          type: "POST",
          data: dataStringDislike,
          success: function(data){
            $('#like' + idvotodislike).removeClass('checkenlike'); //quito la clase
           $("#respuestaVotoLike" + idvotodislike).html(data); // Mostrar la respuestas del script PHP.
          }
        });
      
     }   
  });
  
  
  //Accion Dislike
  
  
  
  
  });