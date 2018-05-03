if(!($(".edit").length)){

    $("form").on("click",".button--follow", function(e){
           //id van de user die je wilt volgen meegeven
       
           var userid = $(".profile_use").attr('id');
           var followerId = userid.slice(5);
           
           $.ajax({
               method: "POST",
               url: "ajax_follow.php",
               data: { followerId: followerId, active:1}
               })
               .done(function( res ) {
               if (res.status == "succes"){
               //Insert statement OK ->button 'refreshen': nieuwe class en value
               console.log("follow succesvol verstuurd");
              
               $(".button--follow").removeClass("button--follow").addClass("button--unfollow");
               $(".button--unfollow").val("unfollow");
               }  
            });           
              
               e.preventDefault();
       });
   
     $("form").on("click",".button--unfollow", function(e){
           //id van de user die je wilt volgen meegeven
           var userid = $(".profile_use").attr('id');
           var followerId = userid.slice(5);
           
           var active=0;
           $.ajax({
               method: "POST",
               url: "ajax_follow.php",
               data: { followerId: followerId, active:0}
               })
               .done(function( res ) {
               if (res.status == "succes"){
               //Insert statement OK ->button 'refreshen': nieuwe class en value
               
               console.log("unfollow succesvol verstuurd");
               $(".button--unfollow").removeClass("button--unfollow").addClass("button--follow");
               $(".button--follow").val("follow");
               
               }  
            });           
              
               e.preventDefault();
       });   
   }    