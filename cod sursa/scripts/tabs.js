function openCity(evt, cityName) {
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    var selectedTab = document.getElementById(cityName);
    if (selectedTab) {
        selectedTab.style.display = "block";
        evt.currentTarget.classList.add("active");
    } else {
        console.error("Element with ID '" + cityName + "' not found.");
    }
}
