<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

HTML HERE
        
<?php endwhile; endif; ?>
<?php get_footer(); ?>