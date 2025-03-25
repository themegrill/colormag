/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/defineProperty.js":
/*!************************************************************************************************************!*\
  !*** ./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/defineProperty.js ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _defineProperty)
/* harmony export */ });
/* harmony import */ var _toPropertyKey_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./toPropertyKey.js */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPropertyKey.js");

function _defineProperty(e, r, t) {
  return (r = (0,_toPropertyKey_js__WEBPACK_IMPORTED_MODULE_0__["default"])(r)) in e ? Object.defineProperty(e, r, {
    value: t,
    enumerable: !0,
    configurable: !0,
    writable: !0
  }) : e[r] = t, e;
}


/***/ }),

/***/ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/extends.js":
/*!*****************************************************************************************************!*\
  !*** ./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _extends)
/* harmony export */ });
function _extends() {
  return _extends = Object.assign ? Object.assign.bind() : function (n) {
    for (var e = 1; e < arguments.length; e++) {
      var t = arguments[e];
      for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]);
    }
    return n;
  }, _extends.apply(null, arguments);
}


/***/ }),

/***/ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPrimitive.js":
/*!*********************************************************************************************************!*\
  !*** ./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPrimitive.js ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ toPrimitive)
/* harmony export */ });
/* harmony import */ var _typeof_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./typeof.js */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/typeof.js");

function toPrimitive(t, r) {
  if ("object" != (0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(t) || !t) return t;
  var e = t[Symbol.toPrimitive];
  if (void 0 !== e) {
    var i = e.call(t, r || "default");
    if ("object" != (0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(i)) return i;
    throw new TypeError("@@toPrimitive must return a primitive value.");
  }
  return ("string" === r ? String : Number)(t);
}


/***/ }),

/***/ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPropertyKey.js":
/*!***********************************************************************************************************!*\
  !*** ./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPropertyKey.js ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ toPropertyKey)
/* harmony export */ });
/* harmony import */ var _typeof_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./typeof.js */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/typeof.js");
/* harmony import */ var _toPrimitive_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./toPrimitive.js */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/toPrimitive.js");


function toPropertyKey(t) {
  var i = (0,_toPrimitive_js__WEBPACK_IMPORTED_MODULE_1__["default"])(t, "string");
  return "symbol" == (0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(i) ? i : i + "";
}


/***/ }),

/***/ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/typeof.js":
/*!****************************************************************************************************!*\
  !*** ./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/typeof.js ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _typeof)
/* harmony export */ });
function _typeof(o) {
  "@babel/helpers - typeof";

  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) {
    return typeof o;
  } : function (o) {
    return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o;
  }, _typeof(o);
}


/***/ }),

/***/ "./src/meta/Plugin.tsx":
/*!*****************************!*\
  !*** ./src/meta/Plugin.tsx ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Plugin: () => (/* binding */ Plugin)
/* harmony export */ });
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_edit_post__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/edit-post */ "@wordpress/edit-post");
/* harmony import */ var _wordpress_edit_post__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_edit_post__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_GeneralPanel__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/GeneralPanel */ "./src/meta/components/GeneralPanel.tsx");
/* harmony import */ var _components_meta_schema__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/meta.schema */ "./src/meta/components/meta.schema.ts");





