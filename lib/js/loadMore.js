var i=0

$(".formLoad__button").on("click", function(e){
        console.log("click");
        //var comment= $(".postForm__text").val();
         i++;
         
           
        //TO DATABASE
        $.ajax({
            method: "POST",
            url: "loadMore.php",
            data: { i: i }
            })
            .done(function( res ) {
            if (res.status == "succes"){
                console.log("succesvol verstuurd");
                
               // var newLoad= `<p> ${res.collection}</p>`;

            //$(".collection").append(newLoad);
            }  
         });           
          
          
         e.preventDefault();
});