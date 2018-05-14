$( document ).ready(function() {



                        navigator.geolocation.getCurrentPosition(function(position) {
                                post(position.coords.latitude, position.coords.longitude);

                          },function (error) { 
                            if (error.code == error.PERMISSION_DENIED){
                                post("","");
                            }
                          });
                          
            

        
        function post(lat,lng) {
            $.ajax({
                method: "POST",
                url: "lib/ajax/ajax_location.php",
                data: {lat: lat, lng: lng}
            })
            .done(function( res ) {
                if( res.status == 'success' ) {
                    console.log("Success");
                }
            }); 
       
        }


});