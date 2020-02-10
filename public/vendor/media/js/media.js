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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
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
/* 1 */
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
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MessageService; });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var MessageService = function () {
    function MessageService() {
        _classCallCheck(this, MessageService);
    }

    _createClass(MessageService, null, [{
        key: 'showMessage',
        value: function showMessage(type, message, messageHeader) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-bottom-right',
                onclick: null,
                showDuration: 1000,
                hideDuration: 1000,
                timeOut: 10000,
                extendedTimeOut: 1000,
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            };
            toastr[type](message, messageHeader);
        }
    }, {
        key: 'handleError',
        value: function handleError(data) {
            if (typeof data.responseJSON !== 'undefined') {
                if (typeof data.responseJSON.message !== 'undefined') {
                    MessageService.showMessage('error', data.responseJSON.message, RV_MEDIA_CONFIG.translations.message.error_header);
                } else {
                    $.each(data.responseJSON, function (index, el) {
                        $.each(el, function (key, item) {
                            MessageService.showMessage('error', item, RV_MEDIA_CONFIG.translations.message.error_header);
                        });
                    });
                }
            } else {
                MessageService.showMessage('error', data.statusText, RV_MEDIA_CONFIG.translations.message.error_header);
            }
        }
    }]);

    return MessageService;
}();

/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MediaService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Services_ActionsService__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__Services_ContextMenuService__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__Views_MediaList__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__Views_MediaDetails__ = __webpack_require__(10);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }









var MediaService = function () {
    function MediaService() {
        _classCallCheck(this, MediaService);

        this.MediaList = new __WEBPACK_IMPORTED_MODULE_5__Views_MediaList__["a" /* MediaList */]();
        this.MediaDetails = new __WEBPACK_IMPORTED_MODULE_6__Views_MediaDetails__["a" /* MediaDetails */]();
        this.breadcrumbTemplate = $('#rv_media_breadcrumb_item').html();
    }

    _createClass(MediaService, [{
        key: 'getMedia',
        value: function getMedia() {
            var reload = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
            var is_popup = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
            var load_more_file = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

            if (typeof RV_MEDIA_CONFIG.pagination != 'undefined') {
                if (RV_MEDIA_CONFIG.pagination.in_process_get_media) {
                    return;
                } else {
                    RV_MEDIA_CONFIG.pagination.in_process_get_media = true;
                }
            }

            var _self = this;

            _self.getFileDetails({
                icon: 'fa fa-picture-o',
                nothing_selected: ''
            });

            var params = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams();

            if (params.view_in === 'recent') {
                params.recent_items = __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["b" /* RecentItems */];
            }

            if (is_popup === true) {
                params.is_popup = true;
            } else {
                params.is_popup = undefined;
            }

            params.onSelectFiles = undefined;

            if (typeof params.search != 'undefined' && params.search != '' && typeof params.selected_file_id != 'undefined') {
                params.selected_file_id = undefined;
            }

            params.load_more_file = load_more_file;
            if (typeof RV_MEDIA_CONFIG.pagination != 'undefined') {
                params.paged = RV_MEDIA_CONFIG.pagination.paged;
                params.posts_per_page = RV_MEDIA_CONFIG.pagination.posts_per_page;
            }
            $.ajax({
                url: RV_MEDIA_URL.get_media,
                type: 'GET',
                data: params,
                dataType: 'json',
                beforeSend: function beforeSend() {
                    __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].showAjaxLoading();
                },
                success: function success(res) {
                    _self.MediaList.renderData(res.data, reload, load_more_file);
                    _self.fetchQuota();
                    _self.renderBreadcrumbs(res.data.breadcrumbs);
                    MediaService.refreshFilter();
                    __WEBPACK_IMPORTED_MODULE_3__Services_ActionsService__["a" /* ActionsService */].renderActions();

                    if (typeof RV_MEDIA_CONFIG.pagination != 'undefined') {
                        if (typeof RV_MEDIA_CONFIG.pagination.paged != 'undefined') {
                            RV_MEDIA_CONFIG.pagination.paged += 1;
                        }

                        if (typeof RV_MEDIA_CONFIG.pagination.in_process_get_media != 'undefined') {
                            RV_MEDIA_CONFIG.pagination.in_process_get_media = false;
                        }

                        if (typeof RV_MEDIA_CONFIG.pagination.posts_per_page != 'undefined' && res.data.files.length < RV_MEDIA_CONFIG.pagination.posts_per_page && typeof RV_MEDIA_CONFIG.pagination.has_more != 'undefined') {
                            RV_MEDIA_CONFIG.pagination.has_more = false;
                        }
                    }
                },
                complete: function complete(data) {
                    __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].hideAjaxLoading();
                },
                error: function error(data) {
                    __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].handleError(data);
                }
            });
        }
    }, {
        key: 'getFileDetails',
        value: function getFileDetails(data) {
            this.MediaDetails.renderData(data);
        }
    }, {
        key: 'fetchQuota',
        value: function fetchQuota() {
            $.ajax({
                url: RV_MEDIA_URL.get_quota,
                type: 'GET',
                dataType: 'json',
                beforeSend: function beforeSend() {},
                success: function success(res) {
                    var data = res.data;

                    $('.rv-media-aside-bottom .used-analytics span').html(data.used + ' / ' + data.quota);
                    $('.rv-media-aside-bottom .progress-bar').css({
                        width: data.percent + '%'
                    });
                },
                error: function error(data) {
                    __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].handleError(data);
                }
            });
        }
    }, {
        key: 'renderBreadcrumbs',
        value: function renderBreadcrumbs(breadcrumbItems) {
            var _self = this;
            var $breadcrumbContainer = $('.rv-media-breadcrumb .breadcrumb');
            $breadcrumbContainer.find('li').remove();

            _.each(breadcrumbItems, function (value, index) {
                var template = _self.breadcrumbTemplate;
                template = template.replace(/__name__/gi, value.name || '').replace(/__icon__/gi, value.icon ? '<i class="' + value.icon + '"></i>' : '').replace(/__folderId__/gi, value.id || 0);
                $breadcrumbContainer.append($(template));
            });
            $('.rv-media-container').attr('data-breadcrumb-count', _.size(breadcrumbItems));
        }
    }], [{
        key: 'refreshFilter',
        value: function refreshFilter() {
            var $rvMediaContainer = $('.rv-media-container');
            var view_in = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in;
            if (view_in !== 'all_media' && __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().folder_id == 0) {
                $('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').addClass('disabled');
                $rvMediaContainer.attr('data-allow-upload', 'false');
            } else {
                $('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').removeClass('disabled');
                $rvMediaContainer.attr('data-allow-upload', 'true');
            }

            $('.rv-media-actions .btn.js-rv-media-change-filter-group').removeClass('disabled');

            var $empty_trash_btn = $('.rv-media-actions .btn[data-action="empty_trash"]');
            if (view_in === 'trash') {
                $empty_trash_btn.removeClass('hidden').removeClass('disabled');
                if (!_.size(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getItems())) {
                    $empty_trash_btn.addClass('hidden').addClass('disabled');
                }
            } else {
                $empty_trash_btn.addClass('hidden');
            }

            __WEBPACK_IMPORTED_MODULE_4__Services_ContextMenuService__["a" /* ContextMenuService */].destroyContext();
            __WEBPACK_IMPORTED_MODULE_4__Services_ContextMenuService__["a" /* ContextMenuService */].initContext();

            $rvMediaContainer.attr('data-view-in', view_in);
        }
    }]);

    return MediaService;
}();

/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ActionsService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__ = __webpack_require__(2);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





var ActionsService = function () {
    function ActionsService() {
        _classCallCheck(this, ActionsService);
    }

    _createClass(ActionsService, null, [{
        key: 'handleDropdown',
        value: function handleDropdown() {
            var selected = _.size(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedItems());

            ActionsService.renderActions();

            if (selected > 0) {
                $('.rv-dropdown-actions').removeClass('disabled');
            } else {
                $('.rv-dropdown-actions').addClass('disabled');
            }
        }
    }, {
        key: 'handlePreview',
        value: function handlePreview() {
            var selected = [];

            _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFiles(), function (value, index) {
                if (_.includes(['image', 'youtube', 'pdf', 'text', 'video'], value.type)) {
                    selected.push({
                        src: value.url
                    });
                    __WEBPACK_IMPORTED_MODULE_0__Config_MediaConfig__["b" /* RecentItems */].push(value.id);
                }
            });

            if (_.size(selected) > 0) {
                $.fancybox.open(selected);
                __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].storeRecentItems();
            } else {
                this.handleGlobalAction('download');
            }
        }
    }, {
        key: 'handleCopyLink',
        value: function handleCopyLink() {
            var links = '';
            _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFiles(), function (value, index) {
                if (!_.isEmpty(links)) {
                    links += '\n';
                }
                links += value.full_url;
            });
            var $clipboardTemp = $('.js-rv-clipboard-temp');
            $clipboardTemp.data('clipboard-text', links);
            new Clipboard('.js-rv-clipboard-temp', {
                text: function text(trigger) {
                    return links;
                }
            });
            __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].showMessage('success', RV_MEDIA_CONFIG.translations.clipboard.success, RV_MEDIA_CONFIG.translations.message.success_header);
            $clipboardTemp.trigger('click');
        }
    }, {
        key: 'handleGlobalAction',
        value: function handleGlobalAction(type, callback) {
            var selected = [];
            _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedItems(), function (value, index) {
                selected.push({
                    is_folder: value.is_folder,
                    id: value.id,
                    full_url: value.full_url
                });
            });

            switch (type) {
                case 'rename':
                    $('#modal_rename_items').modal('show').find('form.rv-form').data('action', type);
                    break;
                case 'copy_link':
                    ActionsService.handleCopyLink();
                    break;
                case 'preview':
                    ActionsService.handlePreview();
                    break;
                case 'trash':
                    $('#modal_trash_items').modal('show').find('form.rv-form').data('action', type);
                    break;
                case 'delete':
                    $('#modal_delete_items').modal('show').find('form.rv-form').data('action', type);
                    break;
                case 'empty_trash':
                    $('#modal_empty_trash').modal('show').find('form.rv-form').data('action', type);
                    break;
                case 'download':
                    var downloadLink = RV_MEDIA_URL.download;
                    var count = 0;
                    _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedItems(), function (value, index) {
                        if (!_.includes(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getConfigs().denied_download, value.mime_type)) {
                            downloadLink += (count === 0 ? '?' : '&') + 'selected[' + count + '][is_folder]=' + value.is_folder + '&selected[' + count + '][id]=' + value.id;
                            count++;
                        }
                    });
                    if (downloadLink !== RV_MEDIA_URL.download) {
                        window.open(downloadLink, '_blank');
                    } else {
                        __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].showMessage('error', RV_MEDIA_CONFIG.translations.download.error, RV_MEDIA_CONFIG.translations.message.error_header);
                    }
                    break;
                default:
                    ActionsService.processAction({
                        selected: selected,
                        action: type
                    }, callback);
                    break;
            }
        }
    }, {
        key: 'processAction',
        value: function processAction(data) {
            var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

            $.ajax({
                url: RV_MEDIA_URL.global_actions,
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function beforeSend() {
                    __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].showAjaxLoading();
                },
                success: function success(res) {
                    __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].resetPagination();
                    if (!res.error) {
                        __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].showMessage('success', res.message, RV_MEDIA_CONFIG.translations.message.success_header);
                    } else {
                        __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].showMessage('error', res.message, RV_MEDIA_CONFIG.translations.message.error_header);
                    }
                    if (callback) {
                        callback(res);
                    }
                },
                complete: function complete(data) {
                    __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].hideAjaxLoading();
                },
                error: function error(data) {
                    __WEBPACK_IMPORTED_MODULE_2__Services_MessageService__["a" /* MessageService */].handleError(data);
                }
            });
        }
    }, {
        key: 'renderRenameItems',
        value: function renderRenameItems() {
            var VIEW = $('#rv_media_rename_item').html();
            var $itemsWrapper = $('#modal_rename_items .rename-items').empty();

            _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedItems(), function (value, index) {
                var item = VIEW.replace(/__icon__/gi, value.icon || 'fa fa-file-o').replace(/__placeholder__/gi, 'Input file name').replace(/__value__/gi, value.name);
                var $item = $(item);
                $item.data('id', value.id);
                $item.data('is_folder', value.is_folder);
                $item.data('name', value.name);
                $itemsWrapper.append($item);
            });
        }
    }, {
        key: 'renderActions',
        value: function renderActions() {
            var hasFolderSelected = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFolder().length > 0;

            var ACTION_TEMPLATE = $('#rv_action_item').html();
            var initialized_item = 0;
            var $dropdownActions = $('.rv-dropdown-actions .dropdown-menu');
            $dropdownActions.empty();

            var actionsList = $.extend({}, true, __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getConfigs().actions_list);

            if (hasFolderSelected) {
                actionsList.basic = _.reject(actionsList.basic, function (item) {
                    return item.action === 'preview';
                });
                actionsList.file = _.reject(actionsList.file, function (item) {
                    return item.action === 'copy_link';
                });

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.create')) {
                    actionsList.file = _.reject(actionsList.file, function (item) {
                        return item.action === 'make_copy';
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.edit')) {
                    actionsList.file = _.reject(actionsList.file, function (item) {
                        return _.includes(['rename'], item.action);
                    });

                    actionsList.user = _.reject(actionsList.user, function (item) {
                        return _.includes(['rename'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.trash')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['trash', 'restore'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.delete')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['delete'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.favorite')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['favorite', 'remove_favorite'], item.action);
                    });
                }
            }

            var selectedFiles = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();

            var can_preview = false;
            _.each(selectedFiles, function (value) {
                if (_.includes(['image', 'youtube', 'pdf', 'text', 'video'], value.type)) {
                    can_preview = true;
                }
            });

            if (!can_preview) {
                actionsList.basic = _.reject(actionsList.basic, function (item) {
                    return item.action === 'preview';
                });
            }

            if (selectedFiles.length > 0) {
                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.create')) {
                    actionsList.file = _.reject(actionsList.file, function (item) {
                        return item.action === 'make_copy';
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.edit')) {
                    actionsList.file = _.reject(actionsList.file, function (item) {
                        return _.includes(['rename'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.trash')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['trash', 'restore'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.delete')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['delete'], item.action);
                    });
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.favorite')) {
                    actionsList.other = _.reject(actionsList.other, function (item) {
                        return _.includes(['favorite', 'remove_favorite'], item.action);
                    });
                }
            }

            _.each(actionsList, function (action, key) {
                _.each(action, function (item, index) {
                    var is_break = false;
                    switch (__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in) {
                        case 'all_media':
                            if (_.includes(['remove_favorite', 'delete', 'restore'], item.action)) {
                                is_break = true;
                            }
                            break;
                        case 'recent':
                            if (_.includes(['remove_favorite', 'delete', 'restore', 'make_copy'], item.action)) {
                                is_break = true;
                            }
                            break;
                        case 'favorites':
                            if (_.includes(['favorite', 'delete', 'restore', 'make_copy'], item.action)) {
                                is_break = true;
                            }
                            break;
                        case 'trash':
                            if (!_.includes(['preview', 'delete', 'restore', 'rename', 'download'], item.action)) {
                                is_break = true;
                            }
                            break;
                    }
                    if (!is_break) {
                        var template = ACTION_TEMPLATE.replace(/__action__/gi, item.action || '').replace(/__icon__/gi, item.icon || '').replace(/__name__/gi, RV_MEDIA_CONFIG.translations.actions_list[key][item.action] || item.name);
                        if (!index && initialized_item) {
                            template = '<li role="separator" class="divider"></li>' + template;
                        }
                        $dropdownActions.append(template);
                    }
                });
                if (action.length > 0) {
                    initialized_item++;
                }
            });
        }
    }]);

    return ActionsService;
}();

/***/ }),
/* 5 */
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

/***/ }),
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MediaList; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Services_ActionsService__ = __webpack_require__(4);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var MediaList = function () {
    function MediaList() {
        _classCallCheck(this, MediaList);

        this.group = {};
        this.group.list = $('#rv_media_items_list').html();
        this.group.tiles = $('#rv_media_items_tiles').html();

        this.item = {};
        this.item.list = $('#rv_media_items_list_element').html();
        this.item.tiles = $('#rv_media_items_tiles_element').html();

        this.$groupContainer = $('.rv-media-items');
    }

    _createClass(MediaList, [{
        key: 'renderData',
        value: function renderData(data) {
            var reload = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
            var load_more_file = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

            var _self = this;
            var MediaConfig = __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getConfigs();
            var template = _self.group[__WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_type];

            var view_in = __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in;

            if (!_.includes(['all_media', 'public', 'trash', 'favorites', 'recent'], view_in)) {
                view_in = 'all_media';
            }

            template = template.replace(/__noItemIcon__/gi, RV_MEDIA_CONFIG.translations.no_item[view_in].icon || '').replace(/__noItemTitle__/gi, RV_MEDIA_CONFIG.translations.no_item[view_in].title || '').replace(/__noItemMessage__/gi, RV_MEDIA_CONFIG.translations.no_item[view_in].message || '');

            var $result = $(template);
            var $itemsWrapper = $result.find('ul');

            if (load_more_file && this.$groupContainer.find('.rv-media-grid ul').length > 0) {
                $itemsWrapper = this.$groupContainer.find('.rv-media-grid ul');
            }

            if (_.size(data.folders) > 0 || _.size(data.files) > 0 || load_more_file) {
                $('.rv-media-items').addClass('has-items');
            } else {
                $('.rv-media-items').removeClass('has-items');
            }

            _.forEach(data.folders, function (value, index) {
                var item = _self.item[__WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_type];
                item = item.replace(/__type__/gi, 'folder').replace(/__id__/gi, value.id).replace(/__name__/gi, value.name || '').replace(/__size__/gi, '').replace(/__date__/gi, value.created_at || '').replace(/__thumb__/gi, '<i class="fa fa-folder-o"></i>');
                var $item = $(item);
                _.forEach(value, function (val, index) {
                    $item.data(index, val);
                });
                $item.data('is_folder', true);
                $item.data('icon', MediaConfig.icons.folder);
                $itemsWrapper.append($item);
            });

            _.forEach(data.files, function (value) {
                var item = _self.item[__WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_type];
                item = item.replace(/__type__/gi, 'file').replace(/__id__/gi, value.id).replace(/__name__/gi, value.name || '').replace(/__size__/gi, value.size || '').replace(/__date__/gi, value.created_at || '');
                if (__WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_type === 'list') {
                    item = item.replace(/__thumb__/gi, '<i class="' + value.icon + '"></i>');
                } else {
                    switch (value.mime_type) {
                        case 'youtube':
                            item = item.replace(/__thumb__/gi, '<img src="' + value.options.thumb + '" alt="' + value.name + '">');
                            break;
                        default:
                            item = item.replace(/__thumb__/gi, value.thumb ? '<img src="' + value.thumb + '" alt="' + value.name + '">' : '<i class="' + value.icon + '"></i>');
                            break;
                    }
                }
                var $item = $(item);
                $item.data('is_folder', false);
                _.forEach(value, function (val, index) {
                    $item.data(index, val);
                });
                $itemsWrapper.append($item);
            });
            if (reload !== false) {
                _self.$groupContainer.empty();
            }

            if (load_more_file && this.$groupContainer.find('.rv-media-grid ul').length > 0) {} else {
                _self.$groupContainer.append($result);
            }
            _self.$groupContainer.find('.loading-wrapper').remove();
            __WEBPACK_IMPORTED_MODULE_1__Services_ActionsService__["a" /* ActionsService */].handleDropdown();

            //trigger event click for file selected
            $('.js-media-list-title[data-id=' + data.selected_file_id + ']').trigger('click');
        }
    }]);

    return MediaList;
}();

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(8);
module.exports = __webpack_require__(16);


/***/ }),
/* 8 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__App_Services_MediaService__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__App_Services_MessageService__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__App_Services_FolderService__ = __webpack_require__(11);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__App_Services_UploadService__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__App_Externals_ExternalServices__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__integrate__ = __webpack_require__(5);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }











var MediaManagement = function () {
    function MediaManagement() {
        _classCallCheck(this, MediaManagement);

        this.MediaService = new __WEBPACK_IMPORTED_MODULE_2__App_Services_MediaService__["a" /* MediaService */]();
        this.UploadService = new __WEBPACK_IMPORTED_MODULE_5__App_Services_UploadService__["a" /* UploadService */]();
        this.FolderService = new __WEBPACK_IMPORTED_MODULE_4__App_Services_FolderService__["a" /* FolderService */]();

        new __WEBPACK_IMPORTED_MODULE_7__App_Externals_ExternalServices__["a" /* ExternalServices */]();

        this.$body = $('body');
    }

    _createClass(MediaManagement, [{
        key: 'init',
        value: function init() {
            __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
            this.setupLayout();

            this.handleMediaList();
            this.changeViewType();
            this.changeFilter();
            this.search();
            this.handleActions();

            this.UploadService.init();

            this.handleModals();
            this.scrollGetMore();
        }
    }, {
        key: 'setupLayout',
        value: function setupLayout() {
            /**
             * Sidebar
             */
            var $current_filter = $('.js-rv-media-change-filter[data-type="filter"][data-value="' + __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getRequestParams().filter + '"]');

            $current_filter.closest('li').addClass('active').closest('.dropdown').find('.js-rv-media-filter-current').html('(' + $current_filter.html() + ')');

            var $current_view_in = $('.js-rv-media-change-filter[data-type="view_in"][data-value="' + __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in + '"]');

            $current_view_in.closest('li').addClass('active').closest('.dropdown').find('.js-rv-media-filter-current').html('(' + $current_view_in.html() + ')');

            if (__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].isUseInModal()) {
                $('.rv-media-footer').removeClass('hidden');
            }

            /**
             * Sort
             */
            $('.js-rv-media-change-filter[data-type="sort_by"][data-value="' + __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getRequestParams().sort_by + '"]').closest('li').addClass('active');

            /**
             * Details pane
             */
            var $mediaDetailsCheckbox = $('#media_details_collapse');
            $mediaDetailsCheckbox.prop('checked', __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].hide_details_pane || false);
            setTimeout(function () {
                $('.rv-media-details').removeClass('hidden');
            }, 300);
            $mediaDetailsCheckbox.on('change', function (event) {
                event.preventDefault();
                __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].hide_details_pane = $(this).is(':checked');
                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();
            });

            $(document).on('click', 'button[data-dismiss-modal]', function () {
                var modal = $(this).data('dismiss-modal');
                $(modal).modal('hide');
            });
        }
    }, {
        key: 'handleMediaList',
        value: function handleMediaList() {
            var _self = this;

            /*Ctrl key in Windows*/
            var ctrl_key = false;

            /*Command key in MAC*/
            var meta_key = false;

            /*Shift key*/
            var shift_key = false;

            $(document).on('keyup keydown', function (e) {
                /*User hold ctrl key*/
                ctrl_key = e.ctrlKey;
                /*User hold command key*/
                meta_key = e.metaKey;
                /*User hold shift key*/
                shift_key = e.shiftKey;
            });

            _self.$body.on('click', '.js-media-list-title', function (event) {
                event.preventDefault();
                var $current = $(this);

                if (shift_key) {
                    var firstItem = _.first(__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getSelectedItems());
                    if (firstItem) {
                        var firstIndex = firstItem.index_key;
                        var currentIndex = $current.index();
                        $('.rv-media-items li').each(function (index) {
                            if (index > firstIndex && index <= currentIndex) {
                                $(this).find('input[type=checkbox]').prop('checked', true);
                            }
                        });
                    }
                } else {
                    if (!ctrl_key && !meta_key) {
                        $current.closest('.rv-media-items').find('input[type=checkbox]').prop('checked', false);
                    }
                }

                var $lineCheckBox = $current.find('input[type=checkbox]');
                $lineCheckBox.prop('checked', true);
                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].handleDropdown();

                _self.MediaService.getFileDetails($current.data());
            }).on('dblclick', '.js-media-list-title', function (event) {
                event.preventDefault();

                var data = $(this).data();
                if (data.is_folder === true) {
                    __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
                    _self.FolderService.changeFolder(data.id);
                } else {
                    if (!__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].isUseInModal()) {
                        __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].handlePreview();
                    } else if (__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getConfigs().request_params.view_in !== 'trash') {
                        var selectedFiles = __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();
                        if (_.size(selectedFiles) > 0) {
                            __WEBPACK_IMPORTED_MODULE_8__integrate__["EditorService"].editorSelectFile(selectedFiles);
                        }
                    }
                }
            }).on('dblclick', '.js-up-one-level', function (event) {
                event.preventDefault();
                var count = $('.rv-media-breadcrumb .breadcrumb li').length;
                $('.rv-media-breadcrumb .breadcrumb li:nth-child(' + (count - 1) + ') a').trigger('click');
            }).on('contextmenu', '.js-context-menu', function (e) {
                if (!$(this).find('input[type=checkbox]').is(':checked')) {
                    $(this).trigger('click');
                }
            }).on('click contextmenu', '.rv-media-items', function (e) {
                if (!_.size(e.target.closest('.js-context-menu'))) {
                    $('.rv-media-items input[type="checkbox"]').prop('checked', false);
                    $('.rv-dropdown-actions').addClass('disabled');
                    _self.MediaService.getFileDetails({
                        icon: 'fa fa-picture-o',
                        nothing_selected: ''
                    });
                }
            });
        }
    }, {
        key: 'changeViewType',
        value: function changeViewType() {
            var _self = this;
            _self.$body.on('click', '.js-rv-media-change-view-type .btn', function (event) {
                event.preventDefault();
                var $current = $(this);
                if ($current.hasClass('active')) {
                    return;
                }
                $current.closest('.js-rv-media-change-view-type').find('.btn').removeClass('active');
                $current.addClass('active');

                __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.view_type = $current.data('type');

                if ($current.data('type') === 'trash') {
                    $(document).find('.js-insert-to-editor').prop('disabled', true);
                } else {
                    $(document).find('.js-insert-to-editor').prop('disabled', false);
                }

                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();

                if (typeof RV_MEDIA_CONFIG.pagination != 'undefined') {
                    if (typeof RV_MEDIA_CONFIG.pagination.paged != 'undefined') {
                        RV_MEDIA_CONFIG.pagination.paged = 1;
                    }
                }

                _self.MediaService.getMedia(true, false);
            });
            $('.js-rv-media-change-view-type .btn[data-type="' + __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_type + '"]').trigger('click');

            this.bindIntegrateModalEvents();
        }
    }, {
        key: 'changeFilter',
        value: function changeFilter() {
            var _self = this;
            _self.$body.on('click', '.js-rv-media-change-filter', function (event) {
                event.preventDefault();
                if (!__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].isOnAjaxLoading()) {
                    var $current = $(this);
                    var $parent = $current.closest('ul');
                    var data = $current.data();

                    __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].request_params[data.type] = data.value;

                    if (data.type === 'view_in') {
                        __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.folder_id = 0;
                        if (data.value === 'trash') {
                            $(document).find('.js-insert-to-editor').prop('disabled', true);
                        } else {
                            $(document).find('.js-insert-to-editor').prop('disabled', false);
                        }
                    }

                    $current.closest('.dropdown').find('.js-rv-media-filter-current').html('(' + $current.html() + ')');

                    __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();
                    __WEBPACK_IMPORTED_MODULE_2__App_Services_MediaService__["a" /* MediaService */].refreshFilter();

                    __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
                    _self.MediaService.getMedia(true);

                    $parent.find('> li').removeClass('active');
                    $current.closest('li').addClass('active');
                }
            });
        }
    }, {
        key: 'search',
        value: function search() {
            var _self = this;
            $('.input-search-wrapper input[type="text"]').val(__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getRequestParams().search || '');
            _self.$body.on('submit', '.input-search-wrapper', function (event) {
                event.preventDefault();
                __WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.search = $(this).find('input[type="text"]').val();

                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].storeConfig();
                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
                _self.MediaService.getMedia(true);
            });
        }
    }, {
        key: 'handleActions',
        value: function handleActions() {
            var _self = this;

            _self.$body.on('click', '.rv-media-actions .js-change-action[data-type="refresh"]', function (event) {
                event.preventDefault();

                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();

                var ele_options = typeof window.rvMedia.$el !== 'undefined' ? window.rvMedia.$el.data('rv-media') : undefined;
                if (typeof ele_options !== 'undefined' && ele_options.length > 0 && typeof ele_options[0].selected_file_id !== 'undefined') {
                    _self.MediaService.getMedia(true, true);
                } else _self.MediaService.getMedia(true, false);
            }).on('click', '.rv-media-items li.no-items', function (event) {
                event.preventDefault();
                $('.rv-media-header .rv-media-top-header .rv-media-actions .js-dropzone-upload').trigger('click');
            }).on('submit', '.form-add-folder', function (event) {
                event.preventDefault();
                var $input = $(this).find('input[type=text]');
                var folderName = $input.val();
                _self.FolderService.create(folderName);
                $input.val('');
            }).on('click', '.js-change-folder', function (event) {
                event.preventDefault();
                var folderId = $(this).data('folder');
                __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
                _self.FolderService.changeFolder(folderId);
            }).on('click', '.js-files-action', function (event) {
                event.preventDefault();
                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].handleGlobalAction($(this).data('action'), function (res) {
                    __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].resetPagination();
                    _self.MediaService.getMedia(true);
                });
            });
        }
    }, {
        key: 'handleModals',
        value: function handleModals() {
            var _self = this;
            /*Rename files*/
            _self.$body.on('show.bs.modal', '#modal_rename_items', function (event) {
                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].renderRenameItems();
            });
            _self.$body.on('submit', '#modal_rename_items .form-rename', function (event) {
                event.preventDefault();
                var items = [];
                var $form = $(this);

                $('#modal_rename_items .form-control').each(function () {
                    var $current = $(this);
                    var data = $current.closest('.form-group').data();
                    data.name = $current.val();
                    items.push(data);
                });

                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].processAction({
                    action: $form.data('action'),
                    selected: items
                }, function (res) {
                    if (!res.error) {
                        $form.closest('.modal').modal('hide');
                        _self.MediaService.getMedia(true);
                    } else {
                        $('#modal_rename_items .form-group').each(function () {
                            var $current = $(this);
                            if (_.includes(res.data, $current.data('id'))) {
                                $current.addClass('has-error');
                            } else {
                                $current.removeClass('has-error');
                            }
                        });
                    }
                });
            });

            /*Delete files*/
            _self.$body.on('submit', '.form-delete-items', function (event) {
                event.preventDefault();
                var items = [];
                var $form = $(this);

                _.each(__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getSelectedItems(), function (value) {
                    items.push({
                        id: value.id,
                        is_folder: value.is_folder
                    });
                });

                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].processAction({
                    action: $form.data('action'),
                    selected: items
                }, function (res) {
                    $form.closest('.modal').modal('hide');
                    if (!res.error) {
                        _self.MediaService.getMedia(true);
                    }
                });
            });

            /*Empty trash*/
            _self.$body.on('submit', '#modal_empty_trash .rv-form', function (event) {
                event.preventDefault();
                var $form = $(this);

                __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].processAction({
                    action: $form.data('action')
                }, function (res) {
                    $form.closest('.modal').modal('hide');
                    _self.MediaService.getMedia(true);
                });
            });

            if (__WEBPACK_IMPORTED_MODULE_0__App_Config_MediaConfig__["a" /* MediaConfig */].request_params.view_in === 'trash') {
                $(document).find('.js-insert-to-editor').prop('disabled', true);
            } else {
                $(document).find('.js-insert-to-editor').prop('disabled', false);
            }

            this.bindIntegrateModalEvents();
        }
    }, {
        key: 'checkFileTypeSelect',
        value: function checkFileTypeSelect(selectedFiles) {
            if (typeof window.rvMedia.$el !== 'undefined') {
                var firstItem = _.first(selectedFiles);
                var ele_options = window.rvMedia.$el.data('rv-media');
                if (typeof ele_options !== 'undefined' && typeof ele_options[0] !== 'undefined' && typeof ele_options[0].file_type !== 'undefined' && firstItem !== 'undefined' && firstItem.type !== 'undefined') {
                    if (!ele_options[0].file_type.match(firstItem.type)) {
                        return false;
                    } else {
                        if (typeof ele_options[0].ext_allowed !== 'undefined' && $.isArray(ele_options[0].ext_allowed)) {
                            if ($.inArray(firstItem.mime_type, ele_options[0].ext_allowed) == -1) {
                                return false;
                            }
                        }
                    }
                }
            }
            return true;
        }
    }, {
        key: 'bindIntegrateModalEvents',
        value: function bindIntegrateModalEvents() {
            var $main_modal = $('#rv_media_modal');
            var _self = this;
            $main_modal.off('click', '.js-insert-to-editor').on('click', '.js-insert-to-editor', function (event) {
                event.preventDefault();
                var selectedFiles = __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();
                if (_.size(selectedFiles) > 0) {
                    window.rvMedia.options.onSelectFiles(selectedFiles, window.rvMedia.$el);
                    if (_self.checkFileTypeSelect(selectedFiles)) {
                        $main_modal.find('.close').trigger('click');
                    }
                }
            });

            $main_modal.off('dblclick', '.js-media-list-title').on('dblclick', '.js-media-list-title', function (event) {
                event.preventDefault();
                if (__WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getConfigs().request_params.view_in !== 'trash') {
                    var selectedFiles = __WEBPACK_IMPORTED_MODULE_1__App_Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();
                    if (_.size(selectedFiles) > 0) {
                        window.rvMedia.options.onSelectFiles(selectedFiles, window.rvMedia.$el);
                        if (_self.checkFileTypeSelect(selectedFiles)) {
                            $main_modal.find('.close').trigger('click');
                        }
                    }
                } else {
                    __WEBPACK_IMPORTED_MODULE_6__App_Services_ActionsService__["a" /* ActionsService */].handlePreview();
                }
            });
        }
    }, {
        key: 'scrollGetMore',


        //scroll get more media
        value: function scrollGetMore() {
            var _self = this;
            $('.rv-media-main .rv-media-items').bind('DOMMouseScroll mousewheel', function (e) {
                if (e.originalEvent.detail > 0 || e.originalEvent.wheelDelta < 0) {
                    var $load_more = false;
                    if ($(this).closest('.media-modal').length > 0) {
                        $load_more = $(this).scrollTop() + $(this).innerHeight() / 2 >= $(this)[0].scrollHeight - 450;
                    } else {
                        $load_more = $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 150;
                    }

                    if ($load_more) {
                        if (typeof RV_MEDIA_CONFIG.pagination != 'undefined' && RV_MEDIA_CONFIG.pagination.has_more) {
                            _self.MediaService.getMedia(false, false, true);
                        } else {
                            return;
                        }
                    }
                }
            });
        }
    }], [{
        key: 'setupSecurity',
        value: function setupSecurity() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    }]);

    return MediaManagement;
}();

