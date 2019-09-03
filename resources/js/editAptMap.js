// mappa

$(document).ready(showPositionOnMap);

var queryString = $("#address").val();

function fillInputValue() {
    var actualAdrress = $("#address").val();
    var search = $(".leaflet-control-search-input");
    search.attr("value", actualAdrress);
}

function showPositionOnMap() {
    $.ajax({
        method: "GET",
        url: `https://api.tomtom.com/search/2/search/${queryString}.json?countrySet=ITA&key=z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc`,
        success: function(data) {
            (function(tomtom, document) {
                // Setting TomTom keys
                tomtom.searchKey("z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc");

                // Creating map
                var HQ = [
                    data.results[0].position.lat,
                    data.results[0].position.lon
                ];
                var map = tomtom.L.map("map", {
                    key: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
                    source: "vector",
                    basePath:
                        "https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk",
                    center: HQ,
                    zoom: 15,
                    language: "it-IT"
                });

                var Hqmarker = tomtom.L.marker(HQ).addTo(map);

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
                        serviceOptions: { unwrapBbox: true },
                        language: "it-IT"
                    })
                    .addTo(map);

                // custom function
                searchBoxInstance.on(L.SearchBox.Events.ResultClicked, function(
                    eventObject
                ) {
                    var lat = document.querySelector("#lat");
                    var lon = document.querySelector("#long");
                    var addr = document.querySelector("#address");

                    lat.value = eventObject.data.position.lat;
                    lon.value = eventObject.data.position.lon;
                    addr.value = eventObject.data.address.freeformAddress;
                });

                fillInputValue();

                // Marker layer to indicate the center of the search
                var searchCenterLayer = tomtom.markersView().addTo(map);
                // Marker layer to display the results over the map
                var markersLayer = L.tomTomMarkersLayer().addTo(map);
                // Draw markers for all the results found by the searchBox control (before user selects one)
                searchBoxInstance.on(
                    searchBoxInstance.Events.ResultsFound,
                    function(results) {
                        drawSearchCenter();
                        markersLayer.setMarkersData(results.data).addMarkers();
                    }
                );
                // Draw markers for all the results found by the searchBox control (before user selects one)
                searchBoxInstance.on(
                    searchBoxInstance.Events.ResultsCleared,
                    function() {
                        markersLayer.clearLayers();
                    }
                );
                // Add a marker to indicate the position of the result selected by the user
                searchBoxInstance.on(
                    searchBoxInstance.Events.ResultClicked,
                    function(result) {
                        markersLayer.setMarkersData([result.data]).addMarkers();
                        var viewport = result.data.viewport;
                        if (viewport) {
                            map.fitBounds([
                                viewport.topLeftPoint,
                                viewport.btmRightPoint
                            ]);
                        } else {
                            map.fitBounds(markersLayer.getBounds());
                        }
                    }
                );

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
                            iconUrl:
                                "https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/../img/center_marker.svg",
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
        }
    });
}
