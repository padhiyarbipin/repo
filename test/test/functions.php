<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function astra_child_enqueue_scripts() {
    // Enqueue CSS
    wp_enqueue_style(
        'custom-style',
        get_stylesheet_directory_uri() . '/css/custom-style.css'
    );

    // Enqueue JS
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/js/custom-script.js',
        array('jquery'),
        null,   
        true   
    );

    // Enqueue Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');

function custom_theme_enqueue_styles() {
    // Google Fonts: Exo 2
    wp_enqueue_style(
        'google-fonts-exo2',
        'https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700&display=swap',
        false
    );
}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_styles');

function render_custom_menu_shortcode($atts) {
    $atts = shortcode_atts( array(
        'menu' => '',
    ), $atts );

    return wp_nav_menu( array(
        'menu' => $atts['menu'],
        'echo' => false,
        'container' => false,
        'menu_class' => 'custom-shortcode-menu',
    ));
}
add_shortcode('show_menu', 'render_custom_menu_shortcode');

function set_category_posts_per_page( $query ) {
    if ( $query->is_main_query() && !is_admin() && is_category() ) {
        $query->set( 'posts_per_page', 24 );
    }
}
add_action( 'pre_get_posts', 'set_category_posts_per_page' );

function custom_social_share_buttons() {
    ob_start();
    ?>
    <div class="social-item">
        <div class="partilhe-content">
            <p class="social-title">Partilhe este conteúdo</p>
            <div class="share-buttons">
                <a href="https://www.facebook.com/travelmagg.pt <?php the_permalink(); ?>" target="_blank" class="share-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" class="share-btn twitter">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" class="share-btn whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://travelmagg.sapo.pt/viagens/artigos/como-evitar-dor-de-ouvidos-no-aviao=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook-messenger">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="share-btn linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('social_share', 'custom_social_share_buttons');

function fale_connosco_feedback_shortcode() {
    ob_start();
    ?>
    <div class="article-feedback">
        <h3>Fale connosco</h3>
        <p>Se encontrou algum erro ou incorreção no artigo, <a href="mailto:leitor@magg.pt">alerte-nos</a>. Muito obrigado.</p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('fale_connosco', 'fale_connosco_feedback_shortcode');


function register_secondary_menu() {
    register_nav_menu('secondary-menu', __('Secondary Menu'));
}
add_action('after_setup_theme', 'register_secondary_menu');


function custom_footer_shortcode() {
    ob_start();
    ?>
    <div class="site-footer">
        <div class="row">
            <div class="small-100 medium-20 large-25 xlarge-40 footer-widget-area">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <figure>
                        <?php 
                            $front_page_id = get_option('page_on_front');
                            $image_url = get_field('footer_logo', $front_page_id);

                            if( $image_url ) {
                                echo '<img src="' . esc_url($image_url) . '" alt="Footer logo" />';
                            }
                        ?>
                    </figure>
                </a>
                <div class="footer-description">
                    <?php 
                        the_field('footer-description', get_option('page_on_front'));
                    ?>
                </div>
            </div>
            <div class="small-100 medium-20 large-25 xlarge-20 widget_block">
                <h3>
                    <?php 
                        the_field('em_destaque_tital', get_option('page_on_front'));
                    ?>
                </h3>
                <div class="custom-footer-menu">
                     <?php
                        wp_nav_menu(array(
                            'menu' => 'em-destaque-footer',
                            'menu_class' => 'primary-menu-class',
                            'container' => false
                        ));
                        ?>
                </div>
            </div>

            <div class="small-100 medium-20 large-25 xlarge-20 widget_block">
                <h3>
                    <?php 
                        the_field('sigam-nos_tital', get_option('page_on_front'));
                    ?>
                </h3>
                <div class="custom-footer-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'follow-menu',
                        'container' => 'div',
                        'container_class' => 'footer-menu',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
            </div>
            <div class="small-100 medium-20 large-25 xlarge-20 widget_block">
                <h3>
                    <?php 
                        the_field('travel_magg_tital', get_option('page_on_front'));
                    ?>
                </h3>
                <div class="custom-footer-menu mb-sm-0">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'topbar-menu',
                        'container' => 'div',
                        'container_class' => 'footer-menu',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('my_custom_footer', 'custom_footer_shortcode');


function register_custom_menu_locations() {
    register_nav_menus(array(
        'foter-menu'    => __('menu-footer'),
        'follow-menu'    => __('follow-menu'),
        'topbar-menu'    => __('Top Bar Menu'),
        'hot-topics-menu'    => __('hot topics menu'),
    ));
}
add_action('after_setup_theme', 'register_custom_menu_locations');

function hot_topics_menu_shortcode() {
    wp_nav_menu(array(
        'theme_location' => 'hot-topics-menu',
        'container' => 'div',
        'container_class' => 'hot topics menu',
        'fallback_cb' => false,
    ));
}
add_shortcode('hot_topics_menu', 'hot_topics_menu_shortcode');

function menu_with_custom_content_shortcode() {
    ob_start();
    ?>

    <div class="custom-primary-wrapper">
        <nav class="custom-menu">
            <div class="toggle-tital">
                <p>
                    <?php 
                        the_field('tital_menu', get_option('page_on_front'));
                    ?>
                </p>
            </div>
            <?php
            wp_nav_menu(array(
                'menu' => 'primary-menu',
                'menu_class' => 'primary-menu-class',
                'container' => false
            ));
            ?>
        </nav>
        <nav class="custom-menu">
            <div class="toggle-tital">
                <p>
                    <?php 
                        the_field('tital_topicos', get_option('page_on_front'));
                    ?>
                </p>
            </div>
            <?php
            wp_nav_menu(array(
                'menu' => 'em-destaque-footer',
                'menu_class' => 'primary-menu-class',
                'container' => false
            ));
            ?>
        </nav>

    <div class="color-scheme-switch">
        <div class="toggle-tital">
            <p>
                <?php 
                    the_field('tital_esquema', get_option('page_on_front'));
                ?>
            </p>
        </div>
        <div id="theme-toggle" class="switch-color">
            <button class="theme-btn" data-theme="dark"><i class="far fa-circle"></i><?php the_field('switch_color_button1', get_option('page_on_front'));?></button>
            <button class="theme-btn" data-theme="auto"><i class="fa fa-adjust"></i><?php the_field('switch_color_button2', get_option('page_on_front'));?></button>
            <button class="theme-btn" data-theme="light"><i class="fa fa-circle"></i><?php the_field('switch_color_button3', get_option('page_on_front'));?></button>
        </div>
        <p><?php the_field('switch_color_description', get_option('page_on_front'));?></p>
    </div>
    <!-- <div class="mobile-menu-social">
        <div class="toggle-tital">
            <p><?php echo esc_html(get_field('popup_tital')); ?></p>
        </div>
        <div class="notificacoes-icon">
            <button class="notification-btn-2 btn-popup"><?php echo esc_html(get_field('popup_button_text')); ?></button>
            <div class="notification-popup-2">
                <div class="popup-text">
                    <h2><?php echo esc_html(get_field('heading_button')); ?></h2>
                    <p><?php echo esc_html(get_field('popup_description')); ?></p>
                    <div class="switch-container"><?php echo esc_html(get_field('popup_switch_label')); ?><a href="#"></a></div>
                    <p>
                        <button class="close-popup"><i class="fa-solid fa-xmark"></i><?php echo esc_html(get_field('close_button')); ?></button>
                    </p>
                </div>
            </div>
        </div> -->
        <div class="mobile-menu-social">
        <div class="toggle-tital">
            <p>Siga-nos</p>
        </div>
        <div class="notificacoes-icon">
            <button class="notification-btn-2 btn-popup"><i class="fa-solid fa-bell"></i>Notificações</button>
            <div class="notification-popup-2">
                <div class="popup-text">
                <h2>Notificações</h2>
                <p>Queremos estar sempre consigo. Para não perder nenhum dos nossos conteúdos, subscreva as nossas notificações e <br> 
                mantenha-se atualizado. Obrigada!</p>
                <div class="switch-container">Geral
                    <a href="#"></a>
                </div>
                <p>
                    <button class="close-popup">
                    <i class="fa-solid fa-xmark"></i> Fechar
                    </button>
                </p>

            </div>
            </div>
        </div>

        <div class="menu-icon-link">
            <button><a href="https://www.instagram.com/travelmagg.pt/"><i class="fa-brands fa-instagram"></i></a></button>
            <button><a href="https://www.facebook.com/travelmagg.pt"><i class="fa-brands fa-facebook-f"></i></a></button>
        </div>
    </div>


    <?php
    return ob_get_clean();
}
add_shortcode('menu_with_content', 'menu_with_custom_content_shortcode');


function change_search_placeholder_text($form) {
    // Replace default placeholder with 'pesquisa'
    $form = str_replace('placeholder="Search..."', 'placeholder="pesquisa"', $form);
    return $form;
}
add_filter('get_search_form', 'change_search_placeholder_text');


// Shortcode to show the popup search HTML
function popup_search_shortcode() {
    ob_start(); ?>
    <span class="search-icon" style="cursor:pointer;"><i class="fa-solid fa-magnifying-glass"></i></span>
    <div style="display:none;" class="popup-search">
        <div class="popup-search-inner">
            <div class="input-field">
                <input type="text" class="live-search" placeholder="o que procura?" autocomplete="off" />
                <span class="close-search" style="cursor:pointer;">&times;</span>
            </div>
            <div class="search-results" style="display:none;"></div>
        </div>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('popup_search', 'popup_search_shortcode');


function handle_live_search_ajax() {
    $query = isset($_REQUEST['q']) ? sanitize_text_field($_REQUEST['q']) : '';

    // If query is empty or less than 3 characters
    if (empty($query) || strlen($query) < 3) {
        echo '<div class="search-validation-msg">Por favor digite pelo menos 3 caracteres.</div>';
        wp_die();
    }

    $args = array(
        's' => $query,
        'post_type' => 'post',
        'posts_per_page' => 10,
    );

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) {
        echo '<div class="search-results-wrapper">';
        echo '<ul class="search-result-item">';
    
        while ($search_query->have_posts()) {
            $search_query->the_post();
            echo '<li>';
            echo '<a href="' . esc_url(get_permalink()) . '">';
            echo '<span class="search-title">' . esc_html(get_the_title()) . '</span>';
            echo '<span class="search-excerpt">' . esc_html(get_the_excerpt()) . '</span>';
            echo '<span class="search-date">' . esc_html(get_the_date()) . '</span>';
            echo '</a>';
            echo '</li>';
         }
            echo '<li class="search-view-all">';
            echo '<a href="' . esc_url(get_site_url() . '?s=' . urlencode($query)) . '">';
            echo '<span class="search-title">Ver todos os resultados</span>';
            echo '</a>';
            echo '</li>';
            echo '</ul>';
            echo '</div>';
    
        wp_reset_postdata();
    } else {
        echo '<div class="search-no-results">Não existem resultados para a pesquisa efectuada</div>';
    }

    wp_die();
}

add_action('wp_ajax_live_search', 'handle_live_search_ajax');
add_action('wp_ajax_nopriv_live_search', 'handle_live_search_ajax');

// Enqueue your JS file and pass ajaxurl
function enqueue_custom_script() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/js/custom-script.js',
        array(),
        '1.0',
        true
    );

    wp_localize_script('custom-script', 'liveSearch', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

// permalink code ulr
add_filter('post_link', 'correct_single_post_category_in_permalink', 10, 3);
function correct_single_post_category_in_permalink($permalink, $post, $leavename) {
    if ($post->post_type !== 'post') {
        return $permalink;
    }

    $categories = get_the_category($post->ID);

    if (!empty($categories)) {
        if (class_exists('WPSEO_Primary_Term')) {
            $wpseo_primary_term = new WPSEO_Primary_Term('category', $post->ID);
            $primary_term_id = $wpseo_primary_term->get_primary_term();
            $primary_category = get_category($primary_term_id);
            if (!is_wp_error($primary_category)) {
                $category_slug = $primary_category->slug;
            } else {
                $category_slug = $categories[0]->slug;
            }
        } else {
            $category_slug = $categories[0]->slug;
        }

        // Final permalink:
        $permalink = home_url("/$category_slug/artigos/$post->post_name/");
    }

    return $permalink;
}

function custom_glightbox_gallery_shortcode($output, $attr) {
    global $post;
    $ids = isset($attr['ids']) ? explode(',', $attr['ids']) : [];

    if (empty($ids)) return '';

    $output = '<div class="custom-glightbox-gallery">';
    $limit = 12;
    $total = count($ids);

    foreach ($ids as $index => $id) {
        $image_full = wp_get_attachment_url($id);
        $image_thumb = wp_get_attachment_image_url($id, 'medium');
        $title = get_the_title($id);
        $caption = trim(wp_get_attachment_caption($id));

        $attachment = get_post($id);
        $description = $attachment ? trim($attachment->post_content) : '';

        $data_title = esc_attr($title);
        $data_description = esc_attr($caption . ($description ? '<br><br>' . $description : ''));

        if ($index == $limit - 1 && $total > $limit) {
            $remaining = $total - $limit;
            $output .= '<a href="' . esc_url($image_full) . '" class="glightbox-gallery" data-gallery="post-gallery" data-title="' . $data_title . '" data-description="' . $data_description . '">';
            $output .= '<div style="position:relative; display:inline-block;">';
            $output .= '<img src="' . esc_url($image_thumb) . '" />';
            $output .= '<div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); color:#fff; font-size:24px; display:flex; align-items:center; justify-content:center;">+'.$remaining.'</div>';
            $output .= '</div></a>';
        } elseif ($index < $limit) {
            $output .= '<a href="' . esc_url($image_full) . '" class="glightbox-gallery" data-gallery="post-gallery" data-title="' . $data_title . '" data-description="' . $data_description . '">';
            $output .= '<img src="' . esc_url($image_thumb) . '" />';
            $output .= '</a>';
        } else {
            $output .= '<a href="' . esc_url($image_full) . '" class="glightbox-gallery" data-gallery="post-gallery" data-title="' . $data_title . '" data-description="' . $data_description . '" style="display:none;"></a>';
        }
    }

    $output .= '</div>';
    return $output;
}
add_filter('post_gallery', 'custom_glightbox_gallery_shortcode', 12, 2);

function enqueue_custom_glightbox_assets() {
    // Enqueue GLightbox CSS & JS
    wp_enqueue_style('glightbox-css', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css');
    wp_enqueue_script('glightbox-js', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', [], null, true);

    // Inert polyfill (optional; remove if not using `inert`)
    wp_enqueue_script('inert-polyfill', 'https://unpkg.com/wicg-inert@3.1.1/dist/inert.min.js', [], null, true);

    // Inline JS for initialization and accessibility fix
    wp_add_inline_script('glightbox-js', "
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox({
            selector: '.glightbox-gallery',
            touchNavigation: true,
            loop: true,
            zoomable: true,
            autoplayVideos: false,
            openEffect: 'fade',
            closeEffect: 'fade',
            slideEffect: 'fade'
        });

        const page = document.getElementById('page');

        // Watch for incorrect aria-hidden assignment
        if (page) {
            const observer = new MutationObserver(mutations => {
                for (const mutation of mutations) {
                    if (mutation.attributeName === 'aria-hidden' && page.getAttribute('aria-hidden') === 'true') {
                        page.removeAttribute('aria-hidden');
                        // If you really need inert fallback, uncomment the line below
                        // page.setAttribute('inert', '');
                    }
                }
            });
            observer.observe(page, { attributes: true });

            // Properly clean up on close using GLightbox's close event
            lightbox.on('close', () => {
                page.removeAttribute('inert');
            });
        }

        // Optional: remove focus from clicked thumbnails for better UX
        document.querySelectorAll('.glightbox-gallery').forEach(el => {
            el.addEventListener('click', function () {
                setTimeout(() => document.activeElement?.blur(), 10);
            });
        });
    });
");
}
add_action('wp_enqueue_scripts', 'enqueue_custom_glightbox_assets');