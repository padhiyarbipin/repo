<?php get_header(); ?>

<main>
    <!-- START ADD SECTION -->
    <section>
        <div class="container">
            <div class="add-content"></div>
        </div>
    </section>
    <!-- END ADD SECTION -->
     
    <!-- START CATEGORY SECTION -->
    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="col-9 col-md-12">
                    <div class="category-page-wrapper">
                        <header class="category-header sub-drop-down">
                            <h1><?php single_cat_title(); ?></h1>
                            <?php
                                $current_category = get_queried_object();

                                if ($current_category->parent != 0) {
                                    $top_category = get_category($current_category->parent);
                                    while ($top_category->parent != 0) {
                                        $top_category = get_category($top_category->parent);
                                    }
                                } else {
                                    $top_category = $current_category;
                                }

                                $subcategories = get_categories([
                                    'child_of' => $top_category->term_id,
                                    'hide_empty' => false,
                                ]);

                                if (!empty($subcategories)) {
                                    echo '<form method="get" class="category-filter-form">';
                                    echo '<select class="category-filter" onchange="if(this.value) window.location.href=this.value">';

                                    $parent_selected = (get_queried_object_id() === $top_category->term_id) ? ' selected' : '';
                                    echo '<option value="' . esc_url(get_category_link($top_category->term_id)) . '"' . $parent_selected . '>' . esc_html($top_category->name) . '</option>';

                                    foreach ($subcategories as $subcategory) {
                                        $selected = (get_queried_object_id() === $subcategory->term_id) ? ' selected' : '';
                                        echo '<option value="' . esc_url(get_category_link($subcategory->term_id)) . '"' . $selected . '>' . esc_html($subcategory->name) . '</option>';
                                    }

                                    echo '</select>';
                                    echo '</form>';
                                }
                            ?>
                        </header>

                        <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            $args = array(
                                'post_type' => 'post',
                                'cat' => get_queried_object_id(),
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
    <!-- END CATEGORY SECTION -->
</main>

<?php get_footer(); ?>
