$("#text").on("keyup",function()
{   
var str= $(this).val();
//geeft alle @'s in array   
//var res=str.match(/@([A-Za-z0-9_]+)/gm);
var result=str.match(/@([A-Za-z0-9_]+)/gm)
console.log(result);
var count=str.match(/@([A-Za-z0-9_]+)/gm).length;
var i;

if(result){
    $.ajax({
        type: "POST",
        //Data will be sent to "ajax.php".
        url: "lib/ajax/ajax_liveTag.php",
        //Data, that will be sent to "ajax.php".
        data: {
            names: result,
            count:count
        }
        }).done(function( res ) {
            if( res.status == 'success' ) {
                var names=res.users;
                $('.search_comment').html("");
                //voor elke naam in res.names neem de username en append die aan de div search_comment
                for(var x=0 ; x<names.length; x++){
                    var searchRes= `<li>@${names[x].username} </li>`;
                    $('.search_comment').append(searchRes);
                }
                $('.search_comment li').on('click', function(){
                    //wanneer op naam wordt geklikt -> vervang de @ met die naam
                    var resValue = $(this).text();
                    var str= $("#text").val();
                    var match = str.match(/@([A-Za-z0-9_]+)/gm);
                   
                    newValue=str.replace(match[res.count],resValue);
                    $("#text").val(newValue);
                    
                    $('.search_comment').empty();
                    $("#text").focus();
                   
                })
                
                
            }  
            if(res.status == 'error' ){
               
                $('.search_comment').html("");
              
            }

    });
}

})
