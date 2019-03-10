function initMap() {
  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers : true,
    polylineOptions: {
      strokeColor: "transparent"
    }
  });
  var options = {
    zoom:14,
    center: {lat: -6.7792474, lng: -43.0393017}
  };

  var map = new google.maps.Map(document.getElementById('map'), options);

  directionsDisplay.setMap(map);

	// chamando função ao submeter o formulário
	document.getElementById('submit').addEventListener('click', () => {
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	});

// função que calcula e mostra a rota
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	let waypts = [];
	let checkboxArray = document.getElementById('waypoints');
	for (let i = 0; i < checkboxArray.length; i++) {
		if (checkboxArray.options[i].selected) {
			waypts.push({
				location: checkboxArray[i].value,
				stopover: true
			});
		}
	}

  // variável que contém o objeto da requisição
	let request = {
		origin: document.getElementById('start').value,
		destination: document.getElementById('end').value,
		waypoints: waypts,
		optimizeWaypoints: true,
		travelMode: 'DRIVING'
	};

  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      var markerCounter = 1;
      directionsDisplay.setDirections(response);
      // add custom markers
      var route = response.routes[0];
        // start marker
      addMarker(route.legs[0].start_location, markerCounter++);
        // the rest
      for (var i = 0; i < route.legs.length; i++) {
        addMarker(route.legs[i].end_location, markerCounter++);
      }
    } else {
			window.alert('Directions request failed due to ' + status);
		}
  });
}

var contentString = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

  function addMarker(position, i) {
    var marker = new google.maps.Marker({
      icon: 'img/markerBlue.png',
      position: position,
      map: map,
      title: 'Hello World!'
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
    return marker;
  }
}
