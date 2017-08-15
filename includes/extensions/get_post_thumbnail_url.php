<?php
function get_post_thumbnail_url( $size='thumbnail', $id=0 ){
	global $post;
	if($id==0){ $id=$post->ID; }
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size );
	$thumb_url = $thumb['0'];
	
	return $thumb_url;
}
?>