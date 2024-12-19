<?php

/*
Plugin Name: Tuyển dụng 
Plugin URI: https://pbao9.github.io
Description: Plugin đăng tin tuyển dụng
Version: 1.0.0
Author: Phạm Bảo
Author URI: https://zalo.me/0901430854
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Định nghĩa hằng số của plugin

define("TUYENDUNG_PATH", plugin_dir_path(__FILE__));
define("TUYENDUNG_URI", plugin_dir_url(__FILE__));


register_activation_hook(__FILE__, 'tuyendung_activation');
function tuyendung_activation()
{
    // Tạo csdl
}


// Định nghĩa hành động khi plugin được tắt đi
register_deactivation_hook(__FILE__, 'tuyendung_deactivation');
function tuyendung_deactivation()
{
    // xoá csdl
    // xoá option
}

function wp_tuyendung_single_template($single_template)
{
    global $post;
    if ($post->post_type == 'tuyen-dung') {
        $single_template = TUYENDUNG_PATH . 'includes/templates/single-tuyen-dung.php';
    }
    return $single_template;
}
add_filter('single_template', 'wp_tuyendung_single_template');


function load_tuyendung_archive_template($archive_template)
{
    if (is_post_type_archive('tuyen-dung')) {
        $archive_template = TUYENDUNG_PATH . 'includes/templates/single-tuyen-dung.php';
    }
    return $archive_template;
}
add_filter('archive_template', 'load_tuyendung_archive_template');


function redirect_tuyendung_archive_to_page()
{
    if (is_post_type_archive('tuyen-dung')) {
        wp_redirect(home_url('/danh-sach-tuyen-dung/'));
        exit();
    }
}
add_action('template_redirect', 'redirect_tuyendung_archive_to_page');


// Thêm custom fields vào đối tượng $post
function add_custom_fields_to_post($post)
{
    if (isset($post) && $post->post_type == 'tuyen-dung') {
        $post->salary = get_post_meta($post->ID, 'salary', true);
        $post->address = get_post_meta($post->ID, 'address', true);
    }
    return $post;
}
add_filter('the_post', 'add_custom_fields_to_post');


include_once TUYENDUNG_PATH . 'includes/include.php';



