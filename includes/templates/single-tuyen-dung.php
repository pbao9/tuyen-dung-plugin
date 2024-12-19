<?php
get_header();
$page = get_page_by_title('DetailRecruitment');
$content = apply_filters('the_content', $page->post_content);
echo $content;

get_footer();
