<?php
// Đăng ký loại bài viết sản phẩm | post type
add_action('init', 'wp_tuyendung_post_type');

function wp_tuyendung_post_type()
{
    // post
    register_post_type(
        'tuyen-dung',
        array(
            'labels' => array(
                'name' => __('Tin Tuyển dụng', 'tuyendung-pbao'),
                'singular_name' => __('Tuyển dụng', 'tuyendung-pbao'),
                'add_new_item' => __('Thêm Tin tuyển dụng'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'tuyen-dung'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-megaphone'
        )
    );
}


// Đăng ký taxonomy

add_action('init', 'wp_register_taxonomy_tuyendung_position');

function wp_register_taxonomy_tuyendung_position()
{
    $labels = array(
        'name' => _x('Cấp bậc tuyển dụng', 'taxonomy general name'),
        'singular_name' => _x('Cấp bậc tuyển dụng', 'taxonomy singular name'),
        'search_items' => __('Tìm kiếm Cấp bậc tuyển dụng'),
        'all_items' => __('Tất cả Cấp bậc tuyển dụng'),
        'parent_item' => __('Parent Cấp bậc tuyển dụng'),
        'parent_item_colon' => __('Parent Cấp bậc tuyển dụng:'),
        'edit_item' => __('Chỉnh sửa Cấp bậc tuyển dụng'),
        'update_item' => __('Cập nhật Cấp bậc tuyển dụng'),
        'add_new_item' => __('Thêm mới Cấp bậc tuyển dụng'),
        'new_item_name' => __('Tạo mới Cấp bậc tuyển dụng Name'),
        'menu_name' => __('Cấp bậc tuyển dụng'),
    );
    $args = array(
        'hierarchical' => true, // make it hierarchical (like categories)
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'course'],
    );
    register_taxonomy('tuyendung_cat', ['tuyen-dung'], $args);
}

add_action('init', 'wp_register_taxonomy_tuyendung_specialized');

function wp_register_taxonomy_tuyendung_specialized()
{
    $labels = array(
        'name' => _x('Ngành tuyển dụng', 'taxonomy general name'),
        'singular_name' => _x('Ngành tuyển dụng', 'taxonomy singular name'),
        'search_items' => __('Tìm kiếm Ngành tuyển dụng'),
        'all_items' => __('Tất cả Ngành tuyển dụng'),
        'parent_item' => __('Parent Ngành tuyển dụng'),
        'parent_item_colon' => __('Parent Ngành tuyển dụng:'),
        'edit_item' => __('Chỉnh sửa Ngành tuyển dụng'),
        'update_item' => __('Cập nhật Ngành tuyển dụng'),
        'add_new_item' => __('Thêm mới Ngành tuyển dụng'),
        'new_item_name' => __('Tạo mới Ngành tuyển dụng Name'),
        'menu_name' => __('Ngành tuyển dụng'),
    );
    $args = array(
        'hierarchical' => true, // make it hierarchical (like categories)
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'course'],
    );
    register_taxonomy('tuyendung_ngang_cat', ['tuyen-dung'], $args);
}
