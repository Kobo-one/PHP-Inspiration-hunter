$("#btnAddComment").on("click", function(e){
    //console.log("hallo?");
    var comment = $("#text").val();
    var postid = $(".new_comment").attr('id');
    var id = postid.slice(5);
    $.ajax({
        method: "POST",
        url: "lib/ajax/ajax_createcomment.php",
        //de eerste 'comment' is de naam vd kolom, de tweede is de value
        data: { comment: comment,postId: id }
    })
    .done(function( res ) {
        if( res.status == 'success' ) {
            //console.log("clicked maal 1010");
            var newComment = `<div style='display:none' class="comment"><div class="comment_username">${res.user.username}</div><p>${res.comment}</p></div>`
            $("#commentfeed").append(newComment);
            $("#commentfeed .comment").slideDown();
            $("#text").val("");
            console.log(res.user);
        }
        if(res.status=="error"){
            console.log("error");
        }
    });
    
    e.preventDefault();
});


