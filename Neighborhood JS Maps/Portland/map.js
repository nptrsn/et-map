var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Castro/Upper Market area
function hoverLaurelhurst(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(45.519274, -122.617333),
	new google.maps.LatLng(45.531661, -122.617247),
	new google.maps.LatLng(45.534607, -122.629006),
	new google.maps.LatLng(45.534457, -122.630680),
	new google.maps.LatLng(45.528414, -122.630701),
	new google.maps.LatLng(45.527632, -122.631302),
	new google.maps.LatLng(45.526783, -122.631667),
	new google.maps.LatLng(45.522151, -122.631678),
	new google.maps.LatLng(45.522128, -122.632107),
	new google.maps.LatLng(45.519299, -122.631996),
	new google.maps.LatLng(45.519284, -122.617308),
  ];

  // Construct the polygon
  areaHighlight = new google.maps.Polygon({
    paths: shapeCoords,
    strokeColor: '#a0151f',
    strokeOpacity: 0.3,
    strokeWeight: 1,
    fillColor: '#a0151f',
    fillOpacity: 0.35
  });

  areaHighlight.setMap(map);
}
// Highlight Alberta area
function hoverAlberta(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  new google.maps.LatLng(45.557284, -122.649747),
  new google.maps.LatLng(45.559989, -122.649715),
  new google.maps.LatLng(45.560019, -122.658513),
  new google.maps.LatLng(45.557303, -122.658577)
  ];

  // Construct the polygon
  areaHighlight = new google.maps.Polygon({
    paths: shapeCoords,
    strokeColor: '#a0151f',
    strokeOpacity: 0.3,
    strokeWeight: 1,
    fillColor: '#a0151f',
    fillOpacity: 0.35
  });

  areaHighlight.setMap(map);
}


///////////////////
// Clear the map
function clearMap(){
  areaHighlight.setMap(null);
}
// Done with Neighborhood Highlights
function initialize() {
        mapOptions = {
          center: { lat: 45.5424364, lng: -122.654422},
          zoom: 12,
          scrollwheel: false,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
  google.maps.event.addDomListener(window, 'load', initialize);