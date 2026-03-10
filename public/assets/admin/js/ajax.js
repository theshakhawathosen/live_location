async function refreshApp(btn, url) {
    const icon = btn.querySelector("i");
    icon.classList.add("fa-spin");

    fetch(url)
        .then((res) => res.text())
        .then((data) => {
            console.log(data);
            showAjaxSuccessToast(data);
        })
        .catch((err) => {
            console.error(err);
        })
        .finally(() => {
            icon.classList.remove("fa-spin");
        });
}
const successAudio = new Audio(
    "http://localhost:8000/assets/audio/success.wav",
);
successAudio.preload = "auto";

function showAjaxSuccessToast(text) {
    var t = document.getElementById("ajax-success-toast");
    t.classList.add("show");
    document.querySelector("#ajax-success-toast p").innerHTML = text;
    setTimeout(function () {
        t.classList.remove("show");
    }, 3000);
    successAudio.play().catch((error) => {
        console.log("Faild to play success audio!");
    });
}


function maintenanceToggle(el, tagId) {

    const checked = el.checked;
    const url = el.dataset.url;
    const tag = document.getElementById(tagId);

    const mode = checked ? "enable" : "disable";
    const label = checked ? "ON" : "OFF";
    Swal.fire({
        title: "Confirm Maintenance Mode",
        text: `Are you sure you want to turn ${label} maintenance mode?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes Continue",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (!result.isConfirmed) {
            el.checked = !checked;
            return;
        }else{
            fetch(url + "?mode=" + mode)
            .then(res => res.text())
            .then(data => {
                tag.innerHTML = `<i class="fa-solid fa-circle text-[5px]"></i> ${label}`;
                showAjaxSuccessToast(`Maintenance mode ${mode}`)
            })
            .catch(() => {
                el.checked = !checked;
                Swal.fire({
                    icon: "error",
                    title: "Request Failed"
                });
            });
        }
    });
}

function allowRegistration(el, tagId) {
    const checked = el.checked;
    const url = el.dataset.url;
    const tag = document.getElementById(tagId);

    const mode = checked ? "enable" : "disable";
    const label = checked ? "ON" : "OFF";
    Swal.fire({
        title: `Confirm ${label} Registration`,
        text: `Are you sure you want to turn ${label} Allow Registration?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes Continue",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (!result.isConfirmed) {
            el.checked = !checked;
            return;
        }else{
            fetch(url + "?mode=" + mode)
            .then(res => res.text())
            .then(data => {
                tag.innerHTML = `<i class="fa-solid fa-circle text-[5px]"></i> ${label}`;
                showAjaxSuccessToast(`Allow Registration ${mode}`)
            })
            .catch(() => {
                el.checked = !checked;
                Swal.fire({
                    icon: "error",
                    title: "Request Failed"
                });
            });
        }
    });
}