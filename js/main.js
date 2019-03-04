function initMap() {
	// instanciando variáveis
	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: {lat: -6.7792474, lng: -43.0393017}
	});
	// setando mapa
	directionsDisplay.setMap(map);

	// chamando função ao submeter o formulário
	document.getElementById('submit').addEventListener('click', () => {
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	});
}

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

	// traçando rota ou exibindo erro
	directionsService.route(request, (response, status) => {
		if (status === 'OK') {
			directionsDisplay.setDirections(response);
		} else {
			window.alert('Directions request failed due to ' + status);
		}
	});
}
