var mapOptions;
var areaHighlight;
var map;

// Colour order: #FF0000, #0000FF, #FF6600, #FFFF00, #551A8B

// Highlight Temescal area
function hoverTemescal(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(37.834908, -122.252894),
	new google.maps.LatLng(37.835908, -122.255083),
	new google.maps.LatLng(37.836535, -122.257078),
	new google.maps.LatLng(37.836925, -122.260190),
	new google.maps.LatLng(37.837450, -122.262893),
	new google.maps.LatLng(37.838111, -122.264803),
	new google.maps.LatLng(37.837840, -122.265919),
	new google.maps.LatLng(37.837840, -122.265919),
	new google.maps.LatLng(37.837264, -122.267078),
	new google.maps.LatLng(37.829977, -122.269030),
	new google.maps.LatLng(37.828773, -122.260555),
	new google.maps.LatLng(37.828265, -122.258430),
	new google.maps.LatLng(37.827892, -122.257336),
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
// Highlight Bushrod area
function hoverBushrod(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(37.834908, -122.252894),
  new google.maps.LatLng(37.835908, -122.255083),
  new google.maps.LatLng(37.836535, -122.257078),
  new google.maps.LatLng(37.836925, -122.260190),
  new google.maps.LatLng(37.837450, -122.262893),
  new google.maps.LatLng(37.838111, -122.264803),
  new google.maps.LatLng(37.837840, -122.265919),
  new google.maps.LatLng(37.837840, -122.265919),
  new google.maps.LatLng(37.837264, -122.267078),
  new google.maps.LatLng(37.829977, -122.269030),
  new google.maps.LatLng(37.828773, -122.260555),
  new google.maps.LatLng(37.828265, -122.258430),
  new google.maps.LatLng(37.827892, -122.257336),
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
// Highlight Longfellow area
function hoverLongfellow(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  new google.maps.LatLng(37.824470, -122.268604),
  new google.maps.LatLng(37.833740, -122.266394),
  new google.maps.LatLng(37.834943, -122.266694),
  new google.maps.LatLng(37.837214, -122.268561),
  new google.maps.LatLng(37.836367, -122.274891),
  new google.maps.LatLng(37.836621, -122.276221),
  new google.maps.LatLng(37.828842, -122.279183),
  new google.maps.LatLng(37.826902, -122.278453)
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
// Highlight Rockridge area
function hoverRockridge(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
    new google.maps.LatLng(37.834908, -122.252894),
  new google.maps.LatLng(37.835908, -122.255083),
  new google.maps.LatLng(37.836535, -122.257078),
  new google.maps.LatLng(37.836925, -122.260190),
  new google.maps.LatLng(37.837450, -122.262893),
  new google.maps.LatLng(37.838111, -122.264803),
  new google.maps.LatLng(37.837840, -122.265919),
  new google.maps.LatLng(37.837840, -122.265919),
  new google.maps.LatLng(37.837264, -122.267078),
  new google.maps.LatLng(37.829977, -122.269030),
  new google.maps.LatLng(37.828773, -122.260555),
  new google.maps.LatLng(37.828265, -122.258430),
  new google.maps.LatLng(37.827892, -122.257336),
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
          center: { lat: 37.7919615, lng: -122.2287941},
          zoom: 12,
          scrollwheel: false,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
  google.maps.event.addDomListener(window, 'load', initialize);