import './bootstrap';
import './gsap';
import.meta.glob(['../images/**']);
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
import $ from 'jquery'; // já tens jQuery integrado

$(function(){
  // cria mapa
  const map = L.map('map').setView([41.9, 12.49], 13);

  // camada base (OpenStreetMap)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // buscar GeoJSON do backend
  $.getJSON('/api/assets/geojson', function(data){
    const layer = L.geoJSON(data, {
      onEachFeature: function(feature, layer) {
        const p = feature.properties || {};
        layer.bindPopup(`<strong>${p.name||'--'}</strong><br/>Categoria: ${p.category||'--'}`);
      },
      pointToLayer: function(feature, latlng) {
        return L.circleMarker(latlng, { radius: 6 });
      }
    }).addTo(map);

    // ajusta zoom para mostrar todos os pontos
    if (layer.getBounds && !layer.getBounds().isValid()) {
      map.fitBounds(layer.getBounds().pad(0.2));
    }
  });

  // popular painel com estatísticas
  $.getJSON('/api/assets/stats', function(stats){
    $('#total-count').text(stats.total);
    // monta lista de categorias
    let html = '';
    stats.byCategory.forEach(c => {
      html += `<li>${c.category}: ${c.cnt}</li>`;
    });
    $('#categories-list').html(html);
  });
});

