$("#text").on("keyup",function()
{   
var str= $(this).val();
   
var res=str.match(/@([A-Za-z0-9_]+)/gm);

    $.ajax({
        //AJAX type is "Post".
        type: "POST",
        //Data will be sent to "ajax.php".
        url: "ajax.php",
        //Data, that will be sent to "ajax.php".
        data: {
            //Assigning value of "name" into "search" variable.
            names: res
        },

        //If result found, this funtion will be called.

        success: function(html) {
            //Assigning result to "display" div in "search.php" file.
            $("#display").html(html).show();
        }

    });

})
