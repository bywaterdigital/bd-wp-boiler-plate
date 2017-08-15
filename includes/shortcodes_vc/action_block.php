<?php
add_action( 'vc_before_init', 'vc_action_block' );
function vc_action_block() {
   vc_map( array(
      "name" => __( "Action Block", "Generic" ),
      "icon" => "icon-theme",
      "base" => "action_block",
      "category" => __( "Generic", "Generic"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "strong",
            "heading" => __( "Title", "Generic" ),
            "param_name" => "title"
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __( "Body", "Generic" ),
            "param_name" => "body"
         ),
         array(
            "type" => "textfield",
            "heading" => __( "Link", "Generic" ),
            "param_name" => "link"
         ),
         array(
            "type" => "attach_image",
            "heading" => __( "Image", "Generic" ),
            "param_name" => "image"
         ),
      )
   ) );
}

function action_block_func($atts){
	$a = shortcode_atts( array(
        'image' => '',
        'title' => '',
        'body' => '',
        'link' => '',
    ), $atts );
	
	$image = wp_get_attachment_url( $a['image'] );
    
	$string = '
	<div class="cases no-pad">
        <section>
          <a href="'.$a['link'].'"><img class="img-responsive underlined" src="'.$image.'" alt=""> </a>              
          <div class="donate-detail"> 
            <a href="'.$a['link'].'" class="head">'.$a['title'].'</a>
            <hr>
            <p>'.$a['body'].'</p>
          </div>
          <a href="'.$a['link'].'" class="btn">Read more</a>
        </section>
    </div>
	';
	return $string;
}
add_shortcode( 'action_block', 'action_block_func' );
?>