var Plugin = () => {
  var [activePanel, setActivePanel] = (0,react__WEBPACK_IMPORTED_MODULE_2__.useState)(_components_meta_schema__WEBPACK_IMPORTED_MODULE_4__.PanelTypes.GENERAL);
  var togglePanel = panel => {
    setActivePanel(prevActivePanel => prevActivePanel === panel ? null : panel);
  };
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement(_wordpress_edit_post__WEBPACK_IMPORTED_MODULE_1__.PluginSidebar, {
    name: "colormag-meta-setting-sidebar",
    title: "ColorMag Page Settings",
    icon: /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement((react__WEBPACK_IMPORTED_MODULE_2___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      xmlSpace: "preserve",
      viewBox: "0 0 50.1 49"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement("path", {
      fill: "#024947",
      d: "M44.9 24.5c0-11-8.9-19.9-19.9-19.9-11 0-19.9 8.9-19.9 19.9 0 11 8.9 19.9 19.9 19.9 11 0 19.9-8.9 19.9-19.9z"
    }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement("path", {
      fill: "#ffffff",
      d: "M31 16.2c-.3 0-.6.1-.9.2-.3.1-.5.3-.8.5L17.5 28.7c-.4.4-.7 1-.7 1.7 0 .6.2 1.2.7 1.7.4.4 1 .7 1.7.7.6 0 1.2-.2 1.7-.7l11.8-11.8c.3-.3.6-.8.6-1.2.1-.5 0-.9-.1-1.4-.2-.4-.5-.8-.9-1.1-.4-.2-.9-.4-1.3-.4zm-13.4 4.2c.2.2.5.3.8.3.3 0 .6-.1.8-.4l4.1-4.1h-4c-.6 0-1.2.2-1.7.7-.5.4-.7 1-.8 1.7 0 .4.1.7.2 1s.3.6.6.8zM31 28.6l-4.1 4.1H31c.6 0 1.2-.2 1.7-.7.5-.4.7-1 .8-1.7 0-.4-.1-.8-.2-1.1-.2-.3-.4-.6-.7-.9-.2-.1-.5-.2-.7-.2-.5.2-.8.4-.9.5z",
      className: "st1"
    })))
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Panel, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.PanelBody, {
    title: "General",
    opened: activePanel === _components_meta_schema__WEBPACK_IMPORTED_MODULE_4__.PanelTypes.GENERAL,
    onToggle: () => togglePanel(_components_meta_schema__WEBPACK_IMPORTED_MODULE_4__.PanelTypes.GENERAL)
  }, activePanel === _components_meta_schema__WEBPACK_IMPORTED_MODULE_4__.PanelTypes.GENERAL && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_2___default().createElement(_components_GeneralPanel__WEBPACK_IMPORTED_MODULE_3__["default"], null))));
};

/***/ }),

/***/ "./src/meta/components/GeneralPanel.tsx":
/*!**********************************************!*\
  !*** ./src/meta/components/GeneralPanel.tsx ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _hoc_withMeta__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../hoc/withMeta */ "./src/meta/hoc/withMeta.tsx");
/* harmony import */ var _Icons__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./Icons */ "./src/meta/components/Icons.tsx");






var OPTIONS = (0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.applyFilters)('colormag.meta.general.layout', [{
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Customizer', 'colormag'),
  icon: _Icons__WEBPACK_IMPORTED_MODULE_5__.Customizer,
  value: 'default_layout'
}, {
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Right Sidebar', 'colormag'),
  icon: _Icons__WEBPACK_IMPORTED_MODULE_5__.RightSidebar,
  value: 'right_sidebar'
}, {
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Left Sidebar', 'colormag'),
  icon: _Icons__WEBPACK_IMPORTED_MODULE_5__.LeftSidebar,
  value: 'left_sidebar'
}, {
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Centered Sidebar', 'colormag'),
  icon: _Icons__WEBPACK_IMPORTED_MODULE_5__.CenteredSidebar,
  value: 'no_sidebar_content_centered'
}, {
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Contained Sidebar', 'colormag'),
  icon: _Icons__WEBPACK_IMPORTED_MODULE_5__.ContainedSidebar,
  value: 'no_sidebar_full_width'
}]);
var GeneralPanel = _ref => {
  var _meta$colormag_page_l;
  var {
    meta,
    updateMeta
  } = _ref;
  var currentLayout = (_meta$colormag_page_l = meta === null || meta === void 0 ? void 0 : meta.colormag_page_layout) !== null && _meta$colormag_page_l !== void 0 ? _meta$colormag_page_l : 'default_layout';
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.PanelRow, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Flex, {
    className: "mainFlexbox",
    direction: 'column'
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Layout', 'colormag')), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Flex, {
    style: {
      flex: 1,
      flexWrap: 'wrap',
      gap: 8
    }
  }, OPTIONS === null || OPTIONS === void 0 ? void 0 : OPTIONS.map(option => {
    var Icon = option.icon;
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Flex, {
      key: option.value,
      style: {
        width: 'calc(50% - 10px)'
      },
      "data-state": currentLayout === option.value ? 'active' : 'inactive',
      onClick: () => {
        updateMeta === null || updateMeta === void 0 || updateMeta('colormag_page_layout', option.value);
      }
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(Icon, {
      className: option.value
    }));
  }))));
};

