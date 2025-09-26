@extends('admin.layout.layouts')

@section('content')
<div class="container-fluid">
    <h2>Map Management</h2>
    <div id="map" style="height: 600px; border: 2px solid #444;"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalContent"></div>
        </div>
    </div>
</div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
const events = @json($events);

const map = L.map('map').setView(
    events.length ? [events[0].latitude, events[0].longitude] : [12.9716, 77.5946], // Bangalore fallback
    13
);

// Dark tile layer
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 19
}).addTo(map);

// Function to fetch address and landmark info from lat/lng using Nominatim
async function getLocationDetails(lat, lng) {
    try {
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&extratags=1`);
        if (!res.ok) return { locationName: 'Unknown', landmarks: [] };
        const data = await res.json();

        const locationName = data.display_name || 'Unknown';
        const landmarks = [];

        // Extract landmark info if available
        if (data.extratags) {
            if (data.extratags.amenity) landmarks.push(`Amenity: ${data.extratags.amenity}`);
            if (data.extratags.shop) landmarks.push(`Shop: ${data.extratags.shop}`);
            if (data.extratags.tourism) landmarks.push(`Tourism: ${data.extratags.tourism}`);
            if (data.extratags.office) landmarks.push(`Office: ${data.extratags.office}`);
            if (data.extratags.leisure) landmarks.push(`Leisure: ${data.extratags.leisure}`);
        }

        return { locationName, landmarks };
    } catch (error) {
        console.error('Error fetching location:', error);
        return { locationName: 'Unknown', landmarks: [] };
    }
}

// Plot events with reverse geocoding and landmark info
events.forEach(async event => {
    const marker = L.circleMarker([event.latitude, event.longitude], {
        radius: 8,
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.9
    }).addTo(map);

    const { locationName, landmarks } = await getLocationDetails(event.latitude, event.longitude);

    // Build landmark HTML
    const landmarkList = landmarks.length
        ? '<br><em>Nearby:</em><ul>' + landmarks.map(l => `<li>${l}</li>`).join('') + '</ul>'
        : '';

    // Marker popup
    marker.bindPopup(`<strong>${event.title}</strong><br>${locationName}${landmarkList}`);

    // Modal on click
    marker.on('click', () => {
        const html = `
            <h4>${event.title}</h4>
            ${event.image ? `<img src="/admin/uploads/event/${event.image}" width="100%" class="mb-2">` : ''}
            <p><strong>Location:</strong> ${locationName}</p>
            ${landmarkList}
            <p><strong>Status:</strong> ${event.status}</p>
            <p><strong>Label:</strong> ${event.label ?? '—'}</p>
            <p><strong>Description:</strong> ${event.description}</p>
            <p><strong>Reported At:</strong> ${event.reported_at ?? '—'}</p>
        `;
        document.getElementById('modalContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('eventModal')).show();
    });
});
</script>

@endsection
