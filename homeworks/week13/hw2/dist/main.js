var messagePlugin =
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/api.js":
/*!********************!*\
  !*** ./src/api.js ***!
  \********************/
/*! exports provided: getAPIMessage, addAPIMessage */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"getAPIMessage\", function() { return getAPIMessage; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"addAPIMessage\", function() { return addAPIMessage; });\nconst getAPIMessage = (apiUrl, cb) => {\n    $.ajax({\n        method: \"GET\",\n        url: apiUrl,\n        success: data => {\n            cb(data);\n        },\n        error: err => {\n            alert('error!')\n        }\n    })\n}\n\nconst addAPIMessage = (apiUrl, data, cb) => {\n    $.ajax({\n        type: 'POST',\n        url: apiUrl,\n        data: data\n    }).done(resp => {\n        cb(resp);\n    })\n}\n\n//# sourceURL=webpack://messagePlugin/./src/api.js?");

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! exports provided: init */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"init\", function() { return init; });\n/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils */ \"./src/utils.js\");\n/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./api */ \"./src/api.js\");\n\n\n\nlet siteKey = '';\nlet getAPIUrl = '';\nlet addAPIUrl = '';\nlet containerElement = null;\n\nlet pagination = {\n    appendCount: 0,\n    page: 1\n}\n\nconst init = (options) => {\n    siteKey = options.siteKey;\n    getAPIUrl = options.getAPIUrl;\n    containerElement = $(options.containerSelector);\n    containerElement.append(_utils__WEBPACK_IMPORTED_MODULE_0__[\"formTemplate\"]);\n\n    getMessage();\n    $('.add-message-form').submit((e) => {\n        e.preventDefault();\n        addAPIUrl = 'http://mentor-program.co/mtr04group2/Ronn/week12/discussion/api_add_message.php';\n        const data = {\n            'site_key': siteKey,\n            'user_name': $('input[name=username]').val(),\n            'message': $('textarea[name=content-text]').val()\n        }\n        Object(_api__WEBPACK_IMPORTED_MODULE_1__[\"addAPIMessage\"])(addAPIUrl, data, resp => {\n            $('input[name=username]').val('');\n            $('textarea[name=content-text]').val('');\n            if(resp.code !== 0)\n                alert('fail');\n            else\n                Object(_utils__WEBPACK_IMPORTED_MODULE_0__[\"appendCommentDOM\"])($('.card-container'), data, true);\n        })\n    })\n\n    $('.btn-more').click((e) => {\n        getMessage();\n    })\n}\n\nconst getMessage = () => {\n    $('.btn-more').hide();\n    let targetUrl = `${getAPIUrl}?site_key=${siteKey}&page=${pagination.page}`\n    Object(_api__WEBPACK_IMPORTED_MODULE_1__[\"getAPIMessage\"])(targetUrl, data => {\n        const messages = data.messages;\n        const count = data.total_count;\n        pagination.appendCount += messages.length;\n        pagination.page += 1;\n        for(let message of messages) {\n            Object(_utils__WEBPACK_IMPORTED_MODULE_0__[\"appendCommentDOM\"])($('.card-container'), message, false);\n        }\n        if (pagination.appendCount === count) {\n            $('.btn-more').remove();\n        } else {\n            $('.btn-more').show();\n        }        \n    })\n}\n\n\n//# sourceURL=webpack://messagePlugin/./src/index.js?");

/***/ }),

/***/ "./src/utils.js":
/*!**********************!*\
  !*** ./src/utils.js ***!
  \**********************/
/*! exports provided: formTemplate, appendCommentDOM */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"formTemplate\", function() { return formTemplate; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"appendCommentDOM\", function() { return appendCommentDOM; });\nconst encodeHTML = (s) => {\n    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/\"/g, '&quot;');\n}\n\nconst formTemplate = `\n    <div>\n        <form class=\"add-message-form\">\n            <div class=\"form-group\">\n                <label for=\"username-text\">Name</label>\n                <input name=\"username\" class=\"form-control\" id=\"username-text\" aria-describedby=\"emailHelp\">\n            </div>\n            <div class=\"form-group\">\n                <label for=\"content-text\">Content</label>\n                <textarea name=\"content-text\" class=\"form-control\" id=\"content-text\" rows=\"3\"></textarea>\n            </div>\n            <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n        </form>\n        <div class=\"card-container\">\n        </div>\n        <button type=\"button\" style=\"display: none;\" class=\"btn btn-primary btn-more\">載入更多</button>\n    </div>\n`;\n\nconst appendCommentDOM = (container, message, isPrepend) => {\n    const card = `\n        <div class=\"card\">\n            <div class=\"card-body\">\n                <blockquote class=\"blockquote mb-0\">\n                <p>${encodeHTML(message.message)}</p>\n                <footer class=\"blockquote-footer\">${encodeHTML(message.user_name)}</footer>\n                </blockquote>\n            </div>\n        </div>\n    `\n    if(isPrepend) {\n        container.prepend(card);\n    } else {\n        container.append(card);\n    }\n}\n\n//# sourceURL=webpack://messagePlugin/./src/utils.js?");

/***/ })

/******/ });