// @ts-ignore
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_hoc_withMeta__WEBPACK_IMPORTED_MODULE_4__.withMeta)((0,_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.withFilters)('ColorMagMetaGeneralPanel')(GeneralPanel)));

/***/ }),

/***/ "./src/meta/components/Icons.tsx":
/*!***************************************!*\
  !*** ./src/meta/components/Icons.tsx ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BothSidebar: () => (/* binding */ BothSidebar),
/* harmony export */   CenteredSidebar: () => (/* binding */ CenteredSidebar),
/* harmony export */   ContainedSidebar: () => (/* binding */ ContainedSidebar),
/* harmony export */   Customizer: () => (/* binding */ Customizer),
/* harmony export */   HeaderCenter: () => (/* binding */ HeaderCenter),
/* harmony export */   HeaderLeft: () => (/* binding */ HeaderLeft),
/* harmony export */   HeaderRight: () => (/* binding */ HeaderRight),
/* harmony export */   LeftSidebar: () => (/* binding */ LeftSidebar),
/* harmony export */   RightSidebar: () => (/* binding */ RightSidebar),
/* harmony export */   StretchedSidebar: () => (/* binding */ StretchedSidebar)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


var Customizer = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "83",
    x: ".5",
    y: "8.5",
    fill: "#71717A",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("path", {
    fill: "#FAFAFA",
    d: "M54.892 34.23c-1.216 0-2.108-.892-2.108-2.108 0-.082 0-.244-.243-.325-.082-.08-.244 0-.325.081-.73.811-2.27.811-3 0-.405-.405-.567-.892-.567-1.54 0-.568.243-1.135.567-1.54.081-.082.081-.244.081-.325 0-.081-.162-.162-.243-.162h-.243c-1.217 0-2.108-.892-2.108-2.108 0-1.217.891-2.108 2.108-2.108.08 0 .243 0 .324-.244.081-.243.081-.243 0-.324-.405-.324-.649-.892-.649-1.46-.08-.567.163-1.135.568-1.54.73-.73 2.19-.73 3 0 .162.081.324.162.486.081 0-.081 0-.081.082-.081.08 0 .08-.081.08-.162v-.162c0-1.217.892-2.108 2.109-2.108 1.216 0 2.108.891 2.108 2.108v.08c0 .082.08.163.162.244.081 0 .243 0 .324-.081.73-.73 2.27-.73 3 0 .406.405.568.892.568 1.54 0 .649-.162 1.054-.568 1.46-.08.08-.08.243-.08.324 0 .081 0 .081.08.162.081.081.081.081.163.081 1.297 0 2.189.892 2.189 2.108 0 1.136-.892 2.109-2.027 2.109l-.325.324c0 .081 0 .243.081.324.811.811.811 2.19 0 3-.81.811-2.189.811-3 0-.08-.08-.243-.08-.324-.08-.081 0-.162.161-.162.242 0 1.298-.892 2.19-2.108 2.19Zm-2.433-4.054c.244 0 .487.08.73.162.81.324 1.216.973 1.216 1.702 0 .325.244.568.487.568s.486-.243.486-.486c0-.811.487-1.541 1.135-1.784.73-.325 1.541-.162 2.109.405.162.162.567.162.73 0 .161-.162.161-.567 0-.73-.568-.567-.73-1.378-.406-2.108 0-.08 0-.08.081-.08.243-.406.73-.974 1.378-1.217h.163c.324 0 .567-.243.567-.486 0-.244-.243-.487-.486-.487-.811 0-1.541-.487-1.784-1.135-.081-.081-.081-.162-.081-.243-.243-.649 0-1.46.486-1.946.081-.081.162-.244.162-.325 0-.08-.08-.243-.162-.324-.162-.162-.567-.162-.73 0a1.99 1.99 0 0 1-2.108.324c-.73-.243-1.135-.973-1.135-1.702v-.081c0-.244-.243-.487-.486-.487s-.487.243-.487.487v.162c0 .73-.486 1.46-1.135 1.703-.081.08-.162.08-.243.08-.649.163-1.378.082-1.946-.405 0 0-.081 0-.081-.081-.162-.162-.568-.162-.73 0-.081.081-.081.243-.081.324 0 .081 0 .325.162.487.568.567.73 1.378.324 2.108a1.753 1.753 0 0 1-1.702 1.216c-.325 0-.568.243-.568.487 0 .243.244.486.487.486h.243c.73 0 1.46.487 1.703 1.135.324.73.162 1.54-.406 2.108-.08.081-.162.244-.162.325 0 .162.081.243.162.324.162.162.568.162.73 0 .324-.324.892-.486 1.378-.486Zm2.27-1.136c-1.621 0-2.837-1.216-2.837-2.837 0-1.622 1.216-2.838 2.838-2.838 1.621 0 2.838 1.216 2.838 2.838 0 1.621-1.217 2.837-2.838 2.837Zm0-4.054c-.648 0-1.216.568-1.216 1.217 0 .648.568 1.216 1.217 1.216.648 0 1.216-.568 1.216-1.216 0-.65-.568-1.217-1.216-1.217Zm3.241 14.966a.81.81 0 0 1-.81-1.022l1.102-4.054a.81.81 0 0 1 .203-.357l9.973-9.973a2.976 2.976 0 0 1 4.127 0 2.903 2.903 0 0 1 0 4.095l-9.973 9.973a.811.811 0 0 1-.357.203l-4.054 1.135a.607.607 0 0 1-.21 0Zm1.833-4.435-.673 2.432 2.432-.681 9.819-9.738a1.281 1.281 0 0 0 0-1.8 1.306 1.306 0 0 0-1.8 0l-9.778 9.787ZM46.008 52.42h-3.953v2.75h3.633v2.046h-3.633v4.352H39.53V50.365h6.477v2.054Zm6.828 3.374a2.14 2.14 0 0 0-1.04-.242c-.536 0-.955.198-1.257.594-.302.39-.453.924-.453 1.601v3.82h-2.469v-8h2.469v1.485h.031c.39-1.083 1.094-1.625 2.11-1.625.26 0 .463.031.609.094v2.273Zm4.906 5.969c-1.333 0-2.383-.372-3.148-1.117-.76-.75-1.14-1.766-1.14-3.047 0-1.323.395-2.357 1.187-3.102.791-.75 1.862-1.125 3.21-1.125 1.329 0 2.37.375 3.126 1.125.755.745 1.132 1.732 1.132 2.961 0 1.328-.39 2.378-1.172 3.149-.776.77-1.84 1.156-3.195 1.156Zm.063-6.5c-.584 0-1.037.2-1.36.602-.323.4-.484.968-.484 1.703 0 1.536.62 2.304 1.86 2.304 1.182 0 1.773-.789 1.773-2.367 0-1.495-.597-2.242-1.79-2.242Zm18.61 6.305h-2.462v-4.563c0-1.161-.427-1.742-1.281-1.742-.406 0-.737.174-.992.523-.256.35-.383.784-.383 1.305v4.477h-2.469v-4.61c0-1.13-.42-1.695-1.258-1.695-.422 0-.76.167-1.015.5-.25.333-.375.786-.375 1.36v4.445h-2.47v-8h2.47v1.25h.03a2.93 2.93 0 0 1 1.071-1.04c.464-.27.969-.406 1.516-.406 1.13 0 1.904.498 2.32 1.492.61-.994 1.505-1.492 2.688-1.492 1.74 0 2.61 1.073 2.61 3.22v4.976ZM27.022 80.169c-.817.396-1.885.594-3.203.594-1.718 0-3.07-.505-4.054-1.516-.985-1.01-1.477-2.356-1.477-4.039 0-1.791.552-3.245 1.656-4.36 1.11-1.114 2.547-1.671 4.313-1.671 1.094 0 2.015.138 2.765.414v2.43c-.75-.448-1.604-.672-2.562-.672-1.052 0-1.901.33-2.547.992-.646.662-.969 1.557-.969 2.688 0 1.083.305 1.948.914 2.593.61.64 1.43.961 2.461.961.985 0 1.886-.24 2.703-.718v2.304Zm9.313.399h-2.461v-1.22h-.04c-.608.944-1.424 1.415-2.444 1.415-1.854 0-2.782-1.123-2.782-3.367v-4.828h2.461v4.609c0 1.13.448 1.695 1.344 1.695.443 0 .797-.153 1.063-.46.265-.313.398-.735.398-1.266v-4.578h2.46v8Zm1.562-.211v-2c.407.245.81.427 1.211.547.407.12.79.18 1.149.18.437 0 .781-.06 1.031-.18.255-.12.383-.302.383-.547a.506.506 0 0 0-.172-.39 1.585 1.585 0 0 0-.445-.274 4.785 4.785 0 0 0-.586-.211 7.15 7.15 0 0 1-.617-.211 6.436 6.436 0 0 1-.844-.383 2.602 2.602 0 0 1-.61-.484 1.982 1.982 0 0 1-.375-.633 2.599 2.599 0 0 1-.125-.852c0-.448.097-.833.29-1.156.197-.323.458-.586.78-.79a3.543 3.543 0 0 1 1.118-.452c.422-.1.86-.149 1.312-.149.355 0 .714.029 1.079.086.364.052.724.13 1.078.235v1.906a3.79 3.79 0 0 0-1.008-.406 4.082 4.082 0 0 0-1.047-.141 2.2 2.2 0 0 0-.46.047 1.32 1.32 0 0 0-.376.125.65.65 0 0 0-.258.21.47.47 0 0 0-.093.29c0 .146.046.27.14.375.094.104.216.195.367.273.151.073.318.14.5.203.188.058.373.118.555.18.328.115.625.24.89.375.266.136.493.294.68.477a1.8 1.8 0 0 1 .438.64c.104.245.156.537.156.875 0 .474-.104.88-.312 1.22a2.472 2.472 0 0 1-.82.82c-.34.208-.732.359-1.18.453a6.32 6.32 0 0 1-1.383.148 7.15 7.15 0 0 1-2.446-.406Zm12.407.117c-.365.193-.914.289-1.649.289-1.74 0-2.61-.904-2.61-2.711v-3.664H44.75v-1.82h1.297V70.84l2.46-.703v2.43h1.798v1.82h-1.797v3.234c0 .834.33 1.25.992 1.25.26 0 .529-.075.805-.226v1.828Zm5.148.289c-1.333 0-2.383-.373-3.148-1.117-.76-.75-1.14-1.766-1.14-3.047 0-1.323.395-2.357 1.187-3.102.791-.75 1.862-1.125 3.21-1.125 1.329 0 2.37.375 3.126 1.125.755.745 1.132 1.732 1.132 2.961 0 1.328-.39 2.378-1.172 3.149-.776.77-1.84 1.156-3.195 1.156Zm.063-6.5c-.584 0-1.037.2-1.36.602-.323.4-.484.968-.484 1.703 0 1.536.62 2.304 1.86 2.304 1.182 0 1.773-.789 1.773-2.367 0-1.495-.597-2.242-1.79-2.242Zm18.609 6.305h-2.46v-4.563c0-1.161-.428-1.742-1.282-1.742-.406 0-.737.174-.992.523-.256.35-.383.784-.383 1.305v4.477h-2.469v-4.61c0-1.13-.42-1.695-1.258-1.695-.422 0-.76.167-1.015.5-.25.333-.375.786-.375 1.36v4.445h-2.47v-8h2.47v1.25h.03a2.93 2.93 0 0 1 1.071-1.04 2.95 2.95 0 0 1 1.516-.406c1.13 0 1.904.498 2.32 1.493.61-.995 1.505-1.493 2.688-1.493 1.74 0 2.609 1.073 2.609 3.22v4.976Zm3.203-9.266c-.416 0-.758-.122-1.023-.367a1.208 1.208 0 0 1-.399-.914c0-.37.133-.672.399-.906.265-.235.606-.352 1.023-.352.422 0 .763.117 1.024.352.265.234.398.536.398.906 0 .375-.133.682-.398.922-.26.24-.602.359-1.024.359Zm1.219 9.266h-2.469v-8h2.469v8Zm8.414 0h-7.18v-1.024l4.016-5.156H80.18v-1.82h6.75v1.218l-3.805 4.961h3.836v1.82Zm8.523-3.297h-5.218c.083 1.161.815 1.742 2.195 1.742.88 0 1.654-.208 2.32-.625v1.781c-.74.396-1.7.594-2.883.594-1.291 0-2.294-.357-3.007-1.07-.714-.72-1.07-1.72-1.07-3 0-1.328.385-2.38 1.156-3.157.77-.776 1.718-1.164 2.843-1.164 1.167 0 2.068.347 2.703 1.04.641.692.961 1.632.961 2.82v1.039Zm-2.289-1.516c0-1.146-.463-1.719-1.39-1.719-.396 0-.74.164-1.032.493-.286.328-.46.737-.523 1.226h2.945Zm8.977-.96a2.14 2.14 0 0 0-1.039-.243c-.537 0-.956.198-1.258.594-.302.39-.453.924-.453 1.601v3.82h-2.469v-8h2.469v1.485h.031c.39-1.083 1.094-1.625 2.109-1.625.261 0 .464.031.61.094v2.273Z"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "83",
    x: ".5",
    y: "8.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var CenteredSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "42",
    height: "3",
    x: "26",
    y: "22",
    fill: "#A1A1AA",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "30",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "36",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "42",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "48",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "57",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "63",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "69",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "26",
    y: "75",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var RightSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "75",
    x: ".5",
    y: "12.5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "42",
    height: "3",
    x: "8",
    y: "22",
    fill: "#A1A1AA",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "30",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "36",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "42",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "48",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "57",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "63",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "69",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "8",
    y: "75",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("path", {
    fill: "#71717A",
    d: "M82 20h30v60H82z"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "75",
    x: ".5",
    y: "12.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var StretchedSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "73",
    height: "3",
    x: "4",
    y: "22",
    fill: "#A1A1AA",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "30",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "36",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "42",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "48",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "57",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "63",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "69",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "112",
    height: "3",
    x: "4",
    y: "75",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var ContainedSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "61",
    height: "3",
    x: "11",
    y: "22",
    fill: "#A1A1AA",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "30",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "36",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "42",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "48",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "57",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "63",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "69",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "98",
    height: "3",
    x: "11",
    y: "75",
    fill: "#D4D4D8",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "71",
    x: ".5",
    y: "14.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var BothSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "120",
    height: "100",
    fill: "none",
    viewBox: "0 0 120 100"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    rx: "4",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: ".5",
    y: "12.5",
    width: "119",
    height: "75",
    rx: "3.5",
    fill: "#FAFAFA"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("path", {
    fill: "#71717A",
    d: "M6.5 20h28v60h-28z"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "20",
    width: "24",
    height: "3",
    rx: "1.5",
    fill: "#A1A1AA"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "28",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "34",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "40",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "46",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "55",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "61",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "67",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: "40.5",
    y: "73",
    width: "39",
    height: "3",
    rx: "1.5",
    fill: "#E4E4E7"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("path", {
    fill: "#71717A",
    d: "M85.5 20h28v60h-28z"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    x: ".5",
    y: "12.5",
    width: "119",
    height: "75",
    rx: "3.5",
    stroke: "#71717A"
  }));
});
var LeftSidebar = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "75",
    x: ".5",
    y: "12.5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("path", {
    fill: "#71717A",
    d: "M8 20h30v60H8z"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "42",
    height: "3",
    x: "44",
    y: "22",
    fill: "#A1A1AA",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "30",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "36",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "42",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "48",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "57",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "63",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "69",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "68",
    height: "3",
    x: "44",
    y: "75",
    fill: "#E4E4E7",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "75",
    x: ".5",
    y: "12.5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var HeaderLeft = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "27",
    x: ".5",
    y: ".5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "18",
    height: "4",
    x: "8",
    y: "12",
    fill: "#71717A",
    rx: "1"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "52",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "68",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "84",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "100",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "27",
    x: ".5",
    y: ".5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var HeaderCenter = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "36",
    x: ".5",
    y: ".5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "18",
    height: "4",
    x: "51",
    y: "12",
    fill: "#71717A",
    rx: "1"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "30",
    y: "22",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "46",
    y: "22",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "62",
    y: "22",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "78",
    y: "22",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "36",
    x: ".5",
    y: ".5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});
var HeaderRight = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().forwardRef((props, ref) => {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("svg", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    ref: ref
  }, props, {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 120 100"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "120",
    height: "100",
    fill: "#E4E4E7",
    rx: "4"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "27",
    x: ".5",
    y: ".5",
    fill: "#FAFAFA",
    rx: "3.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "8",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "24",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "40",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "12",
    height: "3",
    x: "56",
    y: "12.5",
    fill: "#71717A",
    rx: "1.5"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "18",
    height: "4",
    x: "94",
    y: "12",
    fill: "#71717A",
    rx: "1"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default().createElement("rect", {
    width: "119",
    height: "27",
    x: ".5",
    y: ".5",
    stroke: "#71717A",
    rx: "3.5"
  }));
});

/***/ }),

/***/ "./src/meta/components/meta.schema.ts":
/*!********************************************!*\
  !*** ./src/meta/components/meta.schema.ts ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   PanelTypes: () => (/* binding */ PanelTypes)
