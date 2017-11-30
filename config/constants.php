<?php
return [
    'sidebar_menus' => [
        [
            'id' => 'dashboard',
            'name' => 'Dashboard',
            'url' => '/',
            'icon' => 'icon-home',
            'hidden' => 0,
            'user_level' => [1, 2],
            'children' => []
        ], [
            'id' => 'videos',
            'name' => 'Videos',
            'url' => '',
            'icon' => 'icon-social-youtube',
            'hidden' => 0,
            'user_level' => [1, 2],
            'children' => [
                [
                    'id' => 'video_all',
                    'name' => 'All Videos',
                    'url' => '/videos',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1, 2],
                    'children' => [
                        [
                            'id' => 'video_edit',
                            'name' => 'Edit Video',
                            'url' => '/video/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1, 2],
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'video_add',
                    'name' => 'Add Video',
                    'url' => '/video/new',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1, 2],
                    'children' => []
                ], [
                    'id' => 'video_categories',
                    'name' => 'Categories',
                    'url' => '/video/categories',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => [
                        [
                            'id' => 'video_category_edit',
                            'name' => 'Edit Category',
                            'url' => '/video/category/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ]
                    ]
                ]
            ]
        ],[
            'id' => 'events',
            'name' => 'Events',
            'url' => '',
            'icon' => 'icon-calendar',
            'hidden' => 0,
            'user_level' => [1, 2],
            'children' => [
                [
                    'id' => 'event_all',
                    'name' => 'All Events',
                    'url' => '/events',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1,2 ],
                    'children' => [
                        [
                            'id' => 'event_edit',
                            'name' => 'Edit Event',
                            'url' => '/event/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ],
                        [
                            'id' => 'event_attendees',
                            'name' => 'Event Attendees',
                            'url' => '/event/attendees/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ],
                        [
                            'id' => 'event_qr_codes',
                            'name' => 'Event QR codes',
                            'url' => '/event/qr-codes/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ],
                        [
                            'id' => 'event_generate_qr_codes_form',
                            'name' => 'Generate QR codes',
                            'url' => '/event/generate-qr-codes-form/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ]

                    ]
                ], [
                    'id' => 'event_add',
                    'name' => 'Add Event',
                    'url' => '/event/new',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1, 2],
                    'children' => []
                ],
            ]
        ], [
            'id' => 'users',
            'name' => 'Users',
            'url' => '',
            'icon' => 'icon-user',
            'hidden' => 0,
            'user_level' => [1, 2],
            'children' => [
                [
                    'id' => 'user_all',
                    'name' => 'All Users',
                    'url' => '/users',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => [
                        [
                            'id' => 'user_edit',
                            'name' => 'Edit User',
                            'url' => '/user/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'user_level' => [1],
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'user_add',
                    'name' => 'Add User',
                    'url' => '/user/new',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ], [
                    'id' => 'profile',
                    'name' => 'My profile',
                    'url' => '/user/profile',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1, 2],
                    'children' => []
                ]
            ]
        ],
        [
            'id' => 'distributors',
            'name' => 'Distributors',
            'url' => '',
            'icon' => 'icon-users',
            'hidden' => 0,
            'user_level' => [1],
            'children' => [
                [
                    'id' => 'distributors',
                    'name' => 'All Distributor',
                    'url' => '/distributors',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'distributor_add',
                    'name' => 'Add Distributor',
                    'url' => '/distributor/new',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'distributor_edit',
                    'name' => 'Edit Distributor',
                    'url' => '/distributor/edit/{id}',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ]
            ],
        ], [
            'id' => 'settings',
            'name' => 'Settings',
            'url' => '',
            'icon' => 'icon-settings',
            'hidden' => 0,
            'user_level' => [1],
            'children' => [
                [
                    'id' => 'email_setting',
                    'name' => 'Email template',
                    'url' => '/settings/email-template',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'payment_methods_setting',
                    'name' => 'Payment methods',
                    'url' => '/settings/payment-methods',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'payment_sources_setting',
                    'name' => 'Payment sources',
                    'url' => '/settings/payment-sources',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'payment_statuses_setting',
                    'name' => 'Payment statuses',
                    'url' => '/settings/payment-statuses',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ],
                [
                    'id' => 'registration_statuses_setting',
                    'name' => 'Registration statuses',
                    'url' => '/settings/registration-statuses',
                    'icon' => '',
                    'hidden' => 0,
                    'user_level' => [1],
                    'children' => []
                ]




            ]
        ]
    ]
];

