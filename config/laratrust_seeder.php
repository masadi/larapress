<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        [
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Administrator',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'User',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ]
        /*[
            'name' => 'editor',
            'display_name' => 'Editor',
            'description' => 'Editor',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'yayasan',
            'display_name' => 'Pengurus Yayasan',
            'description' => 'Pengurus Yayasan',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'bendahara_yayasan',
            'display_name' => 'Bendahara Yayasan',
            'description' => 'Bendahara Yayasan',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'kepala_sekolah',
            'display_name' => 'Kepala Sekolah',
            'description' => 'Kepala Sekolah',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'bendahara',
            'display_name' => 'Bendahara Sekolah',
            'description' => 'Bendahara Sekolah',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'wali_kelas',
            'display_name' => 'Wali Kelas',
            'description' => 'Wali Kelas',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'wakakur',
            'display_name' => 'Waka Kurikulum',
            'description' => 'Waka Kurikulum',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'tu',
            'display_name' => 'Tata Usaha',
            'description' => 'Tata Usaha',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'ptk',
            'display_name' => 'Pendidik & Tenaga Kependidikan',
            'description' => 'Pendidik & Tenaga Kependidikan',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'pd',
            'display_name' => 'Peserta Didik',
            'description' => 'Peserta Didik',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],
        [
            'name' => 'santri',
            'display_name' => 'Santri',
            'description' => 'Santri',
            'permission' => [
                'web' => 'c,r,u,d'
            ]
        ],*/
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
