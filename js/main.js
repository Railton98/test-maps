function initMap() {
  console.log(user);
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

  // chamando função ao submeter o formulário
	document.getElementById('submitTwo').addEventListener('click', () => {
		calculateAndDisplayRouteTwo(directionsService, directionsDisplay);
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
      addMarker(route.legs[0].start_location, markerCounter++, 'img/markerBlue.png', user[0]);
        // the rest
      for (var i = 0; i < route.legs.length; i++) {
        addMarker(route.legs[i].end_location, markerCounter++, 'img/markerBlue.png', user[i+1]);
      }
    } else {
			window.alert('Directions request failed due to ' + status);
		}
  });
}

// função que calcula e mostra a rota
function calculateAndDisplayRouteTwo(directionsService, directionsDisplay) {
	let wayptsTwo = [];
	let checkboxArrayTwo = document.getElementById('waypointsTwo');
	for (let i = 0; i < checkboxArrayTwo.length; i++) {
		if (checkboxArrayTwo.options[i].selected) {
			wayptsTwo.push({
				location: checkboxArrayTwo[i].value,
				stopover: true
			});
		}
	}

  // variável que contém o objeto da requisição
	let requestTwo = {
		origin: document.getElementById('startTwo').value,
		destination: document.getElementById('endTwo').value,
		waypoints: wayptsTwo,
		optimizeWaypoints: true,
		travelMode: 'DRIVING'
	};

  directionsService.route(requestTwo, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      var markerCounterTwo = 1;
      directionsDisplay.setDirections(response);
      // add custom markers
      var routeTwo = response.routes[0];
        // start marker
      addMarker(routeTwo.legs[0].start_location, markerCounterTwo++, 'img/markerRed.png', user[0]);
        // the rest
      for (var i = 0; i < routeTwo.legs.length; i++) {
        addMarker(routeTwo.legs[i].end_location, markerCounterTwo++, 'img/markerRed.png', user[i+1]);
      }
    } else {
			window.alert('Directions request failed due to ' + status);
		}
  });
}

  function addMarker(position, i, icon, contentString) {
    var marker = new google.maps.Marker({
      icon: icon,
      position: position,
      map: map,
      // title: 'Hello World!'
    });

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
    return marker;
  }
}
