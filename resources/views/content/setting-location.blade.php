@extends('layouts.index')
    @section('header')
    <style>
    .controls {
        margin-top: 10px;
        margin-right: 10px;
        position:absolute;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
         z-index: 99;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
      #searcbox{
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #searchbox:focus {
        border-color: #4d90fe;
      }

    </style>

    @stop
    @section('js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key={{$_ENV['GMAPS_API']}}"></script>
        <script type="text/javascript">
            var marker;
            function defMap(lat,long) {
              if (lat == undefined) id_lati = "lat";
              if (long == undefined) id_longi = "long";

                        lati = -6.886697;
                        longi=107.615295;
                        map = drawMap(lati,longi);
                        drawMarker(lati,longi,map,"Your Location");
                        drawSearchBox(marker,map);
                        document.getElementById(id_lati).value = lati;
                        document.getElementById(id_longi).value = longi;

                        google.maps.event.addListener(map, 'click', function(event) {
                            marker.setMap(null);
                            drawMarker(event.latLng.lat(),event.latLng.lng(),map,"Your Location");
                        });
            }

            function drawMap(lati,longi,zoomVal,id_lati,id_longi){
                if (zoomVal == undefined) {
                    zoomVal = 18;
                }

                if (id_lati == undefined) id_lati = "lat";
                if (id_longi == undefined) id_longi = "long";

                document.getElementById(id_lati).value = lati;
                document.getElementById(id_longi).value = longi;

                var mapProperty = {
                        center:new google.maps.LatLng(lati,longi),
                        zoom:zoomVal,
                        mapTypeId:google.maps.MapTypeId.ROADMAP
                    };
                var map=new google.maps.Map(document.getElementById("map"),mapProperty);

               return map;
            }

            function drawMarker(lati,longi,map,infowdw,id_lati,id_longi){
                if (id_lati == undefined) id_lati = "lat";
                if (id_longi == undefined) id_longi = "long";

                document.getElementById(id_lati).value = lati;
                document.getElementById(id_longi).value = longi;

                if(marker != undefined) marker.setMap(null);

                var myLatLng = {lat: lati, lng: longi};
                 marker = new google.maps.Marker({
                    position: myLatLng,
                    map:map,
                 });

                marker.setMap(map);

                if (infowdw != undefined) {
                    infowindow = drawInfoWindow(infowdw);
                    infowindow.open(map,marker);
                }


            }

            function drawInfoWindow(title){
                var infowindow = new google.maps.InfoWindow({
                    content:title
                });

                return infowindow;
            }

            function drawSearchBox(marker,map) {
                  // Create the search box and link it to the UI element.
                    var input = document.getElementById('searchbox');
                    var autocomplete = new google.maps.places.Autocomplete(input,{
                        componentRestrictions: {'country': 'id'}
                    });
                    var searchBox = new google.maps.places.SearchBox(input);


                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

                    map.addListener('bounds_changed', function() {
                      searchBox.setBounds(map.getBounds());
                    });

                    searchBox.addListener('places_changed', function() {
                      var places = searchBox.getPlaces();

                      if (places.length == 0) {
                        return;
                      }


                      // For each place, get the icon, name and location.
                      var bounds = new google.maps.LatLngBounds();

                      places.forEach(function(place) {
                        console.log(place);
                        var icon = {
                          url: place.icon,
                          size: new google.maps.Size(71, 71),
                          origin: new google.maps.Point(0, 0),
                          anchor: new google.maps.Point(17, 34),
                          scaledSize: new google.maps.Size(25, 25)
                        };


                      //   Create a marker for each place.
                        drawMarker(place.geometry.location.lat(),place.geometry.location.lng(),map);

                        if (place.geometry.viewport) {
                          // Only geocodes have viewport.
                          bounds.union(place.geometry.viewport);
                        } else {
                          bounds.extend(place.geometry.location);
                        }
                      });

                      map.fitBounds(bounds);
                    });


            }

            @if(!empty($latitude))
                lati = parseFloat(document.edit.lat.value);
                longi = parseFloat(document.edit.long.value);
                var map = drawMap(lati,longi);
                drawMarker(lati,longi,map,"Your Store");
                drawSearchBox(marker,map);

                 google.maps.event.addListener(map, 'click', function(event) {
                     marker.setMap(null);
                     drawMarker(event.latLng.lat(),event.latLng.lng(),map,"Your Store");
                 });
            @else
                defMap();
            @endif
        </script>
    @stop
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
            <section class="content">

                <div class="container-fluid">
                    <div class="block-header">
                        <h2>General Setting</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Location Setting</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                @if($errors->has())
                                    <div class="alert alert-danger">
                                        <h4>Error:</h4>
                                        <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                      </ul>
                                    </div>
                                @endif
                                <div class="body">
                                    <form name="edit" method="POST">
                                        <h2 class="card-inside-title">Marker Title</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="marker_text" value="{{$marker_text}}"  placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Marker Location</h2>
                                        <div class="input-group">
                                            <input id="searchbox" type="text" placeholder="Search your location" class="controls" />
                                            <div id="map" style="width: 500px;height: 500px;"></div>
                                        </div>
                                        <input type="hidden" name="lat" id="lat" value="{{$latitude}}"/>
                                        <input type="hidden" name="long" id="long" value="{{$longitude}}"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div style="text-align:center">
                                            <button type="Submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop