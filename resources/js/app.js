/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

// mappa

(function(tomtom, document) {
    // Setting TomTom keys
    tomtom.searchKey("z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc");
    // Creating map
    var map = tomtom.L.map("map", {
        key: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
        source: "vector",
        basePath: "https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk"
    });
    var controlPanel = tomtom
        .controlPanel({
            position: "bottomright",
            title: "Settings",
            collapsed: true
        })
        .addTo(map);
    var unitSelector;
    controlPanel
        .addContent(buildUnitControl())
        .addContent(buildLanguageViewControl())
        .addContent(buildGeopolViewControl(map));
    // Relocating zoom buttons
    map.zoomControl.setPosition("bottomleft");
    // Search input field
    var searchBoxInstance = tomtom
        .searchBox({
            position: "topright",
            imperialDistance: unitSelector.value === "imperial", // FALSE by default
            serviceOptions: { unwrapBbox: true }
        })
        .addTo(map);

    // custom function
    searchBoxInstance.on(L.SearchBox.Events.ResultClicked, function(
        eventObject
    ) {
        var lat = document.querySelector("#lat");
        var lon = document.querySelector("#long");
        var addr = document.querySelector("#address");

        // console.log(lat.value);
        lat.value = eventObject.data.position.lat;
        lon.value = eventObject.data.position.lon;
        addr.value = eventObject.data.address.freeformAddress;

        // console.log(eventObject.data.address.freeformAddress);
    });

    // Marker layer to indicate the center of the search
    var searchCenterLayer = tomtom.markersView().addTo(map);
    // Marker layer to display the results over the map
    var markersLayer = L.tomTomMarkersLayer().addTo(map);
    // Draw markers for all the results found by the searchBox control (before user selects one)
    searchBoxInstance.on(searchBoxInstance.Events.ResultsFound, function(
        results
    ) {
        drawSearchCenter();
        markersLayer.setMarkersData(results.data).addMarkers();
    });
    // Draw markers for all the results found by the searchBox control (before user selects one)
    searchBoxInstance.on(searchBoxInstance.Events.ResultsCleared, function() {
        markersLayer.clearLayers();
    });
    // Add a marker to indicate the position of the result selected by the user
    searchBoxInstance.on(searchBoxInstance.Events.ResultClicked, function(
        result
    ) {
        markersLayer.setMarkersData([result.data]).addMarkers();
        var viewport = result.data.viewport;
        if (viewport) {
            map.fitBounds([viewport.topLeftPoint, viewport.btmRightPoint]);
        } else {
            map.fitBounds(markersLayer.getBounds());
        }
    });
    // Draw a marker at the center of the map
    function drawSearchCenter() {
        var currentLocation = map.getCenter();
        var markerOptions = {
            title:
                "Search Center\nLatitude: " +
                currentLocation.lat +
                "\nLongitude: " +
                currentLocation.lng,
            icon: tomtom.L.icon({
                iconUrl: "<your-tomtom-sdk-base-path>/../img/center_marker.svg",
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            })
        };
        searchCenterLayer.clearLayers();
        searchCenterLayer
            .addLayer(
                tomtom.L.marker(
                    [currentLocation.lat, currentLocation.lng],
                    markerOptions
                )
            )
            .addTo(map);
    }
    function buildUnitControl() {
        unitSelector = tomtom.unitSelector.getHtmlElement(
            tomtom.globalUnitService
        );
        return wrapControl(unitSelector, "Unit of measurement");
    }
    function buildLanguageViewControl() {
        var languageSelector = tomtom.languageSelector.getHtmlElement(
            tomtom.globalLocaleService,
            "search"
        );
        return wrapControl(languageSelector, "Search language");
    }
    function buildGeopolViewControl() {
        var geopolViewSelector = tomtom.geopolViewSelector.getHtmlElement(
            tomtom.globalGeopolViewService,
            "search"
        );
        return wrapControl(geopolViewSelector, "Geopolitical view");
    }
    function wrapControl(control, label) {
        var rowElement = document.createElement("div");
        var labelElement = document.createElement("label");
        var spanElement = document.createElement("span");
        spanElement.innerText = label + ": ";
        labelElement.appendChild(spanElement);
        labelElement.appendChild(control);
        rowElement.appendChild(labelElement);
        rowElement.className = "input-container";
        return rowElement;
    }
})(tomtom, document);
