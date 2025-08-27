<?php get_header(); ?>

<main>
    <!-- START ADD SECTION -->
    <section>
        <div class="container">
            <div class="add-content"></div>
        </div>
    </section>
    <!-- END ADD SECTION -->

    <!-- START AUTHOR SECTION -->
    <section class="author-section category-section">
        <div class="container">
            <div class="author-info">
                <div class="single-author-img">
                    <?php 
                        $author_id = get_queried_object_id();
                        echo get_avatar($author_id, 96);
                    ?>
                </div>
                <div class="author-tital">
                    <h1>Posts de <?php the_author(); ?></h1>
                    <div class="social-btn">
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" class="share-btn twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="mailto:raquelcosta@magg.pt=<?php the_permalink(); ?>" target="_blank" class="share-btn">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9 col-md-12">
                    <div class="category-page-wrapper">
                        <?php
                            $author_id = get_queried_object_id();
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            $args = array(
                                'post_type' => 'post',
                                'author' => get_queried_object_id(),
                                'posts_per_page' => 24,
                                'paged' => $paged,
                                'post_status' => 'publish',
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );

                            $latest_posts = new WP_Query($args);
                            $total_pages = $latest_posts->max_num_pages;
                            $current_page = max(1, $paged);

                            if (!$latest_posts->have_posts()) {
                                echo '<div class="no-results-content"><p>No posts found in this category.</p></div>';
                            }
                        ?>

                        <div class="trip-type">
                            <?php
                                if ($latest_posts->have_posts()) {
                                    echo '<div class="post-grid post-block">';

                                    while ($latest_posts->have_posts()) {
                                        $latest_posts->the_post();
                                        set_query_var('post_object', get_post());
                                        get_template_part('template-parts/module-post-multi-section');
                                    }

                                    echo '</div>';
                                }

                                wp_reset_postdata();
                            ?>
                        </div>

                        <?php if ($total_pages > 1): ?>
                            <div class="custom-pagination">
                                <?php if ($current_page > 1) : ?>
                                    <a class="page-numbers prev" href="<?php echo get_pagenum_link($current_page - 1); ?>">Anterior</a>
                                <?php else : ?>
                                    <span class="page-numbers prev disabled">Anterior</span>
                                <?php endif; ?>

                                <?php
                                echo paginate_links([
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'mid_size' => 3,
                                    'type' => 'plain',
                                    'prev_next' => false,
                                ]);
                                ?>

                                <?php if ($current_page < $total_pages) : ?>
                                    <a class="page-numbers next" href="<?php echo get_pagenum_link($current_page + 1); ?>">Seguinte</a>
                                <?php else : ?>
                                    <span class="page-numbers next disabled">Seguinte</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-3 col-md-12">
                    <div class="add-content-vertical"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- END AUTHOR SECTION -->
</main>

<?php get_footer(); ?>
