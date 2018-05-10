var i=0

$(".formLoad__button").on("click", function(e){
        console.log("click");
        //i = aantal keer op de knop geklikt
         i++;
         
           
        //TO DATABASE
        $.ajax({
            method: "POST",
            url: "lib/ajax/ajax_loadMore.php",
            data: { i: i },
            dataType: 'json'
            })
            .done(function( res ) {
            if (res.status == "succes"){
                console.log("succesvol verstuurd");
                var collection= res.collection;
                
                //loop over collection
                for(var x=0 ; x<collection.length; x++){
                    var newLoad= `<div class="item clearfix">
                        <div class="user">
                            <img src="${collection[x].picture}" alt="avatar" class="avatar">
                            <a href="profile.php?user=${collection[x].post_user_id}">${collection[x].username}</a>
                        </div>
                        <a href="detail.php?post=${collection[x].id}"><img src="${collection[x].image}" alt="image" class="picture_index"></a>
                        <div class="date"><bold>${collection[x].created} </bold></div>
                        <div class="likes">Likes</div>
                        </div>`;
                    $(".collection").append(newLoad);
                };
                console.log(res.count);
                
                //in sql loadMore() staat LIMIT op 21, als er maar 20 of minder resultaten zijn -> je kan geen resultaten meer ophalen=> hide de btn
               if(res.count <= 20){
                $(".formLoad").hide();
               }
            }  
         });           
          
          
         e.preventDefault();
});