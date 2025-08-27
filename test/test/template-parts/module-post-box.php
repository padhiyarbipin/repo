<?php
/**
 * Template Part: Post Box for Given Post
 * Usage: set_query_var('post_object', $post); get_template_part('template-parts/module-post-box');
 */

// /var/www/html/travelmagg-sapo-wp/wp-content/themes/astra-child/template-parts/module-post-box.php  part in is file

$post = get_query_var('post_object');

if (!$post) {
    echo '<p>No post found.</p>';
    return;
}

setup_postdata($post);

// Same logic from your original template
$content = get_the_content();

// Detect video
$has_video = false;
$video_url = '';
if (preg_match('/<video[^>]*src=["\']([^"\']+)["\']/i', $content, $matches) ||
    preg_match('/\[video\s+.*?src=["\']([^"\']+)["\']/', $content, $matches)) {
    $has_video = true;
    $video_url = esc_url($matches[1]);
}

// Detect gallery
$has_gallery = false;
if (
    preg_match('/\[gallery.*?\]/', $content) ||
    strpos($content, 'wp-block-gallery') !== false ||
    preg_match('/<figure[^>]*class=["\'].*?wp-block-gallery.*?["\']/', $content) ||
    strpos($content, '[rl_gallery') !== false ||
    strpos($content, 'rl-gallery') !== false
) {
    $has_gallery = true;
}
?>

    <div class="row">
        <div class="col-12">
            <div class="single-post-box">
                <a href="<?php the_permalink(); ?>" class="video-hover-wrapper<?php echo $has_video ? ' has-video' : ''; ?>">
                    <picture><?php the_post_thumbnail('medium'); ?></picture>

                    <?php if ($has_video): ?>
                        <div class="video-preview-wrapper">
                            <video src="<?php echo $video_url; ?>" autoplay muted loop playsinline></video>
                        </div>
                    <?php endif; ?>

                    <?php if ($has_video || $has_gallery): ?>
                        <div class="post-icons-wrapper d-sm-none">
                            <?php if ($has_video): ?>
                                <div class="video-icon"><i class="fa fa-video"></i></div>
                            <?php endif; ?>
                            <?php if ($has_gallery): ?>
                                <div class="camera-icon"><i class="fa fa-camera"></i></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </a>
                <div class="details-content">
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        echo '<p class="post-categories mb-0">';
                        foreach ($categories as $cat) {
                            echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a> ';
                        }
                        echo '</p>';
                    }
                    ?>
                    <h2 class="post-title-with-icon">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($has_video || $has_gallery): ?>
                                <div class="camera-icon d-on-mobile">
                                    <?php if ($has_video): ?>
                                        <i class="fa fa-video"></i>
                                    <?php endif; ?>
                                    <?php if ($has_gallery): ?>
                                        <i class="fa fa-camera"></i>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="description-post"><?php the_excerpt(); ?></div>
                    <div class="post-meta">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                            por <span><?php the_author(); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
wp_reset_postdata();
