<?php
/**
 * Arorms Personal Blog functions and definitions
 *
 * @package Arorms
 * @since Arorms 2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include custom navigation walker
require_once get_template_directory() . '/inc/custom-nav-walker.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function arorms_setup() {
	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style.css' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Add support for automatic feed links.
	add_theme_support( 'automatic-feed-links' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Add support for HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'arorms' ),
			'footer'  => __( 'Footer Menu', 'arorms' ),
			'social'  => __( 'Social Menu', 'arorms' ),
		)
	);

	// Add support for custom background.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f8fafc',
			'default-image' => '',
		)
	);
}
add_action( 'after_setup_theme', 'arorms_setup' );

/**
 * Enqueue scripts and styles.
 */
function arorms_scripts() {
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'arorms-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Enqueue Tailwind CSS from CDN
	// wp_enqueue_style( 'tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/base.min.css', array(), '3.3.0' );
	// wp_enqueue_style( 'tailwind-components', 'https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/components.min.css', array(), '3.3.0' );
	// wp_enqueue_style( 'tailwind-utilities', 'https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/utilities.min.css', array(), '3.3.0' );

	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), '3.4.1', false );

	// Enqueue theme JavaScript
	wp_enqueue_script( 'arorms-script', get_template_directory_uri() . '/assets/js/theme.js', array(), wp_get_theme()->get( 'Version' ), true );

	// Add comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'arorms_scripts' );

/**
 * Add custom base styles for single post pages only
 */
function arorms_single_page_styles() {
	// Only apply to single post pages
	if ( ! is_single() ) {
		return;
	}
	?>
	<style>
		/* Custom base styles for single post content only */
		.single-post .prose h1,
		.single-post .prose h2,
		.single-post .prose h3,
		.single-post .prose h4,
		.single-post .prose h5,
		.single-post .prose h6,
		.single-post .wp-block-heading,
		.single-post article h1,
		.single-post article h2,
		.single-post article h3,
		.single-post article h4,
		.single-post article h5,
		.single-post article h6 {
			font-weight: bold;
			margin-top: 1em;
			margin-bottom: 0.5em;
			line-height: 1.2;
		}
		
		.single-post .prose h1,
		.single-post .wp-block-heading:first-child,
		.single-post article h1 {
			font-size: 2.25rem; /* 36px */
			margin-top: 0;
		}
		
		.single-post .prose h2,
		.single-post .wp-block-heading:nth-child(2),
		.single-post article h2 {
			font-size: 1.875rem; /* 30px */
		}
		
		.single-post .prose h3,
		.single-post article h3 {
			font-size: 1.5rem; /* 24px */
		}
		
		.single-post .prose h4,
		.single-post article h4 {
			font-size: 1.25rem; /* 20px */
		}
		
		.single-post .prose h5,
		.single-post article h5 {
			font-size: 1.125rem; /* 18px */
		}
		
		.single-post .prose h6,
		.single-post article h6 {
			font-size: 1rem; /* 16px */
		}
		
		.single-post .prose p,
		.single-post article p {
			margin-top: 1em;
			margin-bottom: 1em;
			line-height: 1.6;
		}
		
		.single-post .prose a:not(.wp-element-button),
		.single-post article a:not(.wp-element-button) {
			color: #3b82f6; /* blue-500 */
			text-decoration: underline;
		}
		
		.single-post .prose a:not(.wp-element-button):hover,
		.single-post article a:not(.wp-element-button):hover {
			color: #1d4ed8; /* blue-700 */
		}
		
		.single-post .prose ul,
		.single-post .prose ol,
		.single-post article ul,
		.single-post article ol {
			margin-top: 1em;
			margin-bottom: 1em;
			padding-left: 2em;
		}
		
		.single-post .prose li,
		.single-post article li {
			margin-bottom: 0.5em;
		}
		
		.single-post .prose blockquote,
		.single-post article blockquote {
			border-left: 4px solid #e5e7eb; /* gray-200 */
			padding-left: 1em;
			margin: 1.5em 0;
			font-style: italic;
			color: #4b5563; /* gray-600 */
		}
		
		.single-post .prose code:not(pre code),
		.single-post article code:not(pre code) {
			background-color: #f3f4f6; /* gray-100 */
			padding: 0.2em 0.4em;
			border-radius: 0.25rem;
			font-family: monospace;
			font-size: 0.875em;
		}
		
		.single-post .prose pre,
		.single-post article pre {
			background-color: #1f2937; /* gray-800 */
			color: #f9fafb; /* gray-50 */
			padding: 1em;
			border-radius: 0.5rem;
			overflow-x: auto;
			margin: 1.5em 0;
		}
		
		.single-post .prose pre code,
		.single-post article pre code {
			background-color: transparent;
			padding: 0;
			color: inherit;
			font-size: inherit;
		}
		
		.single-post .prose table,
		.single-post article table {
			width: 100%;
			border-collapse: collapse;
			margin: 1.5em 0;
		}
		
		.single-post .prose th,
		.single-post .prose td,
		.single-post article th,
		.single-post article td {
			border: 1px solid #e5e7eb; /* gray-200 */
			padding: 0.75em;
			text-align: left;
		}
		
		.single-post .prose th,
		.single-post article th {
			background-color: #f9fafb; /* gray-50 */
			font-weight: bold;
		}
		
		.single-post .prose img,
		.single-post article img {
			max-width: 100%;
			height: auto;
		}
		
		.single-post .prose hr,
		.single-post article hr {
			border: 0;
			border-top: 1px solid #e5e7eb; /* gray-200 */
			margin: 2em 0;
		}
		
		/* Ensure WordPress block editor styles work with our theme */
		.single-post .wp-block-heading {
			font-weight: bold;
		}
		
		/* Make sure prose class works properly */
		.single-post .prose {
			color: #374151; /* gray-700 */
		}
		
		.single-post .prose :where(h1, h2, h3, h4, h5, h6) {
			color: #111827; /* gray-900 */
		}
	</style>
	<?php
}
add_action( 'wp_head', 'arorms_single_page_styles', 20 );

