<?php
/**
 * Template Name: Custom Home Page
 */
get_header();
?>

<main>
    <!-- START ADD SECTION -->
        <section>
            <div class="container">
                <div class="add-content"></div>
            </div>
        </section>
    <!-- END ADD SECTION -->

    <!-- /var/www/html/travelmagg-sapo-wp/wp-content/themes/astra-child/page-home.php this file path name  -->
    <!-- START BANNER SECTION -->
     <section class="banner-section">
        <div class="container">
            <?php
                $highlight_post = get_field('trip-highlight');

                if ($highlight_post) {
                    set_query_var('post_object', $highlight_post);
                    get_template_part('template-parts/module', 'post-box');
                }
            ?>
        </div>
     </section>
    <!-- END BANNER SECTION --> 

    <!-- START OF MULTI-SECTION POST DISPLAY -->
    <?php
        $sections = [
            'seasonal_post' => '',
            'destinos-section' => 'DESTINOS DE PRIMAVERA',
            'promocoes-section' => 'PROMOÇÕES',
        ];

        foreach ($sections as $acf_field => $title) {
            echo '<section class="' . esc_attr(str_replace('_', '-', $acf_field)) . '">';
            $posts = get_field($acf_field);
            if ($posts) {
                echo '<div class="container">';
                if (!empty($title)) echo '<h2 class="title">' . esc_html($title) . '</h2>';
                echo '<div class="post-grid sm-scroll">';
                
                foreach ($posts as $post_object) {
                    echo '<div class="post-content col-sm-12 pd-0 custom-height">';
                        echo '<div class="post-box">';
                            set_query_var('post_object', $post_object);
                            get_template_part('template-parts/module', 'post-box');
                        echo '</div>';
                    echo '</div>';
                }

                echo '</div></div>';
                if ($acf_field === 'destinos-section') {
                    echo '<div class="container"><div class="add-content"></div></div>';
                }
                wp_reset_postdata();
            } else {
                echo '<p>No posts selected.</p>';
            }
            echo '</section>';
        }
    ?>
    <!-- END OF MULTI-SECTION POST DISPLAY -->

    <!-- START OF HOTELARIA-SECTION -->
    <section id="hotelaria-section" class="hotelaria-section">
        <?php
            $posts = get_field('hotelaria-section');

            if ($posts):
                if (!is_array($posts)) {
                    $posts = [$posts]; // Ensure it's always an array
                }

                echo '<div class="container">';
                echo '<h2 class="title">HOTELARIA</h2>';
                echo '<div class="post-grid">';

                foreach ($posts as $post):
                    set_query_var('post_object', $post);
                    get_template_part('template-parts/module-post-multi-section');
                endforeach;

                echo '</div></div>';
            endif;
        ?>
    </section>
    <!-- END OF HOTELARIA-SECTION -->

    <!-- START TUDO INCLUÍDO SECTION -->
    <section id="tudo-incluido" class="tudo-incluido-section travel-section">
        <div class="container">
            <h2 class="title">VIAGENS COM TUDO INCLUÍDO</h2>
            <div class="row">
                <div class="col-9 col-md-12 pr-0">
                    <?php
                        $highlight_post = get_field('trip-highlight');

                        if ($highlight_post) {
                            set_query_var('post_object', $highlight_post);
                            get_template_part('template-parts/module', 'post-box');
                        }
                    ?>
                    <div class="trip-type">
                        <?php
                            $posts = get_field('tudo-incluido-section');

                            if ($posts):
                                if (!is_array($posts)) {
                                    $posts = [$posts];
                                }

                                echo '<div class="post-grid">';

                                foreach ($posts as $post):
                                    set_query_var('post_object', $post);
                                    get_template_part('template-parts/module-post-multi-section');
                                endforeach;

                                echo '</div>';
                            endif;
                        ?>
                    </div>
                </div>
                <div class="col-3 col-md-12">
                    <div class="add-content-vertical"></div>
                </div>
            </div>
            <div class="add-content"></div>
        </div>
    </section>
    <!-- END TUDO INCLUÍDO SECTION -->

    <!-- START SECTION-BARATOS -->
    <section id="baratos-section" class="baratos-section common-section">
        <?php
            $posts = get_field('baratos_section');  

            if ($posts):
                if (!is_array($posts)) {
                    $posts = [$posts];
                }

                echo '<div class="container">';
                echo '<h2 class="title">DESTINOS BARATOS</h2>';
                echo '<div class="post-grid">';

                foreach ($posts as $post):
                    set_query_var('post_object', $post);
                    get_template_part('template-parts/module-post-multi-section');
                endforeach;

                echo '</div></div>';
            endif;
        ?>
    </section>
    <!-- END SECTION-BARATOS -->

    <!-- START PORTUGAL SECTION -->
    <section id="portugal-section" class="portugal-section travel-section mb-0">
        <div class="container">
            <h2 class="title">O MELHOR DE PORTUGAL</h2>
            <div class="row">
                <div class="col-9 col-md-12 pr-0">
                    <div class="portugal-content">
                    <?php
                        $posts = get_field('portugal-section');
                        if ($posts) {
                            echo '<div class="post-grid sm-scroll">';
                            foreach ($posts as $post_object) {
                                echo '<div class="post-content col-sm-12 pd-0 custom-height">';
                                    echo '<div class="post-box">';
                                        set_query_var('post_object', $post_object);
                                        get_template_part('template-parts/module', 'post-box');
                                    echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            wp_reset_postdata();
                        } else {
                            echo '<p>No posts selected.</p>';
                        }
                    ?>
                    </div>
                    <div class="trip-type">
                        <?php
                            $posts = get_field('tudo-incluido-section');

                            if ($posts):
                                if (!is_array($posts)) {
                                    $posts = [$posts];
                                }

                                echo '<div class="post-grid">';

                                foreach ($posts as $post):
                                    set_query_var('post_object', $post);
                                    get_template_part('template-parts/module-post-multi-section');
                                endforeach;

                                echo '</div>';
                            endif;
                        ?>
                    </div>
                </div>
                <div class="col-3 col-md-12">
                    <div class="add-content-vertical"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PORTUGAL SECTION -->

    <!-- START PRAIA SECTION -->
    <section id="praia-section" class="praia-section travel-section ">
        <div class="container">
            <h2 class="title">DESTINOS DE PRAIA</h2>
            <div class="row">
                <div class="col-9 col-md-12 pr-0">
                    <?php
                        $highlight_post = get_field('destinos-de-praia');

                        if ($highlight_post) {
                            set_query_var('post_object', $highlight_post);
                            get_template_part('template-parts/module', 'post-box');
                        }
                    ?>
                    <div class="trip-type">
                        <?php
                            $posts = get_field('article-list-praia');

                            if ($posts):
                                if (!is_array($posts)) {
                                    $posts = [$posts];
                                }

                                echo '<div class="post-grid">';

                                foreach ($posts as $post):
                                    set_query_var('post_object', $post);
                                    get_template_part('template-parts/module-post-multi-section');
                                endforeach;

                                echo '</div>';
                            endif;
                        ?>
                    </div>
                </div>
                <div class="col-3 col-md-12">
                    <div class="add-content-vertical"></div>
                </div>
            </div>
            <div class="add-content"></div>
        </div>
    </section>
    <!-- END PRAIA SECTION -->

    <!-- START VIAGENS-A-DOIS SECTION -->
    <section class="viagens-a-dois">
        <?php
            $posts = get_field('viagens_a_dois');
            if ($posts) {
                echo '<div class="container">';
                echo '<h2 class="title">VIAGENS A DOIS</h2>';
                echo '<div class="post-grid sm-scroll">';
                foreach ($posts as $post_object) {
                    echo '<div class="post-content col-sm-12 pd-0 custom-height">';
                        echo '<div class="post-box">';
                            set_query_var('post_object', $post_object);
                            get_template_part('template-parts/module', 'post-box');
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div></div>';
                wp_reset_postdata();
            } else {
                echo '<p>No posts selected.</p>';
            }
        ?>
    </section>
    <!-- END VIAGENS-A-DOIS SECTION -->

    <!-- START MUNDO SECTION -->
    <section id="mundo-section" class="mundo-section destinos-section">
        <?php
            $posts = get_field('mundo_post');
            if ($posts) {
                echo '<div class="container">';
                echo '<h2 class="title">MUNDO</h2>';
                echo '<div class="post-grid sm-scroll">';
                foreach ($posts as $post_object) {
                    echo '<div class="post-content col-sm-12 pd-0 custom-height">';
                        echo '<div class="post-box">';
                            set_query_var('post_object', $post_object);
                            get_template_part('template-parts/module', 'post-box');
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div></div>';
                wp_reset_postdata();
            } else {
                echo '<p>No posts selected.</p>';
            }
        ?>
    </section>
    <!-- END MUNDO SECTION -->
    
    <!-- START VIAGENS SECTION -->
    <section id="viagens-section" class="viagens-section travel-section">
        <div class="container">
            <div class="trip-type">
            <?php
                    $posts = get_field('viagens-section');
                    $viagens_category = get_category_by_slug('viagens');
                    if ($posts && $viagens_category) :
                        $viagens_link = get_category_link($viagens_category->term_id);
                ?>
                <div class="viagens-head">
                    <h2><a href="<?php echo esc_url($viagens_link); ?>" class="title mb-0">Viagens</a></h2>
                    <a href="<?php echo esc_url($viagens_link); ?>" class="ver-btn">Ver mais</a>
                </div>
                <?php
                    $posts = get_field('viagens-section');

                    if ($posts):
                        if (!is_array($posts)) {
                            $posts = [$posts];
                        }

                        echo '<div class="post-grid">';

                        foreach ($posts as $post):
                            set_query_var('post_object', $post);
                            get_template_part('template-parts/module-post-multi-section');
                        endforeach;

                        echo '</div>';
                    endif;
                ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- END VIAGENS SECTION -->
</main>

<?php get_footer(); ?>