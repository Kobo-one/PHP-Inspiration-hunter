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
                        <a href="profile.php?user=${collection[x].post_user_id}">
                        <img src="${collection[x].picture}" alt="avatar" class="avatar">
                        </a>
                        <a href="profile.php?user=${collection[x].post_user_id}" class="username">${collection[x].username}</a>
                        </div>
                        <a href="detail.php?post=${collection[x].id}">
                        <figure class="${collection[x].filter} figure_index">
                        <img src="${collection[x].image}" alt="image" class="picture_index">
                        </figure>
                        </a>

                        <div class="feed_flex">
                        <div class="date">${collection[x].created}</div>
                        <div class="likes"><span>${collection[x].like}</span> likes</div>
                        
                        ${collection[x].userLike ==0 ? `<a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn" id="post_${collection[x].id}"></a>`:` <a href="#"><img src="images/liked_btn.png" alt="like button" class="like_btn" id="post_${collection[x].id}"></a>`}

                        </div>

                        </div>
                        `;
                        
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