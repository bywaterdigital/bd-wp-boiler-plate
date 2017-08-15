<?php 
session_start();
$path = '_tpl/_tpl_standard-taxonomy.php';

$taxonomy = get_query_var( 'taxonomy' );

//specific term data
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$termName = $term->name;

switch($taxonomy){
	//case 'tax': $path = '_tpl/_tpl_tax.php'; break;
}

include($path);
?>