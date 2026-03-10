let locationInterval = null;

function showOnlineFunction() {

    if (showOnline.checked) {
        startSendingLocation();
    }

    showOnline.addEventListener("change", function () {

        if (this.checked) {
            startSendingLocation();
            change_state(user_id, "show_online", 1);

        } else {

            stopSendingLocation();
            change_state(user_id, "show_online", 0);

        }

    });
}

function startSendingLocation() {

    if (locationInterval) return; // already running

    locationInterval = setInterval(() => {

        // simulation
        MyCurrentLocation[0] += 0.0001;
        MyCurrentLocation[1] += 0.0001;

        sendLocation(MyCurrentLocation);

    }, 5000);

}

function stopSendingLocation() {

    if (locationInterval) {
        clearInterval(locationInterval);
        locationInterval = null;
    }

}