/* harmony export */ });
var PanelTypes = /*#__PURE__*/function (PanelTypes) {
  PanelTypes["GENERAL"] = "General";
  return PanelTypes;
}({});

/***/ }),

/***/ "./src/meta/hoc/withMeta.tsx":
/*!***********************************!*\
  !*** ./src/meta/hoc/withMeta.tsx ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   withMeta: () => (/* binding */ withMeta)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/.pnpm/@babel+runtime@7.27.0/node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);


function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1__["default"])(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }


var withMeta = Component => {
  var Comp = props => {
    var meta = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
      var _getEditedPostAttribu, _select;
      return (_getEditedPostAttribu = (_select = select('core/editor')) === null || _select === void 0 ? void 0 : _select.getEditedPostAttribute('meta')) !== null && _getEditedPostAttribu !== void 0 ? _getEditedPostAttribu : {};
    }, []);
    var {
      editPost
    } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useDispatch)('core/editor');
    var updateMeta = (key, value) => {
      editPost({
        meta: _objectSpread(_objectSpread({}, meta), {}, {
          [key]: value
        })
      });
    };
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(Component, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
      updateMeta: updateMeta,
      meta: meta
    }, props));
  };
  Comp.displayName = "withMeta(".concat(Component.displayName || Component.name || 'Component', ")");
  return Comp;
};

/***/ }),

/***/ "./src/meta/meta.scss":
/*!****************************!*\
  !*** ./src/meta/meta.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/edit-post":
/*!**********************************!*\
  !*** external ["wp","editPost"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["editPost"];

/***/ }),

/***/ "@wordpress/hooks":
/*!*******************************!*\
  !*** external ["wp","hooks"] ***!
  \*******************************/
/***/ ((module) => {

module.exports = window["wp"]["hooks"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/plugins":
/*!*********************************!*\
  !*** external ["wp","plugins"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["plugins"];

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

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
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
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
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!***************************!*\
  !*** ./src/meta/meta.tsx ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/plugins */ "@wordpress/plugins");
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_plugins__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Plugin__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Plugin */ "./src/meta/Plugin.tsx");
/* harmony import */ var _meta_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./meta.scss */ "./src/meta/meta.scss");



(0,_wordpress_plugins__WEBPACK_IMPORTED_MODULE_0__.registerPlugin)('colormag-meta-setting-sidebar', {
  render: _Plugin__WEBPACK_IMPORTED_MODULE_1__.Plugin
});
})();

/******/ })()
;
//# sourceMappingURL=meta.js.map