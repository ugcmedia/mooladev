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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Helpers; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__ = __webpack_require__(1);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var Helpers = function () {
    function Helpers() {
        _classCallCheck(this, Helpers);
    }

    _createClass(Helpers, null, [{
        key: 'getUrlParam',
        value: function getUrlParam(paramName) {
            var url = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

            if (!url) {
                url = window.location.search;
            }
            var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
            var match = url.match(reParam);
            return match && match.length > 1 ? match[1] : null;
        }
    }, {
        key: 'asset',
        value: function asset(url) {
            if (url.substring(0, 2) === '//' || url.substring(0, 7) === 'http://' || url.substring(0, 8) === 'https://') {
                return url;
            }

            var baseUrl = RV_MEDIA_URL.base_url.substr(-1, 1) !== '/' ? RV_MEDIA_URL.base_url + '/' : RV_MEDIA_URL.base_url;

            if (url.substring(0, 1) === '/') {
                return baseUrl + url.substring(1);
            }
            return baseUrl + url;
        }
    }, {
        key: 'showAjaxLoading',
        value: function showAjaxLoading() {
            var $element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : $('.rv-media-main');

            $element.addClass('on-loading').append($('#rv_media_loading').html());
        }
    }, {
        key: 'hideAjaxLoading',
        value: function hideAjaxLoading() {
            var $element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : $('.rv-media-main');

            $element.removeClass('on-loading').find('.loading-wrapper').remove();
        }
    }, {
        key: 'isOnAjaxLoading',
        value: function isOnAjaxLoading() {
            var $element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : $('.rv-media-items');

            return $element.hasClass('on-loading');
        }
    }, {
        key: 'jsonEncode',
        value: function jsonEncode(object) {
            "use strict";

            if (typeof object === 'undefined') {
                object = null;
            }
            return JSON.stringify(object);
        }
    }, {
        key: 'jsonDecode',
        value: function jsonDecode(jsonString, defaultValue) {
            "use strict";

            if (!jsonString) {
                return defaultValue;
            }
            if (typeof jsonString === 'string') {
                var result = void 0;
                try {
                    result = $.parseJSON(jsonString);
                } catch (err) {
                    result = defaultValue;
                }
                return result;
            }
            return jsonString;
        }
    }, {
        key: 'getRequestParams',
        value: function getRequestParams() {
            if (window.rvMedia.options && window.rvMedia.options.open_in === 'modal') {
                return $.extend(true, __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["a" /* MediaConfig */].request_params, window.rvMedia.options || {});
            }
            return __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["a" /* MediaConfig */].request_params;
        }
    }, {
        key: 'setSelectedFile',
        value: function setSelectedFile($file_id) {
            if (typeof window.rvMedia.options !== 'undefined') {
                window.rvMedia.options.selected_file_id = $file_id;
            } else {
                __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["a" /* MediaConfig */].request_params.selected_file_id = $file_id;
            }
        }
    }, {
        key: 'getConfigs',
        value: function getConfigs() {
            return __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["a" /* MediaConfig */];
        }
    }, {
        key: 'storeConfig',
        value: function storeConfig() {
            localStorage.setItem('MediaConfig', Helpers.jsonEncode(__WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["a" /* MediaConfig */]));
        }
    }, {
        key: 'storeRecentItems',
        value: function storeRecentItems() {
            localStorage.setItem('RecentItems', Helpers.jsonEncode(__WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["b" /* RecentItems */]));
        }
    }, {
        key: 'addToRecent',
        value: function addToRecent(id) {
            if (id instanceof Array) {
                _.each(id, function (value) {
                    __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["b" /* RecentItems */].push(value);
                });
            } else {
                __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["b" /* RecentItems */].push(id);
            }
        }
    }, {
        key: 'getItems',
        value: function getItems() {
            var items = [];
            $('.js-media-list-title').each(function () {
                var $box = $(this);
                var data = $box.data() || {};
                data.index_key = $box.index();
                items.push(data);
            });
            return items;
        }
    }, {
        key: 'getSelectedItems',
        value: function getSelectedItems() {
            var selected = [];
            $('.js-media-list-title input[type=checkbox]:checked').each(function () {
                var $box = $(this).closest('.js-media-list-title');
                var data = $box.data() || {};
                data.index_key = $box.index();
                selected.push(data);
            });
            return selected;
        }
    }, {
        key: 'getSelectedFiles',
        value: function getSelectedFiles() {
            var selected = [];
            $('.js-media-list-title[data-context=file] input[type=checkbox]:checked').each(function () {
                var $box = $(this).closest('.js-media-list-title');
                var data = $box.data() || {};
                data.index_key = $box.index();
                selected.push(data);
            });
            return selected;
        }
    }, {
        key: 'getSelectedFolder',
        value: function getSelectedFolder() {
            var selected = [];
            $('.js-media-list-title[data-context=folder] input[type=checkbox]:checked').each(function () {
                var $box = $(this).closest('.js-media-list-title');
                var data = $box.data() || {};
                data.index_key = $box.index();
                selected.push(data);
            });
            return selected;
        }
    }, {
        key: 'isUseInModal',
        value: function isUseInModal() {
            return Helpers.getUrlParam('media-action') === 'select-files' || window.rvMedia && window.rvMedia.options && window.rvMedia.options.open_in === 'modal';
        }
    }, {
        key: 'resetPagination',
        value: function resetPagination() {
            RV_MEDIA_CONFIG.pagination = { paged: 1, posts_per_page: 40, in_process_get_media: false, has_more: true };
        }
    }]);

    return Helpers;
}();

/***/ }),

