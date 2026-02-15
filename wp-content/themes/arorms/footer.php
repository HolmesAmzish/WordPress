        </div><!-- Close main content flex container -->
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-auto">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Column 1: About -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-white mb-4">About This Blog</h3>
                    <p class="text-gray-400">
                        A personal space for sharing thoughts, experiences, and insights from my journey. 
                        Join me as I explore technology, creativity, and life lessons.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://x.com/HolmesAmzish" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="https://github.com/HolmesAmzish" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">GitHub</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Quick Links</h3>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'space-y-2',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                </div>

                <!-- Column 3: Recent Posts -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Recent Posts</h3>
                    <?php
                    $recent_posts = wp_get_recent_posts(
                        array(
                            'numberposts' => 3,
                            'post_status' => 'publish',
                        )
                    );
                    if ( $recent_posts ) :
                        ?>
                        <ul class="space-y-3">
                            <?php foreach ( $recent_posts as $post ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>" 
                                       class="text-gray-400 hover:text-white transition-colors flex items-start space-x-3">
                                        <span class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></span>
                                        <span><?php echo esc_html( $post['post_title'] ); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Column 4: Newsletter -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white mb-4">Stay Updated</h3>
                    <p class="text-gray-400">Subscribe to get notified about new posts and updates.</p>
                    <form class="space-y-3">
                        <input type="email" 
                               placeholder="Your email address" 
                               class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white">
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Widget Areas -->
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-4 py-8">

            
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <div><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <?php endif; ?>
                    
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <?php endif; ?>
                    
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    <?php endif; ?>
                    
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <div><?php dynamic_sidebar( 'footer-4' ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="bg-gray-950 py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-500 text-sm mb-4 md:mb-0">
                        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
                    </div>
                    <div class="text-gray-500 text-sm">
                        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'arorms' ) ); ?>" 
                           class="hover:text-white transition-colors">
                            <?php
                            printf(
                                /* translators: %s: WordPress. */
                                esc_html__( 'Proudly powered by %s', 'arorms' ),
                                'WordPress'
                            );
                            ?>
                        </a>
                        <span class="mx-2">•</span>
                        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" 
                           class="hover:text-white transition-colors">
                            Privacy Policy
                        </a>
                        <span class="mx-2">•</span>
                        <a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>" 
                           class="hover:text-white transition-colors">
                            Terms of Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <!-- Theme JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isExpanded);
            menu.classList.toggle('hidden');
            
            // Update button icon
            const icon = this.querySelector('svg');
            if (!isExpanded) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</div><!-- Close page div -->
</body>
</html>