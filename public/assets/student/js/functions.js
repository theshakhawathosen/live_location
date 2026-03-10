function sendLocation(location){
    fetch('/student/save-location',{
        method: "POST",
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : csrf_token,
        },
        body: JSON.stringify({
            lat: location[0],
            lng: location[1],
        })
    }
    ).then(result => console.log(result));
}
function change_state(userId,field_name,status)
{
    if((userId || field_name || status) !== "")
    {
        fetch('/student/change-state',{
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : csrf_token,
            },
            body: JSON.stringify({
                user_id: userId,
                label: field_name,
                status: status,
            })
            
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.status,data.message);
        });
    }else{
        console.log('Perameter can not be null!');
    }
}
function save_location(userId,lat,lng)
{
    if((userId || lat || lng) !== "")
    {
        fetch('/student/save-location',{
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : csrf_token,
            },
            body: JSON.stringify({
                user_id: userId,
                lat: lat,
                lng: lng
            })
            
        })
    }else{
        console.log('Perameter can not be null!');
    }
}

// Locate me
function getCurrentLocationView() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(

            function (position) {

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                map.setView([lat, lng], 16);

            },

            function (error) {
                console.log(error.message);
            },

            {
                enableHighAccuracy: Accuracy,
                timeout: 5000,
                maximumAge: 10000
            }

        );

    } else {

        console.log("Geolocation not supported");

    }

}