$("form").on("click",".button--tag--follow", function(e){
           //tagname die je wilt volgen meegeven
       
           var tag = $(".hashtag_title").attr('id');
           var tagName = tag.slice(0);
           
           $.ajax({
               method: "POST",
               url: "lib/ajax/ajax_tagfollow.php",
               data: { tagName: tagName, active:1}
               })
               .done(function( res ) {
               if (res.status == "succes"){
               //Insert statement OK ->button 'refreshen': nieuwe class en value
               console.log("follow succesvol verstuurd");
              
               $(".button--tag--follow").removeClass("button--tag--follow").addClass("button--tag--unfollow");
               $(".button--tag--unfollow").val("unfollow");
               $(".button--tag--unfollow").attr("name", "unfollow"); 
               }  
            });           
              
               e.preventDefault();
       });
   
     $("form").on("click",".button--tag--unfollow", function(e){
           //tagname die je wilt volgen meegeven
           var tag = $(".hashtag_title").attr('id');
           var tagName = tag.slice(0);
           
           var active=0;
           $.ajax({
               method: "POST",
               url: "lib/ajax/ajax_tagfollow.php",
               data: { tagName: tagName, active:0}
               })
               .done(function( res ) {
               if (res.status == "succes"){
               //Insert statement OK ->button 'refreshen': nieuwe class en value
               
               console.log("unfollow succesvol verstuurd");
               $(".button--tag--unfollow").removeClass("button--tag--unfollow").addClass("button--tag--follow");
               $(".button--tag--follow").val("follow");
               $(".button--tag--follow").attr("name", "follow");
               }  
            });           
              
               e.preventDefault();
       });   
       