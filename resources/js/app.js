import './bootstrap';
import './gsap';
import.meta.glob(['../images/**']);
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
import $ from 'jquery'; // já tens jQuery integrado
import 'leaflet.markercluster';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png'; // Este é importante para retina/mobile
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

L.Icon.Default.mergeOptions({
    iconUrl: markerIcon,
    iconRetinaUrl: markerIcon2x, // Adicione o 2x
    shadowUrl: markerShadow,
    iconSize: [25, 41], // Opcional, mas para garantir o tamanho correto
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    tooltipAnchor: [16, -28],
    shadowSize: [41, 41] // Opcional
});

$(function(){
  loadData();
});

window.loadData = loadData;

const map = L.map('map').setView([41.9, 12.49], 13);
const markers = L.markerClusterGroup();

// camada base (OpenStreetMap)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var layer, userMarker, userCircle;

function loadData(filter = 0) {
    // buscar GeoJSON do backend
  if(layer) (layer.clearLayers());
  if(markers) (markers.clearLayers());
  if (userMarker) {
    map.removeLayer(userMarker);
    map.removeLayer(userCircle);
  }
  $.getJSON('/api/assets/geojson', function(data){
    if (filter) { data.features = data.features.filter(f => f.properties.category === filter)}
      if($('#cluster').prop('checked') === false) {
        layer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            const p = feature.properties || {};
            layer.bindPopup(`<strong>${p.name||'--'}</strong><br/>Categoria: ${p.category||'--'}`);
          },
          pointToLayer: function(feature, latlng) {
            return L.circleMarker(latlng, {
              radius: 6,
              color: getColor(feature.properties.category),
              fillOpacity: 0.8
            });
          }
        }).addTo(map);

        // Espera o mapa carregar completamente antes de ajustar os bounds
        map.whenReady(() => {
          const bounds = layer.getBounds();
          if (bounds.isValid()) {
            map.fitBounds(bounds.pad(0.2));
          }
        });
      }
      else{
        layer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            const p = feature.properties || {};
            layer.bindPopup(`<strong>${p.name}</strong><br/>Categoria: ${p.category}`);
          },
          pointToLayer: function(feature, latlng) {
            return L.circleMarker(latlng, {
              radius: 6,
              color: getColor(feature.properties.category),
              fillOpacity: 0.8
            });
          }
        });  
        markers.addLayer(layer);
        map.addLayer(markers);
        map.fitBounds(markers.getBounds().pad(0.2));
      }
  });

  // popular painel com estatísticas
  $.getJSON('/api/assets/stats', function(stats){
    $('#total-count').text(stats.total);
    // monta lista de categorias
    let html = '';
    stats.byCategory.forEach(c => {
      html += `<li onclick="loadData('${c.category}')">${c.category}: ${c.cnt}</li>`;
    });
    $('#categories-list').html(html);
  });
}

function getColor(cat) {
  switch(cat) {
    case 'station': return 'blue';
    case 'sensor': return 'red';
    case 'poi': return 'green';
    case 'tree': return 'orange';
    default: return 'gray';
  }
}

window.locateUser = locateUser;

function locateUser() {
  if(layer) (layer.clearLayers());
  if(markers) (markers.clearLayers());
  map.locate({ enableHighAccuracy: true });

  map.once('locationfound', function(e) {
    const { latlng, accuracy } = e;

    // remove o marcador anterior (se existir)
    if (userMarker) {
      map.removeLayer(userMarker);
      map.removeLayer(userCircle);
    }
    $('#categories-list').html("");

    // adiciona marcador e círculo
    userMarker = L.marker(latlng)
      .addTo(map)
      .bindPopup(`Você está aqui (±${Math.round(accuracy)}m)`)
      .openPopup();

    userCircle = L.circle(latlng, {
      radius: accuracy / 2,
      color: 'blue',
      fillColor: '#007bff',
      fillOpacity: 0.2
    }).addTo(map);

    // centraliza no ponto
    map.flyTo(latlng, 14, { duration: 1.2 });
  });

  map.once('locationerror', function() {
    alert('Não foi possível obter sua localização (verifique permissões de GPS).');
  });
}