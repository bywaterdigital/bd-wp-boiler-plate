<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <?php wp_head(); ?>
    
    <link href="<?php echo get_template_directory_uri(); ?>/includes/css/mainCSS.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/includes/css/responsiveCSS.css" rel="stylesheet" type="text/css">
    
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body <?php body_class( $class ); ?>>

	<div id="site_wrapper">
    
    	<div id="header_wrapper">
                        
            <div id="main_nav_wrappper">
                <?php 
                    $args = array(
                    'menu_class' => 'left',
                    'theme_location' => 'Main Menu',
                    'depth'           => 1,
					'items_wrap' => '<ul class="main_nav nav" data-attr="abc" itemscope="itemscope" itemtype="http://www.schema.org/SiteNavigationElement">%3$s</ul>',
                    'container' => false,
					//'walker' => new My_Walker_Nav_Menu(),
                    );
                    //wp_nav_menu($args);
                ?>   
            </div><!-- close main_nav_wrapper -->                   
        	
        </div><!-- close header_wrapper -->