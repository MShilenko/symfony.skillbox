(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_styles_app_css__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _like__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./like */ "./assets/like.js");
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
 // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");



/***/ }),

/***/ "./assets/like.js":
/*!************************!*\
  !*** ./assets/like.js ***!
  \************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.find */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);


jquery__WEBPACK_IMPORTED_MODULE_1___default()(function () {
  jquery__WEBPACK_IMPORTED_MODULE_1___default()('[data-item=likes]').each(function () {
    var $container = jquery__WEBPACK_IMPORTED_MODULE_1___default()(this);
    $container.on('click', function (e) {
      e.preventDefault();

      if (e.target.classList.contains('btn')) {
        var type = e.target.getAttribute('data-item');
        jquery__WEBPACK_IMPORTED_MODULE_1___default.a.ajax({
          url: "/articles/10/like/".concat(type),
          method: 'POST'
        }).then(function (data) {
          $container.data('type', type === 'like' ? 'dislike' : 'like');
          $container.find('.fa-heart').toggleClass('far fas');
          $container.find('[data-item=likesCount]').text(data.likes);
        });
      }
    });
  });
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ })

},[["./assets/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9saWtlLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImVhY2giLCIkY29udGFpbmVyIiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJ0YXJnZXQiLCJjbGFzc0xpc3QiLCJjb250YWlucyIsInR5cGUiLCJnZXRBdHRyaWJ1dGUiLCJhamF4IiwidXJsIiwibWV0aG9kIiwidGhlbiIsImRhdGEiLCJmaW5kIiwidG9nZ2xlQ2xhc3MiLCJ0ZXh0IiwibGlrZXMiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0NBR0E7QUFDQTs7QUFFQUEsbUJBQU8sQ0FBQyxnRUFBRCxDQUFQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ2JBO0FBRUFDLDZDQUFDLENBQUMsWUFBWTtBQUVaQSwrQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUJDLElBQXZCLENBQTRCLFlBQVk7QUFDdEMsUUFBTUMsVUFBVSxHQUFHRiw2Q0FBQyxDQUFDLElBQUQsQ0FBcEI7QUFFQUUsY0FBVSxDQUFDQyxFQUFYLENBQWMsT0FBZCxFQUF1QixVQUFVQyxDQUFWLEVBQWE7QUFDbENBLE9BQUMsQ0FBQ0MsY0FBRjs7QUFFQSxVQUFJRCxDQUFDLENBQUNFLE1BQUYsQ0FBU0MsU0FBVCxDQUFtQkMsUUFBbkIsQ0FBNEIsS0FBNUIsQ0FBSixFQUF3QztBQUN0QyxZQUFNQyxJQUFJLEdBQUdMLENBQUMsQ0FBQ0UsTUFBRixDQUFTSSxZQUFULENBQXNCLFdBQXRCLENBQWI7QUFFQVYscURBQUMsQ0FBQ1csSUFBRixDQUFPO0FBQ0xDLGFBQUcsOEJBQXVCSCxJQUF2QixDQURFO0FBRUxJLGdCQUFNLEVBQUU7QUFGSCxTQUFQLEVBR0dDLElBSEgsQ0FHUSxVQUFVQyxJQUFWLEVBQWdCO0FBQ3RCYixvQkFBVSxDQUFDYSxJQUFYLENBQWdCLE1BQWhCLEVBQXdCTixJQUFJLEtBQUssTUFBVCxHQUFrQixTQUFsQixHQUE4QixNQUF0RDtBQUNBUCxvQkFBVSxDQUFDYyxJQUFYLENBQWdCLFdBQWhCLEVBQTZCQyxXQUE3QixDQUF5QyxTQUF6QztBQUNBZixvQkFBVSxDQUFDYyxJQUFYLENBQWdCLHdCQUFoQixFQUEwQ0UsSUFBMUMsQ0FBK0NILElBQUksQ0FBQ0ksS0FBcEQ7QUFDRCxTQVBEO0FBUUQ7QUFFRixLQWhCRDtBQWlCRCxHQXBCRDtBQXNCRCxDQXhCQSxDQUFELEM7Ozs7Ozs7Ozs7O0FDRkEsdUMiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gaW1wb3J0IGl0LlxuLy8gaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcblxucmVxdWlyZSgnYm9vdHN0cmFwJyk7XG5cbmltcG9ydCAnLi9saWtlJ1xuIiwiaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcblxuJChmdW5jdGlvbiAoKSB7XG5cbiAgJCgnW2RhdGEtaXRlbT1saWtlc10nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICBjb25zdCAkY29udGFpbmVyID0gJCh0aGlzKTtcblxuICAgICRjb250YWluZXIub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgIGUucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgaWYgKGUudGFyZ2V0LmNsYXNzTGlzdC5jb250YWlucygnYnRuJykpIHtcbiAgICAgICAgY29uc3QgdHlwZSA9IGUudGFyZ2V0LmdldEF0dHJpYnV0ZSgnZGF0YS1pdGVtJyk7XG5cbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICB1cmw6IGAvYXJ0aWNsZXMvMTAvbGlrZS8ke3R5cGV9YCxcbiAgICAgICAgICBtZXRob2Q6ICdQT1NUJ1xuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgJGNvbnRhaW5lci5kYXRhKCd0eXBlJywgdHlwZSA9PT0gJ2xpa2UnID8gJ2Rpc2xpa2UnIDogJ2xpa2UnKVxuICAgICAgICAgICRjb250YWluZXIuZmluZCgnLmZhLWhlYXJ0JykudG9nZ2xlQ2xhc3MoJ2ZhciBmYXMnKTtcbiAgICAgICAgICAkY29udGFpbmVyLmZpbmQoJ1tkYXRhLWl0ZW09bGlrZXNDb3VudF0nKS50ZXh0KGRhdGEubGlrZXMpO1xuICAgICAgICB9KTtcbiAgICAgIH1cblxuICAgIH0pO1xuICB9KTtcblxufSk7IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIl0sInNvdXJjZVJvb3QiOiIifQ==