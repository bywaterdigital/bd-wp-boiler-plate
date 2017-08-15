<?php get_header(); ?> 
<?php
//get category data
$catActive = true;
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$category_name = $categories[0]->cat_name;

$categoryTermSlug = get_queried_object()->slug;

//switch to tag
if (strpos($_SERVER[REQUEST_URI],'tag') != false) {
    $category_id = intval( get_query_var('tag_id') );
	$category_name = get_query_var('tag');
	$catActive = false;
}
?>

<h1 class="titlers">Post matching '<?php echo $category_name; ?><?php single_term_title(); ?>'</h1>
<?php the_content(); ?>
  
  <?php
    global $paged;
    if(empty($paged)) $paged = 1;
    
    if($catActive){
        $args = array( 
            'post_type' => array('news','technical_article'),
            'category_name'		=> $categoryTermSlug,
            'paged' => $paged
        );	
    }else{
        $args = array( 
            'post_type' => array('news','technical_article'),
            'tag_id'		=> $category_id,
            'paged' => $paged
        );	
    }
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) { $the_query->the_post(); 
	  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	  ?>
	  <div class="newsandarticle">
		<h2><?php the_title(); ?></h2>
		<div class="pubDate"><?php the_date(); ?></div>
		<?php if($feat_image){ the_post_thumbnail('medium'); } ?>
		<?php the_excerpt(); ?>
		<p><a href="<?php the_permalink(); ?>">Read more</a></p>
		<p class="filed">Filed under: <?php the_category(' ') ?></p>
		<p class="tagged"><span class="tas">Tagged as:</span> <?php the_tags(' ', ' ', ' '); ?> </p>
	  </div>
	<?php }
    
    }else{
        echo '<p>There are no posts matching your criteria.</p>';
    }
    ?>
  
    <div class="pagination-centered">
    <?php
      //pagination
      kriesi_pagination($the_query->max_num_pages);		  
      wp_reset_postdata();
    ?>
    </div>

<?php get_template_part( 'sidebar-tech-articles', 'index' ); ?>
    
<?php get_footer(); ?>