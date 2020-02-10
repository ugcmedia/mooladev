<?php

return [
    'max_quota' => env('RV_MEDIA_MAX_QUOTA', 1024 * 1024 * 1024),
    // These sizes will be auto generate when upload an image
    'sizes' => [
        'thumb' => '150x150',
	'deal'	=> '230x230',
    ],
    'driver' => [
        'local' => [
            'root' => public_path('uploads').'/images',
            'path' => env('RV_MEDIA_UPLOAD_PATH', '/uploads/images'),
        ],
        's3' => [
            'path' => env('AWS_SERVER_URL'),
        ],
    ],
    'permissions' => [
        'folders.create',
        'folders.edit',
        'folders.trash',
        'folders.delete',
        'files.create',
        'files.edit',
        'files.trash',
        'files.delete',
        'files.favorite',
        'folders.favorite',
    ],
    'route' => [
        'prefix' => 'media', // Media URL. Ex: media => http://laravel.dev/media
        'middleware' => ['web', 'auth'],
        'options' => [],
    ],
    'views' => [
        'index' => 'media::index',
    ],
    'cache' => [
        'enable' => env('RV_MEDIA_ENABLE_CACHE', false), // true or false
        'cache_time' => env('RV_MEDIA_CACHE_TIME', 10),
        'stored_keys' => storage_path('media_cache_keys.json'), // Cache config
    ],
    'allow_external_services' => env('RV_MEDIA_ALLOW_EXTERNAL_SERVICES', true),
    'external_services' => [
        'youtube',
        'vimeo',
        'dailymotion',
        'instagram',
        'vine',
    ],
    // assets libraries, you can remove if it's existed on your project
    'libraries' => [
        'stylesheets' => [
            //'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            //'vendor/media/packages/font-awesome/css/font-awesome.min.css',
            'vendor/media/packages/fancybox/dist/jquery.fancybox.css',
            'vendor/media/packages/toastr/toastr.min.css',
            'vendor/media/packages/jquery-context-menu/jquery.contextMenu.min.css',
            'vendor/media/css/media.css?v=' . env('RV_MEDIA_VERSION', time()),
        ],
        'javascript' => [
            'vendor/media/packages/lodash/lodash.min.js',
            //'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js', // Comment it if your site have it already
            //'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', // Comment it if your site have it already
            'vendor/media/packages/clipboard/clipboard.min.js',
            'vendor/media/packages/fancybox/dist/jquery.fancybox.js',
            'vendor/media/packages/dropzone/dropzone.js',
            'vendor/media/packages/toastr/toastr.min.js',
            'vendor/media/packages/pace/pace.min.js',
            'vendor/media/packages/jquery-context-menu/jquery.ui.position.min.js',
            'vendor/media/packages/jquery-context-menu/jquery.contextMenu.min.js',
            'vendor/media/js/media.js?v=' . env('RV_MEDIA_VERSION', time()),
        ],
    ],
    // Allowed mime types
    'allowed_mime_types' => env('RV_MEDIA_ALLOWED_MIME_TYPES', 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,docs,xls,xlsx,ppt,pptx,pdf,mp4,svg'),
    'mime_types' => [
        'image' => [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
			 'image/svg+xml',
        ],
        'video' => [
            'video/mp4',
        ],
        'document' => [
            'application/pdf',
            'application/excel',
            'application/x-excel',
            'application/x-msexcel',
            'text/plain',
            'application/msword',
            'text/csv',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ],
        'youtube' => [
            'youtube',
        ],
    ],
    'max_file_size_upload' => env('RV_MEDIA_MAX_FILE_SIZE_UPLOAD', 4 * 1024), // Maximum size to upload
    'default-img' => env('RV_MEDIA_DEFAULT_IMAGE', '/vendor/core/images/default-image.png'), // Default image
    'sidebar_display' => env('RV_MEDIA_SIDEBAR_DISPLAY', 'vertical'), // Use "vertical" or "horizontal"
    'pagination'=>[
        'per_page'  => 40,
        'paged'     => 1,
    ],
];
