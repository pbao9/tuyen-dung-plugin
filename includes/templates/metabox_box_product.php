<?php
global $post;
$fields = [
    'address' => 'Địa điểm làm việc',
    'salary' => 'Lương thưởng',
    'recruitment_deadline' => 'Hạn chót nộp hồ sơ',
    'location' => 'Khu vực',
    'amount' => 'Số lượng tuyển dụng',
    'working_time' => 'Thời gian làm việc',
    'requirements' => 'Yêu cầu',
];

foreach ($fields as $key => $label) {
    $$key = get_post_meta($post->ID, $key, true);
}
?>

<table class="form-table">
    <?php foreach ($fields as $key => $label): ?>
        <?php if ($key === 'requirements'): ?>
            <tr>
                <th scope="row"><label for="<?php echo $key; ?>"><?php echo $label; ?></label></th>
                <td>
                    <?php
                    $settings = array(
                        'textarea_name' => $key,
                        'media_buttons' => true,
                        'textarea_rows' => 10,
                        'teeny' => false,
                        'quicktags' => true,
                    );
                    wp_editor($$key, $key, $settings);
                    ?>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <th scope="row"><label for="<?php echo $key; ?>"><?php echo $label; ?></label></th>
                <td>
                    <input type="<?php echo $key === 'recruitment_deadline' ? 'date' : 'text'; ?>" name="<?php echo $key; ?>"
                        placeholder="<?php echo $label; ?>" value="<?php echo esc_attr($$key); ?>" class="large-text" />
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>