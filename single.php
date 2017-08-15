<?php 
global $postType;

$path = '_tpl/_tpl_standard-post.php';

//get post type
$postType = get_post_type();

//set template if necessary
switch($catID){
	//case 0: $path = '_tpl/_tpl_.php'; break;
}

switch($postType){
	//case '': $path = '_tpl/_tpl_.php'; break;
}

//include template file
include($path);
?>