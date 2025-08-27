<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <main>
        <!-- START ADD SECTION -->
        <section>
            <div class="container">
                <div class="add-content"></div>
            </div>
        </section>
        <!-- END ADD SECTION -->
         
        <!-- START SINGLE-POST SECTION -->
        <section class="section-single-post">
            <div class="container">
                <h1 class="post-tital"><?php the_title(); ?></h1>
                <div class="top-author-detail">
                    <?php
                        $author_id   = get_post_field( 'post_author', get_the_ID() );
                        $author_url  = get_author_posts_url( $author_id );
                        $author_name = get_the_author_meta( 'display_name', $author_id );
                    ?>
                    <a href="<?php echo esc_url( $author_url ); ?>" class="author-box">
                        <div class="author-name">
                            <?php echo esc_html( $author_name ); ?>
                        </div>
                    </a>
                    <div class="post-date-time">
                        <?php echo get_the_date('d M Y'); ?> <?php echo get_the_time('H:i'); ?>
                    </div>
                    <div class="post-categories">
                        <?php the_category(', '); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 d-none-md">
                        <aside class="custom-post-sidebar">
                            <div class="author-detail author-border">
                                <?php
                                    $author_id   = get_post_field( 'post_author', get_the_ID() );
                                    $author_url  = get_author_posts_url( $author_id );
                                    $author_name = get_the_author_meta( 'display_name', $author_id );
                                ?>
                                <a href="<?php echo esc_url( $author_url ); ?>" class="author-box">
                                    <picture>
                                        <?php echo get_avatar( $author_id, 64 ); ?>
                                    </picture>
                                    <div class="author-name">
                                        <?php echo esc_html( $author_name ); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="post-date-time author-border">
                                <?php echo get_the_date('d M Y'); ?> <?php echo get_the_time('H:i'); ?>
                            </div>
                            <div class="post-categories author-border">
                                <?php the_category(', '); ?>
                            </div>
                            <div class="post-tags author-border">
                                <?php
                                    $tags = get_the_tags();
                                    if ($tags) {
                                        the_tags('', ', ', '');
                                    } else {
                                        echo '<p class="no-select">No tag selected.</p>';
                                    }
                                ?>
                            </div>
                                <div class="post-share">
                                <p class="social-title">Partilhe este conteúdo</p>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" class="share-btn twitter">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                    <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" class="share-btn whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="share-btn linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                                <?php
                                    $orig_post = $post;
                                    global $post;
                                    $categories = get_the_category($post->ID);

                                    if ($categories) {
                                        $category_ids = array();

                                        foreach ($categories as $individual_category) {
                                            $category_ids[] = $individual_category->term_id;
                                        }

                                        $args = array(
                                            'category__in'       => $category_ids,
                                            'post__not_in'       => array($post->ID),
                                            'posts_per_page'     => 2,
                                            'orderby'            => 'none',
                                            'ignore_sticky_posts' => true,
                                        );

                                        $related_posts_query = new WP_Query($args);

                                        if ($related_posts_query->have_posts()) {
                                            echo '<div class="related-articles">';

                                            while ($related_posts_query->have_posts()) {
                                                $related_posts_query->the_post();
                                                ?>
                                                <div class="related-article">
                                                    <?php
                                                    setup_postdata($post);
                                                    set_query_var('post_object', $post);
                                                    get_template_part('template-parts/module-post-multi-section');
                                                    ?>
                                                </div>
                                                <?php
                                            }

                                            echo '</div>';
                                        }
                                        wp_reset_postdata();
                                        $post = $orig_post;
                                    } else {
                                        echo '<p>No related posts found.</p>';
                                    }
                                ?>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-6 col-md-12 pr-0">
                        <article id="post-<?php the_ID(); ?>" class="single-post-ctn" <?php post_class('custom-single-post'); ?>>
                            <header class="entry-header">
                                <div class="post-short-description"><?php echo get_the_excerpt(); ?></div>
                            </header>

                            <?php
                                $image_id = get_post_thumbnail_id();
                                $image_url = wp_get_attachment_image_url($image_id, 'large');
                                $image_caption = wp_get_attachment_caption($image_id);
                                $image_description = get_post($image_id)->post_content;
                            ?>

                            <?php if ( $image_url ) : ?>
                            <figure class="post-img">
                                <img src="<?php echo esc_url($image_url); ?>" class="post-thumbnail" alt="">
                                <?php if ( $image_caption || $image_description ) : ?>
                                <figcaption class="[ align-center small half-top-space ]">
                                    <?php if ( $image_caption ) : ?>
                                    <span class="article-image-description"><?php echo esc_html($image_caption); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $image_description ) : ?>
                                    <span class="article-image-credits"><?php echo esc_html($image_description); ?></span>
                                    <?php endif; ?>
                                </figcaption>
                                <?php endif; ?>
                            </figure>
                            <?php endif; ?>

                            <div class="entry-content"><?php the_content(); ?></div>

                            <!-- VEJA TAMBÉM SECTION -->
                            <div class="veja-post">
                                <h2>VEJA TAMBÉM</h2>
                                <?php
                                    $orig_post = $post;
                                    global $post;
                                    $categories = get_the_category($post->ID);

                                    if ($categories) {
                                        $category_ids = array();

                                        foreach ($categories as $individual_category) {
                                            $category_ids[] = $individual_category->term_id;
                                        }

                                        $args = array(
                                            'category__in'       => $category_ids,
                                            'post__not_in'       => array($post->ID),
                                            'posts_per_page'     => 2,
                                            'orderby'            => 'none',
                                            'ignore_sticky_posts' => true,
                                        );

                                        $related_posts_query = new WP_Query($args);

                                        if ($related_posts_query->have_posts()) {
                                            echo '<div class="related-articles d-grid">';

                                            while ($related_posts_query->have_posts()) {
                                                $related_posts_query->the_post();
                                                ?>
                                                <div class="related-article">
                                                    <?php
                                                    setup_postdata($post);
                                                    set_query_var('post_object', $post);
                                                    get_template_part('template-parts/module-post-multi-section');
                                                    ?>
                                                </div>
                                                <?php
                                            }

                                            echo '</div>';
                                        }
                                        wp_reset_postdata();
                                        $post = $orig_post;
                                    } else {
                                        echo '<p>No related posts found.</p>';
                                    }
                                ?>
                            </div>
                            <!-- EM DESTAQUE SECTION -->
                            <div class="em-post">
                                <h2>Em destaque</h2>
                                <?php
                                    
                                    $featured_post_ids = array(84, 281, 808, 28151);

                                    $args = array(
                                        'post_type'      => 'post',
                                        'post__in'       => $featured_post_ids,
                                        'orderby'        => 'post__in',
                                        'posts_per_page' => 4,
                                        'post_status'    => 'publish'
                                    );

                                    $featured_query = new WP_Query($args);

                                    if ($featured_query->have_posts()) {
                                        echo '<div class="featured-posts">';

                                        while ($featured_query->have_posts()) {
                                            $featured_query->the_post();
                                            echo '<div class="post-content col-sm-12 pd-0 custom-height single-featured-post">';
                                                echo '<div class="post-box">';
                                                    set_query_var('post_object', get_post());
                                                    get_template_part('template-parts/module', 'post-box');
                                                echo '</div>';
                                            echo '</div>';
                                        }

                                        echo '</div>';
                                        wp_reset_postdata();
                                    } else {
                                        echo '<p>No matching posts found.</p>';
                                    }
                                ?>
                            </div>

                            <!-- ULTIMAS POSTS SECTION -->
                            <div class="ultimas-latest-posts">
                                <h2><a href="<?php echo site_url('/ultimas'); ?>">Últimas</a></h2>
                                <?php
                                    $args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 6,
                                        'post_status' => 'publish',
                                        'orderby' => 'date',
                                        'order' => 'DESC'
                                    );

                                    $ultimas_query = new WP_Query($args);

                                    if ($ultimas_query->have_posts()) {
                                        echo '<ul>';
                                        while ($ultimas_query->have_posts()) {
                                            $ultimas_query->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                     <?php
                                                        $content = get_the_content();
                                                        if (
                                                            strpos($content, '[gallery') !== false ||
                                                            strpos($content, 'wp-block-gallery') !== false ||
                                                            strpos($content, '<figure') !== false
                                                        ) {
                                                            echo '<div class="camera-icon"><i class="fa fa-camera"></i></div>';
                                                        }
                                                        if (
                                                            strpos($content, '[video') !== false || 
                                                            strpos($content, '<video') !== false || 
                                                            strpos($content, 'youtube.com') !== false || 
                                                            strpos($content, 'vimeo.com') !== false || 
                                                            strpos($content, 'wp-block-embed__wrapper') !== false // Gutenberg video block
                                                        ) {
                                                            echo '<div class="video-icon"><i class="fa fa-video-camera"></i></div>';
                                                        }
                                                    ?>
                                                    <?php the_title(); ?>
                                                </a>
                                                <div class="author-name">
                                                    <a href="<?php echo esc_url( $author_url ); ?>">
                                                        por <span><?php the_author(); ?></span>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php }
                                        echo '</ul>';
                                        wp_reset_postdata();
                                    }
                                ?>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-3 d-none-md">
                        <div class="add-content-vertical"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SINGLE-POST SECTION -->
    </main>
    
</div>


<?php get_footer(); ?>