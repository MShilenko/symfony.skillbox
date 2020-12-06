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
        var href = e.target.getAttribute('data-href');
        jquery__WEBPACK_IMPORTED_MODULE_1___default.a.ajax({
          url: href,
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9saWtlLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImVhY2giLCIkY29udGFpbmVyIiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJ0YXJnZXQiLCJjbGFzc0xpc3QiLCJjb250YWlucyIsInR5cGUiLCJnZXRBdHRyaWJ1dGUiLCJocmVmIiwiYWpheCIsInVybCIsIm1ldGhvZCIsInRoZW4iLCJkYXRhIiwiZmluZCIsInRvZ2dsZUNsYXNzIiwidGV4dCIsImxpa2VzIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7O0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtDQUdBO0FBQ0E7O0FBRUFBLG1CQUFPLENBQUMsZ0VBQUQsQ0FBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUNiQTtBQUVBQyw2Q0FBQyxDQUFDLFlBQVk7QUFFWkEsK0NBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCQyxJQUF2QixDQUE0QixZQUFZO0FBQ3RDLFFBQU1DLFVBQVUsR0FBR0YsNkNBQUMsQ0FBQyxJQUFELENBQXBCO0FBRUFFLGNBQVUsQ0FBQ0MsRUFBWCxDQUFjLE9BQWQsRUFBdUIsVUFBVUMsQ0FBVixFQUFhO0FBQ2xDQSxPQUFDLENBQUNDLGNBQUY7O0FBRUEsVUFBSUQsQ0FBQyxDQUFDRSxNQUFGLENBQVNDLFNBQVQsQ0FBbUJDLFFBQW5CLENBQTRCLEtBQTVCLENBQUosRUFBd0M7QUFDdEMsWUFBTUMsSUFBSSxHQUFHTCxDQUFDLENBQUNFLE1BQUYsQ0FBU0ksWUFBVCxDQUFzQixXQUF0QixDQUFiO0FBQ0EsWUFBTUMsSUFBSSxHQUFHUCxDQUFDLENBQUNFLE1BQUYsQ0FBU0ksWUFBVCxDQUFzQixXQUF0QixDQUFiO0FBRUFWLHFEQUFDLENBQUNZLElBQUYsQ0FBTztBQUNMQyxhQUFHLEVBQUVGLElBREE7QUFFTEcsZ0JBQU0sRUFBRTtBQUZILFNBQVAsRUFHR0MsSUFISCxDQUdRLFVBQVVDLElBQVYsRUFBZ0I7QUFDdEJkLG9CQUFVLENBQUNjLElBQVgsQ0FBZ0IsTUFBaEIsRUFBd0JQLElBQUksS0FBSyxNQUFULEdBQWtCLFNBQWxCLEdBQThCLE1BQXREO0FBQ0FQLG9CQUFVLENBQUNlLElBQVgsQ0FBZ0IsV0FBaEIsRUFBNkJDLFdBQTdCLENBQXlDLFNBQXpDO0FBQ0FoQixvQkFBVSxDQUFDZSxJQUFYLENBQWdCLHdCQUFoQixFQUEwQ0UsSUFBMUMsQ0FBK0NILElBQUksQ0FBQ0ksS0FBcEQ7QUFDRCxTQVBEO0FBUUQ7QUFFRixLQWpCRDtBQWtCRCxHQXJCRDtBQXVCRCxDQXpCQSxDQUFELEM7Ozs7Ozs7Ozs7O0FDRkEsdUMiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xyXG5cclxuLy8gTmVlZCBqUXVlcnk/IEluc3RhbGwgaXQgd2l0aCBcInlhcm4gYWRkIGpxdWVyeVwiLCB0aGVuIHVuY29tbWVudCB0byBpbXBvcnQgaXQuXHJcbi8vIGltcG9ydCAkIGZyb20gJ2pxdWVyeSc7XHJcblxyXG5yZXF1aXJlKCdib290c3RyYXAnKTtcclxuXHJcbmltcG9ydCAnLi9saWtlJ1xyXG4iLCJpbXBvcnQgJCBmcm9tICdqcXVlcnknO1xyXG5cclxuJChmdW5jdGlvbiAoKSB7XHJcblxyXG4gICQoJ1tkYXRhLWl0ZW09bGlrZXNdJykuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICBjb25zdCAkY29udGFpbmVyID0gJCh0aGlzKTtcclxuXHJcbiAgICAkY29udGFpbmVyLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcbiAgICAgIGlmIChlLnRhcmdldC5jbGFzc0xpc3QuY29udGFpbnMoJ2J0bicpKSB7XHJcbiAgICAgICAgY29uc3QgdHlwZSA9IGUudGFyZ2V0LmdldEF0dHJpYnV0ZSgnZGF0YS1pdGVtJyk7XHJcbiAgICAgICAgY29uc3QgaHJlZiA9IGUudGFyZ2V0LmdldEF0dHJpYnV0ZSgnZGF0YS1ocmVmJyk7XHJcblxyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICB1cmw6IGhyZWYsXHJcbiAgICAgICAgICBtZXRob2Q6ICdQT1NUJ1xyXG4gICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKGRhdGEpIHtcclxuICAgICAgICAgICRjb250YWluZXIuZGF0YSgndHlwZScsIHR5cGUgPT09ICdsaWtlJyA/ICdkaXNsaWtlJyA6ICdsaWtlJylcclxuICAgICAgICAgICRjb250YWluZXIuZmluZCgnLmZhLWhlYXJ0JykudG9nZ2xlQ2xhc3MoJ2ZhciBmYXMnKTtcclxuICAgICAgICAgICRjb250YWluZXIuZmluZCgnW2RhdGEtaXRlbT1saWtlc0NvdW50XScpLnRleHQoZGF0YS5saWtlcyk7XHJcbiAgICAgICAgfSk7XHJcbiAgICAgIH1cclxuXHJcbiAgICB9KTtcclxuICB9KTtcclxuXHJcbn0pOyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=