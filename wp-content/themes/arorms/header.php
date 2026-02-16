<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50 text-gray-800 antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="absolute sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Logo and Site Title -->
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ( display_header_text() ) : ?>
                        <div class="site-branding">
                            <h1 class="site-title text-2xl font-bold text-gray-900">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </h1>
                            <?php
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) :
                                ?>
                                <p class="site-description text-gray-600 text-sm mt-1">
                                    <?php echo $description; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Primary Navigation -->
                <nav class="w-full md:w-auto" aria-label="<?php esc_attr_e( 'Primary Menu', 'arorms' ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'menu_class'      => 'flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6',
                            'container_class' => 'primary-navigation',
                            'fallback_cb'     => false,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'          => new Arorms_Walker_Nav_Menu(),
                        )
                    );
                    ?>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        aria-label="Toggle menu" 
                        aria-expanded="false"
                        id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden mt-4" id="mobile-menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary',
                        'menu_class'      => 'flex flex-col space-y-2',
                        'container_class' => 'mobile-navigation',
                        'fallback_cb'     => false,
                    )
                );
                ?>
            </div>
        </div>
    </header>

    <!-- Hero Section (only on homepage) -->
    <?php if ( is_front_page() && ! is_paged() ) : ?>
    <section class="relative bg-fixed min-h-screen bg-cover bg-center text-white flex items-center justify-center overflow-hidden -mt-16 pt-16"
             style="background-image: url('/wp-content/themes/arorms/assets/images/background-1.jpg');">
        
        <div class="absolute inset-0 bg-gray-900/40 z-0"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-4xl mx-auto space-y-6">
                <h1 class="font-sans text-4xl md:text-6xl font-extrabold tracking-tight mb-4 drop-shadow-lg">
                    BLOG OF CACCIATORE
                </h1>
                
                <p class="text-lg font-serif md:text-3xl mb-8 text-gray-100 drop-shadow-md leading-relaxed">
                    Ask, and it will be given to you.<br>
                    Seek, and you will find.<br>
                    Knock, and the door will be opened to you.<br>
                    MATTHEW 7:7
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                    <a href="#recent-posts" class="bg-blue-600 text-white hover:bg-blue-700 px-8 py-3 rounded-full font-bold shadow-lg transition-all transform hover:-translate-y-1">
                        Browse all articles
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" 
                       class="bg-white/10 backdrop-blur-md border border-white/30 hover:bg-white/20 px-8 py-3 rounded-full font-bold transition-all transform hover:-translate-y-1">
                        Read latest article
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
    </section>
<?php endif; ?>

    <!-- Main Content Area -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8 items-stretch">