/**
 * Register widget areas.
 */
function arorms_widgets_init() {
	// Main Sidebar
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'arorms' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'arorms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s bg-white p-6 rounded-lg shadow-md mb-6">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-xl font-bold text-gray-800 mb-4 pb-2 border-b">',
			'after_title'   => '</h3>',
		)
	);

	// Footer Widget Area 1
	register_sidebar(
		array(
			'name'          => __( 'Footer Column 1', 'arorms' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add widgets here to appear in the first footer column.', 'arorms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
			'after_title'   => '</h3>',
		)
	);

	// Footer Widget Area 2
	register_sidebar(
		array(
			'name'          => __( 'Footer Column 2', 'arorms' ),
			'id'            => 'footer-2',
			'description'   => __( 'Add widgets here to appear in the second footer column.', 'arorms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
			'after_title'   => '</h3>',
		)
	);

	// Footer Widget Area 3
	register_sidebar(
		array(
			'name'          => __( 'Footer Column 3', 'arorms' ),
			'id'            => 'footer-3',
			'description'   => __( 'Add widgets here to appear in the third footer column.', 'arorms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
			'after_title'   => '</h3>',
		)
	);

	// Footer Widget Area 4
	register_sidebar(
		array(
			'name'          => __( 'Footer Column 4', 'arorms' ),
			'id'            => 'footer-4',
			'description'   => __( 'Add widgets here to appear in the fourth footer column.', 'arorms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'arorms_widgets_init' );

/**
 * Custom excerpt length.
 */
function arorms_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'arorms_excerpt_length' );

/**
 * Custom excerpt more.
 */
function arorms_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'arorms_excerpt_more' );

/**
 * Add custom classes to body.
 */
function arorms_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'arorms_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function arorms_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'arorms_pingback_header' );

/**
 * Ensure compatibility with Enlighter plugin.
 */
function arorms_enlighter_compatibility() {
	// Add support for Enlighter code syntax highlighter
	if ( class_exists( 'Enlighter' ) ) {
		// Add custom CSS for Enlighter in our theme
		add_action( 'wp_enqueue_scripts', function() {
			wp_add_inline_style( 'arorms-style', '
				.enlighter-default {
					border-radius: 0.5rem;
					margin: 1.5rem 0;
				}
				.enlighter-toolbar {
					border-radius: 0.5rem 0.5rem 0 0;
				}
				.enlighter-code {
					border-radius: 0 0 0.5rem 0.5rem;
				}
			' );
		});
	}
}
add_action( 'after_setup_theme', 'arorms_enlighter_compatibility' );

/**
 * Add theme support for block patterns.
 */
function arorms_register_block_patterns() {
	register_block_pattern_category(
		'arorms-patterns',
		array(
			'label' => __( 'Arorms Patterns', 'arorms' ),
		)
	);
}
add_action( 'init', 'arorms_register_block_patterns' );

/**
 * Add support for blog page
 */
function arorms_blog_setup() {
	// Add support for blog page
	add_theme_support( 'blog-page' );
}
add_action( 'after_setup_theme', 'arorms_blog_setup' );

/**
 * Custom blog page title
 */
function arorms_blog_page_title( $title ) {
	if ( is_home() && ! is_front_page() ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'arorms_blog_page_title' );

/**
 * Add featured post meta box
 */
function arorms_add_featured_meta_box() {
	add_meta_box(
		'arorms_featured_meta',
		__( 'Featured Post', 'arorms' ),
		'arorms_featured_meta_callback',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'arorms_add_featured_meta_box' );

/**
 * Featured meta box callback
 */
function arorms_featured_meta_callback( $post ) {
	wp_nonce_field( 'arorms_featured_meta', 'arorms_featured_meta_nonce' );
	$value = get_post_meta( $post->ID, '_is_featured', true );
	?>
	<label for="arorms_featured">
		<input type="checkbox" id="arorms_featured" name="arorms_featured" value="1" <?php checked( $value, '1' ); ?>>
		<?php _e( 'Mark as featured post', 'arorms' ); ?>
	</label>
	<?php
}

/**
 * Save featured meta box data
 */
function arorms_save_featured_meta( $post_id ) {
	if ( ! isset( $_POST['arorms_featured_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['arorms_featured_meta_nonce'], 'arorms_featured_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	$featured = isset( $_POST['arorms_featured'] ) ? '1' : '0';
	update_post_meta( $post_id, '_is_featured', $featured );
}
add_action( 'save_post', 'arorms_save_featured_meta' );

/**
 * Add subtitle meta box
 */
function arorms_add_subtitle_meta_box() {
	add_meta_box(
		'arorms_subtitle_meta',
		__( 'Subtitle', 'arorms' ),
		'arorms_subtitle_meta_callback',
		'post',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'arorms_add_subtitle_meta_box' );

/**
 * Subtitle meta box callback
 */
function arorms_subtitle_meta_callback( $post ) {
	wp_nonce_field( 'arorms_subtitle_meta', 'arorms_subtitle_meta_nonce' );
	$value = get_post_meta( $post->ID, 'subtitle', true );
	?>
	<label for="arorms_subtitle">
		<?php _e( 'Subtitle (optional):', 'arorms' ); ?>
	</label>
	<input type="text" id="arorms_subtitle" name="arorms_subtitle" value="<?php echo esc_attr( $value ); ?>" style="width: 100%; margin-top: 5px;">
	<?php
}

/**
 * Save subtitle meta box data
 */
function arorms_save_subtitle_meta( $post_id ) {
	if ( ! isset( $_POST['arorms_subtitle_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['arorms_subtitle_meta_nonce'], 'arorms_subtitle_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if ( isset( $_POST['arorms_subtitle'] ) ) {
		update_post_meta( $post_id, 'subtitle', sanitize_text_field( $_POST['arorms_subtitle'] ) );
	}
}
add_action( 'save_post', 'arorms_save_subtitle_meta' );
add_filter( 'big_image_size_threshold', '__return_false' );

/**
 * Generate table of contents from post content
 */
function arorms_generate_toc( $content = null ) {
    // Only generate TOC for single posts
    if ( ! is_single() ) {
        return '';
    }
    
    // If no content provided, get current post content
    if ( $content === null ) {
        global $post;
        if ( ! $post ) {
            return '';
        }
        $content = $post->post_content;
    }
    
    // Extract headings h1-h3
    $pattern = '/<h([1-3])(?:.*?)>(.*?)<\/h[1-3]>/i';
    preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER );
    
    if ( empty( $matches ) ) {
        return '<div class="toc-empty bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Table of Contents</h3>
                    <p class="text-gray-600 text-center py-4">No headings found in this article.</p>
                </div>';
    }
    
    $toc_html = '<div class="toc-widget bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Table of Contents</h3>
                    <nav class="toc-nav" aria-label="Article navigation">';
    
    $current_level = 0;
    $toc_items = array();
    
    foreach ( $matches as $index => $match ) {
        $level = intval( $match[1] );
        $title = strip_tags( $match[2] );
        $title = trim( $title );
        
        // Generate slug for anchor
        $slug = sanitize_title( $title );
        $slug = 'section-' . ( $index + 1 ) . '-' . $slug;
        
        $toc_items[] = array(
            'level' => $level,
            'title' => $title,
            'slug'  => $slug,
            'index' => $index
        );
    }
    
    // Build hierarchical TOC
    $prev_level = 0;
    foreach ( $toc_items as $item ) {
        $level = $item['level'];
        $title = $item['title'];
        $slug = $item['slug'];
        
        // Add level class for styling
        $level_class = 'toc-level-' . $level;
        $indent_class = '';
        
        if ( $level == 2 ) {
            $indent_class = 'ml-4';
        } elseif ( $level == 3 ) {
            $indent_class = 'ml-8';
        }
        
        $toc_html .= '<a href="#' . esc_attr( $slug ) . '" 
                         class="toc-item ' . $level_class . ' ' . $indent_class . ' block py-2 text-gray-700 hover:text-blue-600 transition-colors border-l-2 border-transparent hover:border-blue-500 pl-2">
                         ' . esc_html( $title ) . '
                      </a>';
        
        $prev_level = $level;
    }
    
    $toc_html .= '</nav></div>';
    
    return $toc_html;
}

/**
 * Add IDs to headings in post content for TOC linking
 */
function arorms_add_heading_ids( $content ) {
    if ( ! is_single() ) {
        return $content;
    }
    
    $pattern = '/<h([1-3])(?:.*?)>(.*?)<\/h[1-3]>/i';
    preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER );
    
    foreach ( $matches as $index => $match ) {
        $full_match = $match[0];
        $level = $match[1];
        $title = strip_tags( $match[2] );
        $title = trim( $title );
        
        // Generate slug for anchor
        $slug = sanitize_title( $title );
        $slug = 'section-' . ( $index + 1 ) . '-' . $slug;
        
        // Check if heading already has an ID
        if ( strpos( $full_match, 'id=' ) === false ) {
            // Add ID to heading
            $new_heading = str_replace( '<h' . $level, '<h' . $level . ' id="' . $slug . '"', $full_match );
            $content = str_replace( $full_match, $new_heading, $content );
        }
    }
    
    return $content;
}
add_filter( 'the_content', 'arorms_add_heading_ids' );

/**
 * Enqueue TOC scripts and styles
 */
function arorms_toc_scripts() {
    if ( is_single() ) {
        wp_enqueue_script( 'arorms-toc-script', get_template_directory_uri() . '/assets/js/toc.js', array(), wp_get_theme()->get( 'Version' ), true );
        wp_add_inline_style( 'arorms-style', '
            .toc-item {
                position: relative;
                transition: all 0.2s ease;
            }
            .toc-item.toc-level-1 {
                font-weight: 600;
                font-size: 1rem;
            }
            .toc-item.toc-level-2 {
                font-weight: 500;
                font-size: 0.95rem;
            }
            .toc-item.toc-level-3 {
                font-weight: 400;
                font-size: 0.9rem;
                color: #6b7280;
            }
            .toc-item.active {
                color: #3b82f6;
                border-left-color: #3b82f6 !important;
                background-color: #eff6ff;
            }
            /* Remove sticky positioning and scrollbar */
            .toc-widget {
                position: static;
                max-height: none;
                overflow-y: visible;
            }
        ' );
    }
}
add_action( 'wp_enqueue_scripts', 'arorms_toc_scripts' );
