// mappa

$(document).ready(showPositionOnMap);

var queryString = $(".apt_address").text();

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
            })(tomtom, document);
        }
    });
}
