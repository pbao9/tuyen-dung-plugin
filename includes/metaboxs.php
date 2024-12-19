<?php


add_action('save_post', 'wp_save_tuyendung_post');

function wp_save_tuyendung_post($post_id)
{
    if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'tuyen-dung') {
        $fields = [
            'address',
            'salary',
            'requirements',
            'recruitment_deadline',
            'location',
            'amount',
            'working_time'
        ];

        foreach ($fields as $field) {
            if (isset($_REQUEST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_REQUEST[$field]));
            }
        }
    }
}

add_action('save_post', 'wp_save_tuyendung_post');






add_action('add_meta_boxes', 'wp_add_custom_box');

function wp_add_custom_box()
{
    // $screens = ['post', 'wporg_cpt'];
    add_meta_box(
        'wp_tuyendung_info',                 // Unique ID
        'Thông tin tuyển dụng',      // Box title
        'wp_custom_box_html',  // Content callback, must be of type callable
        'tuyen-dung'                            // Post type
    );
}

function wp_custom_box_html()
{
    include_once TUYENDUNG_PATH . 'includes/templates/metabox_box_product.php';
}