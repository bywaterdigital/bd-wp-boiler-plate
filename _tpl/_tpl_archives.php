<?php
$archiveTitle = single_month_title('', false);
$archiveYear = substr($archiveTitle, -4);
$archiveMonth = strtolower(substr($archiveTitle, 0, -4));
$archiveMonth = date('m', strtotime($archiveMonth));

$postType = $_GET['type'];
?>
<?php get_header(); ?>

<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
  
  <?php
    global $paged;
    if(empty($paged)) $paged = 1;
    
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => 5,
        'paged' => $paged,
        'year' => $archiveYear,
        'monthnum' => $archiveMonth
    );									
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
      <div class="newsandarticle">
        <h2><?php the_title(); ?></h2>
        <div class="pubDate"><?php the_date(); ?></div>
        <?php if(get('settings_feature_image')!=''){ ?><img class="mainImg" src="<?php echo get_template_directory_uri(); ?>/includes/phpthumb/phpThumb.php?src=<?php echo get('settings_feature_image'); ?>&w=120&h=120&zc=C" ><?php } ?>
        <?php the_excerpt(); ?>
        <p><a href="<?php the_permalink(); ?>">Read more</a></p>
        <p class="filed">Filed under: <?php the_category(' ') ?></p>
        <p class="tagged"><span class="tas">Tagged as:</span> <?php the_tags(' ', ' ', ' '); ?> </p>
      </div>
    <?php }
    } wp_reset_postdata();
    ?>
  
    <div class="pagination-centered">
    <?php
      //pagination
      kriesi_pagination($the_query->max_num_pages);		  
      wp_reset_postdata();
    ?>
    </div>
    
<?php get_footer(); ?>