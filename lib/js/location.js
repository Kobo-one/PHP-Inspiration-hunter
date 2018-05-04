$( document ).ready(function() {

            var lat;
            var lng;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    post(position.coords.latitude, position.coords.longitude);
                  });
            } else {
                console.log("user doens't allow geolocation");
            }

        
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