/***/ 1:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MediaConfig; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "b", function() { return RecentItems; });
var MediaConfig = $.parseJSON(localStorage.getItem('MediaConfig')) || {};

var defaultConfig = {
    app_key: '483a0xyzytz1242c0d520426e8ba366c530c3d9dabc',
    request_params: {
        view_type: 'tiles',
        filter: 'everything',
        view_in: 'all_media',
        search: '',
        sort_by: 'created_at-desc',
        folder_id: 0
    },
    hide_details_pane: false,
    icons: {
        folder: 'fa fa-folder-o'
    },
    actions_list: {
        basic: [{
            icon: 'fa fa-eye',
            name: 'Preview',
            action: 'preview',
            order: 0,
            class: 'rv-action-preview'
        }],
        file: [{
            icon: 'fa fa-link',
            name: 'Copy link',
            action: 'copy_link',
            order: 0,
            class: 'rv-action-copy-link'
        }, {
            icon: 'fa fa-pencil',
            name: 'Rename',
            action: 'rename',
            order: 1,
            class: 'rv-action-rename'
        }, {
            icon: 'fa fa-copy',
            name: 'Make a copy',
            action: 'make_copy',
            order: 2,
            class: 'rv-action-make-copy'
        }],
        user: [{
            icon: 'fa fa-star',
            name: 'Favorite',
            action: 'favorite',
            order: 2,
            class: 'rv-action-favorite'
        }, {
            icon: 'fa fa-star-o',
            name: 'Remove favorite',
            action: 'remove_favorite',
            order: 3,
            class: 'rv-action-favorite'
        }],
        other: [{
            icon: 'fa fa-download',
            name: 'Download',
            action: 'download',
            order: 0,
            class: 'rv-action-download'
        }, {
            icon: 'fa fa-trash',
            name: 'Move to trash',
            action: 'trash',
            order: 1,
            class: 'rv-action-trash'
        }, {
            icon: 'fa fa-eraser',
            name: 'Delete permanently',
            action: 'delete',
            order: 2,
            class: 'rv-action-delete'
        }, {
            icon: 'fa fa-undo',
            name: 'Restore',
            action: 'restore',
            order: 3,
            class: 'rv-action-restore'
        }]
    },
    denied_download: ['youtube']
};

if (!MediaConfig.app_key || MediaConfig.app_key !== defaultConfig.app_key) {
    MediaConfig = defaultConfig;
}

var RecentItems = $.parseJSON(localStorage.getItem('RecentItems')) || [];



/***/ }),

/***/ 19:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(5);


/***/ }),

/***/ 5:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "EditorService", function() { return EditorService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__App_Config_MediaConfig__ = __webpack_require__(1);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var EditorService = function () {
    function EditorService() {
        _classCallCheck(this, EditorService);
    }

    _createClass(EditorService, null, [{
        key: 'editorSelectFile',
        value: function editorSelectFile(selectedFiles) {

            var is_ckeditor = __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].getUrlParam('CKEditor') || __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].getUrlParam('CKEditorFuncNum');

            if (window.opener && is_ckeditor) {
                var firstItem = _.first(selectedFiles);

                window.opener.CKEDITOR.tools.callFunction(__WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].getUrlParam('CKEditorFuncNum'), firstItem.url);

                if (window.opener) {
                    window.close();
                }
            } else {
                // No WYSIWYG editor found, use custom method.
            }
        }
    }]);

    return EditorService;
}();

var rvMedia = function rvMedia(selector, options) {
    _classCallCheck(this, rvMedia);

    window.rvMedia = window.rvMedia || {};

    var $body = $('body');

    var defaultOptions = {
        multiple: true,
        type: '*',
        onSelectFiles: function onSelectFiles(files, $el) {}
    };

    options = $.extend(true, defaultOptions, options);

    var clickCallback = function clickCallback(event) {
        event.preventDefault();
        var $current = $(this);
        $('#rv_media_modal').modal();

        window.rvMedia.options = options;
        window.rvMedia.options.open_in = 'modal';

        window.rvMedia.$el = $current;

        __WEBPACK_IMPORTED_MODULE_1__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.filter = 'everything';
        __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();

        var ele_options = window.rvMedia.$el.data('rv-media');
        if (typeof ele_options !== 'undefined' && ele_options.length > 0) {
            ele_options = ele_options[0];
            window.rvMedia.options = $.extend(true, window.rvMedia.options, ele_options || {});
            if (typeof ele_options.selected_file_id !== 'undefined') {
                window.rvMedia.options.is_popup = true;
            } else if (typeof window.rvMedia.options.is_popup !== 'undefined') {
                window.rvMedia.options.is_popup = undefined;
            }
        }

        if ($('#rv_media_body .rv-media-container').length === 0) {
            $('#rv_media_body').load(RV_MEDIA_URL.popup, function (data) {
                if (data.error) {
                    alert(data.message);
                }
                $('#rv_media_body').removeClass('media-modal-loading').closest('.modal-content').removeClass('bb-loading');
            });
        } else {
            $(document).find('.rv-media-container .js-change-action[data-type=refresh]').trigger('click');
        }
    };

    if (typeof selector === 'string') {
        $body.on('click', selector, clickCallback);
    } else {
        selector.on('click', clickCallback);
    }
};

window.RvMediaStandAlone = rvMedia;

$('.js-insert-to-editor').off('click').on('click', function (event) {
    event.preventDefault();
    var selectedFiles = __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();
    if (_.size(selectedFiles) > 0) {
        EditorService.editorSelectFile(selectedFiles);
    }
});

