// =============================
// MAP INIT
// =============================
const map = L.map('map');
// =============================
// MAP TILE
// =============================
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    opacity: 1,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// =============================
// USER DATA FROM BLADE
// =============================
const user_photo = document.getElementById('user_photo').value;
const user_email = document.getElementById('user_email').value;
const user_id = document.getElementById('user_id').value;
const user_name = document.getElementById('user_name').value;
const csrf_token = document.getElementById('csrf_token').value;
const my_lat = document.getElementById('my_lat').value;
const my_lng = document.getElementById('my_lng').value;

// =============================
//  DATA OPTION
// =============================
const showOnline = document.getElementById("showOnline");
const showNotification = document.getElementById("showNotification");
const showRoutes = document.getElementById("showRoutes");
const showBus = document.getElementById("showBus");
const showHiace = document.getElementById("showHiace");
const showStops = document.getElementById("showStops");
const showCampus = document.getElementById("showCampus");
const showStudents = document.getElementById("showStudents");
const highAccuracy = document.getElementById("highAccuracy");
const showMyLocation = document.getElementById("myLocation");

// =============================
// LAYERS
// =============================
let routeLayer = L.layerGroup().addTo(map);
let busLayer = L.layerGroup().addTo(map);
let hiaceLayer = L.layerGroup().addTo(map);
let stopLayer = L.layerGroup().addTo(map);
let campusLayer = L.layerGroup().addTo(map);
let studentLayer = L.layerGroup().addTo(map);
let myLayer = L.layerGroup().addTo(map);



// =============================
// Default Value
// =============================
const Accuracy = highAccuracy.checked ? true : false;
let DefaultZoom = 14;
let MyCurrentLocation = [my_lat,my_lng];
const campusLocation = [23.7939385, 90.4470228];
const busStopLocation = [23.7978725, 90.4251619];


const vehicleMarkers = {};

map.setView(MyCurrentLocation, 14);


// Demo Bus Data
async function loadInitialVehicles() {
    const res = await fetch('/student/get-vehicles-data/'+user_id);
    const data = await res.json();
    renderVehicleMarkers(data);
}

loadInitialVehicles();

setInterval(async () => {
    const res = await fetch('/student/get-vehicles-data/'+user_id);
    const data = await res.json();
    updateVehiclePositions(data);
}, 2000);






// USER ICON
const myIcon = L.divIcon({
    className: "",
    html: `
    <div class="w-[50px] h-[50px] bg-blue-500 rounded-[50%_50%_50%_0] rotate-[-45deg] shadow-lg relative">
                    
    <img src="${user_photo}" 
        class="w-[40px] h-[40px] rounded-full absolute top-[5px] left-[5px] rotate-[45deg] border-[3px] border-white object-cover"
    >

    </div>
    `,
    iconSize: [50, 50],
    iconAnchor: [25, 50]
});

// CAMPUS ICON
const campusIcon = L.divIcon({
    className: "",
    html: `
        <div class="w-[50px] h-[50px] bg-[#0b8053] rounded-[50%_50%_50%_0] rotate-[-45deg] shadow-lg relative flex items-center justify-center">
            
            <i class="fa fa-school 
                w-[40px] h-[40px] bg-transparent rounded-full absolute top-[5px] left-[5px] 
                rotate-[45deg] border-[3px] border-white text-[#e8f0ea] 
                flex items-center justify-center text-[18px]">
            </i>

        </div>
    `,
    iconSize: [50, 50],
    iconAnchor: [25, 50]
});

// STOP ICON
const stopIcon = L.divIcon({
    className: "",
    html: `
    <div class="w-[50px] h-[50px] bg-red-500 rounded-[50%_50%_50%_0] rotate-[-45deg] shadow-lg relative flex items-center justify-center">
        
        <i class="fa fa-flag 
            w-[40px] h-[40px] bg-transparent rounded-full absolute top-[5px] left-[5px] 
            rotate-[45deg] border-[3px] border-white text-[#e8ede9] 
            flex items-center justify-center text-[18px]">
        </i>

    </div>
    `,
    iconSize: [50, 50],
    iconAnchor: [25, 50]
});

// Bus Icon
function createBusIcon() {
    return L.divIcon({
        className: "",
        html: `
            <div class="w-[50px] h-[50px] bg-[#f97316] rounded-[50%_50%_50%_0] rotate-[-45deg] shadow-lg relative flex items-center justify-center">
                <i class="fa fa-bus
                    w-[40px] h-[40px] bg-transparent rounded-full absolute top-[5px] left-[5px]
                    rotate-[45deg] border-[3px] border-white text-white
                    flex items-center justify-center text-[18px]">
                </i>
            </div>
        `,
        iconSize: [50, 50],
        iconAnchor: [25, 50]
    });
}

// Hiace Icon (purple color)
function createHiaceIcon() {
    return L.divIcon({
        className: "",
        html: `
            <div class="w-[50px] h-[50px] bg-[#7c3aed] rounded-[50%_50%_50%_0] rotate-[-45deg] shadow-lg relative flex items-center justify-center">
                <i class="fa fa-shuttle-van
                    w-[40px] h-[40px] bg-transparent rounded-full absolute top-[5px] left-[5px]
                    rotate-[45deg] border-[3px] border-white text-white
                    flex items-center justify-center text-[18px]">
                </i>
            </div>
        `,
        iconSize: [50, 50],
        iconAnchor: [25, 50]
    });
}

