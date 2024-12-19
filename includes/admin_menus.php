<?php

add_action('admin_menu', 'wp_tuyendung_menu');

function wp_tuyendung_menu()
{
    add_submenu_page(
        'edit.php?post_type=tuyen-dung',
        'Cấu hình',
        'Cấu hình',
        'manage_options',
        'settings',
        'wp_tuyendung_admin_page_settings',
        26
    );
}

function wp_tuyendung_admin_page_settings()
{
    include_once TUYENDUNG_PATH . 'includes/admin_pages/settings.php';
}