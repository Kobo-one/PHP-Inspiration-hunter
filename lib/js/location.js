$( document ).ready(function() {


            navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
                if(PermissionStatus.state == 'granted'){

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            post(position.coords.latitude, position.coords.longitude);
                          });
                          
                    } else {
                        console.log("user doens't allow geolocation");
                    }
                }else{
                    post("","");
                }
            })
            

        
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