$.fn.rvMedia = function (options) {
    var $selector = $(this);

    __WEBPACK_IMPORTED_MODULE_1__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.filter = 'everything';
    if (__WEBPACK_IMPORTED_MODULE_1__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.view_in === 'trash') {
        $(document).find('.js-insert-to-editor').prop('disabled', true);
    } else {
        $(document).find('.js-insert-to-editor').prop('disabled', false);
    }
    __WEBPACK_IMPORTED_MODULE_0__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();

    new rvMedia($selector, options);
};

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAgZmI1ZWM2YmY5ZmU4MjQxOTUwNmIiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvSGVscGVycy9IZWxwZXJzLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0NvbmZpZy9NZWRpYUNvbmZpZy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2ludGVncmF0ZS5qcyJdLCJuYW1lcyI6WyJIZWxwZXJzIiwicGFyYW1OYW1lIiwidXJsIiwid2luZG93IiwibG9jYXRpb24iLCJzZWFyY2giLCJyZVBhcmFtIiwiUmVnRXhwIiwibWF0Y2giLCJsZW5ndGgiLCJzdWJzdHJpbmciLCJiYXNlVXJsIiwiUlZfTUVESUFfVVJMIiwiYmFzZV91cmwiLCJzdWJzdHIiLCIkZWxlbWVudCIsIiQiLCJhZGRDbGFzcyIsImFwcGVuZCIsImh0bWwiLCJyZW1vdmVDbGFzcyIsImZpbmQiLCJyZW1vdmUiLCJoYXNDbGFzcyIsIm9iamVjdCIsIkpTT04iLCJzdHJpbmdpZnkiLCJqc29uU3RyaW5nIiwiZGVmYXVsdFZhbHVlIiwicmVzdWx0IiwicGFyc2VKU09OIiwiZXJyIiwicnZNZWRpYSIsIm9wdGlvbnMiLCJvcGVuX2luIiwiZXh0ZW5kIiwiTWVkaWFDb25maWciLCJyZXF1ZXN0X3BhcmFtcyIsIiRmaWxlX2lkIiwic2VsZWN0ZWRfZmlsZV9pZCIsImxvY2FsU3RvcmFnZSIsInNldEl0ZW0iLCJqc29uRW5jb2RlIiwiaWQiLCJBcnJheSIsIl8iLCJlYWNoIiwidmFsdWUiLCJSZWNlbnRJdGVtcyIsInB1c2giLCJpdGVtcyIsIiRib3giLCJkYXRhIiwiaW5kZXhfa2V5IiwiaW5kZXgiLCJzZWxlY3RlZCIsImNsb3Nlc3QiLCJnZXRVcmxQYXJhbSIsIlJWX01FRElBX0NPTkZJRyIsInBhZ2luYXRpb24iLCJwYWdlZCIsInBvc3RzX3Blcl9wYWdlIiwiaW5fcHJvY2Vzc19nZXRfbWVkaWEiLCJoYXNfbW9yZSIsImdldEl0ZW0iLCJkZWZhdWx0Q29uZmlnIiwiYXBwX2tleSIsInZpZXdfdHlwZSIsImZpbHRlciIsInZpZXdfaW4iLCJzb3J0X2J5IiwiZm9sZGVyX2lkIiwiaGlkZV9kZXRhaWxzX3BhbmUiLCJpY29ucyIsImZvbGRlciIsImFjdGlvbnNfbGlzdCIsImJhc2ljIiwiaWNvbiIsIm5hbWUiLCJhY3Rpb24iLCJvcmRlciIsImNsYXNzIiwiZmlsZSIsInVzZXIiLCJvdGhlciIsImRlbmllZF9kb3dubG9hZCIsIkVkaXRvclNlcnZpY2UiLCJzZWxlY3RlZEZpbGVzIiwiaXNfY2tlZGl0b3IiLCJvcGVuZXIiLCJmaXJzdEl0ZW0iLCJmaXJzdCIsIkNLRURJVE9SIiwidG9vbHMiLCJjYWxsRnVuY3Rpb24iLCJjbG9zZSIsInNlbGVjdG9yIiwiJGJvZHkiLCJkZWZhdWx0T3B0aW9ucyIsIm11bHRpcGxlIiwidHlwZSIsIm9uU2VsZWN0RmlsZXMiLCJmaWxlcyIsIiRlbCIsImNsaWNrQ2FsbGJhY2siLCJldmVudCIsInByZXZlbnREZWZhdWx0IiwiJGN1cnJlbnQiLCJtb2RhbCIsInN0b3JlQ29uZmlnIiwiZWxlX29wdGlvbnMiLCJpc19wb3B1cCIsInVuZGVmaW5lZCIsImxvYWQiLCJwb3B1cCIsImVycm9yIiwiYWxlcnQiLCJtZXNzYWdlIiwiZG9jdW1lbnQiLCJ0cmlnZ2VyIiwib24iLCJSdk1lZGlhU3RhbmRBbG9uZSIsIm9mZiIsImdldFNlbGVjdGVkRmlsZXMiLCJzaXplIiwiZWRpdG9yU2VsZWN0RmlsZSIsImZuIiwiJHNlbGVjdG9yIiwicHJvcCJdLCJtYXBwaW5ncyI6IjtBQUFBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOzs7QUFHQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFD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SUFBQSxxRUFBQUEsQ0FBUTZHLFdBQVI7O0FBRUEsUUFBSTdFLE9BQUosQ0FBWStGLFNBQVosRUFBdUI5RixPQUF2QjtBQUNILENBWkQsQyIsImZpbGUiOiIvanMvaW50ZWdyYXRlLmpzIiwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gVGhlIG1vZHVsZSBjYWNoZVxuIFx0dmFyIGluc3RhbGxlZE1vZHVsZXMgPSB7fTtcblxuIFx0Ly8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbiBcdGZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblxuIFx0XHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcbiBcdFx0aWYoaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0pIHtcbiBcdFx0XHRyZXR1cm4gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0uZXhwb3J0cztcbiBcdFx0fVxuIFx0XHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuIFx0XHR2YXIgbW9kdWxlID0gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0gPSB7XG4gXHRcdFx0aTogbW9kdWxlSWQsXG4gXHRcdFx0bDogZmFsc2UsXG4gXHRcdFx0ZXhwb3J0czoge31cbiBcdFx0fTtcblxuIFx0XHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cbiBcdFx0bW9kdWxlc1ttb2R1bGVJZF0uY2FsbChtb2R1bGUuZXhwb3J0cywgbW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cbiBcdFx0Ly8gRmxhZyB0aGUgbW9kdWxlIGFzIGxvYWRlZFxuIFx0XHRtb2R1bGUubCA9IHRydWU7XG5cbiBcdFx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcbiBcdFx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xuIFx0fVxuXG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBtb2R1bGVzO1xuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZSBjYWNoZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5jID0gaW5zdGFsbGVkTW9kdWxlcztcblxuIFx0Ly8gZGVmaW5lIGdldHRlciBmdW5jdGlvbiBmb3IgaGFybW9ueSBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSBmdW5jdGlvbihleHBvcnRzLCBuYW1lLCBnZXR0ZXIpIHtcbiBcdFx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBuYW1lKSkge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBuYW1lLCB7XG4gXHRcdFx0XHRjb25maWd1cmFibGU6IGZhbHNlLFxuIFx0XHRcdFx0ZW51bWVyYWJsZTogdHJ1ZSxcbiBcdFx0XHRcdGdldDogZ2V0dGVyXG4gXHRcdFx0fSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiXCI7XG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMTkpO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHdlYnBhY2svYm9vdHN0cmFwIGZiNWVjNmJmOWZlODI0MTk1MDZiIiwiaW1wb3J0IHtNZWRpYUNvbmZpZywgUmVjZW50SXRlbXN9IGZyb20gJy4uL0NvbmZpZy9NZWRpYUNvbmZpZyc7XG5cbmV4cG9ydCBjbGFzcyBIZWxwZXJzIHtcbiAgICBzdGF0aWMgZ2V0VXJsUGFyYW0ocGFyYW1OYW1lLCB1cmwgPSBudWxsKSB7XG4gICAgICAgIGlmICghdXJsKSB7XG4gICAgICAgICAgICB1cmwgPSB3aW5kb3cubG9jYXRpb24uc2VhcmNoO1xuICAgICAgICB9XG4gICAgICAgIGxldCByZVBhcmFtID0gbmV3IFJlZ0V4cCgnKD86W1xcPyZdfCYpJyArIHBhcmFtTmFtZSArICc9KFteJl0rKScsICdpJyk7XG4gICAgICAgIGxldCBtYXRjaCA9IHVybC5tYXRjaChyZVBhcmFtKTtcbiAgICAgICAgcmV0dXJuICggbWF0Y2ggJiYgbWF0Y2gubGVuZ3RoID4gMSApID8gbWF0Y2hbMV0gOiBudWxsO1xuICAgIH1cblxuICAgIHN0YXRpYyBhc3NldCh1cmwpIHtcbiAgICAgICAgaWYgKHVybC5zdWJzdHJpbmcoMCwgMikgPT09ICcvLycgfHwgdXJsLnN1YnN0cmluZygwLCA3KSA9PT0gJ2h0dHA6Ly8nIHx8IHVybC5zdWJzdHJpbmcoMCwgOCkgPT09ICdodHRwczovLycpIHtcbiAgICAgICAgICAgIHJldHVybiB1cmw7XG4gICAgICAgIH1cblxuICAgICAgICBsZXQgYmFzZVVybCA9IFJWX01FRElBX1VSTC5iYXNlX3VybC5zdWJzdHIoLTEsIDEpICE9PSAnLycgPyBSVl9NRURJQV9VUkwuYmFzZV91cmwgKyAnLycgOiBSVl9NRURJQV9VUkwuYmFzZV91cmw7XG5cbiAgICAgICAgaWYgKHVybC5zdWJzdHJpbmcoMCwgMSkgPT09ICcvJykge1xuICAgICAgICAgICAgcmV0dXJuIGJhc2VVcmwgKyB1cmwuc3Vic3RyaW5nKDEpO1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBiYXNlVXJsICsgdXJsO1xuICAgIH1cblxuICAgIHN0YXRpYyBzaG93QWpheExvYWRpbmcoJGVsZW1lbnQgPSAkKCcucnYtbWVkaWEtbWFpbicpKSB7XG4gICAgICAgICRlbGVtZW50XG4gICAgICAgICAgICAuYWRkQ2xhc3MoJ29uLWxvYWRpbmcnKVxuICAgICAgICAgICAgLmFwcGVuZCgkKCcjcnZfbWVkaWFfbG9hZGluZycpLmh0bWwoKSk7XG4gICAgfVxuXG4gICAgc3RhdGljIGhpZGVBamF4TG9hZGluZygkZWxlbWVudCA9ICQoJy5ydi1tZWRpYS1tYWluJykpIHtcbiAgICAgICAgJGVsZW1lbnRcbiAgICAgICAgICAgIC5yZW1vdmVDbGFzcygnb24tbG9hZGluZycpXG4gICAgICAgICAgICAuZmluZCgnLmxvYWRpbmctd3JhcHBlcicpLnJlbW92ZSgpO1xuICAgIH1cblxuICAgIHN0YXRpYyBpc09uQWpheExvYWRpbmcoJGVsZW1lbnQgPSAkKCcucnYtbWVkaWEtaXRlbXMnKSkge1xuICAgICAgICByZXR1cm4gJGVsZW1lbnQuaGFzQ2xhc3MoJ29uLWxvYWRpbmcnKTtcbiAgICB9XG5cbiAgICBzdGF0aWMganNvbkVuY29kZShvYmplY3QpIHtcbiAgICAgICAgXCJ1c2Ugc3RyaWN0XCI7XG4gICAgICAgIGlmICh0eXBlb2Ygb2JqZWN0ID09PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgb2JqZWN0ID0gbnVsbDtcbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gSlNPTi5zdHJpbmdpZnkob2JqZWN0KTtcbiAgICB9O1xuXG4gICAgc3RhdGljIGpzb25EZWNvZGUoanNvblN0cmluZywgZGVmYXVsdFZhbHVlKSB7XG4gICAgICAgIFwidXNlIHN0cmljdFwiO1xuICAgICAgICBpZiAoIWpzb25TdHJpbmcpIHtcbiAgICAgICAgICAgIHJldHVybiBkZWZhdWx0VmFsdWU7XG4gICAgICAgIH1cbiAgICAgICAgaWYgKHR5cGVvZiBqc29uU3RyaW5nID09PSAnc3RyaW5nJykge1xuICAgICAgICAgICAgbGV0IHJlc3VsdDtcbiAgICAgICAgICAgIHRyeSB7XG4gICAgICAgICAgICAgICAgcmVzdWx0ID0gJC5wYXJzZUpTT04oanNvblN0cmluZyk7XG4gICAgICAgICAgICB9IGNhdGNoIChlcnIpIHtcbiAgICAgICAgICAgICAgICByZXN1bHQgPSBkZWZhdWx0VmFsdWU7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICByZXR1cm4gcmVzdWx0O1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBqc29uU3RyaW5nO1xuICAgIH07XG5cbiAgICBzdGF0aWMgZ2V0UmVxdWVzdFBhcmFtcygpIHtcbiAgICAgICAgaWYgKHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMgJiYgd2luZG93LnJ2TWVkaWEub3B0aW9ucy5vcGVuX2luID09PSAnbW9kYWwnKSB7XG4gICAgICAgICAgICByZXR1cm4gJC5leHRlbmQodHJ1ZSwgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMsIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMgfHwge30pO1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcztcbiAgICB9XG5cbiAgICBzdGF0aWMgc2V0U2VsZWN0ZWRGaWxlKCRmaWxlX2lkKSB7XG4gICAgICAgIGlmICh0eXBlb2Ygd2luZG93LnJ2TWVkaWEub3B0aW9ucyAhPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuc2VsZWN0ZWRfZmlsZV9pZCA9ICRmaWxlX2lkO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMuc2VsZWN0ZWRfZmlsZV9pZCA9ICRmaWxlX2lkO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc3RhdGljIGdldENvbmZpZ3MoKSB7XG4gICAgICAgIHJldHVybiBNZWRpYUNvbmZpZztcbiAgICB9XG5cbiAgICBzdGF0aWMgc3RvcmVDb25maWcoKSB7XG4gICAgICAgIGxvY2FsU3RvcmFnZS5zZXRJdGVtKCdNZWRpYUNvbmZpZycsIEhlbHBlcnMuanNvbkVuY29kZShNZWRpYUNvbmZpZykpO1xuICAgIH1cblxuICAgIHN0YXRpYyBzdG9yZVJlY2VudEl0ZW1zKCkge1xuICAgICAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbSgnUmVjZW50SXRlbXMnLCBIZWxwZXJzLmpzb25FbmNvZGUoUmVjZW50SXRlbXMpKTtcbiAgICB9XG5cbiAgICBzdGF0aWMgYWRkVG9SZWNlbnQoaWQpIHtcbiAgICAgICAgaWYgKGlkIGluc3RhbmNlb2YgQXJyYXkpIHtcbiAgICAgICAgICAgIF8uZWFjaChpZCwgZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgICAgICAgICAgICAgUmVjZW50SXRlbXMucHVzaCh2YWx1ZSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIFJlY2VudEl0ZW1zLnB1c2goaWQpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc3RhdGljIGdldEl0ZW1zKCkge1xuICAgICAgICBsZXQgaXRlbXMgPSBbXTtcbiAgICAgICAgJCgnLmpzLW1lZGlhLWxpc3QtdGl0bGUnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGxldCAkYm94ID0gJCh0aGlzKTtcbiAgICAgICAgICAgIGxldCBkYXRhID0gJGJveC5kYXRhKCkgfHwge307XG4gICAgICAgICAgICBkYXRhLmluZGV4X2tleSA9ICRib3guaW5kZXgoKTtcbiAgICAgICAgICAgIGl0ZW1zLnB1c2goZGF0YSk7XG4gICAgICAgIH0pO1xuICAgICAgICByZXR1cm4gaXRlbXM7XG4gICAgfVxuXG4gICAgc3RhdGljIGdldFNlbGVjdGVkSXRlbXMoKSB7XG4gICAgICAgIGxldCBzZWxlY3RlZCA9IFtdO1xuICAgICAgICAkKCcuanMtbWVkaWEtbGlzdC10aXRsZSBpbnB1dFt0eXBlPWNoZWNrYm94XTpjaGVja2VkJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBsZXQgJGJveCA9ICQodGhpcykuY2xvc2VzdCgnLmpzLW1lZGlhLWxpc3QtdGl0bGUnKTtcbiAgICAgICAgICAgIGxldCBkYXRhID0gJGJveC5kYXRhKCkgfHwge307XG4gICAgICAgICAgICBkYXRhLmluZGV4X2tleSA9ICRib3guaW5kZXgoKTtcbiAgICAgICAgICAgIHNlbGVjdGVkLnB1c2goZGF0YSk7XG4gICAgICAgIH0pO1xuICAgICAgICByZXR1cm4gc2VsZWN0ZWQ7XG4gICAgfVxuXG4gICAgc3RhdGljIGdldFNlbGVjdGVkRmlsZXMoKSB7XG4gICAgICAgIGxldCBzZWxlY3RlZCA9IFtdO1xuICAgICAgICAkKCcuanMtbWVkaWEtbGlzdC10aXRsZVtkYXRhLWNvbnRleHQ9ZmlsZV0gaW5wdXRbdHlwZT1jaGVja2JveF06Y2hlY2tlZCcpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgbGV0ICRib3ggPSAkKHRoaXMpLmNsb3Nlc3QoJy5qcy1tZWRpYS1saXN0LXRpdGxlJyk7XG4gICAgICAgICAgICBsZXQgZGF0YSA9ICRib3guZGF0YSgpIHx8IHt9O1xuICAgICAgICAgICAgZGF0YS5pbmRleF9rZXkgPSAkYm94LmluZGV4KCk7XG4gICAgICAgICAgICBzZWxlY3RlZC5wdXNoKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICAgICAgcmV0dXJuIHNlbGVjdGVkO1xuICAgIH1cblxuICAgIHN0YXRpYyBnZXRTZWxlY3RlZEZvbGRlcigpIHtcbiAgICAgICAgbGV0IHNlbGVjdGVkID0gW107XG4gICAgICAgICQoJy5qcy1tZWRpYS1saXN0LXRpdGxlW2RhdGEtY29udGV4dD1mb2xkZXJdIGlucHV0W3R5cGU9Y2hlY2tib3hdOmNoZWNrZWQnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGxldCAkYm94ID0gJCh0aGlzKS5jbG9zZXN0KCcuanMtbWVkaWEtbGlzdC10aXRsZScpO1xuICAgICAgICAgICAgbGV0IGRhdGEgPSAkYm94LmRhdGEoKSB8fCB7fTtcbiAgICAgICAgICAgIGRhdGEuaW5kZXhfa2V5ID0gJGJveC5pbmRleCgpO1xuICAgICAgICAgICAgc2VsZWN0ZWQucHVzaChkYXRhKTtcbiAgICAgICAgfSk7XG4gICAgICAgIHJldHVybiBzZWxlY3RlZDtcbiAgICB9XG5cbiAgICBzdGF0aWMgaXNVc2VJbk1vZGFsKCkge1xuICAgICAgICByZXR1cm4gSGVscGVycy5nZXRVcmxQYXJhbSgnbWVkaWEtYWN0aW9uJykgPT09ICdzZWxlY3QtZmlsZXMnIHx8ICh3aW5kb3cucnZNZWRpYSAmJiB3aW5kb3cucnZNZWRpYS5vcHRpb25zICYmIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub3Blbl9pbiA9PT0gJ21vZGFsJyk7XG4gICAgfVxuXG4gICAgc3RhdGljIHJlc2V0UGFnaW5hdGlvbigpIHtcbiAgICAgICAgUlZfTUVESUFfQ09ORklHLnBhZ2luYXRpb24gPSB7IHBhZ2VkOiAxLCBwb3N0c19wZXJfcGFnZTogNDAsIGluX3Byb2Nlc3NfZ2V0X21lZGlhOiBmYWxzZSwgaGFzX21vcmU6IHRydWV9O1xuICAgIH1cbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0hlbHBlcnMvSGVscGVycy5qcyIsImxldCBNZWRpYUNvbmZpZyA9ICQucGFyc2VKU09OKGxvY2FsU3RvcmFnZS5nZXRJdGVtKCdNZWRpYUNvbmZpZycpKSB8fCB7fTtcblxubGV0IGRlZmF1bHRDb25maWcgPSB7XG4gICAgYXBwX2tleTogJzQ4M2EweHl6eXR6MTI0MmMwZDUyMDQyNmU4YmEzNjZjNTMwYzNkOWRhYmMnLFxuICAgIHJlcXVlc3RfcGFyYW1zOiB7XG4gICAgICAgIHZpZXdfdHlwZTogJ3RpbGVzJyxcbiAgICAgICAgZmlsdGVyOiAnZXZlcnl0aGluZycsXG4gICAgICAgIHZpZXdfaW46ICdhbGxfbWVkaWEnLFxuICAgICAgICBzZWFyY2g6ICcnLFxuICAgICAgICBzb3J0X2J5OiAnY3JlYXRlZF9hdC1kZXNjJyxcbiAgICAgICAgZm9sZGVyX2lkOiAwLFxuICAgIH0sXG4gICAgaGlkZV9kZXRhaWxzX3BhbmU6IGZhbHNlLFxuICAgIGljb25zOiB7XG4gICAgICAgIGZvbGRlcjogJ2ZhIGZhLWZvbGRlci1vJyxcbiAgICB9LFxuICAgIGFjdGlvbnNfbGlzdDoge1xuICAgICAgICBiYXNpYzogW1xuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS1leWUnLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdQcmV2aWV3JyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdwcmV2aWV3JyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMCxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1wcmV2aWV3JyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIF0sXG4gICAgICAgIGZpbGU6IFtcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtbGluaycsXG4gICAgICAgICAgICAgICAgbmFtZTogJ0NvcHkgbGluaycsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAnY29weV9saW5rJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMCxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1jb3B5LWxpbmsnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtcGVuY2lsJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnUmVuYW1lJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdyZW5hbWUnLFxuICAgICAgICAgICAgICAgIG9yZGVyOiAxLFxuICAgICAgICAgICAgICAgIGNsYXNzOiAncnYtYWN0aW9uLXJlbmFtZScsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS1jb3B5JyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnTWFrZSBhIGNvcHknLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogJ21ha2VfY29weScsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDIsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tbWFrZS1jb3B5JyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIF0sXG4gICAgICAgIHVzZXI6IFtcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtc3RhcicsXG4gICAgICAgICAgICAgICAgbmFtZTogJ0Zhdm9yaXRlJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdmYXZvcml0ZScsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDIsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tZmF2b3JpdGUnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtc3Rhci1vJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnUmVtb3ZlIGZhdm9yaXRlJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdyZW1vdmVfZmF2b3JpdGUnLFxuICAgICAgICAgICAgICAgIG9yZGVyOiAzLFxuICAgICAgICAgICAgICAgIGNsYXNzOiAncnYtYWN0aW9uLWZhdm9yaXRlJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIF0sXG4gICAgICAgIG90aGVyOiBbXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLWRvd25sb2FkJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnRG93bmxvYWQnLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogJ2Rvd25sb2FkJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMCxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1kb3dubG9hZCcsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS10cmFzaCcsXG4gICAgICAgICAgICAgICAgbmFtZTogJ01vdmUgdG8gdHJhc2gnLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogJ3RyYXNoJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMSxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi10cmFzaCcsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS1lcmFzZXInLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdEZWxldGUgcGVybWFuZW50bHknLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogJ2RlbGV0ZScsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDIsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tZGVsZXRlJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLXVuZG8nLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdSZXN0b3JlJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdyZXN0b3JlJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMyxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1yZXN0b3JlJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIF0sXG4gICAgfSxcbiAgICBkZW5pZWRfZG93bmxvYWQ6IFtcbiAgICAgICAgJ3lvdXR1YmUnLFxuICAgIF0sXG59O1xuXG5pZiAoIU1lZGlhQ29uZmlnLmFwcF9rZXkgfHwgTWVkaWFDb25maWcuYXBwX2tleSAhPT0gZGVmYXVsdENvbmZpZy5hcHBfa2V5KSB7XG4gICAgTWVkaWFDb25maWcgPSBkZWZhdWx0Q29uZmlnO1xufVxuXG5sZXQgUmVjZW50SXRlbXMgPSAkLnBhcnNlSlNPTihsb2NhbFN0b3JhZ2UuZ2V0SXRlbSgnUmVjZW50SXRlbXMnKSkgfHwgW107XG5cbmV4cG9ydCB7TWVkaWFDb25maWcsIFJlY2VudEl0ZW1zfTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0NvbmZpZy9NZWRpYUNvbmZpZy5qcyIsImltcG9ydCB7SGVscGVyc30gZnJvbSAnLi9BcHAvSGVscGVycy9IZWxwZXJzJztcbmltcG9ydCB7TWVkaWFDb25maWd9IGZyb20gJy4vQXBwL0NvbmZpZy9NZWRpYUNvbmZpZyc7XG5cbmV4cG9ydCBjbGFzcyBFZGl0b3JTZXJ2aWNlIHtcbiAgICBzdGF0aWMgZWRpdG9yU2VsZWN0RmlsZShzZWxlY3RlZEZpbGVzKSB7XG5cbiAgICAgICAgbGV0IGlzX2NrZWRpdG9yID0gSGVscGVycy5nZXRVcmxQYXJhbSgnQ0tFZGl0b3InKSB8fCBIZWxwZXJzLmdldFVybFBhcmFtKCdDS0VkaXRvckZ1bmNOdW0nKTtcblxuICAgICAgICBpZiAod2luZG93Lm9wZW5lciAmJiBpc19ja2VkaXRvcikge1xuICAgICAgICAgICAgbGV0IGZpcnN0SXRlbSA9IF8uZmlyc3Qoc2VsZWN0ZWRGaWxlcyk7XG5cbiAgICAgICAgICAgIHdpbmRvdy5vcGVuZXIuQ0tFRElUT1IudG9vbHMuY2FsbEZ1bmN0aW9uKEhlbHBlcnMuZ2V0VXJsUGFyYW0oJ0NLRWRpdG9yRnVuY051bScpLCBmaXJzdEl0ZW0udXJsKTtcblxuICAgICAgICAgICAgaWYgKHdpbmRvdy5vcGVuZXIpIHtcbiAgICAgICAgICAgICAgICB3aW5kb3cuY2xvc2UoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIC8vIE5vIFdZU0lXWUcgZWRpdG9yIGZvdW5kLCB1c2UgY3VzdG9tIG1ldGhvZC5cbiAgICAgICAgfVxuICAgIH1cbn1cblxuY2xhc3MgcnZNZWRpYSB7XG4gICAgY29uc3RydWN0b3Ioc2VsZWN0b3IsIG9wdGlvbnMpIHtcbiAgICAgICAgd2luZG93LnJ2TWVkaWEgPSB3aW5kb3cucnZNZWRpYSB8fCB7fTtcblxuICAgICAgICBsZXQgJGJvZHkgPSAkKCdib2R5Jyk7XG5cbiAgICAgICAgbGV0IGRlZmF1bHRPcHRpb25zID0ge1xuICAgICAgICAgICAgbXVsdGlwbGU6IHRydWUsXG4gICAgICAgICAgICB0eXBlOiAnKicsXG4gICAgICAgICAgICBvblNlbGVjdEZpbGVzOiBmdW5jdGlvbiAoZmlsZXMsICRlbCkge1xuXG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgb3B0aW9ucyA9ICQuZXh0ZW5kKHRydWUsIGRlZmF1bHRPcHRpb25zLCBvcHRpb25zKTtcblxuICAgICAgICBsZXQgY2xpY2tDYWxsYmFjayA9IGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIGxldCAkY3VycmVudCA9ICQodGhpcyk7XG4gICAgICAgICAgICAkKCcjcnZfbWVkaWFfbW9kYWwnKS5tb2RhbCgpO1xuXG4gICAgICAgICAgICB3aW5kb3cucnZNZWRpYS5vcHRpb25zID0gb3B0aW9ucztcbiAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub3Blbl9pbiA9ICdtb2RhbCc7XG5cbiAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLiRlbCA9ICRjdXJyZW50O1xuXG4gICAgICAgICAgICBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy5maWx0ZXIgPSAnZXZlcnl0aGluZyc7XG4gICAgICAgICAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG5cbiAgICAgICAgICAgIGxldCBlbGVfb3B0aW9ucyA9IHdpbmRvdy5ydk1lZGlhLiRlbC5kYXRhKCdydi1tZWRpYScpO1xuICAgICAgICAgICAgaWYgKHR5cGVvZiBlbGVfb3B0aW9ucyAhPT0gJ3VuZGVmaW5lZCcgJiYgZWxlX29wdGlvbnMubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgICAgIGVsZV9vcHRpb25zID0gZWxlX29wdGlvbnNbMF07XG4gICAgICAgICAgICAgICAgd2luZG93LnJ2TWVkaWEub3B0aW9ucyA9ICQuZXh0ZW5kKHRydWUsIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMsIGVsZV9vcHRpb25zIHx8IHt9KTtcbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIGVsZV9vcHRpb25zLnNlbGVjdGVkX2ZpbGVfaWQgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgPSB0cnVlO1xuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAodHlwZW9mIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoJCgnI3J2X21lZGlhX2JvZHkgLnJ2LW1lZGlhLWNvbnRhaW5lcicpLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICAgICAgICAgICQoJyNydl9tZWRpYV9ib2R5JykubG9hZChSVl9NRURJQV9VUkwucG9wdXAsIGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgICAgIGlmIChkYXRhLmVycm9yKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBhbGVydChkYXRhLm1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICQoJyNydl9tZWRpYV9ib2R5JylcbiAgICAgICAgICAgICAgICAgICAgICAgIC5yZW1vdmVDbGFzcygnbWVkaWEtbW9kYWwtbG9hZGluZycpXG4gICAgICAgICAgICAgICAgICAgICAgICAuY2xvc2VzdCgnLm1vZGFsLWNvbnRlbnQnKS5yZW1vdmVDbGFzcygnYmItbG9hZGluZycpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcucnYtbWVkaWEtY29udGFpbmVyIC5qcy1jaGFuZ2UtYWN0aW9uW2RhdGEtdHlwZT1yZWZyZXNoXScpLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgaWYgKHR5cGVvZiBzZWxlY3RvciA9PT0gJ3N0cmluZycpIHtcbiAgICAgICAgICAgICRib2R5Lm9uKCdjbGljaycsIHNlbGVjdG9yLCBjbGlja0NhbGxiYWNrKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHNlbGVjdG9yLm9uKCdjbGljaycsIGNsaWNrQ2FsbGJhY2spO1xuICAgICAgICB9XG4gICAgfVxufVxuXG53aW5kb3cuUnZNZWRpYVN0YW5kQWxvbmUgPSBydk1lZGlhO1xuXG4kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLm9mZignY2xpY2snKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIGxldCBzZWxlY3RlZEZpbGVzID0gSGVscGVycy5nZXRTZWxlY3RlZEZpbGVzKCk7XG4gICAgaWYgKF8uc2l6ZShzZWxlY3RlZEZpbGVzKSA+IDApIHtcbiAgICAgICAgRWRpdG9yU2VydmljZS5lZGl0b3JTZWxlY3RGaWxlKHNlbGVjdGVkRmlsZXMpO1xuICAgIH1cbn0pO1xuXG4kLmZuLnJ2TWVkaWEgPSBmdW5jdGlvbiAob3B0aW9ucykge1xuICAgIGxldCAkc2VsZWN0b3IgPSAkKHRoaXMpO1xuXG4gICAgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMuZmlsdGVyID0gJ2V2ZXJ5dGhpbmcnO1xuICAgIGlmIChNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy52aWV3X2luID09PSAndHJhc2gnKSB7XG4gICAgICAgICQoZG9jdW1lbnQpLmZpbmQoJy5qcy1pbnNlcnQtdG8tZWRpdG9yJykucHJvcCgnZGlzYWJsZWQnLCB0cnVlKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLnByb3AoJ2Rpc2FibGVkJywgZmFsc2UpO1xuICAgIH1cbiAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG5cbiAgICBuZXcgcnZNZWRpYSgkc2VsZWN0b3IsIG9wdGlvbnMpO1xufTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvaW50ZWdyYXRlLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==