var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Castro/Upper Market area
function hoverWallingford(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(47.653683, -122.322330),
	new google.maps.LatLng(47.659233, -122.322287),
	new google.maps.LatLng(47.665273, -122.321944),
	new google.maps.LatLng(47.670418, -122.322073),
	new google.maps.LatLng(47.672296, -122.321558),
	new google.maps.LatLng(47.672325, -122.333488),
	new google.maps.LatLng(47.673076, -122.333574),
	new google.maps.LatLng(47.671053, -122.336235),
	new google.maps.LatLng(47.671631, -122.336921),
	new google.maps.LatLng(47.670649, -122.337951),
	new google.maps.LatLng(47.670244, -122.337951),
	new google.maps.LatLng(47.670187, -122.339882),
	new google.maps.LatLng(47.668727, -122.340054),
	new google.maps.LatLng(47.665750, -122.340097),
	new google.maps.LatLng(47.665071, -122.340312),
	new google.maps.LatLng(47.665042, -122.347307),
	new google.maps.LatLng(47.656695, -122.347284),
	new google.maps.LatLng(47.656646, -122.342414),
	new google.maps.LatLng(47.648056, -122.342742),
	new google.maps.LatLng(47.647622, -122.340188),
	new google.maps.LatLng(47.646032, -122.338107),
	new google.maps.LatLng(47.645107, -122.337249),
	new google.maps.LatLng(47.644514, -122.335918),
	new google.maps.LatLng(47.644485, -122.333987),
	new google.maps.LatLng(47.644875, -122.333236),
	new google.maps.LatLng(47.645602, -122.332866),
	new google.maps.LatLng(47.646918, -122.332866),
	new google.maps.LatLng(47.648117, -122.331128),
	new google.maps.LatLng(47.649115, -122.331535),
	new google.maps.LatLng(47.651514, -122.329046),
	new google.maps.LatLng(47.651326, -122.328553),
	new google.maps.LatLng(47.653100, -122.326858),
	new google.maps.LatLng(47.653389, -122.325506),
	new google.maps.LatLng(47.653389, -122.323854),
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
// Highlight UDistrict area
function hoverUDistrict(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(47.647370, -122.300174),
	new google.maps.LatLng(47.649365, -122.297041),
	new google.maps.LatLng(47.651880, -122.295625),
	new google.maps.LatLng(47.653759, -122.292320),
	new google.maps.LatLng(47.654453, -122.286655),
	new google.maps.LatLng(47.658355, -122.286848),
	new google.maps.LatLng(47.658529, -122.290582),
	new google.maps.LatLng(47.661246, -122.292771),
	new google.maps.LatLng(47.661361, -122.300517),
	new google.maps.LatLng(47.667864, -122.300656),
	new google.maps.LatLng(47.667951, -122.303822),
	new google.maps.LatLng(47.669974, -122.304122),
	new google.maps.LatLng(47.671563, -122.311890),
	new google.maps.LatLng(47.671159, -122.313048),
	new google.maps.LatLng(47.672141, -122.318413),
	new google.maps.LatLng(47.674511, -122.321159),
	new google.maps.LatLng(47.653788, -122.322490),
	new google.maps.LatLng(47.653701, -122.318155),
	new google.maps.LatLng(47.647833, -122.309229),
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
// Highlight Fremont area
function hoverFremont(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(47.647370, -122.300174),
	new google.maps.LatLng(47.649365, -122.297041),
	new google.maps.LatLng(47.651880, -122.295625),
	new google.maps.LatLng(47.653759, -122.292320),
	new google.maps.LatLng(47.654453, -122.286655),
	new google.maps.LatLng(47.658355, -122.286848),
	new google.maps.LatLng(47.658529, -122.290582),
	new google.maps.LatLng(47.661246, -122.292771),
	new google.maps.LatLng(47.661361, -122.300517),
	new google.maps.LatLng(47.667864, -122.300656),
	new google.maps.LatLng(47.667951, -122.303822),
	new google.maps.LatLng(47.669974, -122.304122),
	new google.maps.LatLng(47.671563, -122.311890),
	new google.maps.LatLng(47.671159, -122.313048),
	new google.maps.LatLng(47.672141, -122.318413),
	new google.maps.LatLng(47.674511, -122.321159),
	new google.maps.LatLng(47.653788, -122.322490),
	new google.maps.LatLng(47.653701, -122.318155),
	new google.maps.LatLng(47.647833, -122.309229),
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
          center: { lat: 47.614848, lng: -122.3359058},
          zoom: 12,
          scrollwheel: false,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
  google.maps.event.addDomListener(window, 'load', initialize);