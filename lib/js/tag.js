$("#text").on("keyup",function()
{   
var str= $(this).val();
//geeft alle @'s in array   
//var res=str.match(/@([A-Za-z0-9_]+)/gm);
var result=str.match(/@([A-Za-z0-9_]+)/gm)
console.log(result);
var count=str.match(/@([A-Za-z0-9_]+)/gm).length;
  
if(result){
    $.ajax({
        //AJAX type is "Post".
        type: "POST",
        //Data will be sent to "ajax.php".
        url: "lib/ajax/ajax_liveTag.php",
        //Data, that will be sent to "ajax.php".
        data: {
            //Assigning value of "name" into "search" variable.
            names: result,
            count:count
        }
        }).done(function( res ) {
            if( res.status == 'success' ) {
                var names=res.users;
                $('.search_comment').html("");
                for(var x=0 ; x<names.length; x++){
                var searchRes= `<li>@${names[x].username} </li>`;
                $('.search_comment').append(searchRes);
                }
                $('.search_comment li').on('click', function(){
                    var resValue = $(this).text();
                    resValue=resValue
                    
                    console.log(resValue);
                    var str= $("#text").val();
                    /*newValue=str.replace(/@([A-Za-z0-9_]+)/gm, function (match) {
                        
                        return (t === res.count) ? resValue : match;
                      });*/
                    var match = str.match(/@([A-Za-z0-9_]+)/gm);
                    $current=match[res.count];
                   
                   newValue=str.replace(match[res.count],resValue);
                    
                    $("#text").val(newValue);
                    
                    $('.search_comment').empty();
                   $("#text").focus();
                })
           
            }  
            if(res.status == 'error' ){
               var i=0;
                $('.search_comment').html("");
                /*$("#text").one("keypress",function (e) {
                    
                    if (e.key === ' ' || e.key === 'Spacebar' && i==0) {
                    console.log("space");
                    var space=str.replace(/@/gm, '@.');
                    $("#text").val(space);
                    $(this).val($(this).val() + " "); 
                    i++;
                    e.preventDefault()
                    
                    
                    }
                })*/
            }

    });
}

})
