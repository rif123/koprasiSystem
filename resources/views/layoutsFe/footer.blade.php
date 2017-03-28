            </div>
</div>
</body>
<!-- Javascript Files
================================================== -->
<script src="{{ URL::asset('') }}js/jquery.min.js"></script>
<script src="{{ URL::asset('') }}js/jpreLoader.min.js"></script>
<script src="{{ URL::asset('') }}js/bootstrap.min.js"></script>
<script src="{{ URL::asset('') }}js/jquery.isotope.min.js"></script>
<script src="{{ URL::asset('') }}js/easing.js"></script>
<script src="{{ URL::asset('') }}js/jquery.flexslider-min.js"></script>
<script src="{{ URL::asset('') }}js/jquery.scrollto.js"></script>
<script src="{{ URL::asset('') }}js/owl.carousel.js"></script>
<script src="{{ URL::asset('') }}js/jquery.countTo.js"></script>
<script src="{{ URL::asset('') }}js/classie.js"></script>
<script src="{{ URL::asset('') }}js/video.resize.js"></script>
<script src="{{ URL::asset('') }}js/validation.js"></script>
<script src="{{ URL::asset('') }}js/wow.min.js"></script>
<script src="{{ URL::asset('') }}js/jquery.magnific-popup.min.js"></script>
<script src="{{ URL::asset('') }}js/enquire.min.js"></script>
<script src="{{ URL::asset('') }}js/designesia.js"></script>

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script type="text/javascript" src="{{ URL::asset('') }}rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('') }}rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var myLatlng = new google.maps.LatLng({{$latitude}}, {{$longitude}});

            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 17,
                disableDefaultUI: false,
				scrollwheel: false,

                // The latitude and longitude to center the map (always required)

                center: myLatlng, // New York

                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using out element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: "{{$marker_text}}"
            });

            var infowindow = new google.maps.InfoWindow({
                content:"{{$marker_text}}"
            });

            infowindow.open(map,marker);



        }

</script>

</html>
