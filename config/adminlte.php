<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>Sistem Informasi</b><span class="brand-text-second d-block">Gaji Pegawai</span>',
    'use_logo_img' => false,
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /* mee */
    'sidebar_image_brand' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'logout_method' => 'post',
    'login_url' => 'login',
    //'register_url' => 'register',
    'register_url' => false,
    //'password_reset_url' => 'password/reset',
    'password_reset_url' => false,
    //'password_email_url' => 'password/email',
    'password_email_url' => false,
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => false,
            'topnav' => true,
        ],
        [
            'text'      => 'Pegawai',
            'icon'      => 'fas fa-user-tie',
            'route'     => 'pegawai.index',
            'active'    => ['pegawai', 'pegawai*', 'regex:@^pegawai/[0-9]+$@'],
        ],
        [
            'text'      => 'Gaji',
            'icon'      => 'fas fa-money-check',
            'route'     => 'gaji.index',
            'active'    => ['gaji', 'gaji*', 'regex:@^gaji/[0-9]+$@'],
        ],
        [
            'text'    => 'Pengguna',
            'icon'    => 'fas fa-users',
            'route'   => 'users.index',
            'active'    => ['users', 'users*', 'regex:@^users/[0-9]+$@'],
        ],
        [
            'text'    => 'Pengaturan',
            'icon'    => 'fas fa-cogs',
            'active' => ['pengaturan', 'pengaturan*', 'regex:@^pengaturan/[0-9]+$@'],
            'submenu' => [
                ['header' => 'Pegawai'],
                [
                    'text' => 'Agama',
                    'icon'    => 'fas fa-pray',
                    'route' => 'agama.index',
                    'active' => ['pengaturan', 'pengaturan/agama/*', 'regex:@^agama/[0-9]+$@'],
                ],
                [
                    'text' => 'Pernikahan',
                    'icon'    => 'fa fa-heart',
                    'route' => 'pernikahan.index',
                    'active' => ['pengaturan', 'pengaturan/pernikahan/*', 'regex:@^pernikahan/[0-9]+$@'],
                ],
                [
                    'text' => 'Jenis kelamin',
                    'icon' => 'fas fa-venus-mars',
                    'route' => 'kelamin.index',
                    'active' => ['pengaturan', 'pengaturan/kelamin/*', 'regex:@^kelamin/[0-9]+$@'],
                ],
                [
                    'text' => 'Jabatan',
                    'icon'    => 'fas fa-user-tag',
                    'active' => ['pengaturan', 'pengaturan/jabatan*', 'regex:@^jabatan/[0-9]+$@'],
                    'submenu' => [
                        [
                            'text' => 'Golongan',
                            'route' => 'golongan.index',
                            'active' => ['pengaturan/jabatan/golongan*', 'regex:@^golongan/[0-9]+$@'],
                        ],
                        [
                            'text' => 'Posisi',
                            'route' => 'posisi.index',
                            'active' => ['pengaturan/jabatan/posisi*', 'regex:@^posisi/[0-9]+$@'],
                        ],
                    ],
                ],
                [
                    'text' => 'Pendidikan',
                    'icon'    => 'fas fa-user-graduate',
                    'active' => ['pengaturan', 'pengaturan/pendidikan*', 'regex:@^pendidikan/[0-9]+$@'],
                    'submenu' => [
                        [
                            'text' => 'Institusi Pendidikan',
                            'route' => 'institusi.index',
                            'active' => ['pengaturan/pendidikan/institusi*', 'regex:@^institusi/[0-9]+$@'],
                        ],
                        [
                            'text' => 'Jenjang Pendidikan',
                            'route' => 'jenjang.index',
                            'active' => ['pengaturan/pendidikan/jenjang*', 'regex:@^jenjang/[0-9]+$@'],
                        ],
                    ],
                ],
                ['header' => 'Gaji'],
                [
                    'text' => 'Gaji Pokok',
                    'icon'    => "fas fa-money-bill-wave",
                    'route' => 'gaji-pokok.index',
                    'active' => ['pengaturan/gaji/gaji-pokok*', 'regex:@^gaji-pokok/[0-9]+$@'],
                ],
                [
                    'text' => 'Tunjangan Gaji',
                    'icon'    => 'fas fa-hand-holding-usd',
                    'route' => 'gaji-tunjangan.index',
                    'active' => ['pengaturan/gaji/gaji-tunjangan*', 'regex:@^gaji-tunjangan/[0-9]+$@'],
                ],
                [
                    'text' => 'Potongan Gaji',
                    'icon'    => 'fas fa-hand-holding-usd fa-flip-horizontal',
                    'route' => 'gaji-potongan.index',
                    'active' => ['pengaturan/gaji/gaji-potongan*', 'regex:@^gaji-potongan/[0-9]+$@'],
                ]
            ],
        ],
        /* ['header' => 'account_settings'], */
        [
            'text' => 'Profile',
            'icon'    => 'fas fa-fw fa-user',
            'route' => 'profile.index',
            'active' => ['profile*', 'regex:@^profile/[0-9]+$@'],
        ],
/*         [
            'text'    => 'Akun',
            'icon'    => 'fas fa-fw fa-user',
            'active' => ['profil*'],
            'submenu' => [
                [
                    'text' => 'Profile',
                    'route' => 'pegawai.index',
                ],
                [
                    'text' => 'Ganti Sandi',
                    'route' => 'pegawai.create',
                ],
            ],
        ], */
        [
            'text' => 'Log Out',
            'route' => 'logout',
            'icon' => 'fas fa-sign-out-alt',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'bootstrap-table' => [
            'active' => false,
            'cdn' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '../node_modules/dist/bootstrap-table.min.js',
                    'cdn' => '//unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'moment' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/moment@2.24.0/min/moment.min.js',
                ],
            ],
        ],
        'inputmask' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/inputmask@3.3.5/dist/jquery.inputmask.bundle.js',
                ],
            ],
        ],
        'daterangepicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/daterangepicker@3.0.5/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/daterangepicker@3.0.5/daterangepicker.css',
                ],
            ],
        ],
        'tempusdominusbs4' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/tempusdominus-bootstrap-4@5.1.2/build/js/tempusdominus-bootstrap-4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/tempusdominus-bootstrap-4@5.1.2/build/css/tempusdominus-bootstrap-4.min.css',
                ],
            ],
        ],
        'croppie' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/croppie@2.6.5/croppie.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/croppie@2.6.5/croppie.css',
                ],
            ],
        ],
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'jqueryui' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//code.jquery.com/ui/1.11.4/jquery-ui.min.js',
                ],
            ],
        ],
        'assets' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/js/application.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/css/application.css',
                ],
            ],
        ],
        'assets_js' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/js/application.js',
                ],
            ],
        ],
        'assets_css' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/css/application.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