// =============================
// Markers
// =============================
const myMarker = L.marker(MyCurrentLocation, {
    icon: myIcon
}).bindPopup(user_name);

const campusMarker = L.marker(campusLocation, {
    icon: campusIcon
}).bindPopup("DIU Campus");


const stopMarker = L.marker(busStopLocation, {
    icon: stopIcon
}).bindPopup("Bus Stop");

function renderVehicleMarkers(vehicles) {
    // আগের markers clear করো
    busLayer.clearLayers();
    hiaceLayer.clearLayers();

    vehicles.forEach(vehicle => {
        const latlng = [vehicle.lat, vehicle.lng];

        // Icon select
        const icon = vehicle.type === "bus" ? createBusIcon() : createHiaceIcon();

        // Popup content
        const popupContent = `
            <div style="min-width:160px; font-family: sans-serif;">
                <b>${vehicle.name}</b><br>
                🚗 Driver: ${vehicle.driver}<br>
                🛣️ Route: ${vehicle.route}<br>
                🔢 Plate: ${vehicle.plate}<br>
                🟢 Status: <span style="color:${vehicle.status === 'running' ? 'green' : 'red'}">${vehicle.status}</span>
            </div>
        `;

        // Marker তৈরি
        const marker = L.marker(latlng, { icon }).bindPopup(popupContent);

        // Layer এ add করো
        if (vehicle.type === "bus") {
            busLayer.addLayer(marker);
        } else {
            hiaceLayer.addLayer(marker);
        }

        // Track করো
        vehicleMarkers[vehicle.id] = marker;
    });
}




// =============================
// Check
// =============================


// My Layer
if(showMyLocation.checked){
    myLayer.addLayer(myMarker);
    map.addLayer(myLayer);
}

// Campus Layer
if(showCampus.checked){
    campusLayer.addLayer(campusMarker);
    map.addLayer(campusLayer);
}

// Stop Layer
if(showStops.checked){
    stopLayer.addLayer(stopMarker);
    map.addLayer(stopLayer);
}
// Bus Layer 
if (showBus.checked) {
    map.addLayer(busLayer);
}

// HiaceLayer
if (showHiace.checked) {
    map.addLayer(hiaceLayer);
}


// Toggle

// My Layer
showMyLocation.addEventListener("change", function () 
{
    if (this.checked)
    {
        myLayer.addLayer(myMarker);
        map.addLayer(myLayer);
        change_state(user_id,'show_mylocation',1);
    } 
    else {
        myLayer.removeLayer(myMarker);
        map.removeLayer(myLayer);
        change_state(user_id,'show_mylocation',0);
    }

});

// Campus
showCampus.addEventListener("change", function () 
{
    if (this.checked)
    {
        campusLayer.addLayer(campusMarker);
        map.addLayer(campusLayer);
        change_state(user_id,'show_campus',1);
    } 
    else {
        campusLayer.removeLayer(campusMarker);
        map.removeLayer(campusLayer);
        change_state(user_id,'show_campus',0);
    }

});

// Stop
showStops.addEventListener("change", function () 
{
    if (this.checked)
    {
        stopLayer.addLayer(stopMarker);
        map.addLayer(stopLayer);
        change_state(user_id,'show_stop',1);
    } 
    else {
        stopLayer.removeLayer(stopMarker);
        map.removeLayer(stopLayer);
        change_state(user_id,'show_stop',0);
    }

});

// Accuracy
highAccuracy.addEventListener("change", function () 
{
    if (this.checked)
    {
        change_state(user_id,'high_accuracy',1);
    } 
    else {
        change_state(user_id,'high_accuracy',0);
    }

});

// Bus toggle
showBus.addEventListener("change", function () {
    if (this.checked) {
        map.addLayer(busLayer);
        change_state(user_id, 'show_bus', 1);
    } else {
        map.removeLayer(busLayer);
        change_state(user_id, 'show_bus', 0);
    }
});

// Hiace toggle
showHiace.addEventListener("change", function () {
    if (this.checked) {
        map.addLayer(hiaceLayer);
        change_state(user_id, 'show_hiace', 1);
    } else {
        map.removeLayer(hiaceLayer);
        change_state(user_id, 'show_hiace', 0);
    }
});







// if (navigator.geolocation) {

//     navigator.geolocation.watchPosition(

//         function (position) {

//             const lat = position.coords.latitude;
//             const lng = position.coords.longitude;

//             const location = [lat, lng];

//             if (!userMarker) {

//                 map.setView(location, 14);

//                 userMarker = L.marker(location, {
//                     icon: myIcon
//                 })
//                 .addTo(studentsLayer)
//                 .bindPopup(user_name + " (Me)");

//             } else {

//                 userMarker.setLatLng(location);

//             }

//         },

//         function (error) {
//             console.log(error.message);
//         },

//         {
//             enableHighAccuracy: Accuracy,
//             maximumAge: 0,
//             timeout: 5000
//         }

//     );

// } else {

//     console.log("Geolocation not supported");

// }


// =============================
// NAVIGATION BUTTON
// =============================





// Test

