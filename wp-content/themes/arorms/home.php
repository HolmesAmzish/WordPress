<?php
/**
 * The template for displaying blog posts index
 *
 * This is the template that displays all blog posts by default.
 *
 * @package Arorms
 */

get_header();
?>

<!-- Main Content Area -->
<div class="flex flex-col lg:flex-row gap-8">
    <!-- Primary Content -->
    <div class="lg:w-3/4">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900"><?php single_post_title(); ?></h1>
            <?php
            $description = get_the_archive_description();
            if ( $description ) :
                ?>
                <div class="mt-4 text-gray-600 prose max-w-none">
                    <?php echo wp_kses_post( $description ); ?>
                </div>
            <?php endif; ?>
        </header>

        <!-- Blog Posts -->
        <section id="blog-posts">
            <?php if ( have_posts() ) : ?>
                <div class="space-y-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-64 object-cover' ) ); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <header class="mb-4">
                                    <?php if ( 'post' === get_post_type() ) : ?>
                                        <div class="flex flex-wrap items-center text-sm text-gray-500 mb-2">
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
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                </header>
                                
                                <div class="prose max-w-none text-gray-700 mb-4">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="flex flex-wrap justify-between items-center pt-4 border-t">
                                    <a href="<?php the_permalink(); ?>" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                    
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
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-12 flex justify-center">
                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => __( 'Previous', 'arorms' ),
                            'next_text' => __( 'Next', 'arorms' ),
                            'class'     => 'pagination',
                        )
                    );
                    ?>
                </nav>
            <?php else : ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts found</h3>
                    <p class="text-gray-600">Try adjusting your search or filter to find what you're looking for.</p>
                </div>
            <?php endif; ?>
        </section>
    </div><!-- End Primary Content -->

    <!-- Sidebar -->
    <div class="lg:w-1/4">
        <?php get_sidebar(); ?>
    </div>
</div><!-- End flex container -->

<?php
get_footer();