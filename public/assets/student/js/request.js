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
                column_name: field_name,
                status: status,
            })
            
        })
        .then(res => res.json())
        .then(data => console.log(data));
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

function getCurrentLocationView() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(

            function (position) {

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                map.setView([lat, lng], 14);

            },

            function (error) {
                console.log(error.message);
            },

            {
                enableHighAccuracy: Accuracy,
                timeout: 5000,
                maximumAge: 60000
            }

        );

    } else {

        console.log("Geolocation not supported");

    }

}

