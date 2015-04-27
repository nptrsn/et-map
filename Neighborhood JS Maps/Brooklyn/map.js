var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Park Slope area
function hoverParkSlope(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(40.657500, -73.983050),
	new google.maps.LatLng(40.660861, -73.980035),
	new google.maps.LatLng(40.661097, -73.980078),
	new google.maps.LatLng(40.661235, -73.979692),
	new google.maps.LatLng(40.672179, -73.970722),
	new google.maps.LatLng(40.672968, -73.970411),
	new google.maps.LatLng(40.674156, -73.970700),
	new google.maps.LatLng(40.674637, -73.970239),
	new google.maps.LatLng(40.674995, -73.970851),
	new google.maps.LatLng(40.684592, -73.977791),
	new google.maps.LatLng(40.665204, -73.992404)
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
// Highlight Dumbo area
function hoverDumbo(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  new google.maps.LatLng(40.705551, -73.984517),
  new google.maps.LatLng(40.705396, -73.986394),
  new google.maps.LatLng(40.704656, -73.986469),
  new google.maps.LatLng(40.704672, -73.986662),
  new google.maps.LatLng(40.705079, -73.986705),
  new google.maps.LatLng(40.705071, -73.988186),
  new google.maps.LatLng(40.704575, -73.988261),
  new google.maps.LatLng(40.704656, -73.989570),
  new google.maps.LatLng(40.704835, -73.989688),
  new google.maps.LatLng(40.704908, -73.990214),
  new google.maps.LatLng(40.704623, -73.992155),
  new google.maps.LatLng(40.704575, -73.993625),
  new google.maps.LatLng(40.704217, -73.994580),
  new google.maps.LatLng(40.702615, -73.992563),
  new google.maps.LatLng(40.702566, -73.991694),
  new google.maps.LatLng(40.701695, -73.990568),
  new google.maps.LatLng(40.701443, -73.984785)
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
          center: { lat: 40.645244, lng: -73.9449975},
          zoom: 12,
          scrollwheel: false,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
  google.maps.event.addDomListener(window, 'load', initialize);