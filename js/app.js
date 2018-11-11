let $map = document.querySelector('#mapid')

class leafletMap {

	constructor () {

		this.map = null
		this.bounds = []
	}

	async load (element){

		return new Promise((resolve,reject) => {
			$script('https://unpkg.com/leaflet@1.3.3/dist/leaflet.js', () =>{
			this.map = L.map(element).setView([43.799999,6.95], 10)
			L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,',
   			maxZoom: 18 }).addTo(this.map)
   			resolve()
			})		
		})		

	}

	addMarker (lat,lng,text){

		let point = [lat, lng]
		this.bounds.push(point)

		L.popup({

			autoClose: false,
			closeOnEscapeKey: false,
			closeOnClick: false,
			closeButton: false,
			className: 'marker',
			maxWidth: 200
		})

		.setLatLng(point)
		.setContent(text)
		.openOn(this.map)

	}

	center(){
		this.map.fitBounds(this.bounds)
	}

}

const initMap = async function(){

	let map = new leafletMap()
	await map.load($map)
	Array.from(document.querySelectorAll('.js-marker')).forEach((card) => {

		map.addMarker(card.dataset.lat, card.dataset.lng, card.dataset.text)
	})

	map.center()
}

if ($map !== null){

	initMap()
}


// let map = L.map('mapid').setView([43.799999,6.95], 10);
// // variable servant à afficher la map dans ma div id 'mapid', set view determine le point central de la map, 10 correspond au niveau
// // de zoom choisi

// // tileLayer:damier dans lequel on va charger diff cartes, on utilise ici openstreetmap


// L.popup()
//     .setLatLng([43.799999,6.95])
//     .setContent('<p>Hello world!<br />This is a nice popup.</p>')
//     .openOn(map)