$(document).ready(function () {
    window.rvMedia = window.rvMedia || {};

    MediaManagement.setupSecurity();
    new MediaManagement().init();
});

/***/ }),
/* 9 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ContextMenuService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ActionsService__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__ = __webpack_require__(0);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var ContextMenuService = function () {
    function ContextMenuService() {
        _classCallCheck(this, ContextMenuService);
    }

    _createClass(ContextMenuService, null, [{
        key: 'initContext',
        value: function initContext() {
            if (jQuery().contextMenu) {
                $.contextMenu({
                    selector: '.js-context-menu[data-context="file"]',
                    build: function build($element, event) {
                        return {
                            items: ContextMenuService._fileContextMenu()
                        };
                    }
                });

                $.contextMenu({
                    selector: '.js-context-menu[data-context="folder"]',
                    build: function build($element, event) {
                        return {
                            items: ContextMenuService._folderContextMenu()
                        };
                    }
                });
            }
        }
    }, {
        key: '_fileContextMenu',
        value: function _fileContextMenu() {
            var items = {
                preview: {
                    name: 'Preview',
                    icon: function icon(opt, $itemElement, itemKey, item) {
                        $itemElement.html('<i class="fa fa-eye" aria-hidden="true"></i> ' + item.name);

                        return 'context-menu-icon-updated';
                    },
                    callback: function callback(key, opt) {
                        __WEBPACK_IMPORTED_MODULE_0__ActionsService__["a" /* ActionsService */].handlePreview();
                    }
                }
            };

            _.each(__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getConfigs().actions_list, function (actionGroup, key) {
                _.each(actionGroup, function (value) {
                    items[value.action] = {
                        name: value.name,
                        icon: function icon(opt, $itemElement, itemKey, item) {
                            $itemElement.html('<i class="' + value.icon + '" aria-hidden="true"></i> ' + (RV_MEDIA_CONFIG.translations.actions_list[key][value.action] || item.name));

                            return 'context-menu-icon-updated';
                        },
                        callback: function callback(key, opt) {
                            $('.js-files-action[data-action="' + value.action + '"]').trigger('click');
                        }
                    };
                });
            });

            var except = [];

            switch (__WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in) {
                case 'all_media':
                    except = ['remove_favorite', 'delete', 'restore'];
                    break;
                case 'recent':
                    except = ['remove_favorite', 'delete', 'restore', 'make_copy'];
                    break;
                case 'favorites':
                    except = ['favorite', 'delete', 'restore', 'make_copy'];
                    break;
                case 'trash':
                    items = {
                        preview: items.preview,
                        rename: items.rename,
                        download: items.download,
                        delete: items.delete,
                        restore: items.restore
                    };
                    break;
            }

            _.each(except, function (value) {
                items[value] = undefined;
            });

            var hasFolderSelected = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFolder().length > 0;

            if (hasFolderSelected) {
                items.preview = undefined;
                items.copy_link = undefined;

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.create')) {
                    items.make_copy = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.edit')) {
                    items.rename = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.trash')) {
                    items.trash = undefined;
                    items.restore = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.delete')) {
                    items.delete = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'folders.favorite')) {
                    items.favorite = undefined;
                    items.remove_favorite = undefined;
                }
            }

            var selectedFiles = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getSelectedFiles();

            if (selectedFiles.length > 0) {
                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.create')) {
                    items.make_copy = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.edit')) {
                    items.rename = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.trash')) {
                    items.trash = undefined;
                    items.restore = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.delete')) {
                    items.delete = undefined;
                }

                if (!_.includes(RV_MEDIA_CONFIG.permissions, 'files.favorite')) {
                    items.favorite = undefined;
                    items.remove_favorite = undefined;
                }
            }

            var can_preview = false;
            _.each(selectedFiles, function (value) {
                if (_.includes(['image', 'youtube', 'pdf', 'text', 'video'], value.type)) {
                    can_preview = true;
                }
            });

            if (!can_preview) {
                items.preview = undefined;
            }

            return items;
        }
    }, {
        key: '_folderContextMenu',
        value: function _folderContextMenu() {
            var items = ContextMenuService._fileContextMenu();

            items.preview = undefined;
            items.copy_link = undefined;

            return items;
        }
    }, {
        key: 'destroyContext',
        value: function destroyContext() {
            if (jQuery().contextMenu) {
                $.contextMenu('destroy');
            }
        }
    }]);

    return ContextMenuService;
}();

/***/ }),
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MediaDetails; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__ = __webpack_require__(0);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var MediaDetails = function () {
    function MediaDetails() {
        _classCallCheck(this, MediaDetails);

        this.$detailsWrapper = $('.rv-media-main .rv-media-details');

        this.descriptionItemTemplate = '<div class="rv-media-name"><p>__title__</p>__url__</div>';

        this.onlyFields = ['name', 'full_url', 'size', 'mime_type', 'created_at', 'updated_at', 'nothing_selected'];

        this.externalTypes = ['youtube', 'vimeo', 'metacafe', 'dailymotion', 'vine', 'instagram'];
    }

    _createClass(MediaDetails, [{
        key: 'renderData',
        value: function renderData(data) {
            var _self = this;
            var thumb = data.type === 'image' ? '<img src="' + data.full_url + '" alt="' + data.name + '">' : data.mime_type === 'youtube' ? '<img src="' + data.options.thumb + '" alt="' + data.name + '">' : '<i class="' + data.icon + '"></i>';
            var description = '';
            var useClipboard = false;
            _.forEach(data, function (val, index) {
                if (_.includes(_self.onlyFields, index)) {
                    if (!_.includes(_self.externalTypes, data.type) || _.includes(_self.externalTypes, data.type) && !_.includes(['size', 'mime_type'], index)) {
                        description += _self.descriptionItemTemplate.replace(/__title__/gi, RV_MEDIA_CONFIG.translations[index]).replace(/__url__/gi, val ? index === 'full_url' ? '<div class="input-group"><input id="file_details_url" type="text" value="' + val + '" class="form-control"><span class="input-group-btn"><button class="btn btn-default js-btn-copy-to-clipboard" type="button" data-clipboard-target="#file_details_url" title="Copied" data-trigger="click"><img class="clippy" src="' + __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].asset('/vendor/media/images/clippy.svg') + '" width="13" alt="Copy to clipboard"></button></span></div>' : '<span title="' + val + '">' + val + '</span>' : '');
                        if (index === 'full_url') {
                            useClipboard = true;
                        }
                    }
                }
            });
            _self.$detailsWrapper.find('.rv-media-thumbnail').html(thumb);
            _self.$detailsWrapper.find('.rv-media-description').html(description);
            if (useClipboard) {
                var clipboard = new Clipboard('.js-btn-copy-to-clipboard');
                $('.js-btn-copy-to-clipboard').tooltip().on('mouseleave', function (event) {
                    $(this).tooltip('hide');
                });
            }
        }
    }]);

    return MediaDetails;
}();

/***/ }),
/* 11 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FolderService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Views_MediaList__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Config_MediaConfig__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__MediaService__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__ = __webpack_require__(0);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }







var FolderService = function () {
    function FolderService() {
        _classCallCheck(this, FolderService);

        this.MediaList = new __WEBPACK_IMPORTED_MODULE_0__Views_MediaList__["a" /* MediaList */]();
        this.MediaService = new __WEBPACK_IMPORTED_MODULE_2__MediaService__["a" /* MediaService */]();

        $('body').on('shown.bs.modal', '#modal_add_folder', function () {
            $(this).find('.form-add-folder input[type=text]').focus();
        });
    }

    _createClass(FolderService, [{
        key: 'create',
        value: function create(folderName) {
            var _self = this;
            $.ajax({
                url: RV_MEDIA_URL.create_folder,
                type: 'POST',
                data: {
                    parent_id: __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__["a" /* Helpers */].getRequestParams().folder_id,
                    name: folderName
                },
                dataType: 'json',
                beforeSend: function beforeSend() {
                    __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__["a" /* Helpers */].showAjaxLoading();
                },
                success: function success(res) {
                    if (res.error) {
                        __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].showMessage('error', res.message, RV_MEDIA_CONFIG.translations.message.error_header);
                    } else {
                        __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].showMessage('success', res.message, RV_MEDIA_CONFIG.translations.message.success_header);
                        __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__["a" /* Helpers */].resetPagination();
                        _self.MediaService.getMedia(true);
                        FolderService.closeModal();
                    }
                },
                complete: function complete(data) {
                    __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__["a" /* Helpers */].hideAjaxLoading();
                },
                error: function error(data) {
                    __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].handleError(data);
                }
            });
        }
    }, {
        key: 'changeFolder',
        value: function changeFolder(folderId) {
            __WEBPACK_IMPORTED_MODULE_1__Config_MediaConfig__["a" /* MediaConfig */].request_params.folder_id = folderId;
            __WEBPACK_IMPORTED_MODULE_4__Helpers_Helpers__["a" /* Helpers */].storeConfig();
            this.MediaService.getMedia(true);
        }
    }], [{
        key: 'closeModal',
        value: function closeModal() {
            $('#modal_add_folder').modal('hide');
        }
    }]);

    return FolderService;
}();

/***/ }),
/* 12 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return UploadService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Services_MediaService__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__ = __webpack_require__(0);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var UploadService = function () {
    function UploadService() {
        _classCallCheck(this, UploadService);

        this.$body = $('body');

        this.dropZone = null;

        this.uploadUrl = RV_MEDIA_URL.upload_file;

        this.uploadProgressBox = $('.rv-upload-progress');

        this.uploadProgressContainer = $('.rv-upload-progress .rv-upload-progress-table');

        this.uploadProgressTemplate = $('#rv_media_upload_progress_item').html();

        this.totalQueued = 1;

        this.MediaService = new __WEBPACK_IMPORTED_MODULE_0__Services_MediaService__["a" /* MediaService */]();

        this.totalError = 0;
    }

    _createClass(UploadService, [{
        key: 'init',
        value: function init() {
            if (_.includes(RV_MEDIA_CONFIG.permissions, 'files.create') && $('.rv-media-items').length > 0) {
                this.setupDropZone();
            }
            this.handleEvents();
        }
    }, {
        key: 'setupDropZone',
        value: function setupDropZone() {
            var _self = this;
            _self.dropZone = new Dropzone(document.querySelector('.rv-media-items'), {
                url: _self.uploadUrl,
                thumbnailWidth: false,
                thumbnailHeight: false,
                parallelUploads: 1,
                autoQueue: true,
                clickable: '.js-dropzone-upload',
                previewTemplate: false,
                previewsContainer: false,
                uploadMultiple: true,
                sending: function sending(file, xhr, formData) {
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('folder_id', __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().folder_id);
                    formData.append('view_in', __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].getRequestParams().view_in);
                }
            });

            _self.dropZone.on('addedfile', function (file) {
                file.index = _self.totalQueued;
                _self.totalQueued++;
            });

            _self.dropZone.on('sending', function (file) {
                _self.initProgress(file.name, file.size);
            });

            _self.dropZone.on('success', function (file) {});

            _self.dropZone.on('complete', function (file) {
                _self.changeProgressStatus(file);
            });

            _self.dropZone.on('queuecomplete', function () {
                __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].resetPagination();
                _self.MediaService.getMedia(true);
                if (_self.totalError === 0) {
                    setTimeout(function () {
                        $('.rv-upload-progress .close-pane').trigger('click');
                    }, 5000);
                }
            });
        }
    }, {
        key: 'handleEvents',
        value: function handleEvents() {
            var _self = this;
            /**
             * Close upload progress pane
             */
            _self.$body.on('click', '.rv-upload-progress .close-pane', function (event) {
                event.preventDefault();
                $('.rv-upload-progress').addClass('hide-the-pane');
                _self.totalError = 0;
                setTimeout(function () {
                    $('.rv-upload-progress li').remove();
                    _self.totalQueued = 1;
                }, 300);
            });
        }
    }, {
        key: 'initProgress',
        value: function initProgress($fileName, $fileSize) {
            var template = this.uploadProgressTemplate.replace(/__fileName__/gi, $fileName).replace(/__fileSize__/gi, UploadService.formatFileSize($fileSize)).replace(/__status__/gi, 'warning').replace(/__message__/gi, 'Uploading');
            this.uploadProgressContainer.append(template);
            this.uploadProgressBox.removeClass('hide-the-pane');
            this.uploadProgressBox.find('.panel-body').animate({ scrollTop: this.uploadProgressContainer.height() }, 150);
        }
    }, {
        key: 'changeProgressStatus',
        value: function changeProgressStatus(file) {
            var _self = this;
            var $progressLine = _self.uploadProgressContainer.find('li:nth-child(' + file.index + ')');
            var $label = $progressLine.find('.label');
            $label.removeClass('label-success label-danger label-warning');

            var response = __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].jsonDecode(file.xhr.responseText || '', {});

            _self.totalError = _self.totalError + (response.error === true || file.status === 'error' ? 1 : 0);

            $label.addClass(response.error === true || file.status === 'error' ? 'label-danger' : 'label-success');
            $label.html(response.error === true || file.status === 'error' ? 'Error' : 'Uploaded');
            if (file.status === 'error') {
                if (file.xhr.status === 422) {
                    var error_html = '';
                    $.each(response, function (key, item) {
                        error_html += '<span class="text-danger">' + item + '</span><br>';
                    });
                    $progressLine.find('.file-error').html(error_html);
                } else if (file.xhr.status === 500) {
                    $progressLine.find('.file-error').html('<span class="text-danger">' + file.xhr.statusText + '</span>');
                }
            } else if (response.error) {
                $progressLine.find('.file-error').html('<span class="text-danger">' + response.message + '</span>');
            } else {
                __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].addToRecent(response.data.id);
                __WEBPACK_IMPORTED_MODULE_1__Helpers_Helpers__["a" /* Helpers */].setSelectedFile(response.data.id);
            }
        }
    }], [{
        key: 'formatFileSize',
        value: function formatFileSize(bytes) {
            var si = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

            var thresh = si ? 1000 : 1024;
            if (Math.abs(bytes) < thresh) {
                return bytes + ' B';
            }
            var units = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            var u = -1;
            do {
                bytes /= thresh;
                ++u;
            } while (Math.abs(bytes) >= thresh && u < units.length - 1);
            return bytes.toFixed(1) + ' ' + units[u];
        }
    }]);

    return UploadService;
}();

/***/ }),
/* 13 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ExternalServices; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Youtube__ = __webpack_require__(14);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var ExternalServices = function ExternalServices() {
    _classCallCheck(this, ExternalServices);

    new __WEBPACK_IMPORTED_MODULE_0__Youtube__["a" /* Youtube */]();
};

/***/ }),
/* 14 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Youtube; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Config_ExternalServiceConfig__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__Services_MediaService__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__ = __webpack_require__(2);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }






var Youtube = function () {
    function Youtube() {
        _classCallCheck(this, Youtube);

        this.MediaService = new __WEBPACK_IMPORTED_MODULE_2__Services_MediaService__["a" /* MediaService */]();

        this.$body = $('body');

        this.$modal = $('#modal_add_from_youtube');

        var _self = this;

        this.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg);

        this.$modal.on('hidden.bs.modal', function () {
            _self.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg);
        });

        this.$body.on('click', '#modal_add_from_youtube .rv-btn-add-youtube-url', function (event) {
            event.preventDefault();

            _self.checkYouTubeVideo($(this).closest('#modal_add_from_youtube').find('.rv-youtube-url'));
        });
    }

    _createClass(Youtube, [{
        key: 'setMessage',
        value: function setMessage(msg) {
            this.$modal.find('.modal-notice').html(msg);
        }
    }, {
        key: 'checkYouTubeVideo',
        value: function checkYouTubeVideo($input) {
            var _self = this;
            if (!Youtube.validateYouTubeLink($input.val()) || !__WEBPACK_IMPORTED_MODULE_1__Config_ExternalServiceConfig__["a" /* ExternalServiceConfig */].youtube.api_key) {
                if (__WEBPACK_IMPORTED_MODULE_1__Config_ExternalServiceConfig__["a" /* ExternalServiceConfig */].youtube.api_key) {
                    _self.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.invalid_url_msg);
                } else {
                    _self.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.no_api_key_msg);
                }
            } else {
                var youtubeId = Youtube.getYouTubeId($input.val());
                var requestUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' + youtubeId;
                var isPlaylist = _self.$modal.find('.custom-checkbox input[type="checkbox"]').is(':checked');

                if (isPlaylist) {
                    youtubeId = Youtube.getYoutubePlaylistId($input.val());
                    requestUrl = 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId=' + youtubeId;
                }

                $.ajax({
                    url: requestUrl + '&key=' + __WEBPACK_IMPORTED_MODULE_1__Config_ExternalServiceConfig__["a" /* ExternalServiceConfig */].youtube.api_key + '&part=snippet',
                    type: "GET",
                    success: function success(data) {
                        if (isPlaylist) {
                            playlistVideoCallback(data, $input.val());
                        } else {
                            singleVideoCallback(data, $input.val());
                        }
                    },
                    error: function error(data) {
                        _self.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.error_msg);
                    }
                });
            }

            function singleVideoCallback(data, url) {
                $.ajax({
                    url: RV_MEDIA_URL.add_external_service,
                    type: "POST",
                    dataType: 'json',
                    data: {
                        type: 'youtube',
                        name: data.items[0].snippet.title,
                        folder_id: __WEBPACK_IMPORTED_MODULE_0__Helpers_Helpers__["a" /* Helpers */].getRequestParams().folder_id,
                        url: url,
                        options: {
                            thumb: 'https://img.youtube.com/vi/' + data.items[0].id + '/maxresdefault.jpg'
                        }
                    },
                    success: function success(res) {
                        if (res.error) {
                            __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].showMessage('error', res.message, RV_MEDIA_CONFIG.translations.message.error_header);
                        } else {
                            __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].showMessage('success', res.message, RV_MEDIA_CONFIG.translations.message.success_header);
                            _self.MediaService.getMedia(true);
                        }
                    },
                    error: function error(data) {
                        __WEBPACK_IMPORTED_MODULE_3__Services_MessageService__["a" /* MessageService */].handleError(data);
                    }
                });
                _self.$modal.modal('hide');
            }

            function playlistVideoCallback(data, url) {
                _self.$modal.modal('hide');
            }
        }
    }], [{
        key: 'validateYouTubeLink',
        value: function validateYouTubeLink(url) {
            var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
            return url.match(p) ? RegExp.$1 : false;
        }
    }, {
        key: 'getYouTubeId',
        value: function getYouTubeId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length === 11) {
                return match[2];
            }
            return null;
        }
    }, {
        key: 'getYoutubePlaylistId',
        value: function getYoutubePlaylistId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?list=|\&list=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match) {
                return match[2];
            }
            return null;
        }
    }]);

    return Youtube;
}();

