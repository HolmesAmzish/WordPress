<?php
/**
 * The template for displaying single posts
 *
 * @package Arorms
 */

get_header();
?>

<!-- Main Content Area -->
<div class="flex flex-col lg:flex-row gap-8">
    <!-- Primary Content -->
    <div class="lg:w-3/4">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-lg shadow-md overflow-hidden' ); ?>>
                <!-- Post Header -->
                <header class="p-6 border-b">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-6">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg' ) ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="mr-4 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <?php the_author(); ?>
                        </span>
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                            ?>
                            <span class="mr-4 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                </svg>
                                <?php echo esc_html( $categories[0]->name ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php
                        $tags = get_the_tags();
                        if ( $tags ) :
                            ?>
                            <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                                <?php foreach ( $tags as $tag ) : ?>
                                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" 
                                       class="inline-block bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 px-3 py-1 rounded-full text-sm transition-colors">
                                        <?php echo esc_html( $tag->name ); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h1>
                    
                    <?php
                    $subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
                    if ( $subtitle ) :
                        ?>
                        <p class="text-xl text-gray-600 mb-4"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                </header>
                
                <!-- Post Content -->
                <div class="p-6">
                    <div class="prose max-w-none text-gray-800">
                        <?php the_content(); ?>
                        
                        <?php
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links mt-8 pt-4 border-t"><span class="page-links-title">' . __( 'Pages:', 'arorms' ) . '</span>',
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div>
                </div>
                
                <!-- Post Footer -->
                <footer class="p-6 border-t bg-gray-50">
                    <!-- Author Bio -->
                    <?php
                    $author_id = get_the_author_meta( 'ID' );
                    $author_description = get_the_author_meta( 'description' );
                    if ( $author_description ) :
                        ?>
                        <div class="flex items-start gap-4 mb-6 p-4 bg-white rounded-lg shadow-sm">
                            <div class="flex-shrink-0">
                                <?php echo get_avatar( $author_id, 80, '', '', array( 'class' => 'rounded-full' ) ); ?>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">About <?php the_author(); ?></h3>
                                <p class="text-gray-700"><?php echo esc_html( $author_description ); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Post Navigation -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
                        <div class="flex-1">
                            <?php
                            $prev_post = get_previous_post();
                            if ( $prev_post ) :
                                ?>
                                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" 
                                   class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                    <div class="text-sm text-gray-500 mb-1">Previous Post</div>
                                    <div class="font-semibold text-gray-900"><?php echo esc_html( $prev_post->post_title ); ?></div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <?php
                            $next_post = get_next_post();
                            if ( $next_post ) :
                                ?>
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>" 
                                   class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow text-right">
                                    <div class="text-sm text-gray-500 mb-1">Next Post</div>
                                    <div class="font-semibold text-gray-900"><?php echo esc_html( $next_post->post_title ); ?></div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Related Posts -->
                    <?php
                    $related_posts = arorms_get_related_posts( get_the_ID() );
                    if ( $related_posts->have_posts() ) :
                        ?>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Related Posts</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php
                                while ( $related_posts->have_posts() ) :
                                    $related_posts->the_post();
                                    ?>
                                    <a href="<?php the_permalink(); ?>" 
                                       class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        <h4 class="font-semibold text-gray-900 mb-2"><?php the_title(); ?></h4>
                                        <p class="text-sm text-gray-600"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                                    </a>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Comments -->
                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        ?>
                        <div class="mt-8 pt-6 border-t">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>
        <?php endwhile; ?>
    </div><!-- End Primary Content -->

    <!-- Sidebar -->
    <div class="lg:w-1/4">
        <?php get_sidebar(); ?>
    </div>
</div><!-- End flex container -->

<?php
get_footer();

/**
 * Get related posts by category
 */
function arorms_get_related_posts( $post_id, $number = 2 ) {
    $categories = get_the_category( $post_id );
    
    if ( ! $categories ) {
        return new WP_Query();
    }
    
    $category_ids = array();
    foreach ( $categories as $category ) {
        $category_ids[] = $category->term_id;
    }
    
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $number,
        'post__not_in'   => array( $post_id ),
        'category__in'   => $category_ids,
        'orderby'        => 'rand',
    );
    
    return new WP_Query( $args );
}