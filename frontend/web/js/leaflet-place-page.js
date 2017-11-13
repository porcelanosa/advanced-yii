$(document).ready(function () {
	/* Markers */
	var mainMarkerIcon = L.icon({
		iconUrl: '/admin/img/markers/marker-icon.png',
		shadowUrl: '/admin/img/markers/marker-shadow.png',
		iconSize: [25, 41], // size of the icon
		shadowSize: [41, 41], // size of the shadow
		iconAnchor: [25, 41], // point of the icon which will correspond to marker's location
		shadowAnchor: [25, 41],  // the same for the shadow
		popupAnchor: [-13, -37] // point from which the popup should open relative to the iconAnchor
	})
	/* параметры подключения OSM */
	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
	var osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'

	var osmLayer = L.tileLayer(osmUrl, {
		attribution: osmAttrib, subdomains: ['a', 'b', 'c']
	})
	var mapCenter = [60, 70]

	var map = L.map('map').setView(mapCenter, 3)

	/*L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
		'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'examples.map-i875mjb7',
		noWrap : true
	}).addTo(map);*/
	map.addLayer(osmLayer)

	var marker = L.marker(mapCenter, {icon: mainMarkerIcon}).addTo(map)

	function updateMarker (lat, lng) {
		var name = $('#nameInput').val()
		var town = $('#townInput').val()
		marker
			.setLatLng([lat, lng])
			.bindPopup('Место:  ' + name + '<br>Город: ' + town)
			.openPopup()
		return false
	}
	var lat = $('#latInput').val()
	var lng = $('#lngInput').val()
	if (lat !== 0 && lng !== 0 && lat !== '' && lng !== '') {
		updateMarker(lat, lng)

		map.setView([lat, lng], 16)
	}
})