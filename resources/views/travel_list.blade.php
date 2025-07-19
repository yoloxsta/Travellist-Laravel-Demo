@extends('main')

@section('content')
    <div class="map_container clearfix">
        <div class="column x3">
            <div class="column x5">
                <ul class="list">
                    <li class="header visited">Visited</li>
                    @forelse ($visited as $place)
                        <li>{{ $place->name ?? 'Unnamed Location' }}</li>
                    @empty
                        <li>No visited locations yet</li>
                    @endforelse
                </ul>
            </div>

            <div class="column x5">
                <ul class="list">
                    <li class="header togo">To Go</li>
                    @forelse ($togo as $place)
                        <li>{{ $place->name ?? 'Unnamed Location' }}</li>
                    @empty
                        <li>No planned locations yet</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="column x7">
            <div id="map" class="map"></div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

@section('footer')
    <div class="footer">
        <p>
            <a href="https://github.com/do-community/travellist-laravel-demo/tree/tutorial-04" target="_blank" title="Source Code on Github">Travellist Laravel Demo</a>
        </p>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var map;
        var mapLat = 0;
        var mapLng = 0;
        var mapDefaultZoom = 2;

        // Initialize map
        map = new ol.Map({
            target: "map",
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM({
                        url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    })
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([mapLng, mapLat]),
                zoom: mapDefaultZoom
            })
        });

        // Function to safely add markers
        function addSafeMarker(place, iconPath) {
            try {
                // Validate coordinates exist and are numbers
                if (typeof place.lat !== 'undefined' && 
                    typeof place.lng !== 'undefined' &&
                    !isNaN(parseFloat(place.lat)) && 
                    !isNaN(parseFloat(place.lng))) {
                    
                    // Ensure coordinates are within valid ranges
                    const lat = Math.max(-90, Math.min(90, parseFloat(place.lat)));
                    const lng = Math.max(-180, Math.min(180, parseFloat(place.lng)));
                    
                    add_map_point(lat, lng, iconPath);
                }
            } catch (e) {
                console.error('Error adding marker for place:', place, e);
            }
        }

        // Add markers for "To Go" places
        @isset($togo)
            @foreach ($togo as $place)
                addSafeMarker(@json($place), "/img/marker_togo.png");
            @endforeach
        @endisset

        // Add markers for "Visited" places
        @isset($visited)
            @foreach ($visited as $place)
                addSafeMarker(@json($place), "/img/marker_visited.png");
            @endforeach
        @endisset

        // Fallback if no valid coordinates found
        if (map.getLayers().getArray().length === 1) { // Only base layer exists
            map.getView().setZoom(1); // Zoom out further if no markers
        }
    </script>
@endsection