$(".like_btn").on("click", function(e){
    var postid = $(this).attr('id');
    var id = postid.slice(5);
    var status = 
    $.ajax({
        method: "POST",
        url: "lib/ajax/ajax_like.php",
        data: { id: id, status: status }
    })
    .done(function( res ) {
        if( res.status == 'success' ) {
        }
    });
    
    e.preventDefault();
});