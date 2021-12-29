$(function(){
  //Accion para el Boton me Gusta Like
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
          url: "accion_Like.php",
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
          url: "accion_Like.php",
          type: "POST",
          data: dataStringDislike,
          success: function(data){
            $('#like' + idvotodislike).removeClass('checkenlike'); //quito la clase
           $("#respuestaVotoLike" + idvotodislike).html(data); // Mostrar la respuestas del script PHP.
          }
        });
      
     }   
  });
//Fin de las acciones para el boton me gusta Like
  

//Accion para el boton No me Gusta Dislike
    var clicdis = 1;
    $(".iconVotoDislike").click(function(){
       if(clicdis==1){
        clicdis = clicdis + 1;
        likeVoto =1;
        var idvotoPelicula   = $(this).attr("data-id"); //capturando el id de quien recibira el voto
        
        //enviando voto con Ajax
        var menoslike =0;
        dataStringLike = 'accion='+ menoslike +'&idvotoPelicula=' + idvotoPelicula;
        $.ajax({
            url: "accion_Dislike.php",
            type: "POST",
            data: dataStringLike,
            success: function(data){
              $("#like" + idvotoPelicula).addClass("checkenlike"); //Agrego clase de checke like
              $("#respuestaVotoDisLike" + idvotoPelicula).html(data); // Mostrar la respuestas del script PHP.
              console.log(data);
            }
          });
       
       } else{
        clicdis = 1;
        var idvotodislike   = $(this).attr("data-id");
        //enviando voto con Ajax
        var dislike = 0;
        var dislikeVoto=1;
        dataStringDislike = 'accion='+ dislike + '&idvotoPelicula=' + idvotodislike;
         $.ajax({
            url: "accion_Dislike.php",
            type: "POST",
            data: dataStringDislike,
            success: function(data){
              $('#like' + idvotodislike).removeClass('checkenlike'); //quito la clase
             $("#respuestaVotoDisLike" + idvotodislike).html(data); // Mostrar la respuestas del script PHP.
            }
          });
        
       }   
    });
  //Fin de las acciones para el boton me gusta Like
  
  });