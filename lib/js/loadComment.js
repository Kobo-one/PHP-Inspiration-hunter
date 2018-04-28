$("#btnAddComment").on("click", function(e){
    var comment = $("#text").val();
    
    $.ajax({
        method: "POST",
        url: "lib/ajax/ajax_createcomment.php",
        //de eerste 'comment' is de naam vd kolom, de tweede is de value
        data: { comment: comment }
    });
    .done(function( res ) {
        if( res.status == 'success' ) {
            var newComment = `<div style='display:none' class="comment"><div class="comment_username">Ilona Vanseuningen</div><p>${res.comment}</p></div>`
            $("#commentfeed").prepend(newComment);
            $("#commentfeed div").first().slideDown();
        }
    });
    
    e.preventDefault();
});