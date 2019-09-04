/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/editAptMap.js":
/*!************************************!*\
  !*** ./resources/js/editAptMap.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

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
    url: "https://api.tomtom.com/search/2/search/".concat(queryString, ".json?countrySet=ITA&key=z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc"),
    success: function success(data) {
      (function (tomtom, document) {
        // Setting TomTom keys
        tomtom.searchKey("z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc"); // Creating map

        var HQ = [data.results[0].position.lat, data.results[0].position.lon];
        var map = tomtom.L.map("map", {
          key: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
          source: "vector",
          basePath: "https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk",
          center: HQ,
          zoom: 15,
          language: "it-IT"
        });
        var Hqmarker = tomtom.L.marker(HQ).addTo(map);
        var controlPanel = tomtom.controlPanel({
          position: "bottomright",
          title: "Settings",
          collapsed: true
        }).addTo(map);
        var unitSelector;
        controlPanel.addContent(buildUnitControl()).addContent(buildLanguageViewControl()).addContent(buildGeopolViewControl(map)); // Relocating zoom buttons

        map.zoomControl.setPosition("bottomleft"); // Search input field

        var searchBoxInstance = tomtom.searchBox({
          position: "topright",
          imperialDistance: unitSelector.value === "imperial",
          // FALSE by default
          serviceOptions: {
            unwrapBbox: true
          },
          language: "it-IT"
        }).addTo(map); // custom function

        searchBoxInstance.on(L.SearchBox.Events.ResultClicked, function (eventObject) {
          var lat = document.querySelector("#lat");
          var lon = document.querySelector("#long");
          var addr = document.querySelector("#address");
          lat.value = eventObject.data.position.lat;
          lon.value = eventObject.data.position.lon;
          addr.value = eventObject.data.address.freeformAddress;
        });
        fillInputValue(); // Marker layer to indicate the center of the search

        var searchCenterLayer = tomtom.markersView().addTo(map); // Marker layer to display the results over the map

        var markersLayer = L.tomTomMarkersLayer().addTo(map); // Draw markers for all the results found by the searchBox control (before user selects one)

        searchBoxInstance.on(searchBoxInstance.Events.ResultsFound, function (results) {
          drawSearchCenter();
          markersLayer.setMarkersData(results.data).addMarkers();
        }); // Draw markers for all the results found by the searchBox control (before user selects one)

        searchBoxInstance.on(searchBoxInstance.Events.ResultsCleared, function () {
          markersLayer.clearLayers();
        }); // Add a marker to indicate the position of the result selected by the user

        searchBoxInstance.on(searchBoxInstance.Events.ResultClicked, function (result) {
          markersLayer.setMarkersData([result.data]).addMarkers();
          var viewport = result.data.viewport;

          if (viewport) {
            map.fitBounds([viewport.topLeftPoint, viewport.btmRightPoint]);
          } else {
            map.fitBounds(markersLayer.getBounds());
          }
        }); // Draw a marker at the center of the map

        function drawSearchCenter() {
          var currentLocation = map.getCenter();
          var markerOptions = {
            title: "Search Center\nLatitude: " + currentLocation.lat + "\nLongitude: " + currentLocation.lng,
            icon: tomtom.L.icon({
              iconUrl: "https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/../img/center_marker.svg",
              iconSize: [24, 24],
              iconAnchor: [12, 12]
            })
          };
          searchCenterLayer.clearLayers();
          searchCenterLayer.addLayer(tomtom.L.marker([currentLocation.lat, currentLocation.lng], markerOptions)).addTo(map);
        }

        function buildUnitControl() {
          unitSelector = tomtom.unitSelector.getHtmlElement(tomtom.globalUnitService);
          return wrapControl(unitSelector, "Unit of measurement");
        }

        function buildLanguageViewControl() {
          var languageSelector = tomtom.languageSelector.getHtmlElement(tomtom.globalLocaleService, "search");
          return wrapControl(languageSelector, "Search language");
        }

        function buildGeopolViewControl() {
          var geopolViewSelector = tomtom.geopolViewSelector.getHtmlElement(tomtom.globalGeopolViewService, "search");
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

/***/ }),

/***/ 1:
/*!******************************************!*\
  !*** multi ./resources/js/editAptMap.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/raduschirliu/Desktop/booleanServer/Progetto finale/BoolBnB-grp-4/resources/js/editAptMap.js */"./resources/js/editAptMap.js");


/***/ })

/******/ });