$(".inappropriate").on("click", function(e){
        var postid = $(".like_btn").attr('id');
        var id = postid.slice(5);
    console.log("click");
    $.ajax({
        method: "POST",
        url: "lib/ajax/ajax_inappropriate.php",
        data: { id: id }
    })
    .done(function( res ) {
        if( res.status == 'success' ) {
            if( res.type == 'flag' ) {
                console.log("flagged");
                $(".inappropriate > a").html("unflag");
                $(".inappropriate").css("width","80px");
                $(".inappropriate").css("background-color","red");
            }
            else if( res.type == 'unflag' ) {   
                console.log("unflagged");
                $(".inappropriate > a").html("flag");
                $(".inappropriate").css("width","60px");
                $(".inappropriate").css("background-color","#41e1fc");
            }
        }
    });
    
    e.preventDefault();
});