/***/ }),
/* 15 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ExternalServiceConfig; });
var ExternalServiceConfig = {
    youtube: {
        api_key: "AIzaSyCV4fmfdgsValGNR3sc-0W3cbpEZ8uOd60"
    }
};



/***/ }),
/* 16 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAgZmI1ZWM2YmY5ZmU4MjQxOTUwNmIiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvSGVscGVycy9IZWxwZXJzLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0NvbmZpZy9NZWRpYUNvbmZpZy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9NZXNzYWdlU2VydmljZS5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9NZWRpYVNlcnZpY2UuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvU2VydmljZXMvQWN0aW9uc1NlcnZpY2UuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9pbnRlZ3JhdGUuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvVmlld3MvTWVkaWFMaXN0LmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvbWVkaWEuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvU2VydmljZXMvQ29udGV4dE1lbnVTZXJ2aWNlLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1ZpZXdzL01lZGlhRGV0YWlscy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9Gb2xkZXJTZXJ2aWNlLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1NlcnZpY2VzL1VwbG9hZFNlcnZpY2UuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvRXh0ZXJuYWxzL0V4dGVybmFsU2VydmljZXMuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvRXh0ZXJuYWxzL1lvdXR1YmUuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvQ29uZmlnL0V4dGVybmFsU2VydmljZUNvbmZpZy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL3Nhc3MvbWVkaWEuc2Nzcz8wODljIl0sIm5hbWVzIjpbIkhlbHBlcnMiLCJwYXJhbU5hbWUiLCJ1cmwiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsInNlYXJjaCIsInJlUGFyYW0iLCJSZWdFeHAiLCJtYXRjaCIsImxlbmd0aCIsInN1YnN0cmluZyIsImJhc2VVcmwiLCJSVl9NRURJQV9VUkwiLCJiYXNlX3VybCIsInN1YnN0ciIsIiRlbGVtZW50IiwiJCIsImFkZENsYXNzIiwiYXBwZW5kIiwiaHRtbCIsInJlbW92ZUNsYXNzIiwiZmluZCIsInJlbW92ZSIsImhhc0NsYXNzIiwib2JqZWN0IiwiSlNPTiIsInN0cmluZ2lmeSIsImpzb25TdHJpbmciLCJkZWZhdWx0VmFsdWUiLCJyZXN1bHQiLCJwYXJzZUpTT04iLCJlcnIiLCJydk1lZGlhIiwib3B0aW9ucyIsIm9wZW5faW4iLCJleHRlbmQiLCJNZWRpYUNvbmZpZyIsInJlcXVlc3RfcGFyYW1zIiwiJGZpbGVfaWQiLCJzZWxlY3RlZF9maWxlX2lkIiwibG9jYWxTdG9yYWdlIiwic2V0SXRlbSIsImpzb25FbmNvZGUiLCJpZCIsIkFycmF5IiwiXyIsImVhY2giLCJ2YWx1ZSIsIlJlY2VudEl0ZW1zIiwicHVzaCIsIml0ZW1zIiwiJGJveCIsImRhdGEiLCJpbmRleF9rZXkiLCJpbmRleCIsInNlbGVjdGVkIiwiY2xvc2VzdCIsImdldFVybFBhcmFtIiwiUlZfTUVESUFfQ09ORklHIiwicGFnaW5hdGlvbiIsInBhZ2VkIiwicG9zdHNfcGVyX3BhZ2UiLCJpbl9wcm9jZXNzX2dldF9tZWRpYSIsImhhc19tb3JlIiwiZ2V0SXRlbSIsImRlZmF1bHRDb25maWciLCJhcHBfa2V5Iiwidmlld190eXBlIiwiZmlsdGVyIiwidmlld19pbiIsInNvcnRfYnkiLCJmb2xkZXJfaWQiLCJoaWRlX2RldGFpbHNfcGFuZSIsImljb25zIiwiZm9sZGVyIiwiYWN0aW9uc19saXN0IiwiYmFzaWMiLCJpY29uIiwibmFtZSIsImFjdGlvbiIsIm9yZGVyIiwiY2xhc3MiLCJmaWxlIiwidXNlciIsIm90aGVyIiwiZGVuaWVkX2Rvd25sb2FkIiwiTWVzc2FnZVNlcnZpY2UiLCJ0eXBlIiwibWVzc2FnZSIsIm1lc3NhZ2VIZWFkZXIiLCJ0b2FzdHIiLCJjbG9zZUJ1dHRvbiIsInByb2dyZXNzQmFyIiwicG9zaXRpb25DbGFzcyIsIm9uY2xpY2siLCJzaG93RHVyYXRpb24iLCJoaWRlRHVyYXRpb24iLCJ0aW1lT3V0IiwiZXh0ZW5kZWRUaW1lT3V0Iiwic2hvd0Vhc2luZyIsImhpZGVFYXNpbmciLCJzaG93TWV0aG9kIiwiaGlkZU1ldGhvZCIsInJlc3BvbnNlSlNPTiIsInNob3dNZXNzYWdlIiwidHJhbnNsYXRpb25zIiwiZXJyb3JfaGVhZGVyIiwiZWwiLCJrZXkiLCJpdGVtIiwic3RhdHVzVGV4dCIsIk1lZGlhU2VydmljZSIsIk1lZGlhTGlzdCIsIk1lZGlhRGV0YWlscyIsImJyZWFkY3J1bWJUZW1wbGF0ZSIsInJlbG9hZCIsImlzX3BvcHVwIiwibG9hZF9tb3JlX2ZpbGUiLCJfc2VsZiIsImdldEZpbGVEZXRhaWxzIiwibm90aGluZ19zZWxlY3RlZCIsInBhcmFtcyIsImdldFJlcXVlc3RQYXJhbXMiLCJyZWNlbnRfaXRlbXMiLCJ1bmRlZmluZWQiLCJvblNlbGVjdEZpbGVzIiwiYWpheCIsImdldF9tZWRpYSIsImRhdGFUeXBlIiwiYmVmb3JlU2VuZCIsInNob3dBamF4TG9hZGluZyIsInN1Y2Nlc3MiLCJyZXMiLCJyZW5kZXJEYXRhIiwiZmV0Y2hRdW90YSIsInJlbmRlckJyZWFkY3J1bWJzIiwiYnJlYWRjcnVtYnMiLCJyZWZyZXNoRmlsdGVyIiwiQWN0aW9uc1NlcnZpY2UiLCJyZW5kZXJBY3Rpb25zIiwiZmlsZXMiLCJjb21wbGV0ZSIsImhpZGVBamF4TG9hZGluZyIsImVycm9yIiwiaGFuZGxlRXJyb3IiLCJnZXRfcXVvdGEiLCJ1c2VkIiwicXVvdGEiLCJjc3MiLCJ3aWR0aCIsInBlcmNlbnQiLCJicmVhZGNydW1iSXRlbXMiLCIkYnJlYWRjcnVtYkNvbnRhaW5lciIsInRlbXBsYXRlIiwicmVwbGFjZSIsImF0dHIiLCJzaXplIiwiJHJ2TWVkaWFDb250YWluZXIiLCIkZW1wdHlfdHJhc2hfYnRuIiwiZ2V0SXRlbXMiLCJDb250ZXh0TWVudVNlcnZpY2UiLCJkZXN0cm95Q29udGV4dCIsImluaXRDb250ZXh0IiwiZ2V0U2VsZWN0ZWRJdGVtcyIsImdldFNlbGVjdGVkRmlsZXMiLCJpbmNsdWRlcyIsInNyYyIsImZhbmN5Ym94Iiwib3BlbiIsInN0b3JlUmVjZW50SXRlbXMiLCJoYW5kbGVHbG9iYWxBY3Rpb24iLCJsaW5rcyIsImlzRW1wdHkiLCJmdWxsX3VybCIsIiRjbGlwYm9hcmRUZW1wIiwiQ2xpcGJvYXJkIiwidGV4dCIsInRyaWdnZXIiLCJjbGlwYm9hcmQiLCJzdWNjZXNzX2hlYWRlciIsImNhbGxiYWNrIiwiaXNfZm9sZGVyIiwibW9kYWwiLCJoYW5kbGVDb3B5TGluayIsImhhbmRsZVByZXZpZXciLCJkb3dubG9hZExpbmsiLCJkb3dubG9hZCIsImNvdW50IiwiZ2V0Q29uZmlncyIsIm1pbWVfdHlwZSIsInByb2Nlc3NBY3Rpb24iLCJnbG9iYWxfYWN0aW9ucyIsInJlc2V0UGFnaW5hdGlvbiIsIlZJRVciLCIkaXRlbXNXcmFwcGVyIiwiZW1wdHkiLCIkaXRlbSIsImhhc0ZvbGRlclNlbGVjdGVkIiwiZ2V0U2VsZWN0ZWRGb2xkZXIiLCJBQ1RJT05fVEVNUExBVEUiLCJpbml0aWFsaXplZF9pdGVtIiwiJGRyb3Bkb3duQWN0aW9ucyIsImFjdGlvbnNMaXN0IiwicmVqZWN0IiwicGVybWlzc2lvbnMiLCJzZWxlY3RlZEZpbGVzIiwiY2FuX3ByZXZpZXciLCJpc19icmVhayIsIkVkaXRvclNlcnZpY2UiLCJpc19ja2VkaXRvciIsIm9wZW5lciIsImZpcnN0SXRlbSIsImZpcnN0IiwiQ0tFRElUT1IiLCJ0b29scyIsImNhbGxGdW5jdGlvbiIsImNsb3NlIiwic2VsZWN0b3IiLCIkYm9keSIsImRlZmF1bHRPcHRpb25zIiwibXVsdGlwbGUiLCIkZWwiLCJjbGlja0NhbGxiYWNrIiwiZXZlbnQiLCJwcmV2ZW50RGVmYXVsdCIsIiRjdXJyZW50Iiwic3RvcmVDb25maWciLCJlbGVfb3B0aW9ucyIsImxvYWQiLCJwb3B1cCIsImFsZXJ0IiwiZG9jdW1lbnQiLCJvbiIsIlJ2TWVkaWFTdGFuZEFsb25lIiwib2ZmIiwiZWRpdG9yU2VsZWN0RmlsZSIsImZuIiwiJHNlbGVjdG9yIiwicHJvcCIsImdyb3VwIiwibGlzdCIsInRpbGVzIiwiJGdyb3VwQ29udGFpbmVyIiwibm9faXRlbSIsInRpdGxlIiwiJHJlc3VsdCIsImZvbGRlcnMiLCJmb3JFYWNoIiwiY3JlYXRlZF9hdCIsInZhbCIsInRodW1iIiwiaGFuZGxlRHJvcGRvd24iLCJNZWRpYU1hbmFnZW1lbnQiLCJVcGxvYWRTZXJ2aWNlIiwiRm9sZGVyU2VydmljZSIsInNldHVwTGF5b3V0IiwiaGFuZGxlTWVkaWFMaXN0IiwiY2hhbmdlVmlld1R5cGUiLCJjaGFuZ2VGaWx0ZXIiLCJoYW5kbGVBY3Rpb25zIiwiaW5pdCIsImhhbmRsZU1vZGFscyIsInNjcm9sbEdldE1vcmUiLCIkY3VycmVudF9maWx0ZXIiLCIkY3VycmVudF92aWV3X2luIiwiaXNVc2VJbk1vZGFsIiwiJG1lZGlhRGV0YWlsc0NoZWNrYm94Iiwic2V0VGltZW91dCIsImlzIiwiY3RybF9rZXkiLCJtZXRhX2tleSIsInNoaWZ0X2tleSIsImUiLCJjdHJsS2V5IiwibWV0YUtleSIsInNoaWZ0S2V5IiwiZmlyc3RJbmRleCIsImN1cnJlbnRJbmRleCIsIiRsaW5lQ2hlY2tCb3giLCJjaGFuZ2VGb2xkZXIiLCJ0YXJnZXQiLCJnZXRNZWRpYSIsImJpbmRJbnRlZ3JhdGVNb2RhbEV2ZW50cyIsImlzT25BamF4TG9hZGluZyIsIiRwYXJlbnQiLCIkaW5wdXQiLCJmb2xkZXJOYW1lIiwiY3JlYXRlIiwiZm9sZGVySWQiLCJyZW5kZXJSZW5hbWVJdGVtcyIsIiRmb3JtIiwiZmlsZV90eXBlIiwiZXh0X2FsbG93ZWQiLCJpc0FycmF5IiwiaW5BcnJheSIsIiRtYWluX21vZGFsIiwiY2hlY2tGaWxlVHlwZVNlbGVjdCIsImJpbmQiLCJvcmlnaW5hbEV2ZW50IiwiZGV0YWlsIiwid2hlZWxEZWx0YSIsIiRsb2FkX21vcmUiLCJzY3JvbGxUb3AiLCJpbm5lckhlaWdodCIsInNjcm9sbEhlaWdodCIsImFqYXhTZXR1cCIsImhlYWRlcnMiLCJyZWFkeSIsInNldHVwU2VjdXJpdHkiLCJqUXVlcnkiLCJjb250ZXh0TWVudSIsImJ1aWxkIiwiX2ZpbGVDb250ZXh0TWVudSIsIl9mb2xkZXJDb250ZXh0TWVudSIsInByZXZpZXciLCJvcHQiLCIkaXRlbUVsZW1lbnQiLCJpdGVtS2V5IiwiYWN0aW9uR3JvdXAiLCJleGNlcHQiLCJyZW5hbWUiLCJkZWxldGUiLCJyZXN0b3JlIiwiY29weV9saW5rIiwibWFrZV9jb3B5IiwidHJhc2giLCJmYXZvcml0ZSIsInJlbW92ZV9mYXZvcml0ZSIsIiRkZXRhaWxzV3JhcHBlciIsImRlc2NyaXB0aW9uSXRlbVRlbXBsYXRlIiwib25seUZpZWxkcyIsImV4dGVybmFsVHlwZXMiLCJkZXNjcmlwdGlvbiIsInVzZUNsaXBib2FyZCIsImFzc2V0IiwidG9vbHRpcCIsImZvY3VzIiwiY3JlYXRlX2ZvbGRlciIsInBhcmVudF9pZCIsImNsb3NlTW9kYWwiLCJkcm9wWm9uZSIsInVwbG9hZFVybCIsInVwbG9hZF9maWxlIiwidXBsb2FkUHJvZ3Jlc3NCb3giLCJ1cGxvYWRQcm9ncmVzc0NvbnRhaW5lciIsInVwbG9hZFByb2dyZXNzVGVtcGxhdGUiLCJ0b3RhbFF1ZXVlZCIsInRvdGFsRXJyb3IiLCJzZXR1cERyb3Bab25lIiwiaGFuZGxlRXZlbnRzIiwiRHJvcHpvbmUiLCJxdWVyeVNlbGVjdG9yIiwidGh1bWJuYWlsV2lkdGgiLCJ0aHVtYm5haWxIZWlnaHQiLCJwYXJhbGxlbFVwbG9hZHMiLCJhdXRvUXVldWUiLCJjbGlja2FibGUiLCJwcmV2aWV3VGVtcGxhdGUiLCJwcmV2aWV3c0NvbnRhaW5lciIsInVwbG9hZE11bHRpcGxlIiwic2VuZGluZyIsInhociIsImZvcm1EYXRhIiwiaW5pdFByb2dyZXNzIiwiY2hhbmdlUHJvZ3Jlc3NTdGF0dXMiLCIkZmlsZU5hbWUiLCIkZmlsZVNpemUiLCJmb3JtYXRGaWxlU2l6ZSIsImFuaW1hdGUiLCJoZWlnaHQiLCIkcHJvZ3Jlc3NMaW5lIiwiJGxhYmVsIiwicmVzcG9uc2UiLCJqc29uRGVjb2RlIiwicmVzcG9uc2VUZXh0Iiwic3RhdHVzIiwiZXJyb3JfaHRtbCIsImFkZFRvUmVjZW50Iiwic2V0U2VsZWN0ZWRGaWxlIiwiYnl0ZXMiLCJzaSIsInRocmVzaCIsIk1hdGgiLCJhYnMiLCJ1bml0cyIsInUiLCJ0b0ZpeGVkIiwiRXh0ZXJuYWxTZXJ2aWNlcyIsIllvdXR1YmUiLCIkbW9kYWwiLCJzZXRNZXNzYWdlIiwiYWRkX2Zyb20iLCJ5b3V0dWJlIiwib3JpZ2luYWxfbXNnIiwiY2hlY2tZb3VUdWJlVmlkZW8iLCJtc2ciLCJ2YWxpZGF0ZVlvdVR1YmVMaW5rIiwiRXh0ZXJuYWxTZXJ2aWNlQ29uZmlnIiwiYXBpX2tleSIsImludmFsaWRfdXJsX21zZyIsIm5vX2FwaV9rZXlfbXNnIiwieW91dHViZUlkIiwiZ2V0WW91VHViZUlkIiwicmVxdWVzdFVybCIsImlzUGxheWxpc3QiLCJnZXRZb3V0dWJlUGxheWxpc3RJZCIsInBsYXlsaXN0VmlkZW9DYWxsYmFjayIsInNpbmdsZVZpZGVvQ2FsbGJhY2siLCJlcnJvcl9tc2ciLCJhZGRfZXh0ZXJuYWxfc2VydmljZSIsInNuaXBwZXQiLCJwIiwiJDEiLCJyZWdFeHAiXSwibWFwcGluZ3MiOiI7QUFBQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FB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QTRCd0IxWixHQTVCeEIsRUE0QjZCO0FBQ3JCLGdCQUFJMlosU0FBUyxpRUFBYjtBQUNBLGdCQUFJclosUUFBUU4sSUFBSU0sS0FBSixDQUFVcVosTUFBVixDQUFaO0FBQ0EsZ0JBQUlyWixTQUFTQSxNQUFNLENBQU4sRUFBU0MsTUFBVCxLQUFvQixFQUFqQyxFQUFxQztBQUNqQyx1QkFBT0QsTUFBTSxDQUFOLENBQVA7QUFDSDtBQUNELG1CQUFPLElBQVA7QUFDSDtBQW5DTDtBQUFBO0FBQUEsNkNBcUNnQ04sR0FyQ2hDLEVBcUNxQztBQUM3QixnQkFBSTJaLFNBQVMsdUVBQWI7QUFDQSxnQkFBSXJaLFFBQVFOLElBQUlNLEtBQUosQ0FBVXFaLE1BQVYsQ0FBWjtBQUNBLGdCQUFJclosS0FBSixFQUFXO0FBQ1AsdUJBQU9BLE1BQU0sQ0FBTixDQUFQO0FBQ0g7QUFDRCxtQkFBTyxJQUFQO0FBQ0g7QUE1Q0w7O0FBQUE7QUFBQSxJOzs7Ozs7O0FDTEE7QUFBQSxJQUFJcVksd0JBQXdCO0FBQ3hCTCxhQUFTO0FBQ0xNLGlCQUFTO0FBREo7QUFEZSxDQUE1Qjs7Ozs7Ozs7QUNBQSx5QyIsImZpbGUiOiIvanMvbWVkaWEuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHtcbiBcdFx0XHRcdGNvbmZpZ3VyYWJsZTogZmFsc2UsXG4gXHRcdFx0XHRlbnVtZXJhYmxlOiB0cnVlLFxuIFx0XHRcdFx0Z2V0OiBnZXR0ZXJcbiBcdFx0XHR9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCJcIjtcblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSA3KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyB3ZWJwYWNrL2Jvb3RzdHJhcCBmYjVlYzZiZjlmZTgyNDE5NTA2YiIsImltcG9ydCB7TWVkaWFDb25maWcsIFJlY2VudEl0ZW1zfSBmcm9tICcuLi9Db25maWcvTWVkaWFDb25maWcnO1xuXG5leHBvcnQgY2xhc3MgSGVscGVycyB7XG4gICAgc3RhdGljIGdldFVybFBhcmFtKHBhcmFtTmFtZSwgdXJsID0gbnVsbCkge1xuICAgICAgICBpZiAoIXVybCkge1xuICAgICAgICAgICAgdXJsID0gd2luZG93LmxvY2F0aW9uLnNlYXJjaDtcbiAgICAgICAgfVxuICAgICAgICBsZXQgcmVQYXJhbSA9IG5ldyBSZWdFeHAoJyg/OltcXD8mXXwmKScgKyBwYXJhbU5hbWUgKyAnPShbXiZdKyknLCAnaScpO1xuICAgICAgICBsZXQgbWF0Y2ggPSB1cmwubWF0Y2gocmVQYXJhbSk7XG4gICAgICAgIHJldHVybiAoIG1hdGNoICYmIG1hdGNoLmxlbmd0aCA+IDEgKSA/IG1hdGNoWzFdIDogbnVsbDtcbiAgICB9XG5cbiAgICBzdGF0aWMgYXNzZXQodXJsKSB7XG4gICAgICAgIGlmICh1cmwuc3Vic3RyaW5nKDAsIDIpID09PSAnLy8nIHx8IHVybC5zdWJzdHJpbmcoMCwgNykgPT09ICdodHRwOi8vJyB8fCB1cmwuc3Vic3RyaW5nKDAsIDgpID09PSAnaHR0cHM6Ly8nKSB7XG4gICAgICAgICAgICByZXR1cm4gdXJsO1xuICAgICAgICB9XG5cbiAgICAgICAgbGV0IGJhc2VVcmwgPSBSVl9NRURJQV9VUkwuYmFzZV91cmwuc3Vic3RyKC0xLCAxKSAhPT0gJy8nID8gUlZfTUVESUFfVVJMLmJhc2VfdXJsICsgJy8nIDogUlZfTUVESUFfVVJMLmJhc2VfdXJsO1xuXG4gICAgICAgIGlmICh1cmwuc3Vic3RyaW5nKDAsIDEpID09PSAnLycpIHtcbiAgICAgICAgICAgIHJldHVybiBiYXNlVXJsICsgdXJsLnN1YnN0cmluZygxKTtcbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gYmFzZVVybCArIHVybDtcbiAgICB9XG5cbiAgICBzdGF0aWMgc2hvd0FqYXhMb2FkaW5nKCRlbGVtZW50ID0gJCgnLnJ2LW1lZGlhLW1haW4nKSkge1xuICAgICAgICAkZWxlbWVudFxuICAgICAgICAgICAgLmFkZENsYXNzKCdvbi1sb2FkaW5nJylcbiAgICAgICAgICAgIC5hcHBlbmQoJCgnI3J2X21lZGlhX2xvYWRpbmcnKS5odG1sKCkpO1xuICAgIH1cblxuICAgIHN0YXRpYyBoaWRlQWpheExvYWRpbmcoJGVsZW1lbnQgPSAkKCcucnYtbWVkaWEtbWFpbicpKSB7XG4gICAgICAgICRlbGVtZW50XG4gICAgICAgICAgICAucmVtb3ZlQ2xhc3MoJ29uLWxvYWRpbmcnKVxuICAgICAgICAgICAgLmZpbmQoJy5sb2FkaW5nLXdyYXBwZXInKS5yZW1vdmUoKTtcbiAgICB9XG5cbiAgICBzdGF0aWMgaXNPbkFqYXhMb2FkaW5nKCRlbGVtZW50ID0gJCgnLnJ2LW1lZGlhLWl0ZW1zJykpIHtcbiAgICAgICAgcmV0dXJuICRlbGVtZW50Lmhhc0NsYXNzKCdvbi1sb2FkaW5nJyk7XG4gICAgfVxuXG4gICAgc3RhdGljIGpzb25FbmNvZGUob2JqZWN0KSB7XG4gICAgICAgIFwidXNlIHN0cmljdFwiO1xuICAgICAgICBpZiAodHlwZW9mIG9iamVjdCA9PT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgIG9iamVjdCA9IG51bGw7XG4gICAgICAgIH1cbiAgICAgICAgcmV0dXJuIEpTT04uc3RyaW5naWZ5KG9iamVjdCk7XG4gICAgfTtcblxuICAgIHN0YXRpYyBqc29uRGVjb2RlKGpzb25TdHJpbmcsIGRlZmF1bHRWYWx1ZSkge1xuICAgICAgICBcInVzZSBzdHJpY3RcIjtcbiAgICAgICAgaWYgKCFqc29uU3RyaW5nKSB7XG4gICAgICAgICAgICByZXR1cm4gZGVmYXVsdFZhbHVlO1xuICAgICAgICB9XG4gICAgICAgIGlmICh0eXBlb2YganNvblN0cmluZyA9PT0gJ3N0cmluZycpIHtcbiAgICAgICAgICAgIGxldCByZXN1bHQ7XG4gICAgICAgICAgICB0cnkge1xuICAgICAgICAgICAgICAgIHJlc3VsdCA9ICQucGFyc2VKU09OKGpzb25TdHJpbmcpO1xuICAgICAgICAgICAgfSBjYXRjaCAoZXJyKSB7XG4gICAgICAgICAgICAgICAgcmVzdWx0ID0gZGVmYXVsdFZhbHVlO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgcmV0dXJuIHJlc3VsdDtcbiAgICAgICAgfVxuICAgICAgICByZXR1cm4ganNvblN0cmluZztcbiAgICB9O1xuXG4gICAgc3RhdGljIGdldFJlcXVlc3RQYXJhbXMoKSB7XG4gICAgICAgIGlmICh3aW5kb3cucnZNZWRpYS5vcHRpb25zICYmIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub3Blbl9pbiA9PT0gJ21vZGFsJykge1xuICAgICAgICAgICAgcmV0dXJuICQuZXh0ZW5kKHRydWUsIE1lZGlhQ29uZmlnLnJlcXVlc3RfcGFyYW1zLCB3aW5kb3cucnZNZWRpYS5vcHRpb25zIHx8IHt9KTtcbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXM7XG4gICAgfVxuXG4gICAgc3RhdGljIHNldFNlbGVjdGVkRmlsZSgkZmlsZV9pZCkge1xuICAgICAgICBpZiAodHlwZW9mIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICB3aW5kb3cucnZNZWRpYS5vcHRpb25zLnNlbGVjdGVkX2ZpbGVfaWQgPSAkZmlsZV9pZDtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIE1lZGlhQ29uZmlnLnJlcXVlc3RfcGFyYW1zLnNlbGVjdGVkX2ZpbGVfaWQgPSAkZmlsZV9pZDtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHN0YXRpYyBnZXRDb25maWdzKCkge1xuICAgICAgICByZXR1cm4gTWVkaWFDb25maWc7XG4gICAgfVxuXG4gICAgc3RhdGljIHN0b3JlQ29uZmlnKCkge1xuICAgICAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbSgnTWVkaWFDb25maWcnLCBIZWxwZXJzLmpzb25FbmNvZGUoTWVkaWFDb25maWcpKTtcbiAgICB9XG5cbiAgICBzdGF0aWMgc3RvcmVSZWNlbnRJdGVtcygpIHtcbiAgICAgICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oJ1JlY2VudEl0ZW1zJywgSGVscGVycy5qc29uRW5jb2RlKFJlY2VudEl0ZW1zKSk7XG4gICAgfVxuXG4gICAgc3RhdGljIGFkZFRvUmVjZW50KGlkKSB7XG4gICAgICAgIGlmIChpZCBpbnN0YW5jZW9mIEFycmF5KSB7XG4gICAgICAgICAgICBfLmVhY2goaWQsIGZ1bmN0aW9uICh2YWx1ZSkge1xuICAgICAgICAgICAgICAgIFJlY2VudEl0ZW1zLnB1c2godmFsdWUpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBSZWNlbnRJdGVtcy5wdXNoKGlkKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHN0YXRpYyBnZXRJdGVtcygpIHtcbiAgICAgICAgbGV0IGl0ZW1zID0gW107XG4gICAgICAgICQoJy5qcy1tZWRpYS1saXN0LXRpdGxlJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBsZXQgJGJveCA9ICQodGhpcyk7XG4gICAgICAgICAgICBsZXQgZGF0YSA9ICRib3guZGF0YSgpIHx8IHt9O1xuICAgICAgICAgICAgZGF0YS5pbmRleF9rZXkgPSAkYm94LmluZGV4KCk7XG4gICAgICAgICAgICBpdGVtcy5wdXNoKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICAgICAgcmV0dXJuIGl0ZW1zO1xuICAgIH1cblxuICAgIHN0YXRpYyBnZXRTZWxlY3RlZEl0ZW1zKCkge1xuICAgICAgICBsZXQgc2VsZWN0ZWQgPSBbXTtcbiAgICAgICAgJCgnLmpzLW1lZGlhLWxpc3QtdGl0bGUgaW5wdXRbdHlwZT1jaGVja2JveF06Y2hlY2tlZCcpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgbGV0ICRib3ggPSAkKHRoaXMpLmNsb3Nlc3QoJy5qcy1tZWRpYS1saXN0LXRpdGxlJyk7XG4gICAgICAgICAgICBsZXQgZGF0YSA9ICRib3guZGF0YSgpIHx8IHt9O1xuICAgICAgICAgICAgZGF0YS5pbmRleF9rZXkgPSAkYm94LmluZGV4KCk7XG4gICAgICAgICAgICBzZWxlY3RlZC5wdXNoKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICAgICAgcmV0dXJuIHNlbGVjdGVkO1xuICAgIH1cblxuICAgIHN0YXRpYyBnZXRTZWxlY3RlZEZpbGVzKCkge1xuICAgICAgICBsZXQgc2VsZWN0ZWQgPSBbXTtcbiAgICAgICAgJCgnLmpzLW1lZGlhLWxpc3QtdGl0bGVbZGF0YS1jb250ZXh0PWZpbGVdIGlucHV0W3R5cGU9Y2hlY2tib3hdOmNoZWNrZWQnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGxldCAkYm94ID0gJCh0aGlzKS5jbG9zZXN0KCcuanMtbWVkaWEtbGlzdC10aXRsZScpO1xuICAgICAgICAgICAgbGV0IGRhdGEgPSAkYm94LmRhdGEoKSB8fCB7fTtcbiAgICAgICAgICAgIGRhdGEuaW5kZXhfa2V5ID0gJGJveC5pbmRleCgpO1xuICAgICAgICAgICAgc2VsZWN0ZWQucHVzaChkYXRhKTtcbiAgICAgICAgfSk7XG4gICAgICAgIHJldHVybiBzZWxlY3RlZDtcbiAgICB9XG5cbiAgICBzdGF0aWMgZ2V0U2VsZWN0ZWRGb2xkZXIoKSB7XG4gICAgICAgIGxldCBzZWxlY3RlZCA9IFtdO1xuICAgICAgICAkKCcuanMtbWVkaWEtbGlzdC10aXRsZVtkYXRhLWNvbnRleHQ9Zm9sZGVyXSBpbnB1dFt0eXBlPWNoZWNrYm94XTpjaGVja2VkJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBsZXQgJGJveCA9ICQodGhpcykuY2xvc2VzdCgnLmpzLW1lZGlhLWxpc3QtdGl0bGUnKTtcbiAgICAgICAgICAgIGxldCBkYXRhID0gJGJveC5kYXRhKCkgfHwge307XG4gICAgICAgICAgICBkYXRhLmluZGV4X2tleSA9ICRib3guaW5kZXgoKTtcbiAgICAgICAgICAgIHNlbGVjdGVkLnB1c2goZGF0YSk7XG4gICAgICAgIH0pO1xuICAgICAgICByZXR1cm4gc2VsZWN0ZWQ7XG4gICAgfVxuXG4gICAgc3RhdGljIGlzVXNlSW5Nb2RhbCgpIHtcbiAgICAgICAgcmV0dXJuIEhlbHBlcnMuZ2V0VXJsUGFyYW0oJ21lZGlhLWFjdGlvbicpID09PSAnc2VsZWN0LWZpbGVzJyB8fCAod2luZG93LnJ2TWVkaWEgJiYgd2luZG93LnJ2TWVkaWEub3B0aW9ucyAmJiB3aW5kb3cucnZNZWRpYS5vcHRpb25zLm9wZW5faW4gPT09ICdtb2RhbCcpO1xuICAgIH1cblxuICAgIHN0YXRpYyByZXNldFBhZ2luYXRpb24oKSB7XG4gICAgICAgIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uID0geyBwYWdlZDogMSwgcG9zdHNfcGVyX3BhZ2U6IDQwLCBpbl9wcm9jZXNzX2dldF9tZWRpYTogZmFsc2UsIGhhc19tb3JlOiB0cnVlfTtcbiAgICB9XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9IZWxwZXJzL0hlbHBlcnMuanMiLCJsZXQgTWVkaWFDb25maWcgPSAkLnBhcnNlSlNPTihsb2NhbFN0b3JhZ2UuZ2V0SXRlbSgnTWVkaWFDb25maWcnKSkgfHwge307XG5cbmxldCBkZWZhdWx0Q29uZmlnID0ge1xuICAgIGFwcF9rZXk6ICc0ODNhMHh5enl0ejEyNDJjMGQ1MjA0MjZlOGJhMzY2YzUzMGMzZDlkYWJjJyxcbiAgICByZXF1ZXN0X3BhcmFtczoge1xuICAgICAgICB2aWV3X3R5cGU6ICd0aWxlcycsXG4gICAgICAgIGZpbHRlcjogJ2V2ZXJ5dGhpbmcnLFxuICAgICAgICB2aWV3X2luOiAnYWxsX21lZGlhJyxcbiAgICAgICAgc2VhcmNoOiAnJyxcbiAgICAgICAgc29ydF9ieTogJ2NyZWF0ZWRfYXQtZGVzYycsXG4gICAgICAgIGZvbGRlcl9pZDogMCxcbiAgICB9LFxuICAgIGhpZGVfZGV0YWlsc19wYW5lOiBmYWxzZSxcbiAgICBpY29uczoge1xuICAgICAgICBmb2xkZXI6ICdmYSBmYS1mb2xkZXItbycsXG4gICAgfSxcbiAgICBhY3Rpb25zX2xpc3Q6IHtcbiAgICAgICAgYmFzaWM6IFtcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtZXllJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnUHJldmlldycsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAncHJldmlldycsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDAsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tcHJldmlldycsXG4gICAgICAgICAgICB9LFxuICAgICAgICBdLFxuICAgICAgICBmaWxlOiBbXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLWxpbmsnLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdDb3B5IGxpbmsnLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogJ2NvcHlfbGluaycsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDAsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tY29weS1saW5rJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLXBlbmNpbCcsXG4gICAgICAgICAgICAgICAgbmFtZTogJ1JlbmFtZScsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAncmVuYW1lJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMSxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1yZW5hbWUnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtY29weScsXG4gICAgICAgICAgICAgICAgbmFtZTogJ01ha2UgYSBjb3B5JyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdtYWtlX2NvcHknLFxuICAgICAgICAgICAgICAgIG9yZGVyOiAyLFxuICAgICAgICAgICAgICAgIGNsYXNzOiAncnYtYWN0aW9uLW1ha2UtY29weScsXG4gICAgICAgICAgICB9LFxuICAgICAgICBdLFxuICAgICAgICB1c2VyOiBbXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLXN0YXInLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdGYXZvcml0ZScsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAnZmF2b3JpdGUnLFxuICAgICAgICAgICAgICAgIG9yZGVyOiAyLFxuICAgICAgICAgICAgICAgIGNsYXNzOiAncnYtYWN0aW9uLWZhdm9yaXRlJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgaWNvbjogJ2ZhIGZhLXN0YXItbycsXG4gICAgICAgICAgICAgICAgbmFtZTogJ1JlbW92ZSBmYXZvcml0ZScsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAncmVtb3ZlX2Zhdm9yaXRlJyxcbiAgICAgICAgICAgICAgICBvcmRlcjogMyxcbiAgICAgICAgICAgICAgICBjbGFzczogJ3J2LWFjdGlvbi1mYXZvcml0ZScsXG4gICAgICAgICAgICB9LFxuICAgICAgICBdLFxuICAgICAgICBvdGhlcjogW1xuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS1kb3dubG9hZCcsXG4gICAgICAgICAgICAgICAgbmFtZTogJ0Rvd25sb2FkJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdkb3dubG9hZCcsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDAsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tZG93bmxvYWQnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtdHJhc2gnLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdNb3ZlIHRvIHRyYXNoJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICd0cmFzaCcsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDEsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tdHJhc2gnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBpY29uOiAnZmEgZmEtZXJhc2VyJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnRGVsZXRlIHBlcm1hbmVudGx5JyxcbiAgICAgICAgICAgICAgICBhY3Rpb246ICdkZWxldGUnLFxuICAgICAgICAgICAgICAgIG9yZGVyOiAyLFxuICAgICAgICAgICAgICAgIGNsYXNzOiAncnYtYWN0aW9uLWRlbGV0ZScsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS11bmRvJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnUmVzdG9yZScsXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAncmVzdG9yZScsXG4gICAgICAgICAgICAgICAgb3JkZXI6IDMsXG4gICAgICAgICAgICAgICAgY2xhc3M6ICdydi1hY3Rpb24tcmVzdG9yZScsXG4gICAgICAgICAgICB9LFxuICAgICAgICBdLFxuICAgIH0sXG4gICAgZGVuaWVkX2Rvd25sb2FkOiBbXG4gICAgICAgICd5b3V0dWJlJyxcbiAgICBdLFxufTtcblxuaWYgKCFNZWRpYUNvbmZpZy5hcHBfa2V5IHx8IE1lZGlhQ29uZmlnLmFwcF9rZXkgIT09IGRlZmF1bHRDb25maWcuYXBwX2tleSkge1xuICAgIE1lZGlhQ29uZmlnID0gZGVmYXVsdENvbmZpZztcbn1cblxubGV0IFJlY2VudEl0ZW1zID0gJC5wYXJzZUpTT04obG9jYWxTdG9yYWdlLmdldEl0ZW0oJ1JlY2VudEl0ZW1zJykpIHx8IFtdO1xuXG5leHBvcnQge01lZGlhQ29uZmlnLCBSZWNlbnRJdGVtc307XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9Db25maWcvTWVkaWFDb25maWcuanMiLCJleHBvcnQgY2xhc3MgTWVzc2FnZVNlcnZpY2Uge1xuICAgIHN0YXRpYyBzaG93TWVzc2FnZSh0eXBlLCBtZXNzYWdlLCBtZXNzYWdlSGVhZGVyKSB7XG4gICAgICAgIHRvYXN0ci5vcHRpb25zID0ge1xuICAgICAgICAgICAgY2xvc2VCdXR0b246IHRydWUsXG4gICAgICAgICAgICBwcm9ncmVzc0JhcjogdHJ1ZSxcbiAgICAgICAgICAgIHBvc2l0aW9uQ2xhc3M6ICd0b2FzdC1ib3R0b20tcmlnaHQnLFxuICAgICAgICAgICAgb25jbGljazogbnVsbCxcbiAgICAgICAgICAgIHNob3dEdXJhdGlvbjogMTAwMCxcbiAgICAgICAgICAgIGhpZGVEdXJhdGlvbjogMTAwMCxcbiAgICAgICAgICAgIHRpbWVPdXQ6IDEwMDAwLFxuICAgICAgICAgICAgZXh0ZW5kZWRUaW1lT3V0OiAxMDAwLFxuICAgICAgICAgICAgc2hvd0Vhc2luZzogJ3N3aW5nJyxcbiAgICAgICAgICAgIGhpZGVFYXNpbmc6ICdsaW5lYXInLFxuICAgICAgICAgICAgc2hvd01ldGhvZDogJ2ZhZGVJbicsXG4gICAgICAgICAgICBoaWRlTWV0aG9kOiAnZmFkZU91dCdcbiAgICAgICAgfTtcbiAgICAgICAgdG9hc3RyW3R5cGVdKG1lc3NhZ2UsIG1lc3NhZ2VIZWFkZXIpO1xuICAgIH1cblxuICAgIHN0YXRpYyBoYW5kbGVFcnJvcihkYXRhKSB7XG4gICAgICAgIGlmICh0eXBlb2YgKGRhdGEucmVzcG9uc2VKU09OKSAhPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgIGlmICh0eXBlb2YgKGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2UpICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgIE1lc3NhZ2VTZXJ2aWNlLnNob3dNZXNzYWdlKCdlcnJvcicsIGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2UsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5lcnJvcl9oZWFkZXIpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAkLmVhY2goZGF0YS5yZXNwb25zZUpTT04sIGZ1bmN0aW9uIChpbmRleCwgZWwpIHtcbiAgICAgICAgICAgICAgICAgICAgJC5lYWNoKGVsLCBmdW5jdGlvbiAoa2V5LCBpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnZXJyb3InLCBpdGVtLCBSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLm1lc3NhZ2UuZXJyb3JfaGVhZGVyKTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnZXJyb3InLCBkYXRhLnN0YXR1c1RleHQsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5lcnJvcl9oZWFkZXIpO1xuICAgICAgICB9XG4gICAgfVxufVxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1NlcnZpY2VzL01lc3NhZ2VTZXJ2aWNlLmpzIiwiaW1wb3J0IHtSZWNlbnRJdGVtc30gZnJvbSAnLi4vQ29uZmlnL01lZGlhQ29uZmlnJztcbmltcG9ydCB7SGVscGVyc30gZnJvbSAnLi4vSGVscGVycy9IZWxwZXJzJztcbmltcG9ydCB7TWVzc2FnZVNlcnZpY2V9IGZyb20gJy4uL1NlcnZpY2VzL01lc3NhZ2VTZXJ2aWNlJztcbmltcG9ydCB7QWN0aW9uc1NlcnZpY2V9IGZyb20gJy4uL1NlcnZpY2VzL0FjdGlvbnNTZXJ2aWNlJztcbmltcG9ydCB7Q29udGV4dE1lbnVTZXJ2aWNlfSBmcm9tICcuLi9TZXJ2aWNlcy9Db250ZXh0TWVudVNlcnZpY2UnO1xuaW1wb3J0IHtNZWRpYUxpc3R9IGZyb20gJy4uL1ZpZXdzL01lZGlhTGlzdCc7XG5pbXBvcnQge01lZGlhRGV0YWlsc30gZnJvbSAnLi4vVmlld3MvTWVkaWFEZXRhaWxzJztcblxuZXhwb3J0IGNsYXNzIE1lZGlhU2VydmljZSB7XG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMuTWVkaWFMaXN0ID0gbmV3IE1lZGlhTGlzdCgpO1xuICAgICAgICB0aGlzLk1lZGlhRGV0YWlscyA9IG5ldyBNZWRpYURldGFpbHMoKTtcbiAgICAgICAgdGhpcy5icmVhZGNydW1iVGVtcGxhdGUgPSAkKCcjcnZfbWVkaWFfYnJlYWRjcnVtYl9pdGVtJykuaHRtbCgpO1xuICAgIH1cblxuICAgIGdldE1lZGlhKHJlbG9hZCA9IGZhbHNlLCBpc19wb3B1cCA9IGZhbHNlLCBsb2FkX21vcmVfZmlsZSA9IGZhbHNlKSB7XG4gICAgICAgIGlmKHR5cGVvZiBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbiAhPSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgaWYgKFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLmluX3Byb2Nlc3NfZ2V0X21lZGlhKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5pbl9wcm9jZXNzX2dldF9tZWRpYSA9IHRydWU7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBsZXQgX3NlbGYgPSB0aGlzO1xuXG4gICAgICAgIF9zZWxmLmdldEZpbGVEZXRhaWxzKHtcbiAgICAgICAgICAgIGljb246ICdmYSBmYS1waWN0dXJlLW8nLFxuICAgICAgICAgICAgbm90aGluZ19zZWxlY3RlZDogJycsXG4gICAgICAgIH0pO1xuXG4gICAgICAgIGxldCBwYXJhbXMgPSBIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKTtcblxuICAgICAgICBpZiAocGFyYW1zLnZpZXdfaW4gPT09ICdyZWNlbnQnKSB7XG4gICAgICAgICAgICBwYXJhbXMucmVjZW50X2l0ZW1zID0gUmVjZW50SXRlbXM7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoaXNfcG9wdXAgPT09IHRydWUpIHtcbiAgICAgICAgICAgIHBhcmFtcy5pc19wb3B1cCA9IHRydWU7XG4gICAgICAgIH0gZWxzZXtcbiAgICAgICAgICAgIHBhcmFtcy5pc19wb3B1cCA9IHVuZGVmaW5lZDtcbiAgICAgICAgfVxuXG4gICAgICAgIHBhcmFtcy5vblNlbGVjdEZpbGVzID0gdW5kZWZpbmVkO1xuXG4gICAgICAgIGlmICh0eXBlb2YgcGFyYW1zLnNlYXJjaCAhPSAndW5kZWZpbmVkJyAmJiBwYXJhbXMuc2VhcmNoICE9ICcnICYmIHR5cGVvZiBwYXJhbXMuc2VsZWN0ZWRfZmlsZV9pZCAhPSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgcGFyYW1zLnNlbGVjdGVkX2ZpbGVfaWQgPSB1bmRlZmluZWRcbiAgICAgICAgfVxuXG4gICAgICAgIHBhcmFtcy5sb2FkX21vcmVfZmlsZSA9IGxvYWRfbW9yZV9maWxlO1xuICAgICAgICBpZiAodHlwZW9mIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICBwYXJhbXMucGFnZWQgPSBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5wYWdlZDtcbiAgICAgICAgICAgIHBhcmFtcy5wb3N0c19wZXJfcGFnZSA9IFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLnBvc3RzX3Blcl9wYWdlO1xuICAgICAgICB9XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IFJWX01FRElBX1VSTC5nZXRfbWVkaWEsXG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIGRhdGE6IHBhcmFtcyxcbiAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgSGVscGVycy5zaG93QWpheExvYWRpbmcoKTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAocmVzKSB7XG4gICAgICAgICAgICAgICAgX3NlbGYuTWVkaWFMaXN0LnJlbmRlckRhdGEocmVzLmRhdGEsIHJlbG9hZCwgbG9hZF9tb3JlX2ZpbGUpO1xuICAgICAgICAgICAgICAgIF9zZWxmLmZldGNoUXVvdGEoKTtcbiAgICAgICAgICAgICAgICBfc2VsZi5yZW5kZXJCcmVhZGNydW1icyhyZXMuZGF0YS5icmVhZGNydW1icyk7XG4gICAgICAgICAgICAgICAgTWVkaWFTZXJ2aWNlLnJlZnJlc2hGaWx0ZXIoKTtcbiAgICAgICAgICAgICAgICBBY3Rpb25zU2VydmljZS5yZW5kZXJBY3Rpb25zKCk7XG5cbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIGlmICh0eXBlb2YgUlZfTUVESUFfQ09ORklHLnBhZ2luYXRpb24ucGFnZWQgIT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLnBhZ2VkICs9IDE7XG4gICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICAgICBpZiAodHlwZW9mIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLmluX3Byb2Nlc3NfZ2V0X21lZGlhICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5pbl9wcm9jZXNzX2dldF9tZWRpYSA9IGZhbHNlO1xuICAgICAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAgICAgaWYgKHR5cGVvZiBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5wb3N0c19wZXJfcGFnZSAhPSAndW5kZWZpbmVkJyAmJiByZXMuZGF0YS5maWxlcy5sZW5ndGggPCBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5wb3N0c19wZXJfcGFnZSAmJiB0eXBlb2YgUlZfTUVESUFfQ09ORklHLnBhZ2luYXRpb24uaGFzX21vcmUgIT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLmhhc19tb3JlID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgY29tcGxldGU6IGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgSGVscGVycy5oaWRlQWpheExvYWRpbmcoKTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5oYW5kbGVFcnJvcihkYXRhKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgZ2V0RmlsZURldGFpbHMoZGF0YSkge1xuICAgICAgICB0aGlzLk1lZGlhRGV0YWlscy5yZW5kZXJEYXRhKGRhdGEpO1xuICAgIH1cblxuICAgIGZldGNoUXVvdGEoKSB7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IFJWX01FRElBX1VSTC5nZXRfcXVvdGEsXG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAocmVzKSB7XG4gICAgICAgICAgICAgICAgbGV0IGRhdGEgPSByZXMuZGF0YTtcblxuICAgICAgICAgICAgICAgICQoJy5ydi1tZWRpYS1hc2lkZS1ib3R0b20gLnVzZWQtYW5hbHl0aWNzIHNwYW4nKS5odG1sKGRhdGEudXNlZCArICcgLyAnICsgZGF0YS5xdW90YSk7XG4gICAgICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWFzaWRlLWJvdHRvbSAucHJvZ3Jlc3MtYmFyJykuY3NzKHtcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGRhdGEucGVyY2VudCArICclJyxcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5oYW5kbGVFcnJvcihkYXRhKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgcmVuZGVyQnJlYWRjcnVtYnMoYnJlYWRjcnVtYkl0ZW1zKSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG4gICAgICAgIGxldCAkYnJlYWRjcnVtYkNvbnRhaW5lciA9ICQoJy5ydi1tZWRpYS1icmVhZGNydW1iIC5icmVhZGNydW1iJyk7XG4gICAgICAgICRicmVhZGNydW1iQ29udGFpbmVyLmZpbmQoJ2xpJykucmVtb3ZlKCk7XG5cbiAgICAgICAgXy5lYWNoKGJyZWFkY3J1bWJJdGVtcywgZnVuY3Rpb24gKHZhbHVlLCBpbmRleCkge1xuICAgICAgICAgICAgbGV0IHRlbXBsYXRlID0gX3NlbGYuYnJlYWRjcnVtYlRlbXBsYXRlO1xuICAgICAgICAgICAgdGVtcGxhdGUgPSB0ZW1wbGF0ZVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX25hbWVfXy9naSwgdmFsdWUubmFtZSB8fCAnJylcbiAgICAgICAgICAgICAgICAucmVwbGFjZSgvX19pY29uX18vZ2ksIHZhbHVlLmljb24gPyAnPGkgY2xhc3M9XCInICsgdmFsdWUuaWNvbiArICdcIj48L2k+JyA6ICcnKVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX2ZvbGRlcklkX18vZ2ksIHZhbHVlLmlkIHx8IDApO1xuICAgICAgICAgICAgJGJyZWFkY3J1bWJDb250YWluZXIuYXBwZW5kKCQodGVtcGxhdGUpKTtcbiAgICAgICAgfSk7XG4gICAgICAgICQoJy5ydi1tZWRpYS1jb250YWluZXInKS5hdHRyKCdkYXRhLWJyZWFkY3J1bWItY291bnQnLCBfLnNpemUoYnJlYWRjcnVtYkl0ZW1zKSk7XG4gICAgfVxuXG4gICAgc3RhdGljIHJlZnJlc2hGaWx0ZXIoKSB7XG4gICAgICAgIGxldCAkcnZNZWRpYUNvbnRhaW5lciA9ICQoJy5ydi1tZWRpYS1jb250YWluZXInKTtcbiAgICAgICAgbGV0IHZpZXdfaW4gPSBIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKS52aWV3X2luO1xuICAgICAgICBpZiAodmlld19pbiAhPT0gJ2FsbF9tZWRpYScgJiYgSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkuZm9sZGVyX2lkID09IDApIHtcbiAgICAgICAgICAgICQoJy5ydi1tZWRpYS1hY3Rpb25zIC5idG46bm90KFtkYXRhLXR5cGU9XCJyZWZyZXNoXCJdKTpub3QobGFiZWwpJykuYWRkQ2xhc3MoJ2Rpc2FibGVkJyk7XG4gICAgICAgICAgICAkcnZNZWRpYUNvbnRhaW5lci5hdHRyKCdkYXRhLWFsbG93LXVwbG9hZCcsICdmYWxzZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWFjdGlvbnMgLmJ0bjpub3QoW2RhdGEtdHlwZT1cInJlZnJlc2hcIl0pOm5vdChsYWJlbCknKS5yZW1vdmVDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgICAgICRydk1lZGlhQ29udGFpbmVyLmF0dHIoJ2RhdGEtYWxsb3ctdXBsb2FkJywgJ3RydWUnKTtcbiAgICAgICAgfVxuXG4gICAgICAgICQoJy5ydi1tZWRpYS1hY3Rpb25zIC5idG4uanMtcnYtbWVkaWEtY2hhbmdlLWZpbHRlci1ncm91cCcpLnJlbW92ZUNsYXNzKCdkaXNhYmxlZCcpO1xuXG4gICAgICAgIGxldCAkZW1wdHlfdHJhc2hfYnRuID0gJCgnLnJ2LW1lZGlhLWFjdGlvbnMgLmJ0bltkYXRhLWFjdGlvbj1cImVtcHR5X3RyYXNoXCJdJyk7XG4gICAgICAgIGlmICh2aWV3X2luID09PSAndHJhc2gnKSB7XG4gICAgICAgICAgICAkZW1wdHlfdHJhc2hfYnRuLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5yZW1vdmVDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgICAgIGlmICghXy5zaXplKEhlbHBlcnMuZ2V0SXRlbXMoKSkpIHtcbiAgICAgICAgICAgICAgICAkZW1wdHlfdHJhc2hfYnRuLmFkZENsYXNzKCdoaWRkZW4nKS5hZGRDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICRlbXB0eV90cmFzaF9idG4uYWRkQ2xhc3MoJ2hpZGRlbicpO1xuICAgICAgICB9XG5cbiAgICAgICAgQ29udGV4dE1lbnVTZXJ2aWNlLmRlc3Ryb3lDb250ZXh0KCk7XG4gICAgICAgIENvbnRleHRNZW51U2VydmljZS5pbml0Q29udGV4dCgpO1xuXG4gICAgICAgICRydk1lZGlhQ29udGFpbmVyLmF0dHIoJ2RhdGEtdmlldy1pbicsIHZpZXdfaW4pO1xuICAgIH1cbn1cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9NZWRpYVNlcnZpY2UuanMiLCJpbXBvcnQge1JlY2VudEl0ZW1zfSBmcm9tICcuLi9Db25maWcvTWVkaWFDb25maWcnO1xuaW1wb3J0IHtIZWxwZXJzfSBmcm9tICcuLi9IZWxwZXJzL0hlbHBlcnMnO1xuaW1wb3J0IHtNZXNzYWdlU2VydmljZX0gZnJvbSAnLi4vU2VydmljZXMvTWVzc2FnZVNlcnZpY2UnO1xuXG5leHBvcnQgY2xhc3MgQWN0aW9uc1NlcnZpY2Uge1xuICAgIHN0YXRpYyBoYW5kbGVEcm9wZG93bigpIHtcbiAgICAgICAgbGV0IHNlbGVjdGVkID0gXy5zaXplKEhlbHBlcnMuZ2V0U2VsZWN0ZWRJdGVtcygpKTtcblxuICAgICAgICBBY3Rpb25zU2VydmljZS5yZW5kZXJBY3Rpb25zKCk7XG5cbiAgICAgICAgaWYgKHNlbGVjdGVkID4gMCkge1xuICAgICAgICAgICAgJCgnLnJ2LWRyb3Bkb3duLWFjdGlvbnMnKS5yZW1vdmVDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICQoJy5ydi1kcm9wZG93bi1hY3Rpb25zJykuYWRkQ2xhc3MoJ2Rpc2FibGVkJyk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBzdGF0aWMgaGFuZGxlUHJldmlldygpIHtcbiAgICAgICAgbGV0IHNlbGVjdGVkID0gW107XG5cbiAgICAgICAgXy5lYWNoKEhlbHBlcnMuZ2V0U2VsZWN0ZWRGaWxlcygpLCBmdW5jdGlvbiAodmFsdWUsIGluZGV4KSB7XG4gICAgICAgICAgICBpZiAoXy5pbmNsdWRlcyhbJ2ltYWdlJywgJ3lvdXR1YmUnLCAncGRmJywgJ3RleHQnLCAndmlkZW8nXSwgdmFsdWUudHlwZSkpIHtcbiAgICAgICAgICAgICAgICBzZWxlY3RlZC5wdXNoKHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiB2YWx1ZS51cmxcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICBSZWNlbnRJdGVtcy5wdXNoKHZhbHVlLmlkKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgaWYgKF8uc2l6ZShzZWxlY3RlZCkgPiAwKSB7XG4gICAgICAgICAgICAkLmZhbmN5Ym94Lm9wZW4oc2VsZWN0ZWQpO1xuICAgICAgICAgICAgSGVscGVycy5zdG9yZVJlY2VudEl0ZW1zKCk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICB0aGlzLmhhbmRsZUdsb2JhbEFjdGlvbignZG93bmxvYWQnKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHN0YXRpYyBoYW5kbGVDb3B5TGluaygpIHtcbiAgICAgICAgbGV0IGxpbmtzID0gJyc7XG4gICAgICAgIF8uZWFjaChIZWxwZXJzLmdldFNlbGVjdGVkRmlsZXMoKSwgZnVuY3Rpb24gKHZhbHVlLCBpbmRleCkge1xuICAgICAgICAgICAgaWYgKCFfLmlzRW1wdHkobGlua3MpKSB7XG4gICAgICAgICAgICAgICAgbGlua3MgKz0gJ1xcbic7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBsaW5rcyArPSB2YWx1ZS5mdWxsX3VybDtcbiAgICAgICAgfSk7XG4gICAgICAgIGxldCAkY2xpcGJvYXJkVGVtcCA9ICQoJy5qcy1ydi1jbGlwYm9hcmQtdGVtcCcpO1xuICAgICAgICAkY2xpcGJvYXJkVGVtcC5kYXRhKCdjbGlwYm9hcmQtdGV4dCcsIGxpbmtzKTtcbiAgICAgICAgbmV3IENsaXBib2FyZCgnLmpzLXJ2LWNsaXBib2FyZC10ZW1wJywge1xuICAgICAgICAgICAgdGV4dDogZnVuY3Rpb24gKHRyaWdnZXIpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gbGlua3M7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnc3VjY2VzcycsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMuY2xpcGJvYXJkLnN1Y2Nlc3MsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5zdWNjZXNzX2hlYWRlcik7XG4gICAgICAgICRjbGlwYm9hcmRUZW1wLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgfVxuXG4gICAgc3RhdGljIGhhbmRsZUdsb2JhbEFjdGlvbih0eXBlLCBjYWxsYmFjaykge1xuICAgICAgICBsZXQgc2VsZWN0ZWQgPSBbXTtcbiAgICAgICAgXy5lYWNoKEhlbHBlcnMuZ2V0U2VsZWN0ZWRJdGVtcygpLCBmdW5jdGlvbiAodmFsdWUsIGluZGV4KSB7XG4gICAgICAgICAgICBzZWxlY3RlZC5wdXNoKHtcbiAgICAgICAgICAgICAgICBpc19mb2xkZXI6IHZhbHVlLmlzX2ZvbGRlcixcbiAgICAgICAgICAgICAgICBpZDogdmFsdWUuaWQsXG4gICAgICAgICAgICAgICAgZnVsbF91cmw6IHZhbHVlLmZ1bGxfdXJsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgc3dpdGNoICh0eXBlKSB7XG4gICAgICAgICAgICBjYXNlICdyZW5hbWUnOlxuICAgICAgICAgICAgICAgICQoJyNtb2RhbF9yZW5hbWVfaXRlbXMnKS5tb2RhbCgnc2hvdycpLmZpbmQoJ2Zvcm0ucnYtZm9ybScpLmRhdGEoJ2FjdGlvbicsIHR5cGUpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAnY29weV9saW5rJzpcbiAgICAgICAgICAgICAgICBBY3Rpb25zU2VydmljZS5oYW5kbGVDb3B5TGluaygpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAncHJldmlldyc6XG4gICAgICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UuaGFuZGxlUHJldmlldygpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAndHJhc2gnOlxuICAgICAgICAgICAgICAgICQoJyNtb2RhbF90cmFzaF9pdGVtcycpLm1vZGFsKCdzaG93JykuZmluZCgnZm9ybS5ydi1mb3JtJykuZGF0YSgnYWN0aW9uJywgdHlwZSk7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlICdkZWxldGUnOlxuICAgICAgICAgICAgICAgICQoJyNtb2RhbF9kZWxldGVfaXRlbXMnKS5tb2RhbCgnc2hvdycpLmZpbmQoJ2Zvcm0ucnYtZm9ybScpLmRhdGEoJ2FjdGlvbicsIHR5cGUpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAnZW1wdHlfdHJhc2gnOlxuICAgICAgICAgICAgICAgICQoJyNtb2RhbF9lbXB0eV90cmFzaCcpLm1vZGFsKCdzaG93JykuZmluZCgnZm9ybS5ydi1mb3JtJykuZGF0YSgnYWN0aW9uJywgdHlwZSk7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlICdkb3dubG9hZCc6XG4gICAgICAgICAgICAgICAgbGV0IGRvd25sb2FkTGluayA9IFJWX01FRElBX1VSTC5kb3dubG9hZDtcbiAgICAgICAgICAgICAgICBsZXQgY291bnQgPSAwO1xuICAgICAgICAgICAgICAgIF8uZWFjaChIZWxwZXJzLmdldFNlbGVjdGVkSXRlbXMoKSwgZnVuY3Rpb24gKHZhbHVlLCBpbmRleCkge1xuICAgICAgICAgICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoSGVscGVycy5nZXRDb25maWdzKCkuZGVuaWVkX2Rvd25sb2FkLCB2YWx1ZS5taW1lX3R5cGUpKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBkb3dubG9hZExpbmsgKz0gKGNvdW50ID09PSAwID8gJz8nIDogJyYnKSArICdzZWxlY3RlZFsnICsgY291bnQgKyAnXVtpc19mb2xkZXJdPScgKyB2YWx1ZS5pc19mb2xkZXIgKyAnJnNlbGVjdGVkWycgKyBjb3VudCArICddW2lkXT0nICsgdmFsdWUuaWQ7XG4gICAgICAgICAgICAgICAgICAgICAgICBjb3VudCsrO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgaWYgKGRvd25sb2FkTGluayAhPT0gUlZfTUVESUFfVVJMLmRvd25sb2FkKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5vcGVuKGRvd25sb2FkTGluaywgJ19ibGFuaycpO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIE1lc3NhZ2VTZXJ2aWNlLnNob3dNZXNzYWdlKCdlcnJvcicsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMuZG93bmxvYWQuZXJyb3IsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5lcnJvcl9oZWFkZXIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGRlZmF1bHQ6XG4gICAgICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UucHJvY2Vzc0FjdGlvbih7XG4gICAgICAgICAgICAgICAgICAgIHNlbGVjdGVkOiBzZWxlY3RlZCxcbiAgICAgICAgICAgICAgICAgICAgYWN0aW9uOiB0eXBlXG4gICAgICAgICAgICAgICAgfSwgY2FsbGJhY2spO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc3RhdGljIHByb2Nlc3NBY3Rpb24oZGF0YSwgY2FsbGJhY2sgPSBudWxsKSB7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IFJWX01FRElBX1VSTC5nbG9iYWxfYWN0aW9ucyxcbiAgICAgICAgICAgIHR5cGU6ICdQT1NUJyxcbiAgICAgICAgICAgIGRhdGE6IGRhdGEsXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIEhlbHBlcnMuc2hvd0FqYXhMb2FkaW5nKCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgIEhlbHBlcnMucmVzZXRQYWdpbmF0aW9uKCk7XG4gICAgICAgICAgICAgICAgaWYgKCFyZXMuZXJyb3IpIHtcbiAgICAgICAgICAgICAgICAgICAgTWVzc2FnZVNlcnZpY2Uuc2hvd01lc3NhZ2UoJ3N1Y2Nlc3MnLCByZXMubWVzc2FnZSwgUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5tZXNzYWdlLnN1Y2Nlc3NfaGVhZGVyKTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnZXJyb3InLCByZXMubWVzc2FnZSwgUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5tZXNzYWdlLmVycm9yX2hlYWRlcik7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGlmIChjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgICAgICBjYWxsYmFjayhyZXMpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjb21wbGV0ZTogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICBIZWxwZXJzLmhpZGVBamF4TG9hZGluZygpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgIE1lc3NhZ2VTZXJ2aWNlLmhhbmRsZUVycm9yKGRhdGEpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzdGF0aWMgcmVuZGVyUmVuYW1lSXRlbXMoKSB7XG4gICAgICAgIGxldCBWSUVXID0gJCgnI3J2X21lZGlhX3JlbmFtZV9pdGVtJykuaHRtbCgpO1xuICAgICAgICBsZXQgJGl0ZW1zV3JhcHBlciA9ICQoJyNtb2RhbF9yZW5hbWVfaXRlbXMgLnJlbmFtZS1pdGVtcycpLmVtcHR5KCk7XG5cbiAgICAgICAgXy5lYWNoKEhlbHBlcnMuZ2V0U2VsZWN0ZWRJdGVtcygpLCBmdW5jdGlvbiAodmFsdWUsIGluZGV4KSB7XG4gICAgICAgICAgICBsZXQgaXRlbSA9IFZJRVdcbiAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19faWNvbl9fL2dpLCB2YWx1ZS5pY29uIHx8ICdmYSBmYS1maWxlLW8nKVxuICAgICAgICAgICAgICAgICAgICAucmVwbGFjZSgvX19wbGFjZWhvbGRlcl9fL2dpLCAnSW5wdXQgZmlsZSBuYW1lJylcbiAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fdmFsdWVfXy9naSwgdmFsdWUubmFtZSlcbiAgICAgICAgICAgICAgICA7XG4gICAgICAgICAgICBsZXQgJGl0ZW0gPSAkKGl0ZW0pO1xuICAgICAgICAgICAgJGl0ZW0uZGF0YSgnaWQnLCB2YWx1ZS5pZCk7XG4gICAgICAgICAgICAkaXRlbS5kYXRhKCdpc19mb2xkZXInLCB2YWx1ZS5pc19mb2xkZXIpO1xuICAgICAgICAgICAgJGl0ZW0uZGF0YSgnbmFtZScsIHZhbHVlLm5hbWUpO1xuICAgICAgICAgICAgJGl0ZW1zV3JhcHBlci5hcHBlbmQoJGl0ZW0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzdGF0aWMgcmVuZGVyQWN0aW9ucygpIHtcbiAgICAgICAgbGV0IGhhc0ZvbGRlclNlbGVjdGVkID0gSGVscGVycy5nZXRTZWxlY3RlZEZvbGRlcigpLmxlbmd0aCA+IDA7XG5cbiAgICAgICAgbGV0IEFDVElPTl9URU1QTEFURSA9ICQoJyNydl9hY3Rpb25faXRlbScpLmh0bWwoKTtcbiAgICAgICAgbGV0IGluaXRpYWxpemVkX2l0ZW0gPSAwO1xuICAgICAgICBsZXQgJGRyb3Bkb3duQWN0aW9ucyA9ICQoJy5ydi1kcm9wZG93bi1hY3Rpb25zIC5kcm9wZG93bi1tZW51Jyk7XG4gICAgICAgICRkcm9wZG93bkFjdGlvbnMuZW1wdHkoKTtcblxuICAgICAgICBsZXQgYWN0aW9uc0xpc3QgPSAkLmV4dGVuZCh7fSwgdHJ1ZSwgSGVscGVycy5nZXRDb25maWdzKCkuYWN0aW9uc19saXN0KTtcblxuICAgICAgICBpZiAoaGFzRm9sZGVyU2VsZWN0ZWQpIHtcbiAgICAgICAgICAgIGFjdGlvbnNMaXN0LmJhc2ljID0gXy5yZWplY3QoYWN0aW9uc0xpc3QuYmFzaWMsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGl0ZW0uYWN0aW9uID09PSAncHJldmlldyc7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIGFjdGlvbnNMaXN0LmZpbGUgPSBfLnJlamVjdChhY3Rpb25zTGlzdC5maWxlLCBmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBpdGVtLmFjdGlvbiA9PT0gJ2NvcHlfbGluayc7XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZvbGRlcnMuY3JlYXRlJykpIHtcbiAgICAgICAgICAgICAgICBhY3Rpb25zTGlzdC5maWxlID0gXy5yZWplY3QoYWN0aW9uc0xpc3QuZmlsZSwgZnVuY3Rpb24gKGl0ZW0pIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGl0ZW0uYWN0aW9uID09PSAnbWFrZV9jb3B5JztcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZvbGRlcnMuZWRpdCcpKSB7XG4gICAgICAgICAgICAgICAgYWN0aW9uc0xpc3QuZmlsZSA9IF8ucmVqZWN0KGFjdGlvbnNMaXN0LmZpbGUsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBfLmluY2x1ZGVzKFsncmVuYW1lJ10sIGl0ZW0uYWN0aW9uKTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGFjdGlvbnNMaXN0LnVzZXIgPSBfLnJlamVjdChhY3Rpb25zTGlzdC51c2VyLCBmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gXy5pbmNsdWRlcyhbJ3JlbmFtZSddLCBpdGVtLmFjdGlvbik7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmb2xkZXJzLnRyYXNoJykpIHtcbiAgICAgICAgICAgICAgICBhY3Rpb25zTGlzdC5vdGhlciA9IF8ucmVqZWN0KGFjdGlvbnNMaXN0Lm90aGVyLCBmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gXy5pbmNsdWRlcyhbJ3RyYXNoJywgJ3Jlc3RvcmUnXSwgaXRlbS5hY3Rpb24pO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoUlZfTUVESUFfQ09ORklHLnBlcm1pc3Npb25zLCAnZm9sZGVycy5kZWxldGUnKSkge1xuICAgICAgICAgICAgICAgIGFjdGlvbnNMaXN0Lm90aGVyID0gXy5yZWplY3QoYWN0aW9uc0xpc3Qub3RoZXIsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBfLmluY2x1ZGVzKFsnZGVsZXRlJ10sIGl0ZW0uYWN0aW9uKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZvbGRlcnMuZmF2b3JpdGUnKSkge1xuICAgICAgICAgICAgICAgIGFjdGlvbnNMaXN0Lm90aGVyID0gXy5yZWplY3QoYWN0aW9uc0xpc3Qub3RoZXIsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBfLmluY2x1ZGVzKFsnZmF2b3JpdGUnLCAncmVtb3ZlX2Zhdm9yaXRlJ10sIGl0ZW0uYWN0aW9uKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgICAgIGxldCBzZWxlY3RlZEZpbGVzID0gSGVscGVycy5nZXRTZWxlY3RlZEZpbGVzKCk7XG5cbiAgICAgICAgbGV0IGNhbl9wcmV2aWV3ID0gZmFsc2U7XG4gICAgICAgIF8uZWFjaChzZWxlY3RlZEZpbGVzLCBmdW5jdGlvbiAodmFsdWUpIHtcbiAgICAgICAgICAgIGlmIChfLmluY2x1ZGVzKFsnaW1hZ2UnLCAneW91dHViZScsICdwZGYnLCAndGV4dCcsICd2aWRlbyddLCB2YWx1ZS50eXBlKSkge1xuICAgICAgICAgICAgICAgIGNhbl9wcmV2aWV3ID0gdHJ1ZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgaWYgKCFjYW5fcHJldmlldykge1xuICAgICAgICAgICAgYWN0aW9uc0xpc3QuYmFzaWMgPSBfLnJlamVjdChhY3Rpb25zTGlzdC5iYXNpYywgZnVuY3Rpb24gKGl0ZW0pIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gaXRlbS5hY3Rpb24gPT09ICdwcmV2aWV3JztcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG5cbiAgICAgICAgaWYgKHNlbGVjdGVkRmlsZXMubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZpbGVzLmNyZWF0ZScpKSB7XG4gICAgICAgICAgICAgICAgYWN0aW9uc0xpc3QuZmlsZSA9IF8ucmVqZWN0KGFjdGlvbnNMaXN0LmZpbGUsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBpdGVtLmFjdGlvbiA9PT0gJ21ha2VfY29weSc7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmaWxlcy5lZGl0JykpIHtcbiAgICAgICAgICAgICAgICBhY3Rpb25zTGlzdC5maWxlID0gXy5yZWplY3QoYWN0aW9uc0xpc3QuZmlsZSwgZnVuY3Rpb24gKGl0ZW0pIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIF8uaW5jbHVkZXMoWydyZW5hbWUnXSwgaXRlbS5hY3Rpb24pO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoUlZfTUVESUFfQ09ORklHLnBlcm1pc3Npb25zLCAnZmlsZXMudHJhc2gnKSkge1xuICAgICAgICAgICAgICAgIGFjdGlvbnNMaXN0Lm90aGVyID0gXy5yZWplY3QoYWN0aW9uc0xpc3Qub3RoZXIsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBfLmluY2x1ZGVzKFsndHJhc2gnLCAncmVzdG9yZSddLCBpdGVtLmFjdGlvbik7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmaWxlcy5kZWxldGUnKSkge1xuICAgICAgICAgICAgICAgIGFjdGlvbnNMaXN0Lm90aGVyID0gXy5yZWplY3QoYWN0aW9uc0xpc3Qub3RoZXIsIGZ1bmN0aW9uIChpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBfLmluY2x1ZGVzKFsnZGVsZXRlJ10sIGl0ZW0uYWN0aW9uKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZpbGVzLmZhdm9yaXRlJykpIHtcbiAgICAgICAgICAgICAgICBhY3Rpb25zTGlzdC5vdGhlciA9IF8ucmVqZWN0KGFjdGlvbnNMaXN0Lm90aGVyLCBmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gXy5pbmNsdWRlcyhbJ2Zhdm9yaXRlJywgJ3JlbW92ZV9mYXZvcml0ZSddLCBpdGVtLmFjdGlvbik7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBfLmVhY2goYWN0aW9uc0xpc3QsIGZ1bmN0aW9uIChhY3Rpb24sIGtleSkge1xuICAgICAgICAgICAgXy5lYWNoKGFjdGlvbiwgZnVuY3Rpb24gKGl0ZW0sIGluZGV4KSB7XG4gICAgICAgICAgICAgICAgbGV0IGlzX2JyZWFrID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgc3dpdGNoIChIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKS52aWV3X2luKSB7XG4gICAgICAgICAgICAgICAgICAgIGNhc2UgJ2FsbF9tZWRpYSc6XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAoXy5pbmNsdWRlcyhbJ3JlbW92ZV9mYXZvcml0ZScsICdkZWxldGUnLCAncmVzdG9yZSddLCBpdGVtLmFjdGlvbikpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpc19icmVhayA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgICAgICAgICAgY2FzZSAncmVjZW50JzpcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChfLmluY2x1ZGVzKFsncmVtb3ZlX2Zhdm9yaXRlJywgJ2RlbGV0ZScsICdyZXN0b3JlJywgJ21ha2VfY29weSddLCBpdGVtLmFjdGlvbikpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpc19icmVhayA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgICAgICAgICAgY2FzZSAnZmF2b3JpdGVzJzpcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChfLmluY2x1ZGVzKFsnZmF2b3JpdGUnLCAnZGVsZXRlJywgJ3Jlc3RvcmUnLCAnbWFrZV9jb3B5J10sIGl0ZW0uYWN0aW9uKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlzX2JyZWFrID0gdHJ1ZTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgICAgICBjYXNlICd0cmFzaCc6XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoWydwcmV2aWV3JywgJ2RlbGV0ZScsICdyZXN0b3JlJywgJ3JlbmFtZScsICdkb3dubG9hZCddLCBpdGVtLmFjdGlvbikpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpc19icmVhayA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgaWYgKCFpc19icmVhaykge1xuICAgICAgICAgICAgICAgICAgICBsZXQgdGVtcGxhdGUgPSBBQ1RJT05fVEVNUExBVEVcbiAgICAgICAgICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX2FjdGlvbl9fL2dpLCBpdGVtLmFjdGlvbiB8fCAnJylcbiAgICAgICAgICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX2ljb25fXy9naSwgaXRlbS5pY29uIHx8ICcnKVxuICAgICAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fbmFtZV9fL2dpLCBSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLmFjdGlvbnNfbGlzdFtrZXldW2l0ZW0uYWN0aW9uXSB8fCBpdGVtLm5hbWUpO1xuICAgICAgICAgICAgICAgICAgICBpZiAoIWluZGV4ICYmIGluaXRpYWxpemVkX2l0ZW0pIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRlbXBsYXRlID0gJzxsaSByb2xlPVwic2VwYXJhdG9yXCIgY2xhc3M9XCJkaXZpZGVyXCI+PC9saT4nICsgdGVtcGxhdGU7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgJGRyb3Bkb3duQWN0aW9ucy5hcHBlbmQodGVtcGxhdGUpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgaWYgKGFjdGlvbi5sZW5ndGggPiAwKSB7XG4gICAgICAgICAgICAgICAgaW5pdGlhbGl6ZWRfaXRlbSsrO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9BY3Rpb25zU2VydmljZS5qcyIsImltcG9ydCB7SGVscGVyc30gZnJvbSAnLi9BcHAvSGVscGVycy9IZWxwZXJzJztcbmltcG9ydCB7TWVkaWFDb25maWd9IGZyb20gJy4vQXBwL0NvbmZpZy9NZWRpYUNvbmZpZyc7XG5cbmV4cG9ydCBjbGFzcyBFZGl0b3JTZXJ2aWNlIHtcbiAgICBzdGF0aWMgZWRpdG9yU2VsZWN0RmlsZShzZWxlY3RlZEZpbGVzKSB7XG5cbiAgICAgICAgbGV0IGlzX2NrZWRpdG9yID0gSGVscGVycy5nZXRVcmxQYXJhbSgnQ0tFZGl0b3InKSB8fCBIZWxwZXJzLmdldFVybFBhcmFtKCdDS0VkaXRvckZ1bmNOdW0nKTtcblxuICAgICAgICBpZiAod2luZG93Lm9wZW5lciAmJiBpc19ja2VkaXRvcikge1xuICAgICAgICAgICAgbGV0IGZpcnN0SXRlbSA9IF8uZmlyc3Qoc2VsZWN0ZWRGaWxlcyk7XG5cbiAgICAgICAgICAgIHdpbmRvdy5vcGVuZXIuQ0tFRElUT1IudG9vbHMuY2FsbEZ1bmN0aW9uKEhlbHBlcnMuZ2V0VXJsUGFyYW0oJ0NLRWRpdG9yRnVuY051bScpLCBmaXJzdEl0ZW0udXJsKTtcblxuICAgICAgICAgICAgaWYgKHdpbmRvdy5vcGVuZXIpIHtcbiAgICAgICAgICAgICAgICB3aW5kb3cuY2xvc2UoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIC8vIE5vIFdZU0lXWUcgZWRpdG9yIGZvdW5kLCB1c2UgY3VzdG9tIG1ldGhvZC5cbiAgICAgICAgfVxuICAgIH1cbn1cblxuY2xhc3MgcnZNZWRpYSB7XG4gICAgY29uc3RydWN0b3Ioc2VsZWN0b3IsIG9wdGlvbnMpIHtcbiAgICAgICAgd2luZG93LnJ2TWVkaWEgPSB3aW5kb3cucnZNZWRpYSB8fCB7fTtcblxuICAgICAgICBsZXQgJGJvZHkgPSAkKCdib2R5Jyk7XG5cbiAgICAgICAgbGV0IGRlZmF1bHRPcHRpb25zID0ge1xuICAgICAgICAgICAgbXVsdGlwbGU6IHRydWUsXG4gICAgICAgICAgICB0eXBlOiAnKicsXG4gICAgICAgICAgICBvblNlbGVjdEZpbGVzOiBmdW5jdGlvbiAoZmlsZXMsICRlbCkge1xuXG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgb3B0aW9ucyA9ICQuZXh0ZW5kKHRydWUsIGRlZmF1bHRPcHRpb25zLCBvcHRpb25zKTtcblxuICAgICAgICBsZXQgY2xpY2tDYWxsYmFjayA9IGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIGxldCAkY3VycmVudCA9ICQodGhpcyk7XG4gICAgICAgICAgICAkKCcjcnZfbWVkaWFfbW9kYWwnKS5tb2RhbCgpO1xuXG4gICAgICAgICAgICB3aW5kb3cucnZNZWRpYS5vcHRpb25zID0gb3B0aW9ucztcbiAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub3Blbl9pbiA9ICdtb2RhbCc7XG5cbiAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLiRlbCA9ICRjdXJyZW50O1xuXG4gICAgICAgICAgICBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy5maWx0ZXIgPSAnZXZlcnl0aGluZyc7XG4gICAgICAgICAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG5cbiAgICAgICAgICAgIGxldCBlbGVfb3B0aW9ucyA9IHdpbmRvdy5ydk1lZGlhLiRlbC5kYXRhKCdydi1tZWRpYScpO1xuICAgICAgICAgICAgaWYgKHR5cGVvZiBlbGVfb3B0aW9ucyAhPT0gJ3VuZGVmaW5lZCcgJiYgZWxlX29wdGlvbnMubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgICAgIGVsZV9vcHRpb25zID0gZWxlX29wdGlvbnNbMF07XG4gICAgICAgICAgICAgICAgd2luZG93LnJ2TWVkaWEub3B0aW9ucyA9ICQuZXh0ZW5kKHRydWUsIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMsIGVsZV9vcHRpb25zIHx8IHt9KTtcbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIGVsZV9vcHRpb25zLnNlbGVjdGVkX2ZpbGVfaWQgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgPSB0cnVlO1xuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAodHlwZW9mIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMuaXNfcG9wdXAgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoJCgnI3J2X21lZGlhX2JvZHkgLnJ2LW1lZGlhLWNvbnRhaW5lcicpLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICAgICAgICAgICQoJyNydl9tZWRpYV9ib2R5JykubG9hZChSVl9NRURJQV9VUkwucG9wdXAsIGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgICAgIGlmIChkYXRhLmVycm9yKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBhbGVydChkYXRhLm1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICQoJyNydl9tZWRpYV9ib2R5JylcbiAgICAgICAgICAgICAgICAgICAgICAgIC5yZW1vdmVDbGFzcygnbWVkaWEtbW9kYWwtbG9hZGluZycpXG4gICAgICAgICAgICAgICAgICAgICAgICAuY2xvc2VzdCgnLm1vZGFsLWNvbnRlbnQnKS5yZW1vdmVDbGFzcygnYmItbG9hZGluZycpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcucnYtbWVkaWEtY29udGFpbmVyIC5qcy1jaGFuZ2UtYWN0aW9uW2RhdGEtdHlwZT1yZWZyZXNoXScpLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgaWYgKHR5cGVvZiBzZWxlY3RvciA9PT0gJ3N0cmluZycpIHtcbiAgICAgICAgICAgICRib2R5Lm9uKCdjbGljaycsIHNlbGVjdG9yLCBjbGlja0NhbGxiYWNrKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHNlbGVjdG9yLm9uKCdjbGljaycsIGNsaWNrQ2FsbGJhY2spO1xuICAgICAgICB9XG4gICAgfVxufVxuXG53aW5kb3cuUnZNZWRpYVN0YW5kQWxvbmUgPSBydk1lZGlhO1xuXG4kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLm9mZignY2xpY2snKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIGxldCBzZWxlY3RlZEZpbGVzID0gSGVscGVycy5nZXRTZWxlY3RlZEZpbGVzKCk7XG4gICAgaWYgKF8uc2l6ZShzZWxlY3RlZEZpbGVzKSA+IDApIHtcbiAgICAgICAgRWRpdG9yU2VydmljZS5lZGl0b3JTZWxlY3RGaWxlKHNlbGVjdGVkRmlsZXMpO1xuICAgIH1cbn0pO1xuXG4kLmZuLnJ2TWVkaWEgPSBmdW5jdGlvbiAob3B0aW9ucykge1xuICAgIGxldCAkc2VsZWN0b3IgPSAkKHRoaXMpO1xuXG4gICAgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMuZmlsdGVyID0gJ2V2ZXJ5dGhpbmcnO1xuICAgIGlmIChNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy52aWV3X2luID09PSAndHJhc2gnKSB7XG4gICAgICAgICQoZG9jdW1lbnQpLmZpbmQoJy5qcy1pbnNlcnQtdG8tZWRpdG9yJykucHJvcCgnZGlzYWJsZWQnLCB0cnVlKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLnByb3AoJ2Rpc2FibGVkJywgZmFsc2UpO1xuICAgIH1cbiAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG5cbiAgICBuZXcgcnZNZWRpYSgkc2VsZWN0b3IsIG9wdGlvbnMpO1xufTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvaW50ZWdyYXRlLmpzIiwiaW1wb3J0IHtIZWxwZXJzfSBmcm9tICcuLi9IZWxwZXJzL0hlbHBlcnMnO1xuaW1wb3J0IHtBY3Rpb25zU2VydmljZX0gZnJvbSAnLi4vU2VydmljZXMvQWN0aW9uc1NlcnZpY2UnO1xuXG5leHBvcnQgY2xhc3MgTWVkaWFMaXN0IHtcbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5ncm91cCA9IHt9O1xuICAgICAgICB0aGlzLmdyb3VwLmxpc3QgPSAkKCcjcnZfbWVkaWFfaXRlbXNfbGlzdCcpLmh0bWwoKTtcbiAgICAgICAgdGhpcy5ncm91cC50aWxlcyA9ICQoJyNydl9tZWRpYV9pdGVtc190aWxlcycpLmh0bWwoKTtcblxuICAgICAgICB0aGlzLml0ZW0gPSB7fTtcbiAgICAgICAgdGhpcy5pdGVtLmxpc3QgPSAkKCcjcnZfbWVkaWFfaXRlbXNfbGlzdF9lbGVtZW50JykuaHRtbCgpO1xuICAgICAgICB0aGlzLml0ZW0udGlsZXMgPSAkKCcjcnZfbWVkaWFfaXRlbXNfdGlsZXNfZWxlbWVudCcpLmh0bWwoKTtcblxuICAgICAgICB0aGlzLiRncm91cENvbnRhaW5lciA9ICQoJy5ydi1tZWRpYS1pdGVtcycpO1xuICAgIH1cblxuXG4gICAgcmVuZGVyRGF0YShkYXRhLCByZWxvYWQgPSBmYWxzZSwgbG9hZF9tb3JlX2ZpbGUgPSBmYWxzZSkge1xuICAgICAgICBsZXQgX3NlbGYgPSB0aGlzO1xuICAgICAgICBsZXQgTWVkaWFDb25maWcgPSBIZWxwZXJzLmdldENvbmZpZ3MoKTtcbiAgICAgICAgbGV0IHRlbXBsYXRlID0gX3NlbGYuZ3JvdXBbSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkudmlld190eXBlXTtcblxuICAgICAgICBsZXQgdmlld19pbiA9IEhlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLnZpZXdfaW47XG5cbiAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFsnYWxsX21lZGlhJywgJ3B1YmxpYycsICd0cmFzaCcsICdmYXZvcml0ZXMnLCAncmVjZW50J10sIHZpZXdfaW4pKSB7XG4gICAgICAgICAgICB2aWV3X2luID0gJ2FsbF9tZWRpYSc7XG4gICAgICAgIH1cblxuICAgICAgICB0ZW1wbGF0ZSA9IHRlbXBsYXRlXG4gICAgICAgICAgICAucmVwbGFjZSgvX19ub0l0ZW1JY29uX18vZ2ksIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubm9faXRlbVt2aWV3X2luXS5pY29uIHx8ICcnKVxuICAgICAgICAgICAgLnJlcGxhY2UoL19fbm9JdGVtVGl0bGVfXy9naSwgUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5ub19pdGVtW3ZpZXdfaW5dLnRpdGxlIHx8ICcnKVxuICAgICAgICAgICAgLnJlcGxhY2UoL19fbm9JdGVtTWVzc2FnZV9fL2dpLCBSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLm5vX2l0ZW1bdmlld19pbl0ubWVzc2FnZSB8fCAnJyk7XG5cbiAgICAgICAgbGV0ICRyZXN1bHQgPSAkKHRlbXBsYXRlKTtcbiAgICAgICAgbGV0ICRpdGVtc1dyYXBwZXIgPSAkcmVzdWx0LmZpbmQoJ3VsJyk7XG5cbiAgICAgICAgaWYgKGxvYWRfbW9yZV9maWxlICYmIHRoaXMuJGdyb3VwQ29udGFpbmVyLmZpbmQoJy5ydi1tZWRpYS1ncmlkIHVsJykubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgJGl0ZW1zV3JhcHBlciA9IHRoaXMuJGdyb3VwQ29udGFpbmVyLmZpbmQoJy5ydi1tZWRpYS1ncmlkIHVsJyk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoKF8uc2l6ZShkYXRhLmZvbGRlcnMpID4gMCB8fCBfLnNpemUoZGF0YS5maWxlcykgPiAwKSB8fCBsb2FkX21vcmVfZmlsZSkge1xuICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWl0ZW1zJykuYWRkQ2xhc3MoJ2hhcy1pdGVtcycpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWl0ZW1zJykucmVtb3ZlQ2xhc3MoJ2hhcy1pdGVtcycpO1xuICAgICAgICB9XG5cbiAgICAgICAgXy5mb3JFYWNoKGRhdGEuZm9sZGVycywgZnVuY3Rpb24gKHZhbHVlLCBpbmRleCkge1xuICAgICAgICAgICAgbGV0IGl0ZW0gPSBfc2VsZi5pdGVtW0hlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLnZpZXdfdHlwZV07XG4gICAgICAgICAgICBpdGVtID0gaXRlbVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3R5cGVfXy9naSwgJ2ZvbGRlcicpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19faWRfXy9naSwgdmFsdWUuaWQpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fbmFtZV9fL2dpLCB2YWx1ZS5uYW1lIHx8ICcnKVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3NpemVfXy9naSwgJycpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fZGF0ZV9fL2dpLCB2YWx1ZS5jcmVhdGVkX2F0IHx8ICcnKVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3RodW1iX18vZ2ksICc8aSBjbGFzcz1cImZhIGZhLWZvbGRlci1vXCI+PC9pPicpO1xuICAgICAgICAgICAgbGV0ICRpdGVtID0gJChpdGVtKTtcbiAgICAgICAgICAgIF8uZm9yRWFjaCh2YWx1ZSwgZnVuY3Rpb24gKHZhbCwgaW5kZXgpIHtcbiAgICAgICAgICAgICAgICAkaXRlbS5kYXRhKGluZGV4LCB2YWwpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkaXRlbS5kYXRhKCdpc19mb2xkZXInLCB0cnVlKTtcbiAgICAgICAgICAgICRpdGVtLmRhdGEoJ2ljb24nLCBNZWRpYUNvbmZpZy5pY29ucy5mb2xkZXIpO1xuICAgICAgICAgICAgJGl0ZW1zV3JhcHBlci5hcHBlbmQoJGl0ZW0pO1xuICAgICAgICB9KTtcblxuICAgICAgICBfLmZvckVhY2goZGF0YS5maWxlcywgZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgICAgICAgICBsZXQgaXRlbSA9IF9zZWxmLml0ZW1bSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkudmlld190eXBlXTtcbiAgICAgICAgICAgIGl0ZW0gPSBpdGVtXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fdHlwZV9fL2dpLCAnZmlsZScpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19faWRfXy9naSwgdmFsdWUuaWQpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fbmFtZV9fL2dpLCB2YWx1ZS5uYW1lIHx8ICcnKVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3NpemVfXy9naSwgdmFsdWUuc2l6ZSB8fCAnJylcbiAgICAgICAgICAgICAgICAucmVwbGFjZSgvX19kYXRlX18vZ2ksIHZhbHVlLmNyZWF0ZWRfYXQgfHwgJycpO1xuICAgICAgICAgICAgaWYgKEhlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLnZpZXdfdHlwZSA9PT0gJ2xpc3QnKSB7XG4gICAgICAgICAgICAgICAgaXRlbSA9IGl0ZW1cbiAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fdGh1bWJfXy9naSwgJzxpIGNsYXNzPVwiJyArIHZhbHVlLmljb24gKyAnXCI+PC9pPicpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBzd2l0Y2ggKHZhbHVlLm1pbWVfdHlwZSkge1xuICAgICAgICAgICAgICAgICAgICBjYXNlICd5b3V0dWJlJzpcbiAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW0gPSBpdGVtXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fdGh1bWJfXy9naSwgJzxpbWcgc3JjPVwiJyArIHZhbHVlLm9wdGlvbnMudGh1bWIgKyAnXCIgYWx0PVwiJyArIHZhbHVlLm5hbWUgKyAnXCI+Jyk7XG4gICAgICAgICAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgICAgICAgICAgZGVmYXVsdDpcbiAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW0gPSBpdGVtXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fdGh1bWJfXy9naSwgdmFsdWUudGh1bWIgPyAnPGltZyBzcmM9XCInICsgdmFsdWUudGh1bWIgKyAnXCIgYWx0PVwiJyArIHZhbHVlLm5hbWUgKyAnXCI+JyA6ICc8aSBjbGFzcz1cIicgKyB2YWx1ZS5pY29uICsgJ1wiPjwvaT4nKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGxldCAkaXRlbSA9ICQoaXRlbSk7XG4gICAgICAgICAgICAkaXRlbS5kYXRhKCdpc19mb2xkZXInLCBmYWxzZSk7XG4gICAgICAgICAgICBfLmZvckVhY2godmFsdWUsIGZ1bmN0aW9uICh2YWwsIGluZGV4KSB7XG4gICAgICAgICAgICAgICAgJGl0ZW0uZGF0YShpbmRleCwgdmFsKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJGl0ZW1zV3JhcHBlci5hcHBlbmQoJGl0ZW0pO1xuICAgICAgICB9KTtcbiAgICAgICAgaWYgKHJlbG9hZCAhPT0gZmFsc2UpIHtcbiAgICAgICAgICAgIF9zZWxmLiRncm91cENvbnRhaW5lci5lbXB0eSgpO1xuICAgICAgICB9XG5cbiAgICAgICAgaWYgKGxvYWRfbW9yZV9maWxlICYmIHRoaXMuJGdyb3VwQ29udGFpbmVyLmZpbmQoJy5ydi1tZWRpYS1ncmlkIHVsJykubGVuZ3RoID4gMCkge1xuXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBfc2VsZi4kZ3JvdXBDb250YWluZXIuYXBwZW5kKCRyZXN1bHQpO1xuICAgICAgICB9XG4gICAgICAgIF9zZWxmLiRncm91cENvbnRhaW5lci5maW5kKCcubG9hZGluZy13cmFwcGVyJykucmVtb3ZlKCk7XG4gICAgICAgIEFjdGlvbnNTZXJ2aWNlLmhhbmRsZURyb3Bkb3duKCk7XG5cbiAgICAgICAgLy90cmlnZ2VyIGV2ZW50IGNsaWNrIGZvciBmaWxlIHNlbGVjdGVkXG4gICAgICAgICQoJy5qcy1tZWRpYS1saXN0LXRpdGxlW2RhdGEtaWQ9JyArIGRhdGEuc2VsZWN0ZWRfZmlsZV9pZCArICddJykudHJpZ2dlcignY2xpY2snKTtcbiAgICB9XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9WaWV3cy9NZWRpYUxpc3QuanMiLCJpbXBvcnQge01lZGlhQ29uZmlnfSBmcm9tICcuL0FwcC9Db25maWcvTWVkaWFDb25maWcnO1xuaW1wb3J0IHtIZWxwZXJzfSBmcm9tICcuL0FwcC9IZWxwZXJzL0hlbHBlcnMnO1xuaW1wb3J0IHtNZWRpYVNlcnZpY2V9IGZyb20gJy4vQXBwL1NlcnZpY2VzL01lZGlhU2VydmljZSc7XG5pbXBvcnQge01lc3NhZ2VTZXJ2aWNlfSBmcm9tICcuL0FwcC9TZXJ2aWNlcy9NZXNzYWdlU2VydmljZSc7XG5pbXBvcnQge0ZvbGRlclNlcnZpY2V9IGZyb20gJy4vQXBwL1NlcnZpY2VzL0ZvbGRlclNlcnZpY2UnO1xuaW1wb3J0IHtVcGxvYWRTZXJ2aWNlfSBmcm9tICcuL0FwcC9TZXJ2aWNlcy9VcGxvYWRTZXJ2aWNlJztcbmltcG9ydCB7QWN0aW9uc1NlcnZpY2V9IGZyb20gJy4vQXBwL1NlcnZpY2VzL0FjdGlvbnNTZXJ2aWNlJztcbmltcG9ydCB7RXh0ZXJuYWxTZXJ2aWNlc30gZnJvbSAnLi9BcHAvRXh0ZXJuYWxzL0V4dGVybmFsU2VydmljZXMnO1xuaW1wb3J0IHtFZGl0b3JTZXJ2aWNlfSBmcm9tICcuL2ludGVncmF0ZSc7XG5cbmNsYXNzIE1lZGlhTWFuYWdlbWVudCB7XG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMuTWVkaWFTZXJ2aWNlID0gbmV3IE1lZGlhU2VydmljZSgpO1xuICAgICAgICB0aGlzLlVwbG9hZFNlcnZpY2UgPSBuZXcgVXBsb2FkU2VydmljZSgpO1xuICAgICAgICB0aGlzLkZvbGRlclNlcnZpY2UgPSBuZXcgRm9sZGVyU2VydmljZSgpO1xuXG4gICAgICAgIG5ldyBFeHRlcm5hbFNlcnZpY2VzKCk7XG5cbiAgICAgICAgdGhpcy4kYm9keSA9ICQoJ2JvZHknKTtcbiAgICB9XG5cbiAgICBpbml0KCkge1xuICAgICAgICBIZWxwZXJzLnJlc2V0UGFnaW5hdGlvbigpO1xuICAgICAgICB0aGlzLnNldHVwTGF5b3V0KCk7XG5cbiAgICAgICAgdGhpcy5oYW5kbGVNZWRpYUxpc3QoKTtcbiAgICAgICAgdGhpcy5jaGFuZ2VWaWV3VHlwZSgpO1xuICAgICAgICB0aGlzLmNoYW5nZUZpbHRlcigpO1xuICAgICAgICB0aGlzLnNlYXJjaCgpO1xuICAgICAgICB0aGlzLmhhbmRsZUFjdGlvbnMoKTtcblxuICAgICAgICB0aGlzLlVwbG9hZFNlcnZpY2UuaW5pdCgpO1xuXG4gICAgICAgIHRoaXMuaGFuZGxlTW9kYWxzKCk7XG4gICAgICAgIHRoaXMuc2Nyb2xsR2V0TW9yZSgpO1xuICAgIH1cblxuICAgIHNldHVwTGF5b3V0KCkge1xuICAgICAgICAvKipcbiAgICAgICAgICogU2lkZWJhclxuICAgICAgICAgKi9cbiAgICAgICAgbGV0ICRjdXJyZW50X2ZpbHRlciA9ICQoJy5qcy1ydi1tZWRpYS1jaGFuZ2UtZmlsdGVyW2RhdGEtdHlwZT1cImZpbHRlclwiXVtkYXRhLXZhbHVlPVwiJyArIEhlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLmZpbHRlciArICdcIl0nKTtcblxuICAgICAgICAkY3VycmVudF9maWx0ZXIuY2xvc2VzdCgnbGknKVxuICAgICAgICAgICAgLmFkZENsYXNzKCdhY3RpdmUnKVxuICAgICAgICAgICAgLmNsb3Nlc3QoJy5kcm9wZG93bicpLmZpbmQoJy5qcy1ydi1tZWRpYS1maWx0ZXItY3VycmVudCcpLmh0bWwoJygnICsgJGN1cnJlbnRfZmlsdGVyLmh0bWwoKSArICcpJyk7XG5cbiAgICAgICAgbGV0ICRjdXJyZW50X3ZpZXdfaW4gPSAkKCcuanMtcnYtbWVkaWEtY2hhbmdlLWZpbHRlcltkYXRhLXR5cGU9XCJ2aWV3X2luXCJdW2RhdGEtdmFsdWU9XCInICsgSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkudmlld19pbiArICdcIl0nKTtcblxuICAgICAgICAkY3VycmVudF92aWV3X2luLmNsb3Nlc3QoJ2xpJylcbiAgICAgICAgICAgIC5hZGRDbGFzcygnYWN0aXZlJylcbiAgICAgICAgICAgIC5jbG9zZXN0KCcuZHJvcGRvd24nKS5maW5kKCcuanMtcnYtbWVkaWEtZmlsdGVyLWN1cnJlbnQnKS5odG1sKCcoJyArICRjdXJyZW50X3ZpZXdfaW4uaHRtbCgpICsgJyknKTtcblxuICAgICAgICBpZiAoSGVscGVycy5pc1VzZUluTW9kYWwoKSkge1xuICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWZvb3RlcicpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKTtcbiAgICAgICAgfVxuXG4gICAgICAgIC8qKlxuICAgICAgICAgKiBTb3J0XG4gICAgICAgICAqL1xuICAgICAgICAkKCcuanMtcnYtbWVkaWEtY2hhbmdlLWZpbHRlcltkYXRhLXR5cGU9XCJzb3J0X2J5XCJdW2RhdGEtdmFsdWU9XCInICsgSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkuc29ydF9ieSArICdcIl0nKVxuICAgICAgICAgICAgLmNsb3Nlc3QoJ2xpJylcbiAgICAgICAgICAgIC5hZGRDbGFzcygnYWN0aXZlJyk7XG5cbiAgICAgICAgLyoqXG4gICAgICAgICAqIERldGFpbHMgcGFuZVxuICAgICAgICAgKi9cbiAgICAgICAgbGV0ICRtZWRpYURldGFpbHNDaGVja2JveCA9ICQoJyNtZWRpYV9kZXRhaWxzX2NvbGxhcHNlJyk7XG4gICAgICAgICRtZWRpYURldGFpbHNDaGVja2JveC5wcm9wKCdjaGVja2VkJywgTWVkaWFDb25maWcuaGlkZV9kZXRhaWxzX3BhbmUgfHwgZmFsc2UpO1xuICAgICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgICAgICQoJy5ydi1tZWRpYS1kZXRhaWxzJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xuICAgIH0sIDMwMCk7XG4gICAgICAgICRtZWRpYURldGFpbHNDaGVja2JveC5vbignY2hhbmdlJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgTWVkaWFDb25maWcuaGlkZV9kZXRhaWxzX3BhbmUgPSAkKHRoaXMpLmlzKCc6Y2hlY2tlZCcpO1xuICAgICAgICAgICAgSGVscGVycy5zdG9yZUNvbmZpZygpO1xuICAgICAgICB9KTtcblxuICAgICAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnYnV0dG9uW2RhdGEtZGlzbWlzcy1tb2RhbF0nLCBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGxldCBtb2RhbCA9ICQodGhpcykuZGF0YSgnZGlzbWlzcy1tb2RhbCcpO1xuICAgICAgICAgICAgJChtb2RhbCkubW9kYWwoJ2hpZGUnKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgaGFuZGxlTWVkaWFMaXN0KCkge1xuICAgICAgICBsZXQgX3NlbGYgPSB0aGlzO1xuXG4gICAgICAgIC8qQ3RybCBrZXkgaW4gV2luZG93cyovXG4gICAgICAgIGxldCBjdHJsX2tleSA9IGZhbHNlO1xuXG4gICAgICAgIC8qQ29tbWFuZCBrZXkgaW4gTUFDKi9cbiAgICAgICAgbGV0IG1ldGFfa2V5ID0gZmFsc2U7XG5cbiAgICAgICAgLypTaGlmdCBrZXkqL1xuICAgICAgICBsZXQgc2hpZnRfa2V5ID0gZmFsc2U7XG5cbiAgICAgICAgJChkb2N1bWVudCkub24oJ2tleXVwIGtleWRvd24nLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgLypVc2VyIGhvbGQgY3RybCBrZXkqL1xuICAgICAgICAgICAgY3RybF9rZXkgPSBlLmN0cmxLZXk7XG4gICAgICAgICAgICAvKlVzZXIgaG9sZCBjb21tYW5kIGtleSovXG4gICAgICAgICAgICBtZXRhX2tleSA9IGUubWV0YUtleTtcbiAgICAgICAgICAgIC8qVXNlciBob2xkIHNoaWZ0IGtleSovXG4gICAgICAgICAgICBzaGlmdF9rZXkgPSBlLnNoaWZ0S2V5O1xuICAgICAgICB9KTtcblxuICAgICAgICBfc2VsZi4kYm9keVxuICAgICAgICAgICAgLm9uKCdjbGljaycsICcuanMtbWVkaWEtbGlzdC10aXRsZScsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAgICAgbGV0ICRjdXJyZW50ID0gJCh0aGlzKTtcblxuICAgICAgICAgICAgICAgIGlmIChzaGlmdF9rZXkpIHtcbiAgICAgICAgICAgICAgICAgICAgbGV0IGZpcnN0SXRlbSA9IF8uZmlyc3QoSGVscGVycy5nZXRTZWxlY3RlZEl0ZW1zKCkpO1xuICAgICAgICAgICAgICAgICAgICBpZiAoZmlyc3RJdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBsZXQgZmlyc3RJbmRleCA9IGZpcnN0SXRlbS5pbmRleF9rZXk7XG4gICAgICAgICAgICAgICAgICAgICAgICBsZXQgY3VycmVudEluZGV4ID0gJGN1cnJlbnQuaW5kZXgoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICQoJy5ydi1tZWRpYS1pdGVtcyBsaScpLmVhY2goZnVuY3Rpb24gKGluZGV4KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGluZGV4ID4gZmlyc3RJbmRleCAmJiBpbmRleCA8PSBjdXJyZW50SW5kZXgpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5maW5kKCdpbnB1dFt0eXBlPWNoZWNrYm94XScpLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIGlmICghY3RybF9rZXkgJiYgIW1ldGFfa2V5KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkY3VycmVudC5jbG9zZXN0KCcucnYtbWVkaWEtaXRlbXMnKS5maW5kKCdpbnB1dFt0eXBlPWNoZWNrYm94XScpLnByb3AoJ2NoZWNrZWQnLCBmYWxzZSk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBsZXQgJGxpbmVDaGVja0JveCA9ICRjdXJyZW50LmZpbmQoJ2lucHV0W3R5cGU9Y2hlY2tib3hdJyk7XG4gICAgICAgICAgICAgICAgJGxpbmVDaGVja0JveC5wcm9wKCdjaGVja2VkJywgdHJ1ZSk7XG4gICAgICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UuaGFuZGxlRHJvcGRvd24oKTtcblxuICAgICAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRGaWxlRGV0YWlscygkY3VycmVudC5kYXRhKCkpO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC5vbignZGJsY2xpY2snLCAnLmpzLW1lZGlhLWxpc3QtdGl0bGUnLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgICAgICAgICAgbGV0IGRhdGEgPSAkKHRoaXMpLmRhdGEoKTtcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5pc19mb2xkZXIgPT09IHRydWUpIHtcbiAgICAgICAgICAgICAgICAgICAgSGVscGVycy5yZXNldFBhZ2luYXRpb24oKTtcbiAgICAgICAgICAgICAgICAgICAgX3NlbGYuRm9sZGVyU2VydmljZS5jaGFuZ2VGb2xkZXIoZGF0YS5pZCk7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKCFIZWxwZXJzLmlzVXNlSW5Nb2RhbCgpKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBBY3Rpb25zU2VydmljZS5oYW5kbGVQcmV2aWV3KCk7XG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAoSGVscGVycy5nZXRDb25maWdzKCkucmVxdWVzdF9wYXJhbXMudmlld19pbiAhPT0gJ3RyYXNoJykge1xuICAgICAgICAgICAgICAgICAgICAgICAgbGV0IHNlbGVjdGVkRmlsZXMgPSBIZWxwZXJzLmdldFNlbGVjdGVkRmlsZXMoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChfLnNpemUoc2VsZWN0ZWRGaWxlcykgPiAwKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgRWRpdG9yU2VydmljZS5lZGl0b3JTZWxlY3RGaWxlKHNlbGVjdGVkRmlsZXMpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC5vbignZGJsY2xpY2snLCAnLmpzLXVwLW9uZS1sZXZlbCcsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAgICAgbGV0IGNvdW50ID0gJCgnLnJ2LW1lZGlhLWJyZWFkY3J1bWIgLmJyZWFkY3J1bWIgbGknKS5sZW5ndGg7XG4gICAgICAgICAgICAgICAgJCgnLnJ2LW1lZGlhLWJyZWFkY3J1bWIgLmJyZWFkY3J1bWIgbGk6bnRoLWNoaWxkKCcgKyAoY291bnQgLSAxKSArICcpIGEnKS50cmlnZ2VyKCdjbGljaycpO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC5vbignY29udGV4dG1lbnUnLCAnLmpzLWNvbnRleHQtbWVudScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgICAgICAgaWYgKCEkKHRoaXMpLmZpbmQoJ2lucHV0W3R5cGU9Y2hlY2tib3hdJykuaXMoJzpjaGVja2VkJykpIHtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS50cmlnZ2VyKCdjbGljaycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAub24oJ2NsaWNrIGNvbnRleHRtZW51JywgJy5ydi1tZWRpYS1pdGVtcycsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgICAgICAgaWYgKCFfLnNpemUoZS50YXJnZXQuY2xvc2VzdCgnLmpzLWNvbnRleHQtbWVudScpKSkge1xuICAgICAgICAgICAgICAgICAgICAkKCcucnYtbWVkaWEtaXRlbXMgaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdJykucHJvcCgnY2hlY2tlZCcsIGZhbHNlKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLnJ2LWRyb3Bkb3duLWFjdGlvbnMnKS5hZGRDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgICAgICAgICAgICAgX3NlbGYuTWVkaWFTZXJ2aWNlLmdldEZpbGVEZXRhaWxzKHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGljb246ICdmYSBmYS1waWN0dXJlLW8nLFxuICAgICAgICAgICAgICAgICAgICAgICAgbm90aGluZ19zZWxlY3RlZDogJycsXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pXG4gICAgICAgIDtcbiAgICB9XG5cbiAgICBjaGFuZ2VWaWV3VHlwZSgpIHtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgX3NlbGYuJGJvZHkub24oJ2NsaWNrJywgJy5qcy1ydi1tZWRpYS1jaGFuZ2Utdmlldy10eXBlIC5idG4nLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICBsZXQgJGN1cnJlbnQgPSAkKHRoaXMpO1xuICAgICAgICAgICAgaWYgKCRjdXJyZW50Lmhhc0NsYXNzKCdhY3RpdmUnKSkge1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgICRjdXJyZW50LmNsb3Nlc3QoJy5qcy1ydi1tZWRpYS1jaGFuZ2Utdmlldy10eXBlJykuZmluZCgnLmJ0bicpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICAgICRjdXJyZW50LmFkZENsYXNzKCdhY3RpdmUnKTtcblxuICAgICAgICAgICAgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMudmlld190eXBlID0gJGN1cnJlbnQuZGF0YSgndHlwZScpO1xuXG4gICAgICAgICAgICBpZiAoJGN1cnJlbnQuZGF0YSgndHlwZScpID09PSAndHJhc2gnKSB7XG4gICAgICAgICAgICAgICAgJChkb2N1bWVudCkuZmluZCgnLmpzLWluc2VydC10by1lZGl0b3InKS5wcm9wKCdkaXNhYmxlZCcsIHRydWUpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLnByb3AoJ2Rpc2FibGVkJywgZmFsc2UpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG5cbiAgICAgICAgICAgIGlmICh0eXBlb2YgUlZfTUVESUFfQ09ORklHLnBhZ2luYXRpb24gIT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLnBhZ2VkICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgICAgIFJWX01FRElBX0NPTkZJRy5wYWdpbmF0aW9uLnBhZ2VkID0gMTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlLCBmYWxzZSk7XG4gICAgICAgIH0pO1xuICAgICAgICAkKCcuanMtcnYtbWVkaWEtY2hhbmdlLXZpZXctdHlwZSAuYnRuW2RhdGEtdHlwZT1cIicgKyBIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKS52aWV3X3R5cGUgKyAnXCJdJykudHJpZ2dlcignY2xpY2snKTtcblxuICAgICAgICB0aGlzLmJpbmRJbnRlZ3JhdGVNb2RhbEV2ZW50cygpO1xuICAgIH1cblxuICAgIGNoYW5nZUZpbHRlcigpIHtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgX3NlbGYuJGJvZHkub24oJ2NsaWNrJywgJy5qcy1ydi1tZWRpYS1jaGFuZ2UtZmlsdGVyJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgaWYgKCFIZWxwZXJzLmlzT25BamF4TG9hZGluZygpKSB7XG4gICAgICAgICAgICAgICAgbGV0ICRjdXJyZW50ID0gJCh0aGlzKTtcbiAgICAgICAgICAgICAgICBsZXQgJHBhcmVudCA9ICRjdXJyZW50LmNsb3Nlc3QoJ3VsJyk7XG4gICAgICAgICAgICAgICAgbGV0IGRhdGEgPSAkY3VycmVudC5kYXRhKCk7XG5cbiAgICAgICAgICAgICAgICBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtc1tkYXRhLnR5cGVdID0gZGF0YS52YWx1ZTtcblxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnR5cGUgPT09ICd2aWV3X2luJykge1xuICAgICAgICAgICAgICAgICAgICBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy5mb2xkZXJfaWQgPSAwO1xuICAgICAgICAgICAgICAgICAgICBpZiAoZGF0YS52YWx1ZSA9PT0gJ3RyYXNoJykge1xuICAgICAgICAgICAgICAgICAgICAgICAgJChkb2N1bWVudCkuZmluZCgnLmpzLWluc2VydC10by1lZGl0b3InKS5wcm9wKCdkaXNhYmxlZCcsIHRydWUpO1xuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgJChkb2N1bWVudCkuZmluZCgnLmpzLWluc2VydC10by1lZGl0b3InKS5wcm9wKCdkaXNhYmxlZCcsIGZhbHNlKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICRjdXJyZW50LmNsb3Nlc3QoJy5kcm9wZG93bicpLmZpbmQoJy5qcy1ydi1tZWRpYS1maWx0ZXItY3VycmVudCcpLmh0bWwoJygnICsgJGN1cnJlbnQuaHRtbCgpICsgJyknKTtcblxuICAgICAgICAgICAgICAgIEhlbHBlcnMuc3RvcmVDb25maWcoKTtcbiAgICAgICAgICAgICAgICBNZWRpYVNlcnZpY2UucmVmcmVzaEZpbHRlcigpO1xuXG4gICAgICAgICAgICAgICAgSGVscGVycy5yZXNldFBhZ2luYXRpb24oKTtcbiAgICAgICAgICAgICAgICBfc2VsZi5NZWRpYVNlcnZpY2UuZ2V0TWVkaWEodHJ1ZSk7XG5cbiAgICAgICAgICAgICAgICAkcGFyZW50LmZpbmQoJz4gbGknKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgJGN1cnJlbnQuY2xvc2VzdCgnbGknKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIHNlYXJjaCgpIHtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgJCgnLmlucHV0LXNlYXJjaC13cmFwcGVyIGlucHV0W3R5cGU9XCJ0ZXh0XCJdJykudmFsKEhlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLnNlYXJjaCB8fCAnJyk7XG4gICAgICAgIF9zZWxmLiRib2R5Lm9uKCdzdWJtaXQnLCAnLmlucHV0LXNlYXJjaC13cmFwcGVyJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgTWVkaWFDb25maWcucmVxdWVzdF9wYXJhbXMuc2VhcmNoID0gJCh0aGlzKS5maW5kKCdpbnB1dFt0eXBlPVwidGV4dFwiXScpLnZhbCgpO1xuXG4gICAgICAgICAgICBIZWxwZXJzLnN0b3JlQ29uZmlnKCk7XG4gICAgICAgICAgICBIZWxwZXJzLnJlc2V0UGFnaW5hdGlvbigpO1xuICAgICAgICAgICAgX3NlbGYuTWVkaWFTZXJ2aWNlLmdldE1lZGlhKHRydWUpO1xuICAgICAgICB9KVxuICAgIH1cblxuICAgIGhhbmRsZUFjdGlvbnMoKSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG5cbiAgICAgICAgX3NlbGYuJGJvZHlcbiAgICAgICAgICAgIC5vbignY2xpY2snLCAnLnJ2LW1lZGlhLWFjdGlvbnMgLmpzLWNoYW5nZS1hY3Rpb25bZGF0YS10eXBlPVwicmVmcmVzaFwiXScsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgICAgICAgICBIZWxwZXJzLnJlc2V0UGFnaW5hdGlvbigpO1xuXG4gICAgICAgICAgICAgICAgbGV0IGVsZV9vcHRpb25zID0gdHlwZW9mIHdpbmRvdy5ydk1lZGlhLiRlbCAhPT0gJ3VuZGVmaW5lZCcgPyB3aW5kb3cucnZNZWRpYS4kZWwuZGF0YSgncnYtbWVkaWEnKSA6IHVuZGVmaW5lZDtcbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIGVsZV9vcHRpb25zICE9PSAndW5kZWZpbmVkJyAmJiBlbGVfb3B0aW9ucy5sZW5ndGggPiAwICYmIHR5cGVvZiBlbGVfb3B0aW9uc1swXS5zZWxlY3RlZF9maWxlX2lkICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgICAgICBfc2VsZi5NZWRpYVNlcnZpY2UuZ2V0TWVkaWEodHJ1ZSwgdHJ1ZSk7XG4gICAgICAgICAgICAgICAgfSBlbHNlXG4gICAgICAgICAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlLCBmYWxzZSk7XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLm9uKCdjbGljaycsICcucnYtbWVkaWEtaXRlbXMgbGkubm8taXRlbXMnLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgICQoJy5ydi1tZWRpYS1oZWFkZXIgLnJ2LW1lZGlhLXRvcC1oZWFkZXIgLnJ2LW1lZGlhLWFjdGlvbnMgLmpzLWRyb3B6b25lLXVwbG9hZCcpLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLm9uKCdzdWJtaXQnLCAnLmZvcm0tYWRkLWZvbGRlcicsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAgICAgbGV0ICRpbnB1dCA9ICQodGhpcykuZmluZCgnaW5wdXRbdHlwZT10ZXh0XScpO1xuICAgICAgICAgICAgICAgIGxldCBmb2xkZXJOYW1lID0gJGlucHV0LnZhbCgpO1xuICAgICAgICAgICAgICAgIF9zZWxmLkZvbGRlclNlcnZpY2UuY3JlYXRlKGZvbGRlck5hbWUpO1xuICAgICAgICAgICAgICAgICRpbnB1dC52YWwoJycpO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC5vbignY2xpY2snLCAnLmpzLWNoYW5nZS1mb2xkZXInLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgIGxldCBmb2xkZXJJZCA9ICQodGhpcykuZGF0YSgnZm9sZGVyJyk7XG4gICAgICAgICAgICAgICAgSGVscGVycy5yZXNldFBhZ2luYXRpb24oKTtcbiAgICAgICAgICAgICAgICBfc2VsZi5Gb2xkZXJTZXJ2aWNlLmNoYW5nZUZvbGRlcihmb2xkZXJJZCk7XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLm9uKCdjbGljaycsICcuanMtZmlsZXMtYWN0aW9uJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgICAgICBBY3Rpb25zU2VydmljZS5oYW5kbGVHbG9iYWxBY3Rpb24oJCh0aGlzKS5kYXRhKCdhY3Rpb24nKSwgZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgICAgICBIZWxwZXJzLnJlc2V0UGFnaW5hdGlvbigpO1xuICAgICAgICAgICAgICAgICAgICBfc2VsZi5NZWRpYVNlcnZpY2UuZ2V0TWVkaWEodHJ1ZSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KVxuICAgICAgICA7XG4gICAgfVxuXG4gICAgaGFuZGxlTW9kYWxzKCkge1xuICAgICAgICBsZXQgX3NlbGYgPSB0aGlzO1xuICAgICAgICAvKlJlbmFtZSBmaWxlcyovXG4gICAgICAgIF9zZWxmLiRib2R5Lm9uKCdzaG93LmJzLm1vZGFsJywgJyNtb2RhbF9yZW5hbWVfaXRlbXMnLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgIEFjdGlvbnNTZXJ2aWNlLnJlbmRlclJlbmFtZUl0ZW1zKCk7XG4gICAgICAgIH0pO1xuICAgICAgICBfc2VsZi4kYm9keS5vbignc3VibWl0JywgJyNtb2RhbF9yZW5hbWVfaXRlbXMgLmZvcm0tcmVuYW1lJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgbGV0IGl0ZW1zID0gW107XG4gICAgICAgICAgICBsZXQgJGZvcm0gPSAkKHRoaXMpO1xuXG4gICAgICAgICAgICAkKCcjbW9kYWxfcmVuYW1lX2l0ZW1zIC5mb3JtLWNvbnRyb2wnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBsZXQgJGN1cnJlbnQgPSAkKHRoaXMpO1xuICAgICAgICAgICAgICAgIGxldCBkYXRhID0gJGN1cnJlbnQuY2xvc2VzdCgnLmZvcm0tZ3JvdXAnKS5kYXRhKCk7XG4gICAgICAgICAgICAgICAgZGF0YS5uYW1lID0gJGN1cnJlbnQudmFsKCk7XG4gICAgICAgICAgICAgICAgaXRlbXMucHVzaChkYXRhKTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBBY3Rpb25zU2VydmljZS5wcm9jZXNzQWN0aW9uKHtcbiAgICAgICAgICAgICAgICBhY3Rpb246ICRmb3JtLmRhdGEoJ2FjdGlvbicpLFxuICAgICAgICAgICAgICAgIHNlbGVjdGVkOiBpdGVtc1xuICAgICAgICAgICAgfSwgZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgIGlmICghcmVzLmVycm9yKSB7XG4gICAgICAgICAgICAgICAgICAgICRmb3JtLmNsb3Nlc3QoJy5tb2RhbCcpLm1vZGFsKCdoaWRlJyk7XG4gICAgICAgICAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlKTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAkKCcjbW9kYWxfcmVuYW1lX2l0ZW1zIC5mb3JtLWdyb3VwJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBsZXQgJGN1cnJlbnQgPSAkKHRoaXMpO1xuICAgICAgICAgICAgICAgICAgICAgICAgaWYgKF8uaW5jbHVkZXMocmVzLmRhdGEsICRjdXJyZW50LmRhdGEoJ2lkJykpKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJGN1cnJlbnQuYWRkQ2xhc3MoJ2hhcy1lcnJvcicpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkY3VycmVudC5yZW1vdmVDbGFzcygnaGFzLWVycm9yJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcblxuICAgICAgICAvKkRlbGV0ZSBmaWxlcyovXG4gICAgICAgIF9zZWxmLiRib2R5Lm9uKCdzdWJtaXQnLCAnLmZvcm0tZGVsZXRlLWl0ZW1zJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgbGV0IGl0ZW1zID0gW107XG4gICAgICAgICAgICBsZXQgJGZvcm0gPSAkKHRoaXMpO1xuXG4gICAgICAgICAgICBfLmVhY2goSGVscGVycy5nZXRTZWxlY3RlZEl0ZW1zKCksIGZ1bmN0aW9uICh2YWx1ZSkge1xuICAgICAgICAgICAgICAgIGl0ZW1zLnB1c2goe1xuICAgICAgICAgICAgICAgICAgICBpZDogdmFsdWUuaWQsXG4gICAgICAgICAgICAgICAgICAgIGlzX2ZvbGRlcjogdmFsdWUuaXNfZm9sZGVyLFxuICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UucHJvY2Vzc0FjdGlvbih7XG4gICAgICAgICAgICAgICAgYWN0aW9uOiAkZm9ybS5kYXRhKCdhY3Rpb24nKSxcbiAgICAgICAgICAgICAgICBzZWxlY3RlZDogaXRlbXNcbiAgICAgICAgICAgIH0sIGZ1bmN0aW9uIChyZXMpIHtcbiAgICAgICAgICAgICAgICAkZm9ybS5jbG9zZXN0KCcubW9kYWwnKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICAgICAgICAgIGlmICghcmVzLmVycm9yKSB7XG4gICAgICAgICAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLypFbXB0eSB0cmFzaCovXG4gICAgICAgIF9zZWxmLiRib2R5Lm9uKCdzdWJtaXQnLCAnI21vZGFsX2VtcHR5X3RyYXNoIC5ydi1mb3JtJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgbGV0ICRmb3JtID0gJCh0aGlzKTtcblxuICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UucHJvY2Vzc0FjdGlvbih7XG4gICAgICAgICAgICAgICAgYWN0aW9uOiAkZm9ybS5kYXRhKCdhY3Rpb24nKVxuICAgICAgICAgICAgfSwgZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgICRmb3JtLmNsb3Nlc3QoJy5tb2RhbCcpLm1vZGFsKCdoaWRlJyk7XG4gICAgICAgICAgICAgICAgX3NlbGYuTWVkaWFTZXJ2aWNlLmdldE1lZGlhKHRydWUpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGlmIChNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy52aWV3X2luID09PSAndHJhc2gnKSB7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLnByb3AoJ2Rpc2FibGVkJywgdHJ1ZSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKGRvY3VtZW50KS5maW5kKCcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLnByb3AoJ2Rpc2FibGVkJywgZmFsc2UpO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy5iaW5kSW50ZWdyYXRlTW9kYWxFdmVudHMoKTtcbiAgICB9XG5cbiAgICBjaGVja0ZpbGVUeXBlU2VsZWN0KHNlbGVjdGVkRmlsZXMpIHtcbiAgICAgICAgaWYgKHR5cGVvZiB3aW5kb3cucnZNZWRpYS4kZWwgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICBsZXQgZmlyc3RJdGVtID0gXy5maXJzdChzZWxlY3RlZEZpbGVzKTtcbiAgICAgICAgICAgIGxldCBlbGVfb3B0aW9ucyA9IHdpbmRvdy5ydk1lZGlhLiRlbC5kYXRhKCdydi1tZWRpYScpO1xuICAgICAgICAgICAgaWYgKHR5cGVvZiBlbGVfb3B0aW9ucyAhPT0gJ3VuZGVmaW5lZCcgJiYgdHlwZW9mIGVsZV9vcHRpb25zWzBdICE9PSAndW5kZWZpbmVkJyAmJiB0eXBlb2YgZWxlX29wdGlvbnNbMF0uZmlsZV90eXBlICE9PSAndW5kZWZpbmVkJyAmJiBmaXJzdEl0ZW0gIT09ICd1bmRlZmluZWQnXG4gICAgICAgICAgICAgICAgJiYgZmlyc3RJdGVtLnR5cGUgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICAgICAgaWYgKCFlbGVfb3B0aW9uc1swXS5maWxlX3R5cGUubWF0Y2goZmlyc3RJdGVtLnR5cGUpKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICBpZiAoIHR5cGVvZiBlbGVfb3B0aW9uc1swXS5leHRfYWxsb3dlZCAhPT0gJ3VuZGVmaW5lZCcgJiYgJC5pc0FycmF5KGVsZV9vcHRpb25zWzBdLmV4dF9hbGxvd2VkKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCQuaW5BcnJheShmaXJzdEl0ZW0ubWltZV90eXBlLCBlbGVfb3B0aW9uc1swXS5leHRfYWxsb3dlZCkgPT0gLTEpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgfVxuXG4gICAgYmluZEludGVncmF0ZU1vZGFsRXZlbnRzKCkge1xuICAgICAgICBsZXQgJG1haW5fbW9kYWwgPSAkKCcjcnZfbWVkaWFfbW9kYWwnKTtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgJG1haW5fbW9kYWwub2ZmKCdjbGljaycsICcuanMtaW5zZXJ0LXRvLWVkaXRvcicpLm9uKCdjbGljaycsICcuanMtaW5zZXJ0LXRvLWVkaXRvcicsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIGxldCBzZWxlY3RlZEZpbGVzID0gSGVscGVycy5nZXRTZWxlY3RlZEZpbGVzKCk7XG4gICAgICAgICAgICBpZiAoXy5zaXplKHNlbGVjdGVkRmlsZXMpID4gMCkge1xuICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub25TZWxlY3RGaWxlcyhzZWxlY3RlZEZpbGVzLCB3aW5kb3cucnZNZWRpYS4kZWwpO1xuICAgICAgICAgICAgICAgIGlmIChfc2VsZi5jaGVja0ZpbGVUeXBlU2VsZWN0KHNlbGVjdGVkRmlsZXMpKSB7XG4gICAgICAgICAgICAgICAgICAgICRtYWluX21vZGFsLmZpbmQoJy5jbG9zZScpLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAkbWFpbl9tb2RhbC5vZmYoJ2RibGNsaWNrJywgJy5qcy1tZWRpYS1saXN0LXRpdGxlJykub24oJ2RibGNsaWNrJywgJy5qcy1tZWRpYS1saXN0LXRpdGxlJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgaWYgKEhlbHBlcnMuZ2V0Q29uZmlncygpLnJlcXVlc3RfcGFyYW1zLnZpZXdfaW4gIT09ICd0cmFzaCcpIHtcbiAgICAgICAgICAgICAgICBsZXQgc2VsZWN0ZWRGaWxlcyA9IEhlbHBlcnMuZ2V0U2VsZWN0ZWRGaWxlcygpO1xuICAgICAgICAgICAgICAgIGlmIChfLnNpemUoc2VsZWN0ZWRGaWxlcykgPiAwKSB7XG4gICAgICAgICAgICAgICAgICAgIHdpbmRvdy5ydk1lZGlhLm9wdGlvbnMub25TZWxlY3RGaWxlcyhzZWxlY3RlZEZpbGVzLCB3aW5kb3cucnZNZWRpYS4kZWwpO1xuICAgICAgICAgICAgICAgICAgICBpZiAoX3NlbGYuY2hlY2tGaWxlVHlwZVNlbGVjdChzZWxlY3RlZEZpbGVzKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgJG1haW5fbW9kYWwuZmluZCgnLmNsb3NlJykudHJpZ2dlcignY2xpY2snKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UuaGFuZGxlUHJldmlldygpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzdGF0aWMgc2V0dXBTZWN1cml0eSgpIHtcbiAgICAgICAgJC5hamF4U2V0dXAoe1xuICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cblxuXG5cbiAgICAvL3Njcm9sbCBnZXQgbW9yZSBtZWRpYVxuICAgIHNjcm9sbEdldE1vcmUoKSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG4gICAgICAgICQoJy5ydi1tZWRpYS1tYWluIC5ydi1tZWRpYS1pdGVtcycpLmJpbmQoJ0RPTU1vdXNlU2Nyb2xsIG1vdXNld2hlZWwnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgaWYgKGUub3JpZ2luYWxFdmVudC5kZXRhaWwgPiAwIHx8IGUub3JpZ2luYWxFdmVudC53aGVlbERlbHRhIDwgMCkge1xuICAgICAgICAgICAgICAgIGxldCAkbG9hZF9tb3JlID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgaWYgKCQodGhpcykuY2xvc2VzdCgnLm1lZGlhLW1vZGFsJykubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgICAgICAgICAkbG9hZF9tb3JlID0gJCh0aGlzKS5zY3JvbGxUb3AoKSArICQodGhpcykuaW5uZXJIZWlnaHQoKSAvMiA+PSAkKHRoaXMpWzBdLnNjcm9sbEhlaWdodCAtIDQ1MFxuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICRsb2FkX21vcmUgPSAkKHRoaXMpLnNjcm9sbFRvcCgpICsgJCh0aGlzKS5pbm5lckhlaWdodCgpID49ICQodGhpcylbMF0uc2Nyb2xsSGVpZ2h0IC0gMTUwXG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKCRsb2FkX21vcmUpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKHR5cGVvZiBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbiAhPSAndW5kZWZpbmVkJyAmJiBSVl9NRURJQV9DT05GSUcucGFnaW5hdGlvbi5oYXNfbW9yZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgX3NlbGYuTWVkaWFTZXJ2aWNlLmdldE1lZGlhKGZhbHNlLCBmYWxzZSwgdHJ1ZSk7XG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAgIHdpbmRvdy5ydk1lZGlhID0gd2luZG93LnJ2TWVkaWEgfHwge307XG5cbiAgICBNZWRpYU1hbmFnZW1lbnQuc2V0dXBTZWN1cml0eSgpO1xuICAgIG5ldyBNZWRpYU1hbmFnZW1lbnQoKS5pbml0KCk7XG59KTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL21lZGlhLmpzIiwiaW1wb3J0IHtBY3Rpb25zU2VydmljZX0gZnJvbSAnLi9BY3Rpb25zU2VydmljZSc7XG5pbXBvcnQge0hlbHBlcnN9IGZyb20gJy4uL0hlbHBlcnMvSGVscGVycyc7XG5cbmV4cG9ydCBjbGFzcyBDb250ZXh0TWVudVNlcnZpY2Uge1xuICAgIHN0YXRpYyBpbml0Q29udGV4dCgpIHtcbiAgICAgICAgaWYgKGpRdWVyeSgpLmNvbnRleHRNZW51KSB7XG4gICAgICAgICAgICAkLmNvbnRleHRNZW51KHtcbiAgICAgICAgICAgICAgICBzZWxlY3RvcjogJy5qcy1jb250ZXh0LW1lbnVbZGF0YS1jb250ZXh0PVwiZmlsZVwiXScsXG4gICAgICAgICAgICAgICAgYnVpbGQ6IGZ1bmN0aW9uICgkZWxlbWVudCwgZXZlbnQpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW1zOiBDb250ZXh0TWVudVNlcnZpY2UuX2ZpbGVDb250ZXh0TWVudSgpLFxuICAgICAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgJC5jb250ZXh0TWVudSh7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3I6ICcuanMtY29udGV4dC1tZW51W2RhdGEtY29udGV4dD1cImZvbGRlclwiXScsXG4gICAgICAgICAgICAgICAgYnVpbGQ6IGZ1bmN0aW9uICgkZWxlbWVudCwgZXZlbnQpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW1zOiBDb250ZXh0TWVudVNlcnZpY2UuX2ZvbGRlckNvbnRleHRNZW51KCksXG4gICAgICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc3RhdGljIF9maWxlQ29udGV4dE1lbnUoKSB7XG4gICAgICAgIGxldCBpdGVtcyA9IHtcbiAgICAgICAgICAgIHByZXZpZXc6IHtcbiAgICAgICAgICAgICAgICBuYW1lOiAnUHJldmlldycsXG4gICAgICAgICAgICAgICAgaWNvbjogZnVuY3Rpb24gKG9wdCwgJGl0ZW1FbGVtZW50LCBpdGVtS2V5LCBpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgICRpdGVtRWxlbWVudC5odG1sKCc8aSBjbGFzcz1cImZhIGZhLWV5ZVwiIGFyaWEtaGlkZGVuPVwidHJ1ZVwiPjwvaT4gJyArIGl0ZW0ubmFtZSk7XG5cbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuICdjb250ZXh0LW1lbnUtaWNvbi11cGRhdGVkJztcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIGNhbGxiYWNrOiBmdW5jdGlvbiAoa2V5LCBvcHQpIHtcbiAgICAgICAgICAgICAgICAgICAgQWN0aW9uc1NlcnZpY2UuaGFuZGxlUHJldmlldygpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgXy5lYWNoKEhlbHBlcnMuZ2V0Q29uZmlncygpLmFjdGlvbnNfbGlzdCwgZnVuY3Rpb24gKGFjdGlvbkdyb3VwLCBrZXkpIHtcbiAgICAgICAgICAgIF8uZWFjaChhY3Rpb25Hcm91cCwgZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgICAgICAgICAgICAgaXRlbXNbdmFsdWUuYWN0aW9uXSA9IHtcbiAgICAgICAgICAgICAgICAgICAgbmFtZTogdmFsdWUubmFtZSxcbiAgICAgICAgICAgICAgICAgICAgaWNvbjogZnVuY3Rpb24gKG9wdCwgJGl0ZW1FbGVtZW50LCBpdGVtS2V5LCBpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkaXRlbUVsZW1lbnQuaHRtbCgnPGkgY2xhc3M9XCInICsgdmFsdWUuaWNvbiArICdcIiBhcmlhLWhpZGRlbj1cInRydWVcIj48L2k+ICcgKyAoUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5hY3Rpb25zX2xpc3Rba2V5XVt2YWx1ZS5hY3Rpb25dIHx8IGl0ZW0ubmFtZSkpO1xuXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gJ2NvbnRleHQtbWVudS1pY29uLXVwZGF0ZWQnO1xuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICBjYWxsYmFjazogZnVuY3Rpb24gKGtleSwgb3B0KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKCcuanMtZmlsZXMtYWN0aW9uW2RhdGEtYWN0aW9uPVwiJyArIHZhbHVlLmFjdGlvbiArICdcIl0nKS50cmlnZ2VyKCdjbGljaycpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfTtcbiAgICAgICAgICAgIH0pXG4gICAgICAgIH0pO1xuXG4gICAgICAgIGxldCBleGNlcHQgPSBbXTtcblxuICAgICAgICBzd2l0Y2ggKEhlbHBlcnMuZ2V0UmVxdWVzdFBhcmFtcygpLnZpZXdfaW4pIHtcbiAgICAgICAgICAgIGNhc2UgJ2FsbF9tZWRpYSc6XG4gICAgICAgICAgICAgICAgZXhjZXB0ID0gWydyZW1vdmVfZmF2b3JpdGUnLCAnZGVsZXRlJywgJ3Jlc3RvcmUnXTtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ3JlY2VudCc6XG4gICAgICAgICAgICAgICAgZXhjZXB0ID0gWydyZW1vdmVfZmF2b3JpdGUnLCAnZGVsZXRlJywgJ3Jlc3RvcmUnLCAnbWFrZV9jb3B5J107XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlICdmYXZvcml0ZXMnOlxuICAgICAgICAgICAgICAgIGV4Y2VwdCA9IFsnZmF2b3JpdGUnLCAnZGVsZXRlJywgJ3Jlc3RvcmUnLCAnbWFrZV9jb3B5J107XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlICd0cmFzaCc6XG4gICAgICAgICAgICAgICAgaXRlbXMgPSB7XG4gICAgICAgICAgICAgICAgICAgIHByZXZpZXc6IGl0ZW1zLnByZXZpZXcsXG4gICAgICAgICAgICAgICAgICAgIHJlbmFtZTogaXRlbXMucmVuYW1lLFxuICAgICAgICAgICAgICAgICAgICBkb3dubG9hZDogaXRlbXMuZG93bmxvYWQsXG4gICAgICAgICAgICAgICAgICAgIGRlbGV0ZTogaXRlbXMuZGVsZXRlLFxuICAgICAgICAgICAgICAgICAgICByZXN0b3JlOiBpdGVtcy5yZXN0b3JlLFxuICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgIH1cblxuICAgICAgICBfLmVhY2goZXhjZXB0LCBmdW5jdGlvbiAodmFsdWUpIHtcbiAgICAgICAgICAgIGl0ZW1zW3ZhbHVlXSA9IHVuZGVmaW5lZDtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgbGV0IGhhc0ZvbGRlclNlbGVjdGVkID0gSGVscGVycy5nZXRTZWxlY3RlZEZvbGRlcigpLmxlbmd0aCA+IDA7XG5cbiAgICAgICAgaWYgKGhhc0ZvbGRlclNlbGVjdGVkKSB7XG4gICAgICAgICAgICBpdGVtcy5wcmV2aWV3ID0gdW5kZWZpbmVkO1xuICAgICAgICAgICAgaXRlbXMuY29weV9saW5rID0gdW5kZWZpbmVkO1xuXG4gICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoUlZfTUVESUFfQ09ORklHLnBlcm1pc3Npb25zLCAnZm9sZGVycy5jcmVhdGUnKSkge1xuICAgICAgICAgICAgICAgIGl0ZW1zLm1ha2VfY29weSA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZvbGRlcnMuZWRpdCcpKSB7XG4gICAgICAgICAgICAgICAgaXRlbXMucmVuYW1lID0gdW5kZWZpbmVkO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoUlZfTUVESUFfQ09ORklHLnBlcm1pc3Npb25zLCAnZm9sZGVycy50cmFzaCcpKSB7XG4gICAgICAgICAgICAgICAgaXRlbXMudHJhc2ggPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICAgICAgaXRlbXMucmVzdG9yZSA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZvbGRlcnMuZGVsZXRlJykpIHtcbiAgICAgICAgICAgICAgICBpdGVtcy5kZWxldGUgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmb2xkZXJzLmZhdm9yaXRlJykpIHtcbiAgICAgICAgICAgICAgICBpdGVtcy5mYXZvcml0ZSA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgICAgICBpdGVtcy5yZW1vdmVfZmF2b3JpdGUgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBsZXQgc2VsZWN0ZWRGaWxlcyA9IEhlbHBlcnMuZ2V0U2VsZWN0ZWRGaWxlcygpO1xuXG4gICAgICAgIGlmIChzZWxlY3RlZEZpbGVzLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmaWxlcy5jcmVhdGUnKSkge1xuICAgICAgICAgICAgICAgIGl0ZW1zLm1ha2VfY29weSA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZpbGVzLmVkaXQnKSkge1xuICAgICAgICAgICAgICAgIGl0ZW1zLnJlbmFtZSA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCFfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZpbGVzLnRyYXNoJykpIHtcbiAgICAgICAgICAgICAgICBpdGVtcy50cmFzaCA9IHVuZGVmaW5lZDtcbiAgICAgICAgICAgICAgICBpdGVtcy5yZXN0b3JlID0gdW5kZWZpbmVkO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIV8uaW5jbHVkZXMoUlZfTUVESUFfQ09ORklHLnBlcm1pc3Npb25zLCAnZmlsZXMuZGVsZXRlJykpIHtcbiAgICAgICAgICAgICAgICBpdGVtcy5kZWxldGUgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmICghXy5pbmNsdWRlcyhSVl9NRURJQV9DT05GSUcucGVybWlzc2lvbnMsICdmaWxlcy5mYXZvcml0ZScpKSB7XG4gICAgICAgICAgICAgICAgaXRlbXMuZmF2b3JpdGUgPSB1bmRlZmluZWQ7XG4gICAgICAgICAgICAgICAgaXRlbXMucmVtb3ZlX2Zhdm9yaXRlID0gdW5kZWZpbmVkO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICAgICAgbGV0IGNhbl9wcmV2aWV3ID0gZmFsc2U7XG4gICAgICAgIF8uZWFjaChzZWxlY3RlZEZpbGVzLCBmdW5jdGlvbiAodmFsdWUpIHtcbiAgICAgICAgICAgIGlmIChfLmluY2x1ZGVzKFsnaW1hZ2UnLCAneW91dHViZScsICdwZGYnLCAndGV4dCcsICd2aWRlbyddLCB2YWx1ZS50eXBlKSkge1xuICAgICAgICAgICAgICAgIGNhbl9wcmV2aWV3ID0gdHJ1ZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgaWYgKCFjYW5fcHJldmlldykge1xuICAgICAgICAgICAgaXRlbXMucHJldmlldyA9IHVuZGVmaW5lZDtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBpdGVtcztcbiAgICB9XG5cbiAgICBzdGF0aWMgX2ZvbGRlckNvbnRleHRNZW51KCkge1xuICAgICAgICBsZXQgaXRlbXMgPSBDb250ZXh0TWVudVNlcnZpY2UuX2ZpbGVDb250ZXh0TWVudSgpO1xuXG4gICAgICAgIGl0ZW1zLnByZXZpZXcgPSB1bmRlZmluZWQ7XG4gICAgICAgIGl0ZW1zLmNvcHlfbGluayA9IHVuZGVmaW5lZDtcblxuICAgICAgICByZXR1cm4gaXRlbXM7XG4gICAgfVxuXG4gICAgc3RhdGljIGRlc3Ryb3lDb250ZXh0KCkge1xuICAgICAgICBpZiAoalF1ZXJ5KCkuY29udGV4dE1lbnUpIHtcbiAgICAgICAgICAgICQuY29udGV4dE1lbnUoJ2Rlc3Ryb3knKTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1NlcnZpY2VzL0NvbnRleHRNZW51U2VydmljZS5qcyIsImltcG9ydCB7SGVscGVyc30gZnJvbSAnLi4vSGVscGVycy9IZWxwZXJzJztcblxuZXhwb3J0IGNsYXNzIE1lZGlhRGV0YWlscyB7XG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMuJGRldGFpbHNXcmFwcGVyID0gJCgnLnJ2LW1lZGlhLW1haW4gLnJ2LW1lZGlhLWRldGFpbHMnKTtcblxuICAgICAgICB0aGlzLmRlc2NyaXB0aW9uSXRlbVRlbXBsYXRlID0gJzxkaXYgY2xhc3M9XCJydi1tZWRpYS1uYW1lXCI+PHA+X190aXRsZV9fPC9wPl9fdXJsX188L2Rpdj4nO1xuXG4gICAgICAgIHRoaXMub25seUZpZWxkcyA9IFtcbiAgICAgICAgICAgICduYW1lJyxcbiAgICAgICAgICAgICdmdWxsX3VybCcsXG4gICAgICAgICAgICAnc2l6ZScsXG4gICAgICAgICAgICAnbWltZV90eXBlJyxcbiAgICAgICAgICAgICdjcmVhdGVkX2F0JyxcbiAgICAgICAgICAgICd1cGRhdGVkX2F0JyxcbiAgICAgICAgICAgICdub3RoaW5nX3NlbGVjdGVkJyxcbiAgICAgICAgXTtcblxuICAgICAgICB0aGlzLmV4dGVybmFsVHlwZXMgPSBbXG4gICAgICAgICAgICAneW91dHViZScsXG4gICAgICAgICAgICAndmltZW8nLFxuICAgICAgICAgICAgJ21ldGFjYWZlJyxcbiAgICAgICAgICAgICdkYWlseW1vdGlvbicsXG4gICAgICAgICAgICAndmluZScsXG4gICAgICAgICAgICAnaW5zdGFncmFtJyxcbiAgICAgICAgXTtcbiAgICB9XG5cbiAgICByZW5kZXJEYXRhKGRhdGEpIHtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgbGV0IHRodW1iID0gZGF0YS50eXBlID09PSAnaW1hZ2UnID8gJzxpbWcgc3JjPVwiJyArIGRhdGEuZnVsbF91cmwgKyAnXCIgYWx0PVwiJyArIGRhdGEubmFtZSArICdcIj4nIDogZGF0YS5taW1lX3R5cGUgPT09ICd5b3V0dWJlJyA/ICc8aW1nIHNyYz1cIicgKyBkYXRhLm9wdGlvbnMudGh1bWIgKyAnXCIgYWx0PVwiJyArIGRhdGEubmFtZSArICdcIj4nIDogJzxpIGNsYXNzPVwiJyArIGRhdGEuaWNvbiArICdcIj48L2k+JztcbiAgICAgICAgbGV0IGRlc2NyaXB0aW9uID0gJyc7XG4gICAgICAgIGxldCB1c2VDbGlwYm9hcmQgPSBmYWxzZTtcbiAgICAgICAgXy5mb3JFYWNoKGRhdGEsIGZ1bmN0aW9uICh2YWwsIGluZGV4KSB7XG4gICAgICAgICAgICBpZiAoXy5pbmNsdWRlcyhfc2VsZi5vbmx5RmllbGRzLCBpbmRleCkpIHtcbiAgICAgICAgICAgICAgICBpZiAoKCFfLmluY2x1ZGVzKF9zZWxmLmV4dGVybmFsVHlwZXMsIGRhdGEudHlwZSkpIHx8IChfLmluY2x1ZGVzKF9zZWxmLmV4dGVybmFsVHlwZXMsIGRhdGEudHlwZSkgJiYgIV8uaW5jbHVkZXMoWydzaXplJywgJ21pbWVfdHlwZSddLCBpbmRleCkpKSB7XG4gICAgICAgICAgICAgICAgICAgIGRlc2NyaXB0aW9uICs9IF9zZWxmLmRlc2NyaXB0aW9uSXRlbVRlbXBsYXRlXG4gICAgICAgICAgICAgICAgICAgICAgICAucmVwbGFjZSgvX190aXRsZV9fL2dpLCBSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zW2luZGV4XSlcbiAgICAgICAgICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3VybF9fL2dpLCB2YWwgPyBpbmRleCA9PT0gJ2Z1bGxfdXJsJyA/ICc8ZGl2IGNsYXNzPVwiaW5wdXQtZ3JvdXBcIj48aW5wdXQgaWQ9XCJmaWxlX2RldGFpbHNfdXJsXCIgdHlwZT1cInRleHRcIiB2YWx1ZT1cIicgKyB2YWwgKyAnXCIgY2xhc3M9XCJmb3JtLWNvbnRyb2xcIj48c3BhbiBjbGFzcz1cImlucHV0LWdyb3VwLWJ0blwiPjxidXR0b24gY2xhc3M9XCJidG4gYnRuLWRlZmF1bHQganMtYnRuLWNvcHktdG8tY2xpcGJvYXJkXCIgdHlwZT1cImJ1dHRvblwiIGRhdGEtY2xpcGJvYXJkLXRhcmdldD1cIiNmaWxlX2RldGFpbHNfdXJsXCIgdGl0bGU9XCJDb3BpZWRcIiBkYXRhLXRyaWdnZXI9XCJjbGlja1wiPjxpbWcgY2xhc3M9XCJjbGlwcHlcIiBzcmM9XCInICsgSGVscGVycy5hc3NldCgnL3ZlbmRvci9tZWRpYS9pbWFnZXMvY2xpcHB5LnN2ZycpICsgJ1wiIHdpZHRoPVwiMTNcIiBhbHQ9XCJDb3B5IHRvIGNsaXBib2FyZFwiPjwvYnV0dG9uPjwvc3Bhbj48L2Rpdj4nIDogJzxzcGFuIHRpdGxlPVwiJyArIHZhbCArICdcIj4nICsgdmFsICsgJzwvc3Bhbj4nIDogJycpO1xuICAgICAgICAgICAgICAgICAgICBpZiAoaW5kZXggPT09ICdmdWxsX3VybCcpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHVzZUNsaXBib2FyZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICBfc2VsZi4kZGV0YWlsc1dyYXBwZXIuZmluZCgnLnJ2LW1lZGlhLXRodW1ibmFpbCcpLmh0bWwodGh1bWIpO1xuICAgICAgICBfc2VsZi4kZGV0YWlsc1dyYXBwZXIuZmluZCgnLnJ2LW1lZGlhLWRlc2NyaXB0aW9uJykuaHRtbChkZXNjcmlwdGlvbik7XG4gICAgICAgIGlmICh1c2VDbGlwYm9hcmQpIHtcbiAgICAgICAgICAgIGxldCBjbGlwYm9hcmQgPSBuZXcgQ2xpcGJvYXJkKCcuanMtYnRuLWNvcHktdG8tY2xpcGJvYXJkJyk7XG4gICAgICAgICAgICAkKCcuanMtYnRuLWNvcHktdG8tY2xpcGJvYXJkJykudG9vbHRpcCgpLm9uKCdtb3VzZWxlYXZlJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS50b29sdGlwKCdoaWRlJyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1ZpZXdzL01lZGlhRGV0YWlscy5qcyIsImltcG9ydCB7TWVkaWFMaXN0fSBmcm9tICcuLi9WaWV3cy9NZWRpYUxpc3QnO1xuaW1wb3J0IHtNZWRpYUNvbmZpZ30gZnJvbSAnLi4vQ29uZmlnL01lZGlhQ29uZmlnJztcbmltcG9ydCB7TWVkaWFTZXJ2aWNlfSBmcm9tICcuL01lZGlhU2VydmljZSc7XG5pbXBvcnQge01lc3NhZ2VTZXJ2aWNlfSBmcm9tICcuLi9TZXJ2aWNlcy9NZXNzYWdlU2VydmljZSc7XG5pbXBvcnQge0hlbHBlcnN9IGZyb20gJy4uL0hlbHBlcnMvSGVscGVycyc7XG5cbmV4cG9ydCBjbGFzcyBGb2xkZXJTZXJ2aWNlIHtcbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5NZWRpYUxpc3QgPSBuZXcgTWVkaWFMaXN0KCk7XG4gICAgICAgIHRoaXMuTWVkaWFTZXJ2aWNlID0gbmV3IE1lZGlhU2VydmljZSgpO1xuXG4gICAgICAgICQoJ2JvZHknKS5vbignc2hvd24uYnMubW9kYWwnLCAnI21vZGFsX2FkZF9mb2xkZXInLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmZpbmQoJy5mb3JtLWFkZC1mb2xkZXIgaW5wdXRbdHlwZT10ZXh0XScpLmZvY3VzKCk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGNyZWF0ZShmb2xkZXJOYW1lKSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IFJWX01FRElBX1VSTC5jcmVhdGVfZm9sZGVyLFxuICAgICAgICAgICAgdHlwZTogJ1BPU1QnLFxuICAgICAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgICAgIHBhcmVudF9pZDogSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkuZm9sZGVyX2lkLFxuICAgICAgICAgICAgICAgIG5hbWU6IGZvbGRlck5hbWVcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIEhlbHBlcnMuc2hvd0FqYXhMb2FkaW5nKCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgIGlmIChyZXMuZXJyb3IpIHtcbiAgICAgICAgICAgICAgICAgICAgTWVzc2FnZVNlcnZpY2Uuc2hvd01lc3NhZ2UoJ2Vycm9yJywgcmVzLm1lc3NhZ2UsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5lcnJvcl9oZWFkZXIpO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIE1lc3NhZ2VTZXJ2aWNlLnNob3dNZXNzYWdlKCdzdWNjZXNzJywgcmVzLm1lc3NhZ2UsIFJWX01FRElBX0NPTkZJRy50cmFuc2xhdGlvbnMubWVzc2FnZS5zdWNjZXNzX2hlYWRlcik7XG4gICAgICAgICAgICAgICAgICAgIEhlbHBlcnMucmVzZXRQYWdpbmF0aW9uKCk7XG4gICAgICAgICAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlKTtcbiAgICAgICAgICAgICAgICAgICAgRm9sZGVyU2VydmljZS5jbG9zZU1vZGFsKCk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGNvbXBsZXRlOiBmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgIEhlbHBlcnMuaGlkZUFqYXhMb2FkaW5nKCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgTWVzc2FnZVNlcnZpY2UuaGFuZGxlRXJyb3IoZGF0YSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGNoYW5nZUZvbGRlcihmb2xkZXJJZCkge1xuICAgICAgICBNZWRpYUNvbmZpZy5yZXF1ZXN0X3BhcmFtcy5mb2xkZXJfaWQgPSBmb2xkZXJJZDtcbiAgICAgICAgSGVscGVycy5zdG9yZUNvbmZpZygpO1xuICAgICAgICB0aGlzLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlKTtcbiAgICB9XG5cbiAgICBzdGF0aWMgY2xvc2VNb2RhbCgpIHtcbiAgICAgICAgJCgnI21vZGFsX2FkZF9mb2xkZXInKS5tb2RhbCgnaGlkZScpO1xuICAgIH1cbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL1NlcnZpY2VzL0ZvbGRlclNlcnZpY2UuanMiLCJpbXBvcnQge01lZGlhU2VydmljZX0gZnJvbSAnLi4vU2VydmljZXMvTWVkaWFTZXJ2aWNlJztcbmltcG9ydCB7SGVscGVyc30gZnJvbSAnLi4vSGVscGVycy9IZWxwZXJzJztcblxuZXhwb3J0IGNsYXNzIFVwbG9hZFNlcnZpY2Uge1xuICAgIGNvbnN0cnVjdG9yKCkge1xuICAgICAgICB0aGlzLiRib2R5ID0gJCgnYm9keScpO1xuXG4gICAgICAgIHRoaXMuZHJvcFpvbmUgPSBudWxsO1xuXG4gICAgICAgIHRoaXMudXBsb2FkVXJsID0gUlZfTUVESUFfVVJMLnVwbG9hZF9maWxlO1xuXG4gICAgICAgIHRoaXMudXBsb2FkUHJvZ3Jlc3NCb3ggPSAkKCcucnYtdXBsb2FkLXByb2dyZXNzJyk7XG5cbiAgICAgICAgdGhpcy51cGxvYWRQcm9ncmVzc0NvbnRhaW5lciA9ICQoJy5ydi11cGxvYWQtcHJvZ3Jlc3MgLnJ2LXVwbG9hZC1wcm9ncmVzcy10YWJsZScpO1xuXG4gICAgICAgIHRoaXMudXBsb2FkUHJvZ3Jlc3NUZW1wbGF0ZSA9ICQoJyNydl9tZWRpYV91cGxvYWRfcHJvZ3Jlc3NfaXRlbScpLmh0bWwoKTtcblxuICAgICAgICB0aGlzLnRvdGFsUXVldWVkID0gMTtcblxuICAgICAgICB0aGlzLk1lZGlhU2VydmljZSA9IG5ldyBNZWRpYVNlcnZpY2UoKTtcblxuICAgICAgICB0aGlzLnRvdGFsRXJyb3IgPSAwO1xuICAgIH1cblxuICAgIGluaXQoKSB7XG4gICAgICAgIGlmIChfLmluY2x1ZGVzKFJWX01FRElBX0NPTkZJRy5wZXJtaXNzaW9ucywgJ2ZpbGVzLmNyZWF0ZScpICYmICQoJy5ydi1tZWRpYS1pdGVtcycpLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICAgIHRoaXMuc2V0dXBEcm9wWm9uZSgpO1xuICAgICAgICB9XG4gICAgICAgIHRoaXMuaGFuZGxlRXZlbnRzKCk7XG4gICAgfVxuXG4gICAgc2V0dXBEcm9wWm9uZSgpIHtcbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcbiAgICAgICAgX3NlbGYuZHJvcFpvbmUgPSBuZXcgRHJvcHpvbmUoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnJ2LW1lZGlhLWl0ZW1zJyksIHtcbiAgICAgICAgICAgIHVybDogX3NlbGYudXBsb2FkVXJsLFxuICAgICAgICAgICAgdGh1bWJuYWlsV2lkdGg6IGZhbHNlLFxuICAgICAgICAgICAgdGh1bWJuYWlsSGVpZ2h0OiBmYWxzZSxcbiAgICAgICAgICAgIHBhcmFsbGVsVXBsb2FkczogMSxcbiAgICAgICAgICAgIGF1dG9RdWV1ZTogdHJ1ZSxcbiAgICAgICAgICAgIGNsaWNrYWJsZTogJy5qcy1kcm9wem9uZS11cGxvYWQnLFxuICAgICAgICAgICAgcHJldmlld1RlbXBsYXRlOiBmYWxzZSxcbiAgICAgICAgICAgIHByZXZpZXdzQ29udGFpbmVyOiBmYWxzZSxcbiAgICAgICAgICAgIHVwbG9hZE11bHRpcGxlOiB0cnVlLFxuICAgICAgICAgICAgc2VuZGluZzogZnVuY3Rpb24gKGZpbGUsIHhociwgZm9ybURhdGEpIHtcbiAgICAgICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoJ190b2tlbicsICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JykpO1xuICAgICAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZCgnZm9sZGVyX2lkJywgSGVscGVycy5nZXRSZXF1ZXN0UGFyYW1zKCkuZm9sZGVyX2lkKTtcbiAgICAgICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoJ3ZpZXdfaW4nLCBIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKS52aWV3X2luKTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pO1xuXG4gICAgICAgIF9zZWxmLmRyb3Bab25lLm9uKCdhZGRlZGZpbGUnLCBmaWxlID0+IHtcbiAgICAgICAgICAgIGZpbGUuaW5kZXggPSBfc2VsZi50b3RhbFF1ZXVlZDtcbiAgICAgICAgICAgIF9zZWxmLnRvdGFsUXVldWVkKys7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIF9zZWxmLmRyb3Bab25lLm9uKCdzZW5kaW5nJywgZmlsZSA9PiB7XG4gICAgICAgICAgICBfc2VsZi5pbml0UHJvZ3Jlc3MoZmlsZS5uYW1lLCBmaWxlLnNpemUpO1xuICAgICAgICB9KTtcblxuICAgICAgICBfc2VsZi5kcm9wWm9uZS5vbignc3VjY2VzcycsIGZpbGUgPT4ge1xuXG4gICAgICAgIH0pO1xuXG4gICAgICAgIF9zZWxmLmRyb3Bab25lLm9uKCdjb21wbGV0ZScsIGZpbGUgPT4ge1xuICAgICAgICAgICAgX3NlbGYuY2hhbmdlUHJvZ3Jlc3NTdGF0dXMoZmlsZSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIF9zZWxmLmRyb3Bab25lLm9uKCdxdWV1ZWNvbXBsZXRlJywgKCkgPT4ge1xuICAgICAgICAgICAgSGVscGVycy5yZXNldFBhZ2luYXRpb24oKTtcbiAgICAgICAgICAgIF9zZWxmLk1lZGlhU2VydmljZS5nZXRNZWRpYSh0cnVlKTtcbiAgICAgICAgICAgIGlmIChfc2VsZi50b3RhbEVycm9yID09PSAwKSB7XG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICQoJy5ydi11cGxvYWQtcHJvZ3Jlc3MgLmNsb3NlLXBhbmUnKS50cmlnZ2VyKCdjbGljaycpO1xuICAgICAgICAgICAgICAgIH0sIDUwMDApO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBoYW5kbGVFdmVudHMoKSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG4gICAgICAgIC8qKlxuICAgICAgICAgKiBDbG9zZSB1cGxvYWQgcHJvZ3Jlc3MgcGFuZVxuICAgICAgICAgKi9cbiAgICAgICAgX3NlbGYuJGJvZHkub24oJ2NsaWNrJywgJy5ydi11cGxvYWQtcHJvZ3Jlc3MgLmNsb3NlLXBhbmUnLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAkKCcucnYtdXBsb2FkLXByb2dyZXNzJykuYWRkQ2xhc3MoJ2hpZGUtdGhlLXBhbmUnKTtcbiAgICAgICAgICAgIF9zZWxmLnRvdGFsRXJyb3IgPSAwO1xuICAgICAgICAgICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgICAgICAgICAgJCgnLnJ2LXVwbG9hZC1wcm9ncmVzcyBsaScpLnJlbW92ZSgpO1xuICAgICAgICAgICAgICAgIF9zZWxmLnRvdGFsUXVldWVkID0gMTtcbiAgICAgICAgICAgIH0sIDMwMCk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGluaXRQcm9ncmVzcygkZmlsZU5hbWUsICRmaWxlU2l6ZSkge1xuICAgICAgICBsZXQgdGVtcGxhdGUgPSB0aGlzLnVwbG9hZFByb2dyZXNzVGVtcGxhdGVcbiAgICAgICAgICAgICAgICAucmVwbGFjZSgvX19maWxlTmFtZV9fL2dpLCAkZmlsZU5hbWUpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fZmlsZVNpemVfXy9naSwgVXBsb2FkU2VydmljZS5mb3JtYXRGaWxlU2l6ZSgkZmlsZVNpemUpKVxuICAgICAgICAgICAgICAgIC5yZXBsYWNlKC9fX3N0YXR1c19fL2dpLCAnd2FybmluZycpXG4gICAgICAgICAgICAgICAgLnJlcGxhY2UoL19fbWVzc2FnZV9fL2dpLCAnVXBsb2FkaW5nJylcbiAgICAgICAgICAgIDtcbiAgICAgICAgdGhpcy51cGxvYWRQcm9ncmVzc0NvbnRhaW5lci5hcHBlbmQodGVtcGxhdGUpO1xuICAgICAgICB0aGlzLnVwbG9hZFByb2dyZXNzQm94LnJlbW92ZUNsYXNzKCdoaWRlLXRoZS1wYW5lJyk7XG4gICAgICAgIHRoaXMudXBsb2FkUHJvZ3Jlc3NCb3guZmluZCgnLnBhbmVsLWJvZHknKVxuICAgICAgICAgICAgLmFuaW1hdGUoe3Njcm9sbFRvcDogdGhpcy51cGxvYWRQcm9ncmVzc0NvbnRhaW5lci5oZWlnaHQoKX0sIDE1MCk7XG4gICAgfVxuXG4gICAgY2hhbmdlUHJvZ3Jlc3NTdGF0dXMoZmlsZSkge1xuICAgICAgICBsZXQgX3NlbGYgPSB0aGlzO1xuICAgICAgICBsZXQgJHByb2dyZXNzTGluZSA9IF9zZWxmLnVwbG9hZFByb2dyZXNzQ29udGFpbmVyLmZpbmQoJ2xpOm50aC1jaGlsZCgnICsgKGZpbGUuaW5kZXgpICsgJyknKTtcbiAgICAgICAgbGV0ICRsYWJlbCA9ICRwcm9ncmVzc0xpbmUuZmluZCgnLmxhYmVsJyk7XG4gICAgICAgICRsYWJlbC5yZW1vdmVDbGFzcygnbGFiZWwtc3VjY2VzcyBsYWJlbC1kYW5nZXIgbGFiZWwtd2FybmluZycpO1xuXG4gICAgICAgIGxldCByZXNwb25zZSA9IEhlbHBlcnMuanNvbkRlY29kZShmaWxlLnhoci5yZXNwb25zZVRleHQgfHwgJycsIHt9KTtcblxuICAgICAgICBfc2VsZi50b3RhbEVycm9yID0gX3NlbGYudG90YWxFcnJvciArIChyZXNwb25zZS5lcnJvciA9PT0gdHJ1ZSB8fCBmaWxlLnN0YXR1cyA9PT0gJ2Vycm9yJyA/IDEgOiAwKTtcblxuICAgICAgICAkbGFiZWwuYWRkQ2xhc3MocmVzcG9uc2UuZXJyb3IgPT09IHRydWUgfHwgZmlsZS5zdGF0dXMgPT09ICdlcnJvcicgPyAnbGFiZWwtZGFuZ2VyJyA6ICdsYWJlbC1zdWNjZXNzJyk7XG4gICAgICAgICRsYWJlbC5odG1sKHJlc3BvbnNlLmVycm9yID09PSB0cnVlIHx8IGZpbGUuc3RhdHVzID09PSAnZXJyb3InID8gJ0Vycm9yJyA6ICdVcGxvYWRlZCcpO1xuICAgICAgICBpZiAoZmlsZS5zdGF0dXMgPT09ICdlcnJvcicpIHtcbiAgICAgICAgICAgIGlmIChmaWxlLnhoci5zdGF0dXMgPT09IDQyMikge1xuICAgICAgICAgICAgICAgIGxldCBlcnJvcl9odG1sID0gJyc7XG4gICAgICAgICAgICAgICAgJC5lYWNoKHJlc3BvbnNlLCBmdW5jdGlvbiAoa2V5LCBpdGVtKSB7XG4gICAgICAgICAgICAgICAgICAgIGVycm9yX2h0bWwgKz0gJzxzcGFuIGNsYXNzPVwidGV4dC1kYW5nZXJcIj4nICsgaXRlbSArICc8L3NwYW4+PGJyPic7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgJHByb2dyZXNzTGluZS5maW5kKCcuZmlsZS1lcnJvcicpLmh0bWwoZXJyb3JfaHRtbCk7XG4gICAgICAgICAgICB9IGVsc2UgaWYgKGZpbGUueGhyLnN0YXR1cyA9PT0gNTAwKSB7XG4gICAgICAgICAgICAgICAgJHByb2dyZXNzTGluZS5maW5kKCcuZmlsZS1lcnJvcicpLmh0bWwoJzxzcGFuIGNsYXNzPVwidGV4dC1kYW5nZXJcIj4nICsgZmlsZS54aHIuc3RhdHVzVGV4dCArICc8L3NwYW4+Jyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0gZWxzZSBpZiAocmVzcG9uc2UuZXJyb3IpIHtcbiAgICAgICAgICAgICRwcm9ncmVzc0xpbmUuZmluZCgnLmZpbGUtZXJyb3InKS5odG1sKCc8c3BhbiBjbGFzcz1cInRleHQtZGFuZ2VyXCI+JyArIHJlc3BvbnNlLm1lc3NhZ2UgKyAnPC9zcGFuPicpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgSGVscGVycy5hZGRUb1JlY2VudChyZXNwb25zZS5kYXRhLmlkKTtcbiAgICAgICAgICAgIEhlbHBlcnMuc2V0U2VsZWN0ZWRGaWxlKHJlc3BvbnNlLmRhdGEuaWQpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc3RhdGljIGZvcm1hdEZpbGVTaXplKGJ5dGVzLCBzaSA9IGZhbHNlKSB7XG4gICAgICAgIGxldCB0aHJlc2ggPSBzaSA/IDEwMDAgOiAxMDI0O1xuICAgICAgICBpZiAoTWF0aC5hYnMoYnl0ZXMpIDwgdGhyZXNoKSB7XG4gICAgICAgICAgICByZXR1cm4gYnl0ZXMgKyAnIEInO1xuICAgICAgICB9XG4gICAgICAgIGxldCB1bml0cyA9IFsnS0InLCAnTUInLCAnR0InLCAnVEInLCAnUEInLCAnRUInLCAnWkInLCAnWUInXTtcbiAgICAgICAgbGV0IHUgPSAtMTtcbiAgICAgICAgZG8ge1xuICAgICAgICAgICAgYnl0ZXMgLz0gdGhyZXNoO1xuICAgICAgICAgICAgKyt1O1xuICAgICAgICB9IHdoaWxlIChNYXRoLmFicyhieXRlcykgPj0gdGhyZXNoICYmIHUgPCB1bml0cy5sZW5ndGggLSAxKTtcbiAgICAgICAgcmV0dXJuIGJ5dGVzLnRvRml4ZWQoMSkgKyAnICcgKyB1bml0c1t1XTtcbiAgICB9XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL0FwcC9TZXJ2aWNlcy9VcGxvYWRTZXJ2aWNlLmpzIiwiaW1wb3J0IHtZb3V0dWJlfSBmcm9tICcuL1lvdXR1YmUnO1xuXG5leHBvcnQgY2xhc3MgRXh0ZXJuYWxTZXJ2aWNlcyB7XG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIG5ldyBZb3V0dWJlKCk7XG4gICAgfVxufVxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0V4dGVybmFscy9FeHRlcm5hbFNlcnZpY2VzLmpzIiwiaW1wb3J0IHtIZWxwZXJzfSBmcm9tICcuLi9IZWxwZXJzL0hlbHBlcnMnO1xuaW1wb3J0IHtFeHRlcm5hbFNlcnZpY2VDb25maWd9IGZyb20gJy4uL0NvbmZpZy9FeHRlcm5hbFNlcnZpY2VDb25maWcnO1xuaW1wb3J0IHtNZWRpYVNlcnZpY2V9IGZyb20gJy4uL1NlcnZpY2VzL01lZGlhU2VydmljZSc7XG5pbXBvcnQge01lc3NhZ2VTZXJ2aWNlfSBmcm9tICcuLi9TZXJ2aWNlcy9NZXNzYWdlU2VydmljZSc7XG5cbmV4cG9ydCBjbGFzcyBZb3V0dWJlIHtcbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgdGhpcy5NZWRpYVNlcnZpY2UgPSBuZXcgTWVkaWFTZXJ2aWNlKCk7XG5cbiAgICAgICAgdGhpcy4kYm9keSA9ICQoJ2JvZHknKTtcblxuICAgICAgICB0aGlzLiRtb2RhbCA9ICQoJyNtb2RhbF9hZGRfZnJvbV95b3V0dWJlJyk7XG5cbiAgICAgICAgbGV0IF9zZWxmID0gdGhpcztcblxuICAgICAgICB0aGlzLnNldE1lc3NhZ2UoUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5hZGRfZnJvbS55b3V0dWJlLm9yaWdpbmFsX21zZyk7XG5cbiAgICAgICAgdGhpcy4kbW9kYWwub24oJ2hpZGRlbi5icy5tb2RhbCcsICgpID0+IHtcbiAgICAgICAgICAgIF9zZWxmLnNldE1lc3NhZ2UoUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5hZGRfZnJvbS55b3V0dWJlLm9yaWdpbmFsX21zZyk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIHRoaXMuJGJvZHkub24oJ2NsaWNrJywgJyNtb2RhbF9hZGRfZnJvbV95b3V0dWJlIC5ydi1idG4tYWRkLXlvdXR1YmUtdXJsJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgICAgICBfc2VsZi5jaGVja1lvdVR1YmVWaWRlbygkKHRoaXMpLmNsb3Nlc3QoJyNtb2RhbF9hZGRfZnJvbV95b3V0dWJlJykuZmluZCgnLnJ2LXlvdXR1YmUtdXJsJykpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzdGF0aWMgdmFsaWRhdGVZb3VUdWJlTGluayh1cmwpIHtcbiAgICAgICAgbGV0IHAgPSAvXig/Omh0dHBzPzpcXC9cXC8pPyg/Ond3d1xcLik/eW91dHViZVxcLmNvbVxcL3dhdGNoXFw/KD89Lip2PSgoXFx3fC0pezExfSkpKD86XFxTKyk/JC87XG4gICAgICAgIHJldHVybiAodXJsLm1hdGNoKHApKSA/IFJlZ0V4cC4kMSA6IGZhbHNlO1xuICAgIH1cblxuICAgIHN0YXRpYyBnZXRZb3VUdWJlSWQodXJsKSB7XG4gICAgICAgIGxldCByZWdFeHAgPSAvXi4qKHlvdXR1LmJlXFwvfHZcXC98dVxcL1xcd1xcL3xlbWJlZFxcL3x3YXRjaFxcP3Y9fFxcJnY9KShbXiNcXCZcXD9dKikuKi87XG4gICAgICAgIGxldCBtYXRjaCA9IHVybC5tYXRjaChyZWdFeHApO1xuICAgICAgICBpZiAobWF0Y2ggJiYgbWF0Y2hbMl0ubGVuZ3RoID09PSAxMSkge1xuICAgICAgICAgICAgcmV0dXJuIG1hdGNoWzJdO1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBudWxsO1xuICAgIH1cblxuICAgIHN0YXRpYyBnZXRZb3V0dWJlUGxheWxpc3RJZCh1cmwpIHtcbiAgICAgICAgbGV0IHJlZ0V4cCA9IC9eLiooeW91dHUuYmVcXC98dlxcL3x1XFwvXFx3XFwvfGVtYmVkXFwvfHdhdGNoXFw/bGlzdD18XFwmbGlzdD0pKFteI1xcJlxcP10qKS4qLztcbiAgICAgICAgbGV0IG1hdGNoID0gdXJsLm1hdGNoKHJlZ0V4cCk7XG4gICAgICAgIGlmIChtYXRjaCkge1xuICAgICAgICAgICAgcmV0dXJuIG1hdGNoWzJdO1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBudWxsO1xuICAgIH1cblxuICAgIHNldE1lc3NhZ2UobXNnKSB7XG4gICAgICAgIHRoaXMuJG1vZGFsLmZpbmQoJy5tb2RhbC1ub3RpY2UnKS5odG1sKG1zZyk7XG4gICAgfVxuXG4gICAgY2hlY2tZb3VUdWJlVmlkZW8oJGlucHV0KSB7XG4gICAgICAgIGxldCBfc2VsZiA9IHRoaXM7XG4gICAgICAgIGlmICghWW91dHViZS52YWxpZGF0ZVlvdVR1YmVMaW5rKCRpbnB1dC52YWwoKSkgfHwgIUV4dGVybmFsU2VydmljZUNvbmZpZy55b3V0dWJlLmFwaV9rZXkpIHtcbiAgICAgICAgICAgIGlmIChFeHRlcm5hbFNlcnZpY2VDb25maWcueW91dHViZS5hcGlfa2V5KSB7XG4gICAgICAgICAgICAgICAgX3NlbGYuc2V0TWVzc2FnZShSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLmFkZF9mcm9tLnlvdXR1YmUuaW52YWxpZF91cmxfbXNnKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgX3NlbGYuc2V0TWVzc2FnZShSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLmFkZF9mcm9tLnlvdXR1YmUubm9fYXBpX2tleV9tc2cpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgbGV0IHlvdXR1YmVJZCA9IFlvdXR1YmUuZ2V0WW91VHViZUlkKCRpbnB1dC52YWwoKSk7XG4gICAgICAgICAgICBsZXQgcmVxdWVzdFVybCA9ICdodHRwczovL3d3dy5nb29nbGVhcGlzLmNvbS95b3V0dWJlL3YzL3ZpZGVvcz9pZD0nICsgeW91dHViZUlkO1xuICAgICAgICAgICAgbGV0IGlzUGxheWxpc3QgPSBfc2VsZi4kbW9kYWwuZmluZCgnLmN1c3RvbS1jaGVja2JveCBpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl0nKS5pcygnOmNoZWNrZWQnKTtcblxuICAgICAgICAgICAgaWYgKGlzUGxheWxpc3QpIHtcbiAgICAgICAgICAgICAgICB5b3V0dWJlSWQgPSBZb3V0dWJlLmdldFlvdXR1YmVQbGF5bGlzdElkKCRpbnB1dC52YWwoKSk7XG4gICAgICAgICAgICAgICAgcmVxdWVzdFVybCA9ICdodHRwczovL3d3dy5nb29nbGVhcGlzLmNvbS95b3V0dWJlL3YzL3BsYXlsaXN0SXRlbXM/cGxheWxpc3RJZD0nICsgeW91dHViZUlkO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgIHVybDogcmVxdWVzdFVybCArICcma2V5PScgKyBFeHRlcm5hbFNlcnZpY2VDb25maWcueW91dHViZS5hcGlfa2V5ICsgJyZwYXJ0PXNuaXBwZXQnLFxuICAgICAgICAgICAgICAgIHR5cGU6IFwiR0VUXCIsXG4gICAgICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKGlzUGxheWxpc3QpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHBsYXlsaXN0VmlkZW9DYWxsYmFjayhkYXRhLCAkaW5wdXQudmFsKCkpO1xuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgc2luZ2xlVmlkZW9DYWxsYmFjayhkYXRhLCAkaW5wdXQudmFsKCkpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAgICAgX3NlbGYuc2V0TWVzc2FnZShSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLmFkZF9mcm9tLnlvdXR1YmUuZXJyb3JfbXNnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIHNpbmdsZVZpZGVvQ2FsbGJhY2soZGF0YSwgdXJsKSB7XG4gICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgIHVybDogUlZfTUVESUFfVVJMLmFkZF9leHRlcm5hbF9zZXJ2aWNlLFxuICAgICAgICAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxuICAgICAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgICAgICAgICB0eXBlOiAneW91dHViZScsXG4gICAgICAgICAgICAgICAgICAgIG5hbWU6IGRhdGEuaXRlbXNbMF0uc25pcHBldC50aXRsZSxcbiAgICAgICAgICAgICAgICAgICAgZm9sZGVyX2lkOiBIZWxwZXJzLmdldFJlcXVlc3RQYXJhbXMoKS5mb2xkZXJfaWQsXG4gICAgICAgICAgICAgICAgICAgIHVybDogdXJsLFxuICAgICAgICAgICAgICAgICAgICBvcHRpb25zOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICB0aHVtYjogJ2h0dHBzOi8vaW1nLnlvdXR1YmUuY29tL3ZpLycgKyBkYXRhLml0ZW1zWzBdLmlkICsgJy9tYXhyZXNkZWZhdWx0LmpwZydcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgICAgICBpZiAocmVzLmVycm9yKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnZXJyb3InLCByZXMubWVzc2FnZSwgUlZfTUVESUFfQ09ORklHLnRyYW5zbGF0aW9ucy5tZXNzYWdlLmVycm9yX2hlYWRlcik7XG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBNZXNzYWdlU2VydmljZS5zaG93TWVzc2FnZSgnc3VjY2VzcycsIHJlcy5tZXNzYWdlLCBSVl9NRURJQV9DT05GSUcudHJhbnNsYXRpb25zLm1lc3NhZ2Uuc3VjY2Vzc19oZWFkZXIpO1xuICAgICAgICAgICAgICAgICAgICAgICAgX3NlbGYuTWVkaWFTZXJ2aWNlLmdldE1lZGlhKHRydWUpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAgICAgTWVzc2FnZVNlcnZpY2UuaGFuZGxlRXJyb3IoZGF0YSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICBfc2VsZi4kbW9kYWwubW9kYWwoJ2hpZGUnKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGZ1bmN0aW9uIHBsYXlsaXN0VmlkZW9DYWxsYmFjayhkYXRhLCB1cmwpIHtcbiAgICAgICAgICAgIF9zZWxmLiRtb2RhbC5tb2RhbCgnaGlkZScpO1xuICAgICAgICB9XG4gICAgfVxufVxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9BcHAvRXh0ZXJuYWxzL1lvdXR1YmUuanMiLCJsZXQgRXh0ZXJuYWxTZXJ2aWNlQ29uZmlnID0ge1xuICAgIHlvdXR1YmU6IHtcbiAgICAgICAgYXBpX2tleTogXCJBSXphU3lDVjRmbWZkZ3NWYWxHTlIzc2MtMFczY2JwRVo4dU9kNjBcIlxuICAgIH1cbn07XG5cbmV4cG9ydCB7RXh0ZXJuYWxTZXJ2aWNlQ29uZmlnfTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvQXBwL0NvbmZpZy9FeHRlcm5hbFNlcnZpY2VDb25maWcuanMiLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpblxuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9zYXNzL21lZGlhLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IDE2XG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJzb3VyY2VSb290IjoiIn0=