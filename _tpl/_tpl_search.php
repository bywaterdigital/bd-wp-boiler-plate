<?php get_header(); ?>

    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        //get data
        $my_link = get_the_permalink();
        $obj = get_post_type_object( get_post_type() );
        $post_type_name = $obj->labels->name;
        if( $post_type_name=='Posts' ){ $post_type_name = 'News'; }
        $post_type_name_singular = $obj->labels->singular_name;
        if( $post_type_name_singular=='Post' ){ $post_type_name_singular = 'News'; }
        ?>
        
        <div class="item">
          <h3><a href="<?php echo $my_link; ?>"><?php the_title(); ?></a></h3>
          <?php echo the_excerpt(); ?>
          <a href="<?php echo $my_link; ?>">Read more...</a>
        </div> 
          
        <?php endwhile; endif; ?>
    </div>

<?php get_footer(); ?>