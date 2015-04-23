var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Castro/Upper Market area
function hoverCastro(){

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