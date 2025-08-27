<?php
/*
Template Name: Últimas
*/

get_header(); ?>

<main>
    <!-- START ADD SECTION -->
    <section>
        <div class="container">
            <div class="add-content"></div>
        </div>
    </section>
    <!-- END ADD SECTION -->

    <!-- START ULTIMAS SECTION -->
    <section class="ultimas-section">
        <div class="container">
            <div class="row">
                <div class="col-9 col-md-12 pr-0">
                    <div class="ultimas-posts">
                        <h1>Últimas</h1>
                        <div class="trip-type">
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 24,
                                'paged' => $paged,
                                'post_status' => 'publish',
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );

                            $latest_posts = new WP_Query($args);

                            if ($latest_posts->have_posts()) {
                                echo '<div class="post-grid">';

                                while ($latest_posts->have_posts()) {
                                    $latest_posts->the_post();

                                    // Pass current post object to the module
                                    set_query_var('post_object', get_post());

                                    // Load your module template for each post
                                    get_template_part('template-parts/module-post-multi-section');
                                }

                                echo '</div>';
                            } else {
                                echo '<p>No posts found.</p>';
                            }

                            // Pagination setup
                            $total_pages = $latest_posts->max_num_pages;
                            $current_page = max(1, $paged);
                            $base = get_pagenum_link(1) . '%_%';

                            wp_reset_postdata();
                            ?>
                        </div>

                        <div class="add-content"></div>

                        <?php if ($total_pages > 1) : ?>
                            <div class="custom-pagination">
                                <?php if ($current_page > 1) : ?>
                                    <a class="page-numbers prev" href="<?php echo get_pagenum_link($current_page - 1); ?>">Anterior</a>
                                <?php else : ?>
                                    <span class="page-numbers prev disabled">Anterior</span>
                                <?php endif; ?>

                                <?php
                                echo paginate_links(array(
                                    'base' => $base,
                                    'format' => 'page/%#%/',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'mid_size' => 2,
                                    'type' => 'plain',
                                    'prev_next' => false
                                ));
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
    <!-- END ULTIMAS SECTION -->
</main>

<?php get_footer(); ?>
