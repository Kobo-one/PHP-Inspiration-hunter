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

            }
            else if( res.type == 'unflag' ) {
                console.log("unflagged");

            }
        }
    });
    
    e.preventDefault();
});