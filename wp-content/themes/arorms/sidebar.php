<aside class="space-y-8">
    <!-- Search Widget -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Search</h3>
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="relative">
                <input type="search" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'arorms' ); ?>" 
                       value="<?php echo get_search_query(); ?>" 
                       name="s" />
                <button type="submit" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Table of Contents (only on single post pages) -->
    <?php if ( is_single() ) : ?>
        <?php echo arorms_generate_toc(); ?>
    <?php else : ?>
        <!-- About Me Widget (shown on non-single pages) -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">About Me</h3>
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold font-serif text-xl">
                    C
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Cacciatore</h4>
                    <p class="text-sm text-gray-600">Owner & Developer</p>
                </div>
            </div>
            <p class="text-gray-500 italic font-serif">
                You will know the truth, and the truth will set you free.
            </p>
        </div>
    <?php endif; ?>

    <!-- Recent Posts Widget -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Recent Posts</h3>
        <?php
        $recent_posts = wp_get_recent_posts(
            array(
                'numberposts' => 5,
                'post_status' => 'publish',
            )
        );
        if ( $recent_posts ) :
            ?>
            <ul class="space-y-3">
                <?php foreach ( $recent_posts as $post ) : ?>
                    <li class="border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                        <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>" 
                           class="text-gray-700 hover:text-blue-600 transition-colors flex items-start space-x-3">
                            <span class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></span>
                            <span class="flex-grow"><?php echo esc_html( $post['post_title'] ); ?></span>
                        </a>
                        <span class="text-xs text-gray-500 block mt-1">
                            <?php echo get_the_date( '', $post['ID'] ); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Categories Widget -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Categories</h3>
        <?php
        $categories = get_categories(
            array(
                'orderby' => 'name',
                'order'   => 'ASC',
            )
        );
        if ( $categories ) :
            ?>
            <ul class="space-y-2">
                <?php foreach ( $categories as $category ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
                           class="text-gray-700 hover:text-blue-600 transition-colors flex justify-between items-center">
                            <span><?php echo esc_html( $category->name ); ?></span>
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                                <?php echo esc_html( $category->count ); ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Tags Widget -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Popular Tags</h3>
        <?php
        $tags = get_tags(
            array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'number'  => 10,
            )
        );
        if ( $tags ) :
            ?>
            <div class="flex flex-wrap gap-2">
                <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" 
                       class="inline-block bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 px-3 py-1 rounded-full text-sm transition-colors">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Newsletter Widget -->
    <!-- <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-4">Newsletter</h3>
        <p class="mb-4 text-blue-100">Subscribe to get the latest posts directly in your inbox.</p>
        <form class="space-y-3">
            <input type="email" 
                   placeholder="Your email address" 
                   class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent text-white placeholder-blue-200">
            <button type="submit" 
                    class="w-full bg-white text-blue-600 hover:bg-gray-100 font-semibold py-2 px-4 rounded-lg transition-colors">
                Subscribe
            </button>
        </form>
    </div> -->

    <!-- Dynamic Sidebar Widgets -->
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php endif; ?>
</aside>