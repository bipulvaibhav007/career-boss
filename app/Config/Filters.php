<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\JWTAuthenticationFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'AuthCheck'     => \App\Filters\AuthCheckFilter::class,
        'AlreadyLoggedIn' => \App\Filters\AlreadyLoggedInFilter::class,
        'NoAccessFilter' => \App\Filters\NoAccessFilter::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => JWTAuthenticationFilter::class, // add this line
        "MemAuthCheck"   => \App\Filters\MemAuthCheck::class,
        "MemAlreadyLoggedIn"   => \App\Filters\MemAlreadyLoggedIn::class,
        "StuAuthCheck"   => \App\Filters\StuAuthCheck::class,
        "StuAlreadyLoggedIn"   => \App\Filters\StuAlreadyLoggedIn::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => ['home/save-contact-us',
                                    'home/save-subscriber', 
                                    'admin/upload_blog_image_in_description',
                                    '/webhook','admin/delete_whatsAppReplyLog_ByAjax',
                                    'test/jstest',
                                    '/get_districts',
                                    '/admin/view_franchise_student_by_ajax',
                                    '/admin/generate_cert_by_ajax',
                                    '/admin/ins_enq_csv_file_upload',
                                    '/get_module_html',
                                    'examination/update_examinee_duration',
                                    'examination/save_result',
                                    '/admin/view_student_result_by_ajax',
                                    'admin/watch_test',
                                    '/institute/get_course_details',
                                    '/institute/update_activetab',
                                    '/institute/generate_certificate/',
                                    '/save_chat',
                                    ]
                    ],
            // 'invalidchars',
        ],
        'after' => [
            //'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'auth' => [
            'before' => [
                'client/*',
                'client'
          ],
        ]
    ];
}
