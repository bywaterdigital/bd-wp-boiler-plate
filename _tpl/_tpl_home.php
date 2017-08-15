<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
$post_id = get_the_id();
$post_type = get_post_type();
?>

<?php the_content(); ?>
        
<?php endwhile; endif; ?>
<?php get_footer(); ?>