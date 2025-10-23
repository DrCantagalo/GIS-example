import './bootstrap';
import './gsap';
import.meta.glob(['../images/**']);
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
import $ from 'jquery'; // já tens jQuery integrado
import 'leaflet.markercluster';

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

var layer;

function loadData(filter = 0) {
    // buscar GeoJSON do backend
  if(layer) (layer.clearLayers());
  $.getJSON('/api/assets/geojson', function(data){
    if (filter) { data.features = data.features.filter(f => f.properties.category === filter)}
      if($('#cluster').prop('checked') === false) {
        layer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            const p = feature.properties || {};
            layer.bindPopup(`<strong>${p.name||'--'}</strong><br/>Categoria: ${p.category||'--'}`);
          },
          pointToLayer: function(feature, latlng) {
            return L.circleMarker(latlng, { radius: 6 });
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
            return L.circleMarker(latlng, { radius: 6 });
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
