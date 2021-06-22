/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./js/progress.js */ "./src/js/progress.js");

__webpack_require__(/*! ./js/getMessage */ "./src/js/getMessage.js");

__webpack_require__(/*! ./js/reply.js */ "./src/js/reply.js");

__webpack_require__(/*! ./js/studentLogin */ "./src/js/studentLogin.js");

if (window.location.pathname === '/on_track/admin.php') {
  __webpack_require__(/*! ./js/getUser.js */ "./src/js/getUser.js");
}

/***/ }),

/***/ "./src/js/deleteMessage.js":
/*!*********************************!*\
  !*** ./src/js/deleteMessage.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "deleteMessage": () => (/* binding */ deleteMessage)
/* harmony export */ });
/* harmony import */ var _getMessage__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./getMessage */ "./src/js/getMessage.js");


function deleteMessage() {
  // delete message
  var deleteButton = document.getElementById('delete-btn');
  deleteButton.addEventListener("click", function () {
    var val = this.dataset.value;
    console.log(val);

    if (val == "") {
      _getMessage__WEBPACK_IMPORTED_MODULE_0__.messageBox.innerHTML = "";
    } else {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log('deleted');
          _getMessage__WEBPACK_IMPORTED_MODULE_0__.messageBox.innerHTML = this.responseText;
        }
      };

      xmlhttp.open("GET", "ajax.php?q=" + val, true);
      xmlhttp.send();
    }
  });
}



/***/ }),

/***/ "./src/js/getMessage.js":
/*!******************************!*\
  !*** ./src/js/getMessage.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "messageBox": () => (/* binding */ messageBox)
/* harmony export */ });
/* harmony import */ var _deleteMessage__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./deleteMessage */ "./src/js/deleteMessage.js");
/* harmony import */ var _reply__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./reply */ "./src/js/reply.js");


var getMessages = document.querySelectorAll('.messages__item');
var messageBox = document.getElementById("message-box");
getMessages.forEach(function (message) {
  message.addEventListener("click", function () {
    var messageValue = this.dataset.value;

    if (messageValue == "") {
      messageBox.innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log('success');
          messageBox.innerHTML = this.responseText;
          $('#exampleModal').modal('show');
          (0,_deleteMessage__WEBPACK_IMPORTED_MODULE_0__.deleteMessage)();
          (0,_reply__WEBPACK_IMPORTED_MODULE_1__.replyMessage)();
        }
      };

      xmlhttp.open("GET", "message.php?q=" + messageValue, true);
      xmlhttp.send();
    }
  });
});


/***/ }),

/***/ "./src/js/getUser.js":
/*!***************************!*\
  !*** ./src/js/getUser.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _progress__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./progress */ "./src/js/progress.js");

var getUser = document.getElementById('select-user');
getUser.addEventListener("change", function () {
  var str = this.value;

  if (str == "") {
    document.getElementById("results").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log('success');
        document.getElementById("results").innerHTML = this.responseText;
        (0,_progress__WEBPACK_IMPORTED_MODULE_0__.progress)();
      }
    };

    xmlhttp.open("GET", "getuser.php?q=" + str, true);
    xmlhttp.send();
  }
});

/***/ }),

/***/ "./src/js/progress.js":
/*!****************************!*\
  !*** ./src/js/progress.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "progress": () => (/* binding */ progress)
/* harmony export */ });
progress();

function progress() {
  var progressBar = document.querySelectorAll('.progress-bar');
  progressBar.forEach(function (bar) {
    var barValue = bar.innerHTML;

    if (barValue == '%' || barValue == '20%' || barValue == '40%') {
      bar.classList.remove('bg-primary');
      bar.classList.add('progress-color-started');
    } else if (barValue == '60%' || barValue == '80%') {
      bar.classList.remove('bg-primary');
      bar.classList.add('progress-color-inter');
    } else {
      bar.classList.remove('bg-primary');
      bar.classList.add('progress-color-indi');
    }
  });
}

;


/***/ }),

/***/ "./src/js/reply.js":
/*!*************************!*\
  !*** ./src/js/reply.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "replyMessage": () => (/* binding */ replyMessage)
/* harmony export */ });
/* harmony import */ var _getMessage__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./getMessage */ "./src/js/getMessage.js");


function replyMessage() {
  var reply = document.getElementById('reply');
  var replyValue = document.getElementById('reply-message');
  reply.addEventListener("click", function (event) {
    var message = replyValue.value;
    var userId = reply.dataset.value;
    console.log(userId); //create key value pairs

    var vars = "message=" + message + "&userId=" + userId;

    if (message == "") {
      _getMessage__WEBPACK_IMPORTED_MODULE_0__.messageBox.innerHTML = "";
    } else {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          _getMessage__WEBPACK_IMPORTED_MODULE_0__.messageBox.innerHTML = userId;
        }
      };

      xmlhttp.open("POST", "ajax.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // send variables over to php file

      xmlhttp.send(vars);
    }
  });
}



/***/ }),

/***/ "./src/js/studentLogin.js":
/*!********************************!*\
  !*** ./src/js/studentLogin.js ***!
  \********************************/
/***/ (() => {

// const studentLogin = document.querySelector(".student-login");
// const emailField = document.querySelector(".username-field");
// const passwordField = document.querySelector(".password-field");
// studentLogin.addEventListener('click', (e)=> {
//     e.preventDefault()
//     emailField.value= 'janedoe@jcloud.com'
//     passwordField.value = 'Student1234';
// })

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			__webpack_require__.O();
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkon_track"] = self["webpackChunkon_track"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./src/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./src/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;