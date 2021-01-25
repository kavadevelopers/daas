
    <h3>Drag or re-shape for coordinates to display below</h3>
    <div id="map-canvas">
    </div>
    <div id="info">
    </div>



<style type="text/css">
	#map-canvas {
    width: auto;
    height: 500px;
}
#info {
    position: absolute;
    font-family: arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
}
</style>
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&&libraries=drawing'></script>
<script type="text/javascript">
	var bermudaTriangle;
	initialize();
function initialize() {
    var myLatLng = new google.maps.LatLng(18.453308, 73.812018);
    var mapOptions = {
        zoom: 10,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.RoadMap
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'),
                                  mapOptions);


    var triangleCoords = [
        new google.maps.LatLng(18.583129,73.73829),
        new google.maps.LatLng(18.419037,73.743783),
        new google.maps.LatLng(18.426855,74.028055),
        new google.maps.LatLng(18.601352,74.012949),

    ];

    // Construct the polygon
    bermudaTriangle = new google.maps.Polygon({
    	paths: triangleCoords,
        draggable: true,
        editable: true,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });

    bermudaTriangle.setMap(map);

    google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);
}

function getPolygonCoords() {
    var len = bermudaTriangle.getPath().getLength();
    var htmlStr = "";
    for (var i = 0; i < len; i++) {
        htmlStr += bermudaTriangle.getPath().getAt(i).toUrlValue(5) + "<br>";
    }
    document.getElementById('info').innerHTML = htmlStr;
}
</script>