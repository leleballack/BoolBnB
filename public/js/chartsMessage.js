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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/chartsMessage.js":
/*!***************************************!*\
  !*** ./resources/js/chartsMessage.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// var Chart = require("chart.js");
// // dati e grafico messaggi singolo apt
// var ctx = document.getElementById("messagesChart");
// var results = [];
// var gennaio = $("#gen_mes").val();
// var febbraio = $("#feb_mes").val();
// var marzo = $("#mar_mes").val();
// var aprile = $("#apr_mes").val();
// var maggio = $("#mag_mes").val();
// var giugno = $("#giu_mes").val();
// var luglio = $("#lug_mes").val();
// var agosto = $("#ago_mes").val();
// var settembre = $("#set_mes").val();
// var ottobre = $("#ott_mes").val();
// var novembre = $("#nov_mes").val();
// var dicembre = $("#dic_mes").val();
// var myChart = new Chart(ctx, {
//     type: "line",
//     data: {
//         labels: [
//             "Gennaio",
//             "Febbraio",
//             "Marzo",
//             "Aprile",
//             "Maggio",
//             "Giugno",
//             "Luglio",
//             "Agosto",
//             "Settembre",
//             "Ottobre",
//             "Novembre",
//             "Dicembre"
//         ],
//         datasets: [
//             {
//                 label: "Numero messaggi",
//                 data: [
//                     gennaio,
//                     febbraio,
//                     marzo,
//                     aprile,
//                     maggio,
//                     giugno,
//                     luglio,
//                     agosto,
//                     settembre,
//                     ottobre,
//                     novembre,
//                     dicembre
//                 ],
//                 backgroundColor: [
//                     "rgba(255, 99, 132, 0.2)",
//                     "rgba(54, 162, 235, 0.2)",
//                     "rgba(255, 206, 86, 0.2)",
//                     "rgba(75, 192, 192, 0.2)",
//                     "rgba(153, 102, 255, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                     "rgba(255, 159, 64, 0.2)"
//                 ],
//                 borderColor: [
//                     "rgba(255, 99, 132, 1)",
//                     "rgba(54, 162, 235, 1)",
//                     "rgba(255, 206, 86, 1)",
//                     "rgba(75, 192, 192, 1)",
//                     "rgba(153, 102, 255, 1)",
//                     "rgba(255, 159, 64, 1)"
//                 ],
//                 borderWidth: 1
//             }
//         ]
//     },
//     options: {
//         scales: {
//             yAxes: [
//                 {
//                     ticks: {
//                         beginAtZero: true
//                     }
//                 }
//             ]
//         }
//     }
// });

/***/ }),

/***/ 6:
/*!*********************************************!*\
  !*** multi ./resources/js/chartsMessage.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Emanuele\Desktop\BoolBnB-Manu\resources\js\chartsMessage.js */"./resources/js/chartsMessage.js");


/***/ })

/******/ });