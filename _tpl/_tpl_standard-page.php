<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
$post_id = get_the_id();
$post_type = get_post_type();

$vc_active = false;
$post = get_post();
if ( $post && preg_match( '/vc_row/', $post->post_content ) ) {
    $vc_active = true;
}
?>

<?php if($vc_active){ ?>
<div class="container">
	<?php the_content(); ?>
</div>
<?php }else{ ?>
<div class="basic_page_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main_content">
					<?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
        
<?php endwhile; endif; ?>
<?php get_footer(); ?>