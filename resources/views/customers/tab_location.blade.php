<div class="content">
   <div id='map' style="width: 100%; height: 600px;"></div>
</div>

@push('page_scripts')
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <script type="text/javascript">
        function getLocData() {
            var centerLoc = "";

            var lat = "{{ $customer->Latitude }}"
            var longi = "{{ $customer->Longitude }}"

            if (jQuery.isEmptyObject(lat) | jQuery.isEmptyObject(longi)) {
               centerLoc = "0,0"
            } else {
               centerLoc = lat + "," + longi
            }

            return centerLoc;
        }

        $(document).ready(function() {
            // MAPBOX
            mapboxgl.accessToken = 'pk.eyJ1IjoianVsemxvcGV6IiwiYSI6ImNqZzJ5cWdsMjJid3Ayd2xsaHcwdGhheW8ifQ.BcTcaOXmXNLxdO3wfXaf5A';

            var centerLoc = getLocData();

            var map = new mapboxgl.Map({
                container: 'map',
                zoom: 15,
                center: [centerLoc.split(",")[1], centerLoc.split(",")[0]],
                style: 'mapbox://styles/mapbox/satellite-v9'
            });

            map.once('idle',function(){
               const markerBldg = new mapboxgl.Marker()
                        .setLngLat([centerLoc.split(",")[1], centerLoc.split(",")[0]])
                        .addTo(map);
            });    

            
        });
    </script>
@endpush