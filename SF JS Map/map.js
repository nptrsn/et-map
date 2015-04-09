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

// Highlight SOMA area
function hoverSOMA(){

	// Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
	new google.maps.LatLng(37.785639,-122.405977),
	new google.maps.LatLng(37.772072,-122.423573),
	new google.maps.LatLng(37.771190,-122.422886),
	new google.maps.LatLng(37.770443,-122.421684),
	new google.maps.LatLng(37.770308,-122.420483),
	new google.maps.LatLng(37.770172,-122.419367),
	new google.maps.LatLng(37.770104,-122.418079),
	new google.maps.LatLng(37.769968,-122.417307),
	new google.maps.LatLng(37.769833,-122.416191),
	new google.maps.LatLng(37.769765,-122.414732),
	new google.maps.LatLng(37.769765,-122.413530),
	new google.maps.LatLng(37.769629,-122.411900),
	new google.maps.LatLng(37.769697,-122.411213),
	new google.maps.LatLng(37.769290,-122.409668),
	new google.maps.LatLng(37.769222,-122.408724),
	new google.maps.LatLng(37.768951,-122.407866),
	new google.maps.LatLng(37.768544,-122.406664),
	new google.maps.LatLng(37.768001,-122.405720),
	new google.maps.LatLng(37.767187,-122.405205),
	new google.maps.LatLng(37.766237,-122.405119),
	new google.maps.LatLng(37.765965,-122.404947),
	new google.maps.LatLng(37.767119,-122.385035),
	new google.maps.LatLng(37.767526,-122.384777),
	new google.maps.LatLng(37.767526,-122.382803),
	new google.maps.LatLng(37.767729,-122.382460),
	new google.maps.LatLng(37.767797,-122.383575),
	new google.maps.LatLng(37.768069,-122.383747),
	new google.maps.LatLng(37.768408,-122.384949),
	new google.maps.LatLng(37.769833,-122.385464),
	new google.maps.LatLng(37.770036,-122.385550),
	new google.maps.LatLng(37.769358,-122.383490),
	new google.maps.LatLng(37.769968,-122.383060),
	new google.maps.LatLng(37.769968,-122.383575),
	new google.maps.LatLng(37.770104,-122.383661),
	new google.maps.LatLng(37.770172,-122.383833),
	new google.maps.LatLng(37.770104,-122.384005),
	new google.maps.LatLng(37.770647,-122.385464),
	new google.maps.LatLng(37.771732,-122.385464),
	new google.maps.LatLng(37.772207,-122.385635),
	new google.maps.LatLng(37.771800,-122.386236),
	new google.maps.LatLng(37.772275,-122.386665),
	new google.maps.LatLng(37.773293,-122.386665),
	new google.maps.LatLng(37.773293,-122.384691),
	new google.maps.LatLng(37.771868,-122.381516),
	new google.maps.LatLng(37.774650,-122.381430),
	new google.maps.LatLng(37.774378,-122.386751),
	new google.maps.LatLng(37.775057,-122.387009),
	new google.maps.LatLng(37.775396,-122.384949),
	new google.maps.LatLng(37.776278,-122.385035),
	new google.maps.LatLng(37.776007,-122.387094),
	new google.maps.LatLng(37.776617,-122.387352),
	new google.maps.LatLng(37.776617,-122.389755),
	new google.maps.LatLng(37.777228,-122.390013),
	new google.maps.LatLng(37.778177,-122.387524),
	new google.maps.LatLng(37.778449,-122.385721),
	new google.maps.LatLng(37.779059,-122.384949),
	new google.maps.LatLng(37.781027,-122.384949),
	new google.maps.LatLng(37.781434,-122.385464),
	new google.maps.LatLng(37.781637,-122.385206),
	new google.maps.LatLng(37.781773,-122.385550),
	new google.maps.LatLng(37.781841,-122.387695),
	new google.maps.LatLng(37.782180,-122.387781),
	new google.maps.LatLng(37.782451,-122.384777),
	new google.maps.LatLng(37.782994,-122.384691),
	new google.maps.LatLng(37.782926,-122.387695),
	new google.maps.LatLng(37.783130,-122.387867),
	new google.maps.LatLng(37.783265,-122.387524),
	new google.maps.LatLng(37.783537,-122.386494),
	new google.maps.LatLng(37.783808,-122.386494),
	new google.maps.LatLng(37.783944,-122.387524),
	new google.maps.LatLng(37.784486,-122.387524),
	new google.maps.LatLng(37.784554,-122.385635),
	new google.maps.LatLng(37.784961,-122.385550),
	new google.maps.LatLng(37.784961,-122.387524),
	new google.maps.LatLng(37.785436,-122.387524),
	new google.maps.LatLng(37.785639,-122.384348),
	new google.maps.LatLng(37.787267,-122.384605),
	new google.maps.LatLng(37.787267,-122.387352),
	new google.maps.LatLng(37.787674,-122.387266),
	new google.maps.LatLng(37.788081,-122.385206),
	new google.maps.LatLng(37.788488,-122.385206),
	new google.maps.LatLng(37.788285,-122.387009),
	new google.maps.LatLng(37.788624,-122.387094),
	new google.maps.LatLng(37.789234,-122.385120),
	new google.maps.LatLng(37.789709,-122.385206),
	new google.maps.LatLng(37.789234,-122.387352),
	new google.maps.LatLng(37.789777,-122.387524),
	new google.maps.LatLng(37.790455,-122.385635),
	new google.maps.LatLng(37.790998,-122.385893),
	new google.maps.LatLng(37.790252,-122.388296),
	new google.maps.LatLng(37.790862,-122.388897),
	new google.maps.LatLng(37.791202,-122.389412),
	new google.maps.LatLng(37.782044,-122.401171),
	new google.maps.LatLng(37.785639,-122.405806)
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

// Highlight Russian Hill area
function hoverRH(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.804969,-122.425289),
	new google.maps.LatLng(37.805919,-122.418337),
	new google.maps.LatLng(37.798052,-122.407093),
	new google.maps.LatLng(37.795746,-122.423229),
	new google.maps.LatLng(37.804901,-122.425203)
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

// Highlight Haight Ashbury area
function hoverHA(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.774582,-122.454472),
	new google.maps.LatLng(37.777024,-122.438335),
	new google.maps.LatLng(37.773225,-122.437391),
	new google.maps.LatLng(37.771936,-122.437134),
	new google.maps.LatLng(37.770240,-122.436962),
	new google.maps.LatLng(37.769697,-122.436190),
	new google.maps.LatLng(37.769086,-122.435932),
	new google.maps.LatLng(37.769019,-122.438164),
	new google.maps.LatLng(37.767526,-122.440224),
	new google.maps.LatLng(37.766983,-122.440481),
	new google.maps.LatLng(37.765897,-122.442026),
	new google.maps.LatLng(37.765897,-122.442541),
	new google.maps.LatLng(37.765083,-122.443829),
	new google.maps.LatLng(37.764540,-122.444000),
	new google.maps.LatLng(37.764337,-122.444258),
	new google.maps.LatLng(37.763455,-122.444515),
	new google.maps.LatLng(37.762166,-122.445803),
	new google.maps.LatLng(37.762233,-122.446146),
	new google.maps.LatLng(37.761894,-122.446318),
	new google.maps.LatLng(37.761691,-122.446575),
	new google.maps.LatLng(37.761216,-122.446575),
	new google.maps.LatLng(37.759791,-122.447262),
	new google.maps.LatLng(37.759451,-122.447519),
	new google.maps.LatLng(37.759180,-122.447948),
	new google.maps.LatLng(37.759112,-122.448721),
	new google.maps.LatLng(37.758976,-122.449923),
	new google.maps.LatLng(37.758976,-122.450695),
	new google.maps.LatLng(37.758909,-122.451296),
	new google.maps.LatLng(37.761148,-122.451725),
	new google.maps.LatLng(37.762166,-122.451982),
	new google.maps.LatLng(37.766237,-122.452755),
	new google.maps.LatLng(37.774446,-122.454472)
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

// Highlight The Richmond area
function hoverRichmond(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.787471,-122.487345),
	new google.maps.LatLng(37.787674,-122.485199),
	new google.maps.LatLng(37.787810,-122.483912),
	new google.maps.LatLng(37.786793,-122.478590),
	new google.maps.LatLng(37.787200,-122.465715),
	new google.maps.LatLng(37.788285,-122.465801),
	new google.maps.LatLng(37.789099,-122.462454),
	new google.maps.LatLng(37.786928,-122.462282),
	new google.maps.LatLng(37.786860,-122.459021),
	new google.maps.LatLng(37.781637,-122.458591),
	new google.maps.LatLng(37.781569,-122.455587),
	new google.maps.LatLng(37.782655,-122.447176),
	new google.maps.LatLng(37.780891,-122.447262),
	new google.maps.LatLng(37.775939,-122.446146),
	new google.maps.LatLng(37.774718,-122.454472),
	new google.maps.LatLng(37.773903,-122.460737),
	new google.maps.LatLng(37.773496,-122.464428),
	new google.maps.LatLng(37.773157,-122.471209),
	new google.maps.LatLng(37.772682,-122.483997),
	new google.maps.LatLng(37.771461,-122.511377),
	new google.maps.LatLng(37.775192,-122.511635),
	new google.maps.LatLng(37.775260,-122.508974),
	new google.maps.LatLng(37.779670,-122.509060),
	new google.maps.LatLng(37.779738,-122.507944),
	new google.maps.LatLng(37.779738,-122.507086),
	new google.maps.LatLng(37.779670,-122.505198),
	new google.maps.LatLng(37.781230,-122.505198),
	new google.maps.LatLng(37.781637,-122.492237),
	new google.maps.LatLng(37.783604,-122.492151),
	new google.maps.LatLng(37.783944,-122.486830),
	new google.maps.LatLng(37.787335,-122.487345)
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

// Highlight The Sunset area
function hoverSunset(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.764269,-122.511549),
	new google.maps.LatLng(37.763998,-122.510605),
	new google.maps.LatLng(37.764269,-122.505541),
	new google.maps.LatLng(37.766237,-122.458763),
	new google.maps.LatLng(37.765830,-122.457390),
	new google.maps.LatLng(37.765762,-122.456532),
	new google.maps.LatLng(37.766033,-122.455416),
	new google.maps.LatLng(37.766169,-122.452755),
	new google.maps.LatLng(37.761351,-122.451811),
	new google.maps.LatLng(37.758909,-122.451382),
	new google.maps.LatLng(37.758637,-122.452326),
	new google.maps.LatLng(37.758298,-122.453012),
	new google.maps.LatLng(37.757891,-122.453527),
	new google.maps.LatLng(37.757551,-122.453957),
	new google.maps.LatLng(37.756873,-122.454214),
	new google.maps.LatLng(37.756262,-122.454557),
	new google.maps.LatLng(37.755516,-122.454901),
	new google.maps.LatLng(37.754837,-122.455072),
	new google.maps.LatLng(37.753005,-122.456017),
	new google.maps.LatLng(37.752326,-122.456188),
	new google.maps.LatLng(37.751715,-122.456446),
	new google.maps.LatLng(37.751444,-122.457132),
	new google.maps.LatLng(37.751580,-122.457905),
	new google.maps.LatLng(37.751851,-122.459192),
	new google.maps.LatLng(37.751851,-122.460566),
	new google.maps.LatLng(37.751647,-122.461681),
	new google.maps.LatLng(37.751783,-122.462196),
	new google.maps.LatLng(37.752598,-122.463312),
	new google.maps.LatLng(37.752869,-122.463655),
	new google.maps.LatLng(37.752733,-122.466745),
	new google.maps.LatLng(37.749069,-122.466488),
	new google.maps.LatLng(37.748865,-122.469492),
	new google.maps.LatLng(37.747100,-122.469578),
	new google.maps.LatLng(37.745336,-122.509232),
	new google.maps.LatLng(37.753887,-122.510347),
	new google.maps.LatLng(37.759044,-122.511034),
	new google.maps.LatLng(37.764133,-122.511635)
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

// Highlight Pacific Heights area
function hoverPH(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.795068,-122.446918),
	new google.maps.LatLng(37.797916,-122.424173),
	new google.maps.LatLng(37.790659,-122.422628),
	new google.maps.LatLng(37.787607,-122.447004),
	new google.maps.LatLng(37.788828,-122.447176),
	new google.maps.LatLng(37.792015,-122.447863),
	new google.maps.LatLng(37.792219,-122.446489),
	new google.maps.LatLng(37.794932,-122.446918)
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

// Highlight Marina area
function hoverMarina(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.808902,-122.439966),
	new google.maps.LatLng(37.807139,-122.439280),
	new google.maps.LatLng(37.807614,-122.436104),
	new google.maps.LatLng(37.808428,-122.433615),
	new google.maps.LatLng(37.808563,-122.432327),
	new google.maps.LatLng(37.809106,-122.431726),
	new google.maps.LatLng(37.809241,-122.430010),
	new google.maps.LatLng(37.808699,-122.426920),
	new google.maps.LatLng(37.809241,-122.427006),
	new google.maps.LatLng(37.809852,-122.426662),
	new google.maps.LatLng(37.810462,-122.426147),
	new google.maps.LatLng(37.810801,-122.425547),
	new google.maps.LatLng(37.810801,-122.424688),
	new google.maps.LatLng(37.810530,-122.424173),
	new google.maps.LatLng(37.810259,-122.424431),
	new google.maps.LatLng(37.810394,-122.424774),
	new google.maps.LatLng(37.810462,-122.424946),
	new google.maps.LatLng(37.810462,-122.425461),
	new google.maps.LatLng(37.810055,-122.426062),
	new google.maps.LatLng(37.809716,-122.426405),
	new google.maps.LatLng(37.809106,-122.426662),
	new google.maps.LatLng(37.808563,-122.426491),
	new google.maps.LatLng(37.808089,-122.426405),
	new google.maps.LatLng(37.807682,-122.426233),
	new google.maps.LatLng(37.807004,-122.425547),
	new google.maps.LatLng(37.797984,-122.423658),
	new google.maps.LatLng(37.795135,-122.446833),
	new google.maps.LatLng(37.800426,-122.447777),
	new google.maps.LatLng(37.801036,-122.448463),
	new google.maps.LatLng(37.802189,-122.449923),
	new google.maps.LatLng(37.803138,-122.450438),
	new google.maps.LatLng(37.803477,-122.450094),
	new google.maps.LatLng(37.803884,-122.449837),
	new google.maps.LatLng(37.804359,-122.448978),
	new google.maps.LatLng(37.804766,-122.448378),
	new google.maps.LatLng(37.805512,-122.448463),
	new google.maps.LatLng(37.806122,-122.448463),
	new google.maps.LatLng(37.806597,-122.448292),
	new google.maps.LatLng(37.807139,-122.447691),
	new google.maps.LatLng(37.807546,-122.447090),
	new google.maps.LatLng(37.807546,-122.445974),
	new google.maps.LatLng(37.807614,-122.445374),
	new google.maps.LatLng(37.807682,-122.444258),
	new google.maps.LatLng(37.807750,-122.443743),
	new google.maps.LatLng(37.807885,-122.443228),
	new google.maps.LatLng(37.808021,-122.442541),
	new google.maps.LatLng(37.808156,-122.441854),
	new google.maps.LatLng(37.808224,-122.441168),
	new google.maps.LatLng(37.808360,-122.440739),
	new google.maps.LatLng(37.808835,-122.440138)
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

// Highlight North Beach area
function hoverNorthBeach(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.811411,-122.420654),
	new google.maps.LatLng(37.811479,-122.418423),
	new google.maps.LatLng(37.809445,-122.415504),
	new google.maps.LatLng(37.809581,-122.415247),
	new google.maps.LatLng(37.809852,-122.415333),
	new google.maps.LatLng(37.809648,-122.413960),
	new google.maps.LatLng(37.810055,-122.414303),
	new google.maps.LatLng(37.810259,-122.413960),
	new google.maps.LatLng(37.809581,-122.412844),
	new google.maps.LatLng(37.809648,-122.412157),
	new google.maps.LatLng(37.810598,-122.413015),
	new google.maps.LatLng(37.811411,-122.411470),
	new google.maps.LatLng(37.811479,-122.408552),
	new google.maps.LatLng(37.809038,-122.407436),
	new google.maps.LatLng(37.808767,-122.407866),
	new google.maps.LatLng(37.809513,-122.408123),
	new google.maps.LatLng(37.809852,-122.409840),
	new google.maps.LatLng(37.809241,-122.409410),
	new google.maps.LatLng(37.808699,-122.408724),
	new google.maps.LatLng(37.808496,-122.407436),
	new google.maps.LatLng(37.808089,-122.407179),
	new google.maps.LatLng(37.807953,-122.406750),
	new google.maps.LatLng(37.809987,-122.406750),
	new google.maps.LatLng(37.810055,-122.406063),
	new google.maps.LatLng(37.807275,-122.405720),
	new google.maps.LatLng(37.806936,-122.405376),
	new google.maps.LatLng(37.808902,-122.404346),
	new google.maps.LatLng(37.808767,-122.403746),
	new google.maps.LatLng(37.806868,-122.404518),
	new google.maps.LatLng(37.806732,-122.403831),
	new google.maps.LatLng(37.808021,-122.402544),
	new google.maps.LatLng(37.807953,-122.402201),
	new google.maps.LatLng(37.806393,-122.403231),
	new google.maps.LatLng(37.806054,-122.402802),
	new google.maps.LatLng(37.807614,-122.400913),
	new google.maps.LatLng(37.807207,-122.400398),
	new google.maps.LatLng(37.803613,-122.400827),
	new google.maps.LatLng(37.803477,-122.400484),
	new google.maps.LatLng(37.804562,-122.398596),
	new google.maps.LatLng(37.804291,-122.398167),
	new google.maps.LatLng(37.803274,-122.399969),
	new google.maps.LatLng(37.802867,-122.399540),
	new google.maps.LatLng(37.803816,-122.397652),
	new google.maps.LatLng(37.803477,-122.397394),
	new google.maps.LatLng(37.802257,-122.399454),
	new google.maps.LatLng(37.801918,-122.399197),
	new google.maps.LatLng(37.803138,-122.397137),
	new google.maps.LatLng(37.802053,-122.396021),
	new google.maps.LatLng(37.800629,-122.398252),
	new google.maps.LatLng(37.800358,-122.397909),
	new google.maps.LatLng(37.801443,-122.395678),
	new google.maps.LatLng(37.801104,-122.395248),
	new google.maps.LatLng(37.799815,-122.397566),
	new google.maps.LatLng(37.799544,-122.397051),
	new google.maps.LatLng(37.798933,-122.398252),
	new google.maps.LatLng(37.797916,-122.406664),
	new google.maps.LatLng(37.806732,-122.419281),
	new google.maps.LatLng(37.806732,-122.420654),
	new google.maps.LatLng(37.808835,-122.421169),
	new google.maps.LatLng(37.809377,-122.420740),
	new google.maps.LatLng(37.809174,-122.418423),
	new google.maps.LatLng(37.811276,-122.420654)
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

// Highlight Sea Cliff area
function hoverSeaCliff(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.775192,-122.513180),
	new google.maps.LatLng(37.775328,-122.509060),
	new google.maps.LatLng(37.779602,-122.509317),
	new google.maps.LatLng(37.779806,-122.508202),
	new google.maps.LatLng(37.779806,-122.507343),
	new google.maps.LatLng(37.779806,-122.506399),
	new google.maps.LatLng(37.779670,-122.505283),
	new google.maps.LatLng(37.780620,-122.505198),
	new google.maps.LatLng(37.781298,-122.505198),
	new google.maps.LatLng(37.781773,-122.492323),
	new google.maps.LatLng(37.783537,-122.492323),
	new google.maps.LatLng(37.783944,-122.486916),
	new google.maps.LatLng(37.787539,-122.487259),
	new google.maps.LatLng(37.787810,-122.484083),
	new google.maps.LatLng(37.788285,-122.483997),
	new google.maps.LatLng(37.788692,-122.483912),
	new google.maps.LatLng(37.789234,-122.483568),
	new google.maps.LatLng(37.789438,-122.483740),
	new google.maps.LatLng(37.789709,-122.484598),
	new google.maps.LatLng(37.789981,-122.485027),
	new google.maps.LatLng(37.790591,-122.485714),
	new google.maps.LatLng(37.790795,-122.485886),
	new google.maps.LatLng(37.790455,-122.486401),
	new google.maps.LatLng(37.789777,-122.487001),
	new google.maps.LatLng(37.789641,-122.487602),
	new google.maps.LatLng(37.789506,-122.488117),
	new google.maps.LatLng(37.789574,-122.488804),
	new google.maps.LatLng(37.789641,-122.489405),
	new google.maps.LatLng(37.789438,-122.489834),
	new google.maps.LatLng(37.788828,-122.490692),
	new google.maps.LatLng(37.788421,-122.491379),
	new google.maps.LatLng(37.788149,-122.491808),
	new google.maps.LatLng(37.787878,-122.492151),
	new google.maps.LatLng(37.787878,-122.492580),
	new google.maps.LatLng(37.787674,-122.493095),
	new google.maps.LatLng(37.787607,-122.493696),
	new google.maps.LatLng(37.787742,-122.494297),
	new google.maps.LatLng(37.788081,-122.494555),
	new google.maps.LatLng(37.787742,-122.494984),
	new google.maps.LatLng(37.787403,-122.495842),
	new google.maps.LatLng(37.787471,-122.496872),
	new google.maps.LatLng(37.787742,-122.497559),
	new google.maps.LatLng(37.787878,-122.498074),
	new google.maps.LatLng(37.788081,-122.498417),
	new google.maps.LatLng(37.788421,-122.499189),
	new google.maps.LatLng(37.788488,-122.499619),
	new google.maps.LatLng(37.788488,-122.499790),
	new google.maps.LatLng(37.788217,-122.500391),
	new google.maps.LatLng(37.788014,-122.500820),
	new google.maps.LatLng(37.787742,-122.501507),
	new google.maps.LatLng(37.787878,-122.502537),
	new google.maps.LatLng(37.788014,-122.503653),
	new google.maps.LatLng(37.788081,-122.504339),
	new google.maps.LatLng(37.788149,-122.505627),
	new google.maps.LatLng(37.788149,-122.505970),
	new google.maps.LatLng(37.787674,-122.506399),
	new google.maps.LatLng(37.787267,-122.507000),
	new google.maps.LatLng(37.786657,-122.507515),
	new google.maps.LatLng(37.786114,-122.507944),
	new google.maps.LatLng(37.785843,-122.508373),
	new google.maps.LatLng(37.785775,-122.508888),
	new google.maps.LatLng(37.785843,-122.509661),
	new google.maps.LatLng(37.785504,-122.509489),
	new google.maps.LatLng(37.784961,-122.509747),
	new google.maps.LatLng(37.784622,-122.510605),
	new google.maps.LatLng(37.784622,-122.510948),
	new google.maps.LatLng(37.784351,-122.511635),
	new google.maps.LatLng(37.784283,-122.512836),
	new google.maps.LatLng(37.783604,-122.512665),
	new google.maps.LatLng(37.782723,-122.513180),
	new google.maps.LatLng(37.782926,-122.513437),
	new google.maps.LatLng(37.781095,-122.514553),
	new google.maps.LatLng(37.779670,-122.514124),
	new google.maps.LatLng(37.779195,-122.514210),
	new google.maps.LatLng(37.778245,-122.514381),
	new google.maps.LatLng(37.777974,-122.513952),
	new google.maps.LatLng(37.775125,-122.513351)
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

// Highlight Noe Valley area
function hoverNoeValley(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.756194,-122.440910),
	new google.maps.LatLng(37.756398,-122.439022),
	new google.maps.LatLng(37.755448,-122.438850),
	new google.maps.LatLng(37.755583,-122.437649),
	new google.maps.LatLng(37.755855,-122.437649),
	new google.maps.LatLng(37.756601,-122.425718),
	new google.maps.LatLng(37.742349,-122.424173),
	new google.maps.LatLng(37.741739,-122.432241),
	new google.maps.LatLng(37.742010,-122.432842),
	new google.maps.LatLng(37.741603,-122.434130),
	new google.maps.LatLng(37.741467,-122.435503),
	new google.maps.LatLng(37.742349,-122.435932),
	new google.maps.LatLng(37.742892,-122.436705),
	new google.maps.LatLng(37.743503,-122.437735),
	new google.maps.LatLng(37.744182,-122.438850),
	new google.maps.LatLng(37.745064,-122.440052),
	new google.maps.LatLng(37.745607,-122.440224),
	new google.maps.LatLng(37.746218,-122.440138),
	new google.maps.LatLng(37.746422,-122.440138),
	new google.maps.LatLng(37.746897,-122.440395),
	new google.maps.LatLng(37.747236,-122.440910),
	new google.maps.LatLng(37.746965,-122.441769),
	new google.maps.LatLng(37.746829,-122.442541),
	new google.maps.LatLng(37.746557,-122.443485),
	new google.maps.LatLng(37.746625,-122.444086),
	new google.maps.LatLng(37.746761,-122.444944),
	new google.maps.LatLng(37.746965,-122.444429),
	new google.maps.LatLng(37.747236,-122.444086),
	new google.maps.LatLng(37.747440,-122.444000),
	new google.maps.LatLng(37.748254,-122.444344),
	new google.maps.LatLng(37.748865,-122.444086),
	new google.maps.LatLng(37.749476,-122.443657),
	new google.maps.LatLng(37.750765,-122.443142),
	new google.maps.LatLng(37.751715,-122.442799),
	new google.maps.LatLng(37.752733,-122.442713),
	new google.maps.LatLng(37.753683,-122.442284),
	new google.maps.LatLng(37.754362,-122.441940),
	new google.maps.LatLng(37.754837,-122.441683),
	new google.maps.LatLng(37.756126,-122.440996)
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

// Highlight Nob Hill area
function hoverNobHill(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.795610,-122.423573),
	new google.maps.LatLng(37.797374,-122.410440),
	new google.maps.LatLng(37.790252,-122.408895),
	new google.maps.LatLng(37.788488,-122.422113),
	new google.maps.LatLng(37.795475,-122.423658)
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

// Highlight Twin Peaks area
function hoverTwinPeaks(){

  // Define the LatLng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.761012,-122.446404),
	new google.maps.LatLng(37.758773,-122.446404),
	new google.maps.LatLng(37.758366,-122.444944),
	new google.maps.LatLng(37.758230,-122.444086),
	new google.maps.LatLng(37.757823,-122.443485),
	new google.maps.LatLng(37.757144,-122.442884),
	new google.maps.LatLng(37.756737,-122.442198),
	new google.maps.LatLng(37.756533,-122.441339),
	new google.maps.LatLng(37.756126,-122.441082),
	new google.maps.LatLng(37.755719,-122.441168),
	new google.maps.LatLng(37.755244,-122.441597),
	new google.maps.LatLng(37.753683,-122.442369),
	new google.maps.LatLng(37.752190,-122.442799),
	new google.maps.LatLng(37.751037,-122.443056),
	new google.maps.LatLng(37.750358,-122.443314),
	new google.maps.LatLng(37.749544,-122.443571),
	new google.maps.LatLng(37.749001,-122.444000),
	new google.maps.LatLng(37.748458,-122.444344),
	new google.maps.LatLng(37.747847,-122.444086),
	new google.maps.LatLng(37.747372,-122.444000),
	new google.maps.LatLng(37.747033,-122.444258),
	new google.maps.LatLng(37.746761,-122.444944),
	new google.maps.LatLng(37.746693,-122.445288),
	new google.maps.LatLng(37.746557,-122.446489),
	new google.maps.LatLng(37.746286,-122.447519),
	new google.maps.LatLng(37.745947,-122.450008),
	new google.maps.LatLng(37.745539,-122.451468),
	new google.maps.LatLng(37.745472,-122.452240),
	new google.maps.LatLng(37.745743,-122.454128),
	new google.maps.LatLng(37.746150,-122.455072),
	new google.maps.LatLng(37.746490,-122.456274),
	new google.maps.LatLng(37.746693,-122.457476),
	new google.maps.LatLng(37.746829,-122.458677),
	new google.maps.LatLng(37.747236,-122.459192),
	new google.maps.LatLng(37.747779,-122.458849),
	new google.maps.LatLng(37.748458,-122.459450),
	new google.maps.LatLng(37.749340,-122.460136),
	new google.maps.LatLng(37.750019,-122.460651),
	new google.maps.LatLng(37.750629,-122.461166),
	new google.maps.LatLng(37.751376,-122.461681),
	new google.maps.LatLng(37.751512,-122.461853),
	new google.maps.LatLng(37.751715,-122.460308),
	new google.maps.LatLng(37.751715,-122.459278),
	new google.maps.LatLng(37.751647,-122.458677),
	new google.maps.LatLng(37.751512,-122.457819),
	new google.maps.LatLng(37.751308,-122.456875),
	new google.maps.LatLng(37.751512,-122.456188),
	new google.maps.LatLng(37.751987,-122.456017),
	new google.maps.LatLng(37.752530,-122.455931),
	new google.maps.LatLng(37.753140,-122.455845),
	new google.maps.LatLng(37.753683,-122.455416),
	new google.maps.LatLng(37.754362,-122.455072),
	new google.maps.LatLng(37.755176,-122.454901),
	new google.maps.LatLng(37.755787,-122.454557),
	new google.maps.LatLng(37.756533,-122.454128),
	new google.maps.LatLng(37.757008,-122.453957),
	new google.maps.LatLng(37.757416,-122.453785),
	new google.maps.LatLng(37.758026,-122.453098),
	new google.maps.LatLng(37.758501,-122.452068),
	new google.maps.LatLng(37.758773,-122.451124),
	new google.maps.LatLng(37.758909,-122.449493),
	new google.maps.LatLng(37.759112,-122.448292),
	new google.maps.LatLng(37.759248,-122.447519),
	new google.maps.LatLng(37.759723,-122.447176),
	new google.maps.LatLng(37.761080,-122.446318)
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

// Highlight Civic Center area
function hoverCivicCenter(){

  // Define the Lat &Lng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.788353,-122.422199),
	new google.maps.LatLng(37.790320,-122.407093),
	new google.maps.LatLng(37.785775,-122.406321),
	new google.maps.LatLng(37.772954,-122.422371),
	new google.maps.LatLng(37.783604,-122.424603),
	new google.maps.LatLng(37.783808,-122.421341),
	new google.maps.LatLng(37.788217,-122.422199)
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

// Highlight Alamo Square area
function hoverAlamoSquare(){

  // Define the Lat &Lng coordinates for the polygon's path
  var shapeCoords = [
  	new google.maps.LatLng(37.780509, -122.432142),
	new google.maps.LatLng(37.779593, -122.438708),
	new google.maps.LatLng(37.775058, -122.437895),
	new google.maps.LatLng(37.776228, -122.427939),
	new google.maps.LatLng(37.779060, -122.428561),
	new google.maps.LatLng(37.778638, -122.431768)
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

// Clear the map
function clearMap(){
  areaHighlight.setMap(null);
}

// Done with Neighborhood Highlights
function initialize() {
        mapOptions = {
          center: { lat: 37.7757, lng: -122.4376},
          zoom: 12,
          scrollwheel: false,
          disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
  google.maps.event.addDomListener(window, 'load', initialize);