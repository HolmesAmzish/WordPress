<!DOCTYPE html>
<html>
<head>
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head();?>
</head>
<body>
<h1>Blog of Cacciatore</h1>
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_title('<h2>', '</h2>');
        the_excerpt();
    endwhile;
endif;
?>
<?php wp_footer();?>
</body>
</html>