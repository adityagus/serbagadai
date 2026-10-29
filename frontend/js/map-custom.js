(function ($) {
    // USE STRICT
    "use strict";

        $(document).ready(function () {
            let map;

            function initMap() {
                const { Map } = google.maps.importLibrary("maps");

                map = new Map(document.getElementById("map"), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8,
                });
            }

            initMap();
        });

})(jQuery);