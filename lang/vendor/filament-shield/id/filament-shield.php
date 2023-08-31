<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nama',
    'column.guard_name' => 'Nama Penjaga',
    'column.roles' => 'Peran',
    'column.permissions' => 'Izin',
    'column.updated_at' => 'Dirubah',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nama',
    'field.guard_name' => 'Nama Penjaga',
    'field.permissions' => 'Izin',
    'field.select_all.name' => 'Pilih Semua',
    'field.select_all.message' => 'Aktifkan semua izin yang <span class="text-primary font-medium">Tersedia</span> untuk Peran ini.',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Manajemen',
    'nav.role.label' => 'Peran',
    'nav.role.icon' => 'heroicon-o-key',
    'resource.label.role' => 'Peran',
    'resource.label.roles' => 'Peran',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */

    'section' => 'Entitas',
    'resources' => 'Sumber Daya',
    'widgets' => 'Widget',
    'pages' => 'Halaman',
    'custom' => 'Izin Kustom',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Kamu tidak punya izin akses',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions' Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Lihat',
        'view_any' => 'Lihat Lainnya',
        'create' => 'Buat',
        'update' => 'Ubah',
        'delete' => 'Hapus',
        'delete_any' => 'Hapus Lainnya',
        'force_delete' => 'Hapus Permanen',
        'force_delete_any' => 'Hapus Permanen Lainnya',
        'restore' => 'Memulihkan',
        'replicate' => 'Menduplikasi',
        'reorder' => 'Mengurutkan',
        'restore_any' => 'Memulihkan Lainnya',
    ],
];
