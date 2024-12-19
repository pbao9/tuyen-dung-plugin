<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()): ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php post_type_archive_title(); ?>
                </h1>
            </header><!-- .page-header -->

            <?php
            // Start the Loop.
            while (have_posts()):
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            // Pagination.
            the_posts_pagination(
                array(
                    'prev_text' => __('Previous', 'textdomain'),
                    'next_text' => __('Next', 'textdomain'),
                )
            );

        else:
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
