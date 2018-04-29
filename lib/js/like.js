$(".like_btn").on("click", function(e){
    var postid = $(this).attr('id');
    var id = postid.slice(5);
    
    $.ajax({
        method: "POST",
        url: "lib/ajax/ajax_like.php",
        data: { id: id }
    })
    .done(function( res ) {
        if( res.status == 'success' ) {
        }
    });
    
    e.preventDefault();
});