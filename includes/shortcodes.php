<?php
function display_job_listings($atts)
{
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $query = new WP_Query(array(
        'post_type' => 'tuyen-dung',
        'posts_per_page' => 1,
        'paged' => $paged,
    ));

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="job-listings">';

        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="job-item row align-middle">';
            echo '<div class="col large-8 medium-6 small-12">';
            echo '<div class="col-inner">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '</div></div>';
            echo '<div class="col large-4 medium-6 small-12">';
            echo '<div class="col-inner text-right">';
            echo '<a href="' . get_permalink() . '" class="button primary custom-btn-pbao">Chi tiết</a>';
            echo '</div></div></div>';
        }
        echo '</div>';

        if ($paged < $query->max_num_pages) {
            echo '<div class="load-more-container text-center">';
            echo '<button class="button primary load-more-jobs custom-btn-pbao" data-paged="' . ($paged + 1) . '">Xem thêm</button>';
            echo '</div>';
        }
    } else {
        if ($paged === 1) {
            echo '<p>No job listings found.</p>';
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('job_listings', 'display_job_listings');


add_action('wp_ajax_load_more_jobs', 'load_more_jobs');
add_action('wp_ajax_nopriv_load_more_jobs', 'load_more_jobs');

function load_more_jobs()
{
    echo do_shortcode('[job_listings]');
    wp_die();
}

add_action('wp_footer', 'custom_ajax_jobs_script');
function custom_ajax_jobs_script()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(document).on('click', '.load-more-jobs', function () {
                const button = $(this);
                const paged = button.data('paged');

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'load_more_jobs',
                        paged: paged,
                    },
                    beforeSend: function () {
                        button.text('Đang tải...').prop('disabled', true);
                    },
                    success: function (response) {
                        $('.job-listings').append(response);
                        button.data('paged', paged + 1).text('Tải thêm').prop('disabled', false);

                        if ($(response).find('.job-item').length === 0) {
                            button.hide();
                        }
                    },
                    error: function () {
                        button.text('Lỗi, thử lại!').prop('disabled', false);
                    },
                });
            });
        });
    </script>
    <?php
}

$custom_fields = [
    'address' => 'address',
    'salary' => 'salary',
    'requirements' => 'requirements',
    'recruitment_deadline' => 'recruitment_deadline',
    'location' => 'location',
    'amount' => 'amount',
    'working_time' => 'working_time',
];

foreach ($custom_fields as $key => $field) {
    add_shortcode($field, function ($atts) use ($field) {
        global $post;
        if ($post->post_type !== 'tuyen-dung') {
            return '';
        }
        $value = get_post_meta($post->ID, $field, true);
        if ($field === 'requirements') {
            return wpautop(esc_html($value));
        }
        return esc_html($value);
    });
}

function custom_title_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'post_id' => '',
        ),
        $atts,
        'custom_the_title'
    );
    $post_id = $atts['post_id'] ? $atts['post_id'] : get_the_ID();
    $title = get_the_title($post_id);
    return $title;
}
add_shortcode('custom_the_title', 'custom_title_shortcode');

function custom_created_date_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'format' => 'd/m/Y',
            'post_id' => '',
        ),
        $atts,
        'custom_created_date'
    );

    $post_id = $atts['post_id'] ? $atts['post_id'] : get_the_ID();
    $date = get_the_date($atts['format'], $post_id);
    return $date;
}
add_shortcode('custom_created_date', 'custom_created_date_shortcode');


function custom_description_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'post_id' => '',
        ),
        $atts,
        'description'
    );

    $post_id = $atts['post_id'] ? $atts['post_id'] : get_the_ID();
    $description = get_post_field('post_content', $post_id);

    return apply_filters('the_content', $description);
}
add_shortcode('description', 'custom_description_shortcode');
