var i=0

$(".formLoad__button").on("click", function(e){
        console.log("click");
        //var comment= $(".postForm__text").val();
         i++;
         
           
        //TO DATABASE
        $.ajax({
            method: "POST",
            url: "loadMore.php",
            data: { i: i },
            dataType: 'json'
            })
            .done(function( res ) {
            if (res.status == "succes"){
                console.log("succesvol verstuurd");
                var collection= res.collection;
                //JSON.parse(collection);
                
                for(var x=0 ; x<collection.length; x++){
                var newLoad= `<div class="item clearfix">
                <div class="user">
                     <img src="${collection[x].picture}" alt="avatar" class="avatar">
                     <a href="profile.php?user=?">${collection[x].username}</a>
                </div>
                <a href="detail.php?post=?"><img src="${collection[x].image}" alt="image" class="picture_index"></a>
                <div class="date"><bold>${collection[x].date} </bold></div>
                <div class="likes">Likes</div>
             </div>`;
            

            $(".collection").append(newLoad);
        };
            }  
         });           
          
          
         e.preventDefault();
});