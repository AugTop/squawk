@extends('layout.layout')

@section('content')
<main role="main" class="container">
  <div class="jumbotron">
    <h1>{{ $flight->callsign }}</h1>
    <p class="lead">A flight from {{ $flight->departure }} to {{ $flight->destination }} </p>
    <p> Pilot VID : {{ $flight->vid }}</p>
    <hr />
    <h2>Flight plan of {{ $flight->callsign }} :</h2>
    <p>(FPL-{{ $flight->callsign }}-@if($flight->rule == 'V'){{ $flight->rule }}G @else{{ $flight->rule }}S @endif<br/>
      -{{ $flight->aircraft }} <br/>
      -{{ $flight->departure }}{{ $flight->departure_time }} <br />
      -{{ $flight->route }}<br />
      -{{ $flight->destination }}{{ $flight->destination_time }} {{ $flight->alternate }} <br />
      -{{ $flight->rmk }})</p>

      <h1>Generated code :<h1>
        <h2>{{ $code }}</h2>
      </div>
      <div id='map' class="container" style='width: 800px; height: 400px;'></div>
      <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYXVndG9wIiwiYSI6ImNqczBpYTVlajFleHg0NGx4eGZ6bnFibHoifQ.VNbNg3PwIVzwKG9X1K8Z3Q';
        var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: [{{ $flight->lng }}, {{ $flight->lat }} ],
          zoom: 5,
        });

        map.on('load', function() {
          map.addSource('places', {
            'type': 'geojson',
            'data': {
              'type': 'FeatureCollection',
              'features': [
              {
                'type': 'Feature',
                'properties': {
                  'description':
                  '<strong>{{ $flight->callsign }}</strong><p>A flight from {{ $flight->departure }} to {{ $flight->destination }} <br/> ROUTE : {{ $flight->route }}</p>',
                  'icon': 'airport'
                },
                'geometry': {
                  'type': 'Point',
                  'coordinates': [{{ $flight->lng }}, {{ $flight->lat }} ]
                }
              }, 
              ]
            }
          });
        // Add a layer showing the places.
        map.addLayer({
          'id': 'places',
          'type': 'symbol',
          'source': 'places',
          'layout': {
            'icon-image': '{icon}-15',
            'icon-allow-overlap': true
          }
        });
        map.on('click', 'places', function(e) {
          var coordinates = e.features[0].geometry.coordinates.slice();
          var description = e.features[0].properties.description;

            // Ensure that if the map is zoomed out such that multiple
            // copies of the feature are visible, the popup appears
            // over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
              coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }

            new mapboxgl.Popup()
            .setLngLat(coordinates)
            .setHTML(description)
            .addTo(map);
          });

        // Change the cursor to a pointer when the mouse is over the places layer.
        map.on('mouseenter', 'places', function() {
          map.getCanvas().style.cursor = 'pointer';
        });

        // Change it back to a pointer when it leaves.
        map.on('mouseleave', 'places', function() {
          map.getCanvas().style.cursor = '';
        });
      });

    </script>
  </main>

  @endsection