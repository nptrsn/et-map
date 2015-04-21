var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Castro/Upper Market area
function hoverCastro(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(37.769086,-122.437992),
	new google.maps.LatLng(37.769019,-122.434988),
	new google.maps.LatLng(37.769222,-122.432842),
	new google.maps.LatLng(37.769426,-122.429409),
	new google.maps.LatLng(37.769561,-122.426834),
	new google.maps.LatLng(37.762844,-122.426233),
	new google.maps.LatLng(37.756737,-122.425718),
	new google.maps.LatLng(37.756466,-122.428637),
	new google.maps.LatLng(37.756126,-122.434130),
	new google.maps.LatLng(37.755991,-122.437563),
	new google.maps.LatLng(37.755583,-122.437735),
	new google.maps.LatLng(37.755380,-122.438679),
	new google.maps.LatLng(37.756330,-122.438850),
	new google.maps.LatLng(37.756330,-122.440052),
	new google.maps.LatLng(37.756126,-122.440825),
	new google.maps.LatLng(37.756533,-122.441168),
	new google.maps.LatLng(37.756669,-122.441940),
	new google.maps.LatLng(37.757076,-122.442369),
	new google.maps.LatLng(37.757619,-122.442884),
	new google.maps.LatLng(37.758162,-122.443743),
	new google.maps.LatLng(37.758366,-122.444944),
	new google.maps.LatLng(37.758637,-122.446232),
	new google.maps.LatLng(37.759248,-122.446318),
	new google.maps.LatLng(37.760876,-122.446404),
	new google.maps.LatLng(37.761148,-122.446404),
	new google.maps.LatLng(37.761826,-122.446833),
	new google.maps.LatLng(37.761758,-122.446404),
	new google.maps.LatLng(37.762098,-122.446060),
	new google.maps.LatLng(37.763183,-122.444601),
	new google.maps.LatLng(37.764337,-122.444429),
	new google.maps.LatLng(37.764473,-122.444086),
	new google.maps.LatLng(37.764948,-122.444086),
	new google.maps.LatLng(37.765965,-122.442627),
	new google.maps.LatLng(37.765762,-122.442198),
	new google.maps.LatLng(37.766847,-122.440567),
	new google.maps.LatLng(37.767594,-122.440138),
	new google.maps.LatLng(37.768069,-122.439451),
	new google.maps.LatLng(37.769019,-122.438078)
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