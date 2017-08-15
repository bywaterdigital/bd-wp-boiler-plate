<?php
/******** Container Box ************/
add_action( 'vc_before_init', 'vc_container_box' );
function vc_container_box() {
   vc_map( array(
      "name" => __( "Container Box", "Generic" ),
      "icon" => "icon-theme",
      "base" => "container_box",
	  "content_element" => true,
	  "as_parent" => array(),
	  "is_container" => true,
      "category" => __( "Generic", "Generic"),
      "params" => array(
         array(
            "type" => "dropdown",
            "heading" => __( "Background", "Generic" ),
            "param_name" => "background",
            "value" => array( "none", "white" ),
         ),
      ),
      "js_view" => 'VcColumnView'
   ) );
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Container_Box extends WPBakeryShortCodesContainer {
    }
}

function container_box_func($atts, $content = null){
	$a = shortcode_atts( array(
        'background' => 'none',
    ), $atts );
    
	$string = '
	<div class="container_box '.$a['background'].'">
       '.do_shortcode($content).'
    </div>
	';
	return $string;
}
add_shortcode( 'container_box', 'container_box_func' );
?>