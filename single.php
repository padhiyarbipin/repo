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
 <?php if( has_post_thumbnail() ): ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php endif; ?>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php
$categories = get_the_category();
if ( $categories ) {
  $cat_ids = wp_list_pluck( $categories, 'term_id' );

  $related = new WP_Query( array(
    'category__in'   => $cat_ids,
    'post__not_in'   => array( get_the_ID() ),
    'posts_per_page' => 3, // number of related posts
  ) );

  if ( $related->have_posts() ) : ?>
    <div class="related-posts">
      <h3>Related Posts</h3>
      <ul>
        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('thumbnail');
              } ?>
              <p><?php the_title(); ?></p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <?php
    wp_reset_postdata();
  endif;
}
?>

<?php get_footer(); ?>
