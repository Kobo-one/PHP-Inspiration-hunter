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
        var likebtn = $('#post_'+id);
        if( res.status == 'success' ) {
            if( res.type == 'liked' ) {

                likebtn.attr('src',"images/liked_btn.png");
                var likes = likebtn.parent().siblings('.likes').find("span");
                var num = +(likes.text()) + 1;
                likes.text(num);
                console.log(num);

            }
            else if( res.type == 'disliked' ) {

                likebtn.attr('src',"images/tolike_btn.png");
                var likes = likebtn.parent().siblings('.likes').find("span");
                var num = +(likes.text()) - 1;
                likes.text(num);
                console.log(num);

            }
        }
    });
    
    e.preventDefault();
});