$("#text").on("keyup",function()
{   
var str= $(this).val();
//geeft alle @'s in array   
//var res=str.match(/@([A-Za-z0-9_]+)/gm);
var res=str.match(/@([A-Za-z0-9_]+)/gm);
console.log(res);
if(res){
    $.ajax({
        //AJAX type is "Post".
        type: "POST",
        //Data will be sent to "ajax.php".
        url: "ajax_liveTag.php",
        //Data, that will be sent to "ajax.php".
        data: {
            //Assigning value of "name" into "search" variable.
            names: res
        }
        }).done(function( res ) {
            if( res.status == 'success' ) {
                var names=res.users;
                console.log(names);
                $('.search_comment').html("");
                for(var x=0 ; x<names.length; x++){
                var searchRes= `<li>${names[x].username} </li>`;
                $('.search_comment').append(searchRes);
                }
                $('.search_comment').on('click', 'li', function(){
                    var resValue = $(this).text();
                   resValue='@.'+resValue
                    var str= $("#text").val();
                    console.log(str);
                    newValue=str.replace(/@([A-Za-z0-9_]+)/gm, resValue);
                   
                    console.log(newValue);
                    $("#text").val(newValue);
                    $('.search_comment').empty();
                   $("#text").focus();
                });
                
            }

    });
}

})
