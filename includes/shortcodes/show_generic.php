<?php
function generic_func($atts){
	$a = shortcode_atts( array(
        'cat' => ''
    ), $atts );
	
	//return "cat = {$a['cat']}";
	?>
	html content here
	<?php
}
add_shortcode( 'show_generic', 'generic_func' );
?>