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
                    'user_level' => [1, 2],
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
        ]
